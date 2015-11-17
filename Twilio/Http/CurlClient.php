<?php


namespace Twilio\Http;


use Twilio\Exceptions\EnvironmentException;

class CurlClient implements Client {
    const DEFAULT_TIMEOUT = 60;

    public function request($method, $url, $params = array(), $data = array(),
                            $headers = array(), $user = null, $password = null,
                            $timeout = null) {
        $timeout = $timeout || self::DEFAULT_TIMEOUT;

        $options = array(
            CURLOPT_URL => $url,
            CURLOPT_HEADER => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_INFILESIZE => -1,
            CURLOPT_HTTPHEADER => array(),
            CURLOPT_TIMEOUT => $timeout,
        );

        foreach ($headers as $key => $value) {
            $options[CURLOPT_HTTPHEADER][] = "$key: $value";
        }

        if ($user && $password) {
            $options[CURLOPT_USERPWD] = "$user:$password";
        }

        $body = $this->buildQuery($params);

        switch (strtolower(trim($method))) {
            case 'get':
                $options[CURLOPT_HTTPGET] = true;
                break;
            case 'post':
                $options[CURLOPT_POST] = true;
                $options[CURLOPT_POSTFIELDS] = $body;
                break;
            case 'put':
                $options[CURLOPT_PUT] = true;
                if ($body) {
                    if ($buffer = fopen('php://memory', 'w+')) {
                        fwrite($buffer, $body);
                        fseek($buffer, 0);
                        $options[CURLOPT_INFILE] = $buffer;
                        $options[CURLOPT_INFILESIZE] = strlen($body);
                    }
                } else {
                    throw new EnvironmentException('Unable to open a temporary file');
                }
                break;
            case 'head':
                $opts[CURLOPT_NOBODY] = true;
                break;
            default:
                $opts[CURLOPT_CUSTOMREQUEST] = strtoupper($method);
        }

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
            list($head, $body) = ($parts[0] == 'HTTP/1.1 100 Continue')
                               ? array($parts[1], $parts[2])
                               : array($parts[0], $parts[1]);

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

            return new Response($statusCode, $body, $responseHeaders);
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

    protected function buildQuery($params) {
        $parts = array();

        foreach ($params as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $item) {
                    $parts[] = $key . '=' . urlencode((string)$item);
                }
            } else {
                $parts[] = $key . '=' . urlencode((string)$value);
            }
        }

        return implode('&', $parts);
    }
}