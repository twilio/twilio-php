<?php


namespace Twilio\Tests;

use Twilio\AuthStrategy\AuthStrategy;

class Request {
    public $method;
    public $url;
    public $params;
    public $data;
    public $headers;
    public $user;
    public $password;
    public $authStrategy;

    public function __construct(string $method, string $url,
                                ?array $params = [], array $data = [], array $headers = [],
                                ?string $user = null, ?string $password = null, ?AuthStrategy $authStrategy = null) {
        $this->method = $method;
        $this->url = $url;
        $this->params = $params;
        $this->data = $data;
        $this->headers = $headers;
        $this->user = $user;
        $this->password = $password;
        $this->authStrategy = $authStrategy;
    }
}
