<?php

namespace Twilio\Metadata;

use Iterator;

/**
 * Wrapper containing an iterator object along with HTTP response metadata (headers, status code).
 * Allows access to response headers while maintaining backward compatibility.
 *
 * @template T of Iterator
 */
abstract class IteratorMetadata implements Iterator
{
    /**
     * @var T
     */
    private $iterator;

    /**
     * @var array<string, string>
     */
    private $headers;

    /**
     * @var int
     */
    private $statusCode;

    /**
     * Create metadata wrapper.
     *
     * @param T $iterator the iterator object (Page, Stream etc.)
     * @param int $statusCode HTTP status code
     * @param array<string, string> $headers HTTP response headers
     */
    public function __construct(
        Iterator $iterator,
        int   $statusCode,
        array $headers
    ) {
        $this->iterator = $iterator;
        $this->statusCode = $statusCode;
        $this->headers = $headers;
    }

    /**
     * Get the iterator.
     *
     * @return Iterator
     */
    public function getIterator(): Iterator {
        return $this->iterator;
    }

    /**
     * Get HTTP response headers.
     *
     * @return array<string, string>
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * Get HTTP status code.
     *
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * Get specific header value.
     *
     * @param string $headerName name of the header
     * @return string|null header value or null if not present
     */
    public function getHeader(string $headerName): ?string
    {
        return $this->headers[$headerName] ?? null;
    }

    /**
     * String representation of the page metadata.
     *
     * @return string
     */
    public function __toString(): string {
        return 'statusCode=' . $this->getStatusCode() .
            ', headers=' . json_encode($this->getHeaders()) .
            ', array=' . json_encode($this->iterator) .
            '}';
    }

    /**
     * Implementation of Iterator interface
     */

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     */
    #[\ReturnTypeWillChange]
    public function current()
    {
        return $this->iterator->current();
    }

    public function next(): void
    {
        $this->iterator->next();
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     */
    #[\ReturnTypeWillChange]
    public function key()
    {
        return $this->iterator->key();
    }

    public function valid(): bool
    {
        return $this->iterator->valid();
    }

    public function rewind(): void
    {
        $this->iterator->rewind();
    }
}
