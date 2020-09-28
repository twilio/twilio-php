<?php


namespace Twilio\Http;


use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Psr7\Request;
use Twilio\Exceptions\HttpException;
use function GuzzleHttp\Psr7\build_query;

final class GuzzleClient implements Client {
    /**
     * @var ClientInterface
     */
    private $client;

    public function __construct(ClientInterface $client) {
        $this->client = $client;
    }

    public function request(string $method, string $url,
                            array $params = [], array $data = [], array $headers = [],
                            string $user = null, string $password = null,
                            int $timeout = null): Response {
        try {
            $options = [
                'timeout' => $timeout,
                'auth' => [$user, $password],
            ];

            if ($params) {
                $options['query'] = $params;
            }

            if ($method === 'POST') {
                if ($this->shouldSendRequestAsMultipart($data)) {
                    $multipart = [];
                    foreach ($data as $key => $value) {
                        $multipart[] = [
                            'name' => $key,
                            'contents' => $value,
                        ];
                    }

                    $options['multipart'] = $multipart;
                } else {
                    $options['body'] = build_query($data, PHP_QUERY_RFC1738);
                    $headers['Content-Type'] = 'application/x-www-form-urlencoded';
                }
            }

            $response = $this->client->send(new Request($method, $url, $headers), $options);
        } catch (BadResponseException $exception) {
            $response = $exception->getResponse();
        } catch (\Exception $exception) {
            throw new HttpException('Unable to complete the HTTP request', 0, $exception);
        }

        // Casting the body (stream) to a string performs a rewind, ensuring we return the entire response.
        // See https://stackoverflow.com/a/30549372/86696
        return new Response($response->getStatusCode(), (string)$response->getBody(), $response->getHeaders());
    }

    private function shouldSendRequestAsMultipart(array $data): bool {
        return \array_key_exists('File', $data);
    }
}
