<?php


namespace Twilio\Http;


use Twilio\Exceptions\EnvironmentException;

class CurlClient implements Client {
    const DEFAULT_TIMEOUT = 60;
    protected $curlOptions = array();
    protected $debugHttp = false;

    public $lastRequest = null;
    public $lastResponse = null;

    public function __construct(array $options = array()) {
        $this->curlOptions = $options;
        $this->debugHttp = getenv('DEBUG_HTTP_TRAFFIC') === 'true';
    }

    public function request($method, $url, $params = array(), $data = array(),
                            $headers = array(), $user = null, $password = null,
                            $timeout = null) {
        $options = $this->options($method, $url, $params, $data, $headers,
                                  $user, $password, $timeout);

        $this->lastRequest = $options;
        $this->lastResponse = null;

        try {
            if (!$curl = curl_init()) {
                throw new EnvironmentException('Unable to initialize cURL');
            }

            if (!curl_setopt_array($curl, $options)) {
                throw new EnvironmentException(curl_error($curl));
            }

            if (!$response = curl_exec($curl)) {
                throw new EnvironmentException(curl_error($curl));
            }

            $parts = explode("\r\n\r\n", $response, 3);
            list($head, $body) = ($parts[0] == 'HTTP/1.1 100 Continue'
                            || $parts[0] == 'HTTP/1.1 200 Connection established')
                               ? array($parts[1], $parts[2])
                               : array($parts[0], $parts[1]);

            if ($this->debugHttp) {
                $u = parse_url($url);
                $hdrLine = $method . ' ' . $u['path'];
                if (isset($u['query']) && strlen($u['query']) > 0 ) {
                    $hdrLine = $hdrLine . '?' . $u['query'];
                }
                error_log($hdrLine);
                foreach ($headers as $key => $value) {
                    error_log("$key: $value");
                }
                if ($method === 'POST') {
                    error_log("\n" . $options[CURLOPT_POSTFIELDS] . "\n");
                }
            }
            $statusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);

            $responseHeaders = array();
            $headerLines = explode("\r\n", $head);
            array_shift($headerLines);
            foreach ($headerLines as $line) {
                list($key, $value) = explode(':', $line, 2);
                $responseHeaders[$key] = $value;
            }

            curl_close($curl);

            if (isset($buffer) && is_resource($buffer)) {
                fclose($buffer);
            }

            if ($this->debugHttp) {
                error_log("HTTP/1.1 $statusCode");
                foreach ($responseHeaders as $key => $value) {
                    error_log("$key: $value");
                }
                error_log("\n$body");
            }

            $this->lastResponse = new Response($statusCode, $body, $responseHeaders);

            return $this->lastResponse;
        } catch (\ErrorException $e) {
            if (isset($curl) && is_resource($curl)) {
                curl_close($curl);
            }

            if (isset($buffer) && is_resource($buffer)) {
                fclose($buffer);
            }

            throw $e;
        }
    }

    public function options($method, $url, $params = array(), $data = array(),
                            $headers = array(), $user = null, $password = null,
                            $timeout = null) {

        $timeout = is_null($timeout)
            ? self::DEFAULT_TIMEOUT
            : $timeout;
        $options = $this->curlOptions + array(
            CURLOPT_URL => $url,
            CURLOPT_HEADER => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_INFILESIZE => Null,
            CURLOPT_HTTPHEADER => array(),
            CURLOPT_TIMEOUT => $timeout,
        );

        foreach ($headers as $key => $value) {
            $options[CURLOPT_HTTPHEADER][] = "$key: $value";
        }

        if ($user && $password) {
            $options[CURLOPT_HTTPHEADER][] = 'Authorization: Basic ' . base64_encode("$user:$password");
        }

        $body = $this->buildQuery($params);
        if ($body) {
            $options[CURLOPT_URL] .= '?' . $body;
        }

        switch (strtolower(trim($method))) {
            case 'get':
                $options[CURLOPT_HTTPGET] = true;
                break;
            case 'post':
                $options[CURLOPT_POST] = true;
                $options[CURLOPT_POSTFIELDS] = $this->buildQuery($data);

                break;
            case 'put':
                $options[CURLOPT_PUT] = true;
                if ($data) {
                    if ($buffer = fopen('php://memory', 'w+')) {
                        $dataString = $this->buildQuery($data);
                        fwrite($buffer, $dataString);
                        fseek($buffer, 0);
                        $options[CURLOPT_INFILE] = $buffer;
                        $options[CURLOPT_INFILESIZE] = strlen($dataString);
                    } else {
                        throw new EnvironmentException('Unable to open a temporary file');
                    }
                }
                break;
            case 'head':
                $options[CURLOPT_NOBODY] = true;
                break;
            default:
                $options[CURLOPT_CUSTOMREQUEST] = strtoupper($method);
        }

        return $options;
    }

    public function buildQuery($params) {
        $parts = array();

        if (is_string($params)) {
            return $params;
        }

        $params = $params ?: array();

        foreach ($params as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $item) {
                    $parts[] = urlencode((string)$key) . '=' . urlencode((string)$item);
                }
            } else {
                $parts[] = urlencode((string)$key) . '=' . urlencode((string)$value);
            }
        }

        return implode('&', $parts);
    }
}
