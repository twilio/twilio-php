<?php

namespace Twilio;

use Twilio\Exceptions\RestException;
use Twilio\Exceptions\RestExceptionV1;
use Twilio\Exceptions\TwilioException;
use Twilio\Http\Response;

abstract class Version {
    /**
     * @const int MAX_PAGE_SIZE largest page the Twilio API will return
     */
    public const MAX_PAGE_SIZE = 1000;

    /**
     * @var Domain $domain
     */
    protected $domain;

    /**
     * @var string $version
     */
    protected $version;

    /**
     * @param Domain $domain
     */
    public function __construct(Domain $domain) {
        $this->domain = $domain;
        $this->version = null;
    }

    /**
     * Generate an absolute URL from a version relative uri
     * @param string $uri Version relative uri
     * @return string Absolute URL
     */
    public function absoluteUrl(string $uri): string {
        return $this->getDomain()->absoluteUrl($this->relativeUri($uri));
    }

    /**
     * Generate a domain relative uri from a version relative uri
     * @param string $uri Version relative uri
     * @return string Domain relative uri
     */
    public function relativeUri(string $uri): string {
        return \trim($this->version ?? '', '/') . '/' . \trim($uri, '/');
    }

    public function request(string $method, string $uri,
                            array $params = [], array $data = [], array $headers = [],
                            ?string $username = null, ?string $password = null,
                            ?int $timeout = null): Response {
        $uri = $this->relativeUri($uri);
        return $this->getDomain()->request(
            $method,
            $uri,
            $params,
            $data,
            $headers,
            $username,
            $password,
            $timeout
        );
    }

    /**
     * Create the best possible exception for the response.
     *
     * Attempts to parse the response for Twilio Standard error messages and use
     * those to populate the exception, falls back to generic error message and
     * HTTP status code.
     *
     * @param Response $response Error response
     * @param string $header Header for exception message
     * @return TwilioException
     */
    protected function exception(Response $response, string $header): TwilioException {
        $message = '[HTTP ' . $response->getStatusCode() . '] ' . $header;

        $content = $response->getContent();
        if (\is_array($content)) {
            $message .= isset($content['message']) ? ': ' . $content['message'] : '';
            $code = $content['code'] ?? $response->getStatusCode();
            $moreInfo = $content['more_info'] ?? '';
            $details = $content['details'] ?? [];
            return new RestException($message, $code, $response->getStatusCode(), $moreInfo, $details);
        }

        return new RestException($message, $response->getStatusCode(), $response->getStatusCode());
    }

    /**
     * Create the best possible exception for the response as per Twilio API Standard V1.
     *
     * Attempts to parse the response for Twilio Standard error as defined in Twilio API Standards V1
     * and use those to populate the exception, falls back to generic error message and
     * HTTP status code.
     *
     * @param Response $response Error response
     * @param string $header Header for exception message
     * @return TwilioException
     */
    protected function exceptionV1(Response $response, string $header): TwilioException {
        $message = '[HTTP ' . $response->getStatusCode() . '] ' . $header;

        $content = $response->getContent();
        if (\is_array($content)) {
            $message .= isset($content['message']) ? ': ' . $content['message'] : '';
            $code = $content['code'] ?? $response->getStatusCode();
            $httpStatusCode = $content['httpStatusCode'] ?? $response->getStatusCode();
            $params = $content['params'] ?? [];
            $userError = $content['userError'] ?? false;
            return new RestExceptionV1($code, $message, $httpStatusCode, $params, $userError);
        }

        return new RestExceptionV1($response->getStatusCode(), $message, $response->getStatusCode());
    }

    /**
     * @throws TwilioException
     */
    public function fetch(string $method, string $uri,
                          array $params = [], array $data = [], array $headers = [],
                          ?string $username = null, ?string $password = null,
                          ?int $timeout = null) {
        return $this->handleException(
            $method,
            $uri,
            $params,
            $data,
            $headers,
            $username,
            $password,
            $timeout,
            "fetch"
        );
    }

    /**
     * @throws TwilioException
     */
    public function fetchV1(string $method, string $uri,
                            array $params = [], array $data = [], array $headers = [],
                            ?string $username = null, ?string $password = null,
                            ?int $timeout = null) {
        return $this->handleException(
            $method,
            $uri,
            $params,
            $data,
            $headers,
            $username,
            $password,
            $timeout,
            "fetch",
            true
        );
    }

    /**
     * @throws TwilioException
     */
    public function patch(string $method, string $uri,
                           array $params = [], array $data = [], array $headers = [],
                           ?string $username = null, ?string $password = null,
                           ?int $timeout = null) {
        return $this->update($method, $uri, $params, $data, $headers, $username, $password, $timeout);
    }

