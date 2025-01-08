<?php


namespace Twilio\Tests;


use Twilio\Http\Client;
use Twilio\Http\Response;

class Holodeck implements Client {
    private $requests = [];
    private $responses = [];

    public function request(string $method, string $url,
                            array $params = [], array $data = [], array $headers = [],
                            string $user = null, string $password = null,
                            int $timeout = null): Response {
        $this->requests[] = new Request($method, $url, $params, $data, $headers, $user, $password);
        if (\count($this->responses) === 0) {
            return new Response(404, null, null);
        }

        return \array_shift($this->responses);
    }

    public function mock(Response $response): void {
        $this->responses[] = $response;
    }

    public function assertRequest(Request $request): void {
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

    public function hasRequest(Request $request): bool {
        foreach ($this->requests as $c) {
            if (\strtolower($request->method) == \strtolower($c->method) &&
                $request->url == $c->url &&
                $request->params == $c->params &&
                $request->data == $c->data) {
                foreach ($request->headers as $h => $value) {
                    if ($c->headers[$h] != $value) {
                        return false;
                    }
                }
                return true;
            }
        }

        return false;
    }

    protected function printRequest(Request $request): string {
        $url = $request->url;
        if ($request->params) {
            $url .= '?' . \http_build_query($request->params);
        }

        $data = $request->data
            ? '-d ' . \http_build_query($request->data)
            : '';

        $headers = $request->headers
            ? '-h ' . \http_build_query($request->headers, null, ' ')
            : '';

        return \implode(' ', [\strtoupper($request->method), $url, $data, $headers]);
    }
}
