<?php


namespace Twilio\Tests;


use Twilio\Http\Client;
use Twilio\Http\Response;

class Holodeck implements Client {
    private $requests = [];
    private $responses = [];

    public function request($method, $url, $params = [], $data = [],
                            $headers = [], $user = null, $password = null,
                            $timeout = null): Response {
        $this->requests[] = new Request($method, $url, $params, $data, $headers, $user, $password);

        if (\count($this->responses) === 0) {
            return new Response(404, null, null);
        }

        return \array_shift($this->responses);
    }

    public function mock($response): void {
        $this->responses[] = $response;
    }

    public function assertRequest($request): void {
        if ($this->hasRequest($request)) {
            return;
        }

        $message = "Failed asserting that the following request exists: \n";
        $message .= ' - ' . $this->printRequest($request);
        $message .= "\n" . \str_repeat('-', 3) . "\n";
        $message .= "Candidate Requests:\n";
        foreach ($this->requests as $candidate) {
            $message .= ' + ' . $this->printRequest($candidate) . "\n";
        }

        throw new \RuntimeException($message);
    }

    public function hasRequest($request): bool {
        foreach ($this->requests as $c) {
            if (\strtolower($request->method) == \strtolower($c->method) &&
                $request->url == $c->url &&
                $request->params == $c->params &&
                $request->data == $c->data) {
                return true;
            }
        }

        return false;
    }

    protected function printRequest($request): string {
        $url = $request->url;
        if ($request->params) {
            $url .= '?' . \http_build_query($request->params);
        }


        $data = $request->data
            ? '-d ' . \http_build_query($request->data)
            : '';

        return \implode(' ', [\strtoupper($request->method), $url, $data]);
    }
}
