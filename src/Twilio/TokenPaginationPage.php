<?php


namespace Twilio;


use Twilio\Exceptions\KeyErrorException;
use Twilio\Http\Response;

/**
 * TokenPaginationPage is an abstract base class for handling paginated API responses
 * that use token-based pagination rather than traditional page numbers. These are part of
 * the new Twilio API Standards V1.
 *
 * Unlike the base {@see Page} class, which typically uses page numbers and URLs for navigation,
 * TokenPaginationPage manages pagination using tokens (e.g., nextToken, previousToken) provided
 * in the API response metadata. This allows for more flexible and scalable pagination, especially
 * for APIs that do not support offset-based pagination.
 *
 * Example expected response format with token metadata:
 * {
 *   "meta": {
 *     "key": "items",
 *     "pageSize": 50,
 *     "nextToken": "abc123",
 *     "previousToken": "xyz789"
 *   },
 *   "items": [
 *     { "id": 1, "name": "Item 1" },
 *     { "id": 2, "name": "Item 2" }
 *     // ...
 *   ]
 * }
 *
 */
abstract class TokenPaginationPage extends Page {

    protected $key;
    protected $pageSize;
    protected $nextToken;
    protected $previousToken;
    protected $url;
    protected $queryParams;
    protected $previousPageUrl;
    protected $nextPageUrl;

    /**
     * TokenPaginationPage constructor.
     *
     * @param Version $version The API version object.
     * @param Response $response The HTTP response object.
     * @throws KeyErrorException If the 'key' metadata is missing.
     */
    public function __construct(Version $version, Response $response) {
        parent::__construct($version, $response);

        $httpClient = $version->getDomain()->getClient()->getHttpClient();

        $this->url = '';
        $this->queryParams = [];
        if ($httpClient->lastRequest) {
            $fullUrl = $httpClient->lastRequest[CURLOPT_URL];
            // remove query parameters from url
            $parts = explode('?', $fullUrl);
            $this->url = $parts[0];
            if (count($parts) > 1) {
                parse_str($parts[1], $this->queryParams); // store existing query params
            }
        }

        $this->key = $this->getMeta('key');
        $this->pageSize = (int) $this->getMeta('pageSize');
        $this->nextToken = $this->getMeta('nextToken');
        $this->previousToken = $this->getMeta('previousToken');
    }

    /**
     * Load the current page of records based on the 'key' metadata.
     *
     * @return array Array of records from the current page.
     * @throws KeyErrorException If the 'key' metadata is missing.
     */
    protected function loadPage(): array {
        $this->key = $this->getMeta('key');
        if ($this->key) {
            return $this->payload[$this->key];
        }

        throw new KeyErrorException('key not found in the response');
    }

    /**
     * Construct the query string for pagination URLs.
     *
     * @param string|null $pageToken The token for the desired page.
     * @return string The constructed query string.
     */
    protected function getQueryString(?string $pageToken): string {
        $params = $this->queryParams; // initialize with existing query params
        if ($this->pageSize) {
            $params['pageSize'] = $this->pageSize;
        }
        if ($pageToken !== null && $pageToken !== '') {
            $params['pageToken'] = $pageToken;
        }
        $queryString = http_build_query($params);
        return $queryString ? '?' . $queryString : '';
    }

    /**
     * Get the URL for the previous page of results.
     *
     * @return string|null The URL for the previous page, or null if there is no previous page.
     */
    public function getPreviousPageUrl(): ?string {
        if (!$this->previousToken) {
            return null;
        }
        if (!$this->previousPageUrl) {
            $this->previousPageUrl = $this->url . $this->getQueryString($this->previousToken);
        }
        return $this->previousPageUrl;
    }

    /**
     * Get the URL for the next page of results.
     *
     * @return string|null The URL for the next page, or null if there is no next page.
     */
    public function getNextPageUrl(): ?string {
        if (!$this->nextToken) {
            return null;
        }
        if (!$this->nextPageUrl) {
            $this->nextPageUrl = $this->url . $this->getQueryString($this->nextToken);
        }
        return $this->nextPageUrl;
    }

    public function __toString(): string {
        return '[TokenPaginationPage]';
    }

}
