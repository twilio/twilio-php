<?php


namespace Twilio\Tests;

class Request {
    public $method;
    public $url;
    public $params;
    public $data;
    public $headers;
    public $user;
    public $password;

    public function __construct(string $method, string $url,
                                ?array $params = [], array $data = [], array $headers = [],
                                string $user = null, string $password = null) {
        $this->method = $method;
        $this->url = $url;
        $this->params = $params;
        $this->data = $data;
        $this->headers = $headers;
        $this->user = $user;
        $this->password = $password;
    }
}
