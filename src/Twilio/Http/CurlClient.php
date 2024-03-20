<?php


namespace Twilio\Http;


use Twilio\Exceptions\ConfigurationException;
use Twilio\Exceptions\EnvironmentException;

class CurlClient implements Client {
    public const DEFAULT_TIMEOUT = 60;
    protected $curlOptions = [];

    public $lastRequest;
    public $lastResponse;

    public function __construct(array $options = []) {
        $this->curlOptions = $options;
    }

    public function request(string $method, string $url,
                            array $params = [], array $data = [], array $headers = [],
                            string $user = null, string $password = null,
                            int $timeout = null): Response {
        $options = $this->options($method, $url, $params, $data, $headers,
                                  $user, $password, $timeout);

        $this->lastRequest = $options;
        $this->lastResponse = null;

        try {
            if (!$curl = \curl_init()) {
                throw new EnvironmentException('Unable to initialize cURL');
            }

            if (!\curl_setopt_array($curl, $options)) {
                throw new EnvironmentException(\curl_error($curl));
            }

            if (!$response = \curl_exec($curl)) {
                throw new EnvironmentException(\curl_error($curl));
            }

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

            \curl_close($curl);

            if (isset($options[CURLOPT_INFILE]) && \is_resource($options[CURLOPT_INFILE])) {
                \fclose($options[CURLOPT_INFILE]);
            }

            $this->lastResponse = new Response($statusCode, $body, $responseHeaders);

            return $this->lastResponse;
        } catch (\ErrorException $e) {
            if (isset($curl) && \is_resource($curl)) {
                \curl_close($curl);
            }

            if (isset($options[CURLOPT_INFILE]) && \is_resource($options[CURLOPT_INFILE])) {
                \fclose($options[CURLOPT_INFILE]);
            }

            throw $e;
        }
    }

    public function options(string $method, string $url,
                            array $params = [], array $data = [], array $headers = [],
                            string $user = null, string $password = null,
                            int $timeout = null): array {
        $timeout = $timeout ?? self::DEFAULT_TIMEOUT;
        $options = $this->curlOptions + [
            CURLOPT_URL => $url,
            CURLOPT_HEADER => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_INFILESIZE => Null,
            CURLOPT_HTTPHEADER => [],
            CURLOPT_TIMEOUT => $timeout,
        ];

        foreach ($headers as $key => $value) {
            $options[CURLOPT_HTTPHEADER][] = "$key: $value";
        }

        if ($user && $password) {
            $options[CURLOPT_HTTPHEADER][] = 'Authorization: Basic ' . \base64_encode("$user:$password");
        }

        $query = $this->buildQuery($params);
        if ($query) {
            $options[CURLOPT_URL] .= '?' . $query;
        }

        switch (\strtolower(\trim($method))) {
            case 'get':
                $options[CURLOPT_HTTPGET] = true;
                break;
            case 'post':
                $options[CURLOPT_POST] = true;
                if ($this->hasFile($data)) {
                    [$headers, $body] = $this->buildMultipartOptions($data);
                    $options[CURLOPT_POSTFIELDS] = $body;
                    $options[CURLOPT_HTTPHEADER] = \array_merge($options[CURLOPT_HTTPHEADER], $headers);
                }
                elseif (array_key_exists('Content-Type', $headers)) {
                    $options[CURLOPT_POSTFIELDS] = json_encode($data);
                }
                else {
                    $options[CURLOPT_POSTFIELDS] = $this->buildQuery($data);
                    $options[CURLOPT_HTTPHEADER][] = 'Content-Type: application/x-www-form-urlencoded';
                }

                break;
            case 'put':
                // TODO: PUT doesn't used anywhere and it has strange implementation. Must investigate later
                $options[CURLOPT_PUT] = true;
                if ($data) {
                    if ($buffer = \fopen('php://memory', 'w+')) {
                        $dataString = $this->buildQuery($data);
                        \fwrite($buffer, $dataString);
                        \fseek($buffer, 0);
                        $options[CURLOPT_INFILE] = $buffer;
                        $options[CURLOPT_INFILESIZE] = \strlen($dataString);
                    } else {
                        throw new EnvironmentException('Unable to open a temporary file');
                    }
                }
                break;
            case 'head':
                $options[CURLOPT_NOBODY] = true;
                break;
            default:
                $options[CURLOPT_CUSTOMREQUEST] = \strtoupper($method);
        }

        return $options;
    }

    public function buildQuery(?array $params): string {
        $parts = [];
        $params = $params ?: [];

        foreach ($params as $key => $value) {
            if (\is_array($value)) {
                foreach ($value as $item) {
                    $parts[] = \urlencode((string)$key) . '=' . \urlencode((string)$item);
                }
            } else {
                $parts[] = \urlencode((string)$key) . '=' . \urlencode((string)$value);
            }
        }

        return \implode('&', $parts);
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
