<?php


namespace Twilio;


use Twilio\Http\Response;
use Twilio\Rest\Client;

/**
 * Class Domain
 * Abstracts a Twilio sub domain
 * @package Twilio
 */
abstract class Domain {
    /**
     * @var Client Twilio Client
     */
    protected $client;

    /**
     * @var string Base URL for this domain
     */
    protected $baseUrl;

    /**
     * Construct a new Domain
     * @param Client $client used to communicate with Twilio
     */
    public function __construct(Client $client) {
        $this->client = $client;
        $this->baseUrl = '';
    }

    /**
     * Translate version relative URIs into absolute URLs
     *
     * @param string $uri Version relative URI
     * @return string Absolute URL for this domain
     */
    public function absoluteUrl(string $uri): string {
        return \implode('/', [\trim($this->baseUrl, '/'), \trim($uri, '/')]);
    }

    /**
     * Make an HTTP request to the domain
     *
     * @param string $method HTTP Method to make the request with
     * @param string $uri Relative uri to make a request to
     * @param array $params Query string arguments
     * @param array $data Post form data
     * @param array $headers HTTP headers to send with the request
     * @param string $user User to authenticate as
     * @param string $password Password
     * @param int $timeout Request timeout
     * @return Response the response for the request
     */
    public function request(string $method, string $uri,
                            array $params = [], array $data = [], array $headers = [],
                            ?string $user = null, ?string $password = null,
                            ?int $timeout = null): Response {
        $url = $this->absoluteUrl($uri);
        return $this->client->request(
            $method,
            $url,
            $params,
            $data,
            $headers,
            $user,
            $password,
            $timeout
        );
    }

    public function getClient(): Client {
        return $this->client;
    }

    public function __toString(): string {
        return '[Domain]';
    }
}
