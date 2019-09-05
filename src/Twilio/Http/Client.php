<?php


namespace Twilio\Http;


interface Client {
    public function request($method, $url, $params = array(), $data = array(),
                            $headers = array(), $user = null, $password = null,
                            $timeout = null);
}