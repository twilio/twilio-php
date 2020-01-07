<?php


namespace Twilio\Http;


use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Psr7\Request;
use Twilio\Exceptions\HttpException;

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
                'form_params' => $data,
            ];

            if ($params) {
                $options['query'] = $params;
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
}
