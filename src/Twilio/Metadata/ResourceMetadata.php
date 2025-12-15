<?php

namespace Twilio\Metadata;

use Twilio\InstanceResource;

/**
 * Wrapper containing a resource along with HTTP response metadata (headers, status code).
 * Allows access to response headers while maintaining backward compatibility.
 *
 * @template T of InstanceResource
 */
class ResourceMetadata
{
    /**
     * @var InstanceResource
     */
    private $resource;

    /**
     * @var array<string, string>
     */
    private $headers;

    /**
     * @var int
     */
    private $statusCode;

    /**
     * Create response metadata wrapper.
     *
     * @param ?InstanceResource $resource the resource object (Message, Call, etc.)
     * @param int $statusCode HTTP status code
     * @param array<string, string> $headers HTTP response headers
     */
    public function __construct(
        ?InstanceResource $resource,
        int $statusCode,
        array $headers
    ) {
        $this->resource = $resource ?? true;
        $this->statusCode = $statusCode;
        $this->headers = $headers;
    }

    /**
     * Get the resource.
     */
    public function getResource() {
        return $this->resource;
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
     * String representation of the response metadata.
     *
     * @return string
     */
    public function __toString(): string
    {
        return 'ResourceMetadata{' .
            'statusCode=' . $this->statusCode .
            ', headers=' . json_encode($this->headers) .
            ', resource=' . $this->resource .
            '}';
    }
}
