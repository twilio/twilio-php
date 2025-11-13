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
            $full_url = $http_client->lastRequest[CURLOPT_URL];
            // remove query parameters from url
            $parts = explode('?', $full_url);
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

    protected function addQueryParam(String $query): String {
        if($query === '') {
            $query .= '?';
        } else {
            $query .= '&';
        }
        return $query;
    }

    protected function getQueryString(?String $pageToken): String {
        $queryString = '';
        if ($this->pageSize) {
            $queryString = $this->addQueryParam($queryString);
            $queryString .= 'pageSize=' . $this->pageSize;
        }
        if ($pageToken && $pageToken !== '') {
            $queryString = $this->addQueryParam($queryString);
            $queryString .= 'pageToken=' . $pageToken;
        }
        return $queryString;
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
