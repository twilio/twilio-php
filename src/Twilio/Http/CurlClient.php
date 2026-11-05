<?php


namespace Twilio\Http;


use Twilio\AuthStrategy\AuthStrategy;
use Twilio\Exceptions\ConfigurationException;
use Twilio\Exceptions\EnvironmentException;

class CurlClient implements Client {
    public const DEFAULT_TIMEOUT = 60;
    // How long a clean chain check for a host is reused before the chain is fetched again.
    private const CHAIN_CHECK_TTL = 300;

    protected $curlOptions = [];
    private $distrustedSpki;
    private $checkedHosts = [];

    public $lastRequest;
    public $lastResponse;

    /**
     * @param array $options cURL options
     * @param string[]|null $distrustedSpki SPKI SHA-256 hashes to refuse, defaults to
     *                                      DistrustedIntermediates::DISTRUSTED_SPKI_SHA256
     */
    public function __construct(array $options = [], ?array $distrustedSpki = null) {
        $this->curlOptions = $options;
        $this->distrustedSpki = $distrustedSpki;
    }

    public function request(string $method, string $url,
                            array $params = [], array $data = [], array $headers = [],
                            ?string $user = null, ?string $password = null,
                            ?int $timeout = null, ?AuthStrategy $authStrategy = null): Response {
        $options = $this->options($method, $url, $params, $data, $headers,
                                  $user, $password, $timeout, $authStrategy);

        $this->lastRequest = $options;
        $this->lastResponse = null;

        try {
            $this->checkServerChain($options);

            if (!$curl = \curl_init()) {
                throw new EnvironmentException('Unable to initialize cURL');
            }

            if ($this->isHttps($options[CURLOPT_URL])) {
                // Lets us check the chain curl verified, which also covers requests that go through a proxy.
                $options[CURLOPT_CERTINFO] = true;
            }

            if (!\curl_setopt_array($curl, $options)) {
                throw new EnvironmentException(\curl_error($curl));
            }

            if (!$response = \curl_exec($curl)) {
                throw new EnvironmentException(\curl_error($curl));
            }

            $this->checkVerifiedChain($curl);

            $parts = \explode("\r\n\r\n", $response, 3);

            list($head, $body) = (
                \preg_match('/\AHTTP\/1.\d 100 Continue\Z/', $parts[0])
                || \preg_match('/\AHTTP\/1.\d 200 Connection established\Z/', $parts[0])
                || \preg_match('/\AHTTP\/1.\d 200 Tunnel established\Z/', $parts[0])
            )
                ? array($parts[1], $parts[2])
                : array($parts[0], $parts[1]);

            $statusCode = \curl_getinfo($curl, CURLINFO_HTTP_CODE);

            $responseHeaders = [];
            $headerLines = \explode("\r\n", $head);
            \array_shift($headerLines);
            foreach ($headerLines as $line) {
                list($key, $value) = \explode(':', $line, 2);
                $responseHeaders[$key] = $value;
            }

            if (PHP_MAJOR_VERSION < 8) {
                \curl_close($curl);
            }

            if (isset($options[CURLOPT_INFILE]) && \is_resource($options[CURLOPT_INFILE])) {
                \fclose($options[CURLOPT_INFILE]);
            }

            $this->lastResponse = new Response($statusCode, $body, $responseHeaders);

            return $this->lastResponse;
        } catch (\ErrorException $e) {
            if (PHP_MAJOR_VERSION < 8 && isset($curl) && \is_resource($curl)) {
                \curl_close($curl);
            }

            if (isset($options[CURLOPT_INFILE]) && \is_resource($options[CURLOPT_INFILE])) {
                \fclose($options[CURLOPT_INFILE]);
            }

            throw $e;
        }
    }