    /**
     * @throws TwilioException
     */
    public function patchV1(string $method, string $uri,
                          array $params = [], array $data = [], array $headers = [],
                          ?string $username = null, ?string $password = null,
                          ?int $timeout = null) {
        return $this->updateV1($method, $uri, $params, $data, $headers, $username, $password, $timeout);
    }

    /**
     * @throws TwilioException
     */
    public function update(string $method, string $uri,
                           array $params = [], array $data = [], array $headers = [],
                           ?string $username = null, ?string $password = null,
                           ?int $timeout = null) {
        return $this->handleException(
            $method,
            $uri,
            $params,
            $data,
            $headers,
            $username,
            $password,
            $timeout,
            "update"
        );
    }

    /**
     * @throws TwilioException
     */
    public function updateV1(string $method, string $uri,
                             array $params = [], array $data = [], array $headers = [],
                             ?string $username = null, ?string $password = null,
                             ?int $timeout = null) {
        return $this->handleException(
            $method,
            $uri,
            $params,
            $data,
            $headers,
            $username,
            $password,
            $timeout,
            "update",
            true
        );
    }

    /**
     * @throws TwilioException
     */
    public function delete(string $method, string $uri,
                           array $params = [], array $data = [], array $headers = [],
                           ?string $username = null, ?string $password = null,
                           ?int $timeout = null): bool {
        return $this->handleException(
            $method,
            $uri,
            $params,
            $data,
            $headers,
            $username,
            $password,
            $timeout,
            "delete",
            true
        );
    }

    /**
     * @throws TwilioException
     */
    public function deleteV1(string $method, string $uri,
                           array $params = [], array $data = [], array $headers = [],
                           ?string $username = null, ?string $password = null,
                           ?int $timeout = null): bool {
        return $this->handleException(
            $method,
            $uri,
            $params,
            $data,
            $headers,
            $username,
            $password,
            $timeout,
            "delete",
            true
        );
    }

    public function readLimits(?int $limit = null, ?int $pageSize = null): array {
        if ($limit && $pageSize === null) {
            $pageSize = $limit;
        }

        $pageSize = \min($pageSize, self::MAX_PAGE_SIZE);

        return [
            'limit' => $limit ?: Values::NONE,
            'pageSize' => $pageSize ?: Values::NONE,
            'pageLimit' => Values::NONE,
        ];
    }

    public function page(string $method, string $uri,
                         array $params = [], array $data = [], array $headers = [],
                         ?string $username = null, ?string $password = null,
                         ?int $timeout = null): Response {
        return $this->request(
            $method,
            $uri,
            $params,
            $data,
            $headers,
            $username,
            $password,
            $timeout
        );
    }

    public function stream(Page $page, $limit = null, $pageLimit = null): Stream {
        return new Stream($page, $limit, $pageLimit);
    }

    /**
     * @throws TwilioException
     */
    public function create(string $method, string $uri,
                           array $params = [], array $data = [], array $headers = [],
                           ?string $username = null, ?string $password = null,
                           ?int $timeout = null) {
        return $this->handleException(
            $method,
            $uri,
            $params,
            $data,
            $headers,
            $username,
            $password,
            $timeout,
            "create"
        );
    }

    /**
     * @throws TwilioException
     */
    public function createV1(string $method, string $uri,
                           array $params = [], array $data = [], array $headers = [],
                           ?string $username = null, ?string $password = null,
                           ?int $timeout = null) {
        return $this->handleException(
            $method,
            $uri,
            $params,
            $data,
            $headers,
            $username,
            $password,
            $timeout,
            "create",
            true
        );
    }

    /**
     * @throws TwilioException
     */
    public function handleException(string $method, string $uri,
                           array $params = [], array $data = [], array $headers = [],
                           ?string $username = null, ?string $password = null,
                           ?int $timeout = null, ?string $operation = "", ?bool $isApiV1 = false) {
        $response = $this->request(
            $method,
            $uri,
            $params,
            $data,
            $headers,
            $username,
            $password,
            $timeout
        );

        if ($response->getStatusCode() < 200 || $response->getStatusCode() >= 300) {
            $exceptionHeader = 'Unable to ' . $operation . ' record';
            if ($isApiV1) {
                throw $this->exceptionV1($response, $exceptionHeader);
            }
            throw $this->exception($response, $exceptionHeader);
        }

        if ($operation === "delete") {
            return true;
        }

        return $response->getContent();
    }

    public function getDomain(): Domain {
        return $this->domain;
    }

    public function __toString(): string {
        return '[Version]';
    }
}
