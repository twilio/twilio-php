<?php


namespace Twilio\Tests;

class Request {
    function __construct($method, $url, $params = array(), $data = array(), $headers = array(), $user = null, $password = null) {
        $this->method = $method;
        $this->url = $url;
        $this->params = $params;
        $this->data = $data;
        $this->headers = $headers;
        $this->user = $user;
        $this->password = $password;
    }
}
