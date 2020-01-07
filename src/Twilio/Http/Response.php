<?php


namespace Twilio\Http;


class Response {
    protected $headers;
    protected $content;
    protected $statusCode;

    public function __construct(int $statusCode, ?string $content, ?array $headers = []) {
        $this->statusCode = $statusCode;
        $this->content = $content;
        $this->headers = $headers;
    }

    /**
     * @return mixed
     */
    public function getContent() {
        return \json_decode($this->content, true);
    }

    public function getStatusCode(): int {
        return $this->statusCode;
    }

    public function getHeaders(): array {
        return $this->headers;
    }

    public function ok(): bool {
        return $this->getStatusCode() < 400;
    }

    public function __toString(): string {
        return '[Response] HTTP ' . $this->getStatusCode() . ' ' . $this->content;
    }
}
