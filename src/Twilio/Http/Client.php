<?php


namespace Twilio\Http;


use Twilio\AuthStrategy\AuthStrategy;

interface Client {
    public function request(string $method, string $url,
                            array $params = [], array $data = [], array $headers = [],
                            ?string $user = null, ?string $password = null,
                            ?int $timeout = null, ?AuthStrategy $authStrategy = null): Response;
}