    /**
     * Refuse a server whose certificate chain contains a distrusted intermediate before anything, including the
     * credentials, is sent. This opens its own TLS connection and reads the chain the server sends; a clean result
     * is reused for CHAIN_CHECK_TTL seconds. If that connection can't be made the check is skipped and curl reports
     * the failure itself. Requests through a proxy are covered by checkVerifiedChain() instead.
     */
    private function checkServerChain(array $options): void {
        $url = $options[CURLOPT_URL];
        if (!$this->isHttps($url) || !empty($options[CURLOPT_PROXY])) {
            return;
        }

        $host = \parse_url($url, PHP_URL_HOST);
        $port = \parse_url($url, PHP_URL_PORT) ?: 443;
        $key = $host . ':' . $port;
        if (isset($this->checkedHosts[$key]) && $this->checkedHosts[$key] > \time()) {
            return;
        }

        $verifyHost = $options[CURLOPT_SSL_VERIFYHOST] ?? 2;
        $ssl = [
            'capture_peer_cert_chain' => true,
            'verify_peer' => (bool)($options[CURLOPT_SSL_VERIFYPEER] ?? true),
            'verify_peer_name' => $verifyHost !== 0 && $verifyHost !== false,
            'peer_name' => $host,
            'SNI_enabled' => true,
        ];
        if (isset($options[CURLOPT_CAINFO])) {
            $ssl['cafile'] = $options[CURLOPT_CAINFO];
        }

        $stream = @\stream_socket_client(
            'ssl://' . $host . ':' . $port,
            $errno,
            $errstr,
            $options[CURLOPT_TIMEOUT] ?? self::DEFAULT_TIMEOUT,
            STREAM_CLIENT_CONNECT,
            \stream_context_create(['ssl' => $ssl])
        );
        if (!$stream) {
            return;
        }

        $params = \stream_context_get_params($stream);
        \fclose($stream);

        $der = [];
        foreach ($params['options']['ssl']['peer_certificate_chain'] ?? [] as $certificate) {
            if (\openssl_x509_export($certificate, $pem)) {
                $der[] = DistrustedIntermediates::pemToDer($pem);
            }
        }

        DistrustedIntermediates::checkChain($der, $this->distrustedSpki);
        $this->checkedHosts[$key] = \time() + self::CHAIN_CHECK_TTL;
    }

    /**
     * Backstop for checkServerChain(): check the chain curl verified for the connection it just made. By now the
     * request has been sent, so this discards the response rather than preventing the request.
     *
     * @param resource|\CurlHandle $curl
     */
    private function checkVerifiedChain($curl): void {
        $certInfo = \curl_getinfo($curl, CURLINFO_CERTINFO);
        if (!\is_array($certInfo)) {
            return;
        }

        $der = [];
        foreach ($certInfo as $certificate) {
            if (isset($certificate['Cert'])) {
                $der[] = DistrustedIntermediates::pemToDer($certificate['Cert']);
            }
        }

        DistrustedIntermediates::checkChain($der, $this->distrustedSpki);
    }

    private function isHttps(string $url): bool {
        return \strtolower((string)\parse_url($url, PHP_URL_SCHEME)) === 'https';
    }

    public function options(string $method, string $url,
                            array $params = [], array $data = [], array $headers = [],
                            ?string $user = null, ?string $password = null,
                            ?int $timeout = null, ?AuthStrategy $authStrategy = null): array {
        $timeout = $timeout ?? self::DEFAULT_TIMEOUT;
        $options = $this->curlOptions + [
            CURLOPT_URL => $url,
            CURLOPT_HEADER => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_INFILESIZE => Null,
            CURLOPT_HTTPHEADER => [],
            CURLOPT_TIMEOUT => $timeout,
            CURLOPT_PROTOCOLS => CURLPROTO_HTTPS | CURLPROTO_HTTP
        ];

        foreach ($headers as $key => $value) {
            $options[CURLOPT_HTTPHEADER][] = "$key: $value";
        }

        if ($user && $password) {
            $options[CURLOPT_HTTPHEADER][] = 'Authorization: Basic ' . \base64_encode("$user:$password");
        }
        elseif ($authStrategy) {
            $options[CURLOPT_HTTPHEADER][] = 'Authorization: ' . $authStrategy->getAuthString();
        }

        $query = $this->buildQuery($params);
        if ($query) {
            $options[CURLOPT_URL] .= '?' . $query;
        }

        $methodName = \strtolower(\trim($method));

        // Configure HTTP method-specific options
        if ($methodName === 'get') {
            $options[CURLOPT_HTTPGET] = true;
        } elseif ($methodName === 'head') {
            $options[CURLOPT_NOBODY] = true;
        } elseif (\in_array($methodName, ['post', 'put', 'patch'])) {
            // Handle methods that send data in the request body
            $this->configureMethodWithData($options, $methodName, $method, $data, $headers);
        } else {
            // Handle other HTTP methods (DELETE, etc.)
            $options[CURLOPT_CUSTOMREQUEST] = \strtoupper($method);
        }

        return $options;
    }

