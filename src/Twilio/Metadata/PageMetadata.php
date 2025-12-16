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
        $nextPageUrl = $this->page->getNextPageUrl();
        if (!$nextPageUrl) {
            return null;
        }

        $response = $this->page->getResponse($nextPageUrl);
        return new static(
            $this->page->createPage($response),
            $response->getStatusCode(),
            $response->getHeaders()
        );
    }

    public function previousPage(): ?PageMetadata
    {
        $previousPageUrl = $this->page->getPreviousPageUrl();
        if (!$previousPageUrl) {
            return null;
        }

        $response = $this->page->getResponse($previousPageUrl);
        return new static(
            $this->page->createPage($response),
            $response->getStatusCode(),
            $response->getHeaders()
        );
    }

    public function __toString(): string
    {
        return 'ArrayMetadata{' . parent::__toString();
    }
}
