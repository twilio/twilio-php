<?php


namespace Twilio;


use Twilio\Exceptions\KeyErrorException;
use Twilio\Http\Response;

abstract class TokenPaginationPage extends Page {

    protected $key;
    protected $pageSize;
    protected $nextToken;
    protected $previousToken;
    protected $url;
    protected $previousPageUrl;
    protected $nextPageUrl;

    public function __construct(Version $version, Response $response) {
        parent::__construct($version, $response);

        $http_client = $version->getDomain()->getClient()->getHttpClient();

        $this->url = '';
        if($http_client->lastRequest) {
            $fullUrl = $http_client->lastRequest[CURLOPT_URL];
            // remove query parameters from url
            $parts = explode('?', $fullUrl);
            $this->url = $parts[0];
        }

        $this->key = $this->getMeta('key');
        $this->pageSize = (int) $this->getMeta('pageSize');
        $this->nextToken = $this->getMeta('nextToken');
        $this->previousToken = $this->getMeta('previousToken');
    }

    /**
     * @throws KeyErrorException
     */
    protected function loadPage(): array {
        $this->key = $this->getMeta('key');
        if ($this->key) {
            return $this->payload[$this->key];
        }

        throw new KeyErrorException('key not found in the response');
    }

    protected function getQueryString(?String $pageToken): String {
        $params = [];
        if ($this->pageSize) {
            $params['pageSize'] = $this->pageSize;
        }
        if ($pageToken && $pageToken !== '') {
            $params['pageToken'] = $pageToken;
        }
        $queryString = http_build_query($params);
        return $queryString ? '?' . $queryString : '';
    }

    public function getPreviousPageUrl(): ?string {
        if (!$this->previousPageUrl) {
            $this->previousPageUrl = $this->url . $this->getQueryString($this->previousToken);
        }
        return $this->previousPageUrl;
    }

    public function getNextPageUrl(): ?string {
        if (!$this->nextPageUrl) {
            $this->nextPageUrl = $this->url . $this->getQueryString($this->nextToken);
        }
        return $this->nextPageUrl;
    }


    public function __toString(): string {
        return '[TokenPaginationPage]';
    }

}