    /**
     * Configure cURL options for HTTP methods that send data in the request body
     * (POST, PUT, PATCH)
     */
    private function configureMethodWithData(array &$options, string $methodName, string $method, array $data, array $headers): void
    {
        // Set the appropriate cURL option for the HTTP method
        if ($methodName === 'post') {
            $options[CURLOPT_POST] = true;
        } else {
            $options[CURLOPT_CUSTOMREQUEST] = \strtoupper($method);
        }

        // Configure the request body based on data type
        if ($this->hasFile($data)) {
            // Handle multipart/form-data for file uploads
            [$headers, $body] = $this->buildMultipartOptions($data);
            $options[CURLOPT_POSTFIELDS] = $body;
            $options[CURLOPT_HTTPHEADER] = \array_merge($options[CURLOPT_HTTPHEADER], $headers);
        } elseif (isset($headers['Content-Type']) && $headers['Content-Type'] === 'application/json') {
            // Handle JSON data
            $options[CURLOPT_POSTFIELDS] = \json_encode($data);
        } else {
            // Handle URL-encoded form data
            $options[CURLOPT_POSTFIELDS] = $this->buildQuery($data);
        }
    }

    public function buildQuery(?array $params): string {
        $parts = [];
        $params = $params ?: [];

        foreach ($params as $key => $value) {
            if (\is_array($value)) {
                foreach ($value as $item) {
                    $parts[] = $this->encodeQueryComponent((string)$key) . '=' .
                        $this->encodeQueryComponent((string)$item);
                }
            } else {
                $parts[] = $this->encodeQueryComponent((string)$key) . '=' .
                    $this->encodeQueryComponent((string)$value);
            }
        }

        return \implode('&', $parts);
    }

    /**
     * Custom encoder for query string components that:
     * 1. Encodes spaces as '+' (like urlencode)
     * 2. Preserves unreserved characters including tilde (like rawurlencode)
     */
    private function encodeQueryComponent(string $string): string {
        // Start with rawurlencode to encode as per RFC 3986
        $encoded = \rawurlencode($string);

        // Convert %20 back to + for query string compatibility
        $encoded = \str_replace('%20', '+', $encoded);

        return $encoded;
    }

    private function hasFile(array $data): bool {
        foreach ($data as $value) {
            if ($value instanceof File) {
                return true;
            }
        }

        return false;
    }

    private function buildMultipartOptions(array $data): array {
        $boundary = \uniqid('', true);
        $delimiter = "-------------{$boundary}";
        $body = '';

        foreach ($data as $key => $value) {
            if ($value instanceof File) {
                $contents = $value->getContents();
                if ($contents === null) {
                    $chunk = \file_get_contents($value->getFileName());
                    $filename = \basename($value->getFileName());
                } elseif (\is_resource($contents)) {
                    $chunk = '';
                    while (!\feof($contents)) {
                        $chunk .= \fread($contents, 8096);
                    }

                    $filename = $value->getFileName();
                } elseif (\is_string($contents)) {
                    $chunk = $contents;
                    $filename = $value->getFileName();
                } else {
                    throw new \InvalidArgumentException('Unsupported content type');
                }

                $headers = '';
                $contentType = $value->getContentType();
                if ($contentType !== null) {
                    $headers .= "Content-Type: {$contentType}\r\n";
                }

                $body .= \vsprintf("--%s\r\nContent-Disposition: form-data; name=\"%s\"; filename=\"%s\"\r\n%s\r\n%s\r\n", [
                    $delimiter,
                    $key,
                    $filename,
                    $headers,
                    $chunk,
                ]);
            } else {
                $body .= \vsprintf("--%s\r\nContent-Disposition: form-data; name=\"%s\"\r\n\r\n%s\r\n", [
                    $delimiter,
                    $key,
                    $value,
                ]);
            }
        }

        $body .= "--{$delimiter}--\r\n";

        return [
            [
                "Content-Type: multipart/form-data; boundary={$delimiter}",
                'Content-Length: ' . \strlen($body),
            ],
            $body,
        ];
    }
}
