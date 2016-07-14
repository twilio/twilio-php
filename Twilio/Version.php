<?php

namespace Twilio;

use Twilio\Exceptions\TwilioException;

abstract class Version {
    /**
     * @const int MAX_PAGE_SIZE largest page the Twilio API will return
     */
    const MAX_PAGE_SIZE = 1000;

    /**
     * @var \Twilio\Domain $domain
     */
    protected $domain;

    /**
     * @var string $version
     */
    protected $version;

    /**
     * @param \Twilio\Domain $domain
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
    public function absoluteUrl($uri) {
        return $this->getDomain()->absoluteUrl($this->relativeUri($uri));
    }

    /**
     * Generate a domain relative uri from a version relative uri
     * @param string $uri Version relative uri
     * @return string Domain relative uri
     */
    public function relativeUri($uri) {
        return trim($this->version, '/') . '/' . trim($uri, '/');
    }

    public function request($method, $uri, $params = array(), $data = array(),
                            $headers = array(), $username = null,
                            $password = null, $timeout = null) {
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

    public function fetch($method, $uri, $params = array(), $data = array(),
                          $headers = array(), $username = null,
                          $password = null, $timeout = null) {
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
            throw new TwilioException('Unable to fetch record', $response->getStatusCode());
        }

        return $response->getContent();
    }

    public function update($method, $uri, $params = array(), $data = array(),
                           $headers = array(), $username = null,
                           $password = null, $timeout = null) {
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
            throw new TwilioException('Unable to update record', $response->getStatusCode());
        }

        return $response->getContent();
    }

    public function delete($method, $uri, $params = array(), $data = array(),
                           $headers = array(), $username = null,
                           $password = null, $timeout = null) {
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
            throw new TwilioException('Unable to delete record', $response->getStatusCode());
        }

        return $response->getStatusCode() == 204;
    }

    public function readLimits($limit = null, $pageSize = null) {
        $pageLimit = Values::NONE;

        if ($limit) {
            if ($pageSize) {
                $pageSize = min($limit, self::MAX_PAGE_SIZE);
            }
            $pageLimit = (int)(ceil($limit / (float)$pageSize));
        }

        return array(
            'limit' => $limit ?: Values::NONE,
            'pageSize' => $pageSize ?: Values::NONE,
            'pageLimit' => $pageLimit,
        );
    }

    public function page($method, $uri, $params = array(), $data = array(),
                         $headers = array(), $username = null,
                         $password = null, $timeout = null) {
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

    public function stream($page, $limit = null, $pageLimit = null) {
        return new Stream($page, $limit, $pageLimit);
    }

    public function create($method, $uri, $params = array(), $data = array(),
                           $headers = array(), $username = null,
                           $password = null, $timeout = null) {
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
            throw new TwilioException('Unable to create record', $response->getStatusCode());
        }

        return $response->getContent();
    }

    /**
     * @return \Twilio\Domain $domain
     */
    public function getDomain() {
        return $this->domain;
    }

    public function __toString() {
        return '[Version]';
    }
}
