<?php


namespace Twilio\Http;


interface Client {
    public function request(string $method, string $url,
                            array $params = [], array $data = [], array $headers = [],
                            string $user = null, string $password = null,
                            int $timeout = null): Response;
}
