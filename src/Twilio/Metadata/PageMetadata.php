<?php

namespace Twilio\Metadata;

use Twilio\Page;

/**
 * Wrapper containing a page along with HTTP response metadata (headers, status code).
 * Allows access to response headers while maintaining backward compatibility.
 *
 * @template T of Page
 */
class PageMetadata extends IteratorMetadata
{
    private $page;

    /**
     * @param Page $page
     * @param int $statusCode
     * @param array $headers
     */
    public function __construct(
        Page $page,
        int   $statusCode,
        array $headers
    ) {
        parent::__construct($page, $statusCode, $headers);
        $this->page = $page;
    }

    /**
     * Get the page.
     *
     * @return Page
     */
    public function getPage(): Page
    {
        return $this->page;
    }

    public function nextPage(): ?PageMetadata
    {
        if (!$this->getPage()->getNextPageUrl()) {
            return null;
        }

        $response = $this->page->getResponse($this->page->getNextPageUrl());
        return new static(
            $this->page->createPage($response),
            $response->getStatusCode(),
            $response->getHeaders()
        );
    }

    public function previousPage(): ?PageMetadata
    {
        if (!$this->page->getPreviousPageUrl()) {
            return null;
        }

        $response = $this->page->getResponse($this->page->getPreviousPageUrl());
        return new static(
            $this->page->createPage($response),
            $response->getStatusCode(),
            $response->getHeaders()
        );
    }

    public function __toString(): string
    {
        return 'ArrayMetadata{' . parent::__toString() . '}';
    }
}
