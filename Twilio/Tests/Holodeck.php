<?php


namespace Twilio\Tests;


use Twilio\Http\Client;
use Twilio\Http\Response;

class Holodeck implements Client {
    private $requests = array();
    private $response = null;

    public function request($method, $url, $params = array(), $data = array(),
                            $headers = array(), $user = null, $password = null,
                            $timeout = null) {
        array_push($this->requests, new Request($method, $url, $params, $data, $headers, $user, $password));

        if ($this->response == null) {
            return new Response(404, null, null);
        } else {
            return $this->response;
        }
    }

    public function mock($response) {
        $this->response = $response;
    }

    public function assertRequest($request) {
        if ($this->hasRequest($request)) {
            return;
        }

        $message = "Failed asserting that the following request exists: \n";
        $message .= ' - ' . $this->printRequest($request);
        $message .= "\n" . str_repeat('-', 3) . "\n";
        $message .= "Candidate Requests:\n";
        foreach ($this->requests as $candidate) {
            $message .= ' + ' . $this->printRequest($candidate) . "\n";
        }

        throw new \PHPUnit_Framework_ExpectationFailedException($message);
    }

    public function hasRequest($request) {
        for ($i = 0; $i < count($this->requests); $i++) {
            $c = $this->requests[$i];
            if (strtolower($request->method) == strtolower($c->method) &&
                $request->url == $c->url &&
                $request->params == $c->params &&
                $request->data == $c->data) {
                return true;
            }
        }

        return false;
    }

    protected function printRequest($request) {
        $url = $request->url;
        if ($request->params) {
            $url .= '?' . http_build_query($request->params);
        }


        $data = $request->data
              ? '-d ' . http_build_query($request->data)
              : '';

        return implode(' ', array(strtoupper($request->method), $url, $data));
    }
}
