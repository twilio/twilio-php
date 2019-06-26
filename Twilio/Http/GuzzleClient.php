<?php


namespace Twilio\Http;


use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Psr7\Request;
use Twilio\Exceptions\HttpException;

final class GuzzleClient implements Client
{
    /**
     * @var ClientInterface
     */
    private $client;

    public function __construct(ClientInterface $client)
    {
        $this->client = $client;
    }

    public function request(
        $method,
        $url,
        $params = [],
        $data = [],
        $headers = [],
        $user = null,
        $password = null,
        $timeout = null
    ) {
        try {
            $response = $this->client->send(new Request($method, $url, $headers), [
                'timeout' => $timeout,
                'auth' => [$user, $password],
                'query' => $params,
                'form_params' => $data,
            ]);
        } catch (BadResponseException $exception) {
            $response = $exception->getResponse();
        } catch (\Exception $exception) {
            throw new HttpException('Unable to complete the HTTP request', 0, $exception);
        }

        return new Response($response->getStatusCode(), $response->getBody()->getContents(), $response->getHeaders());
    }
}