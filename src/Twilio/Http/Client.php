<?php


namespace Twilio\Http;


interface Client {
    public function request($method, $url, $params = [], $data = [],
                            $headers = [], $user = null, $password = null,
                            $timeout = null): Response;
}
