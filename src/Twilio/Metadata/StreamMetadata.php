<?php

namespace Twilio\Metadata;

use Twilio\Page;
use Twilio\Stream;
use Iterator;

/**
 * Wrapper containing a page along with HTTP response metadata (headers, status code).
 * Allows access to response headers while maintaining backward compatibility.
 *
 * @template T of Stream
 */
class StreamMetadata extends IteratorMetadata
{
    private $stream;

    /**
     * @param Stream $stream
     * @param int $statusCode
     * @param array $headers
     */
    public function __construct(
        Stream $stream,
        int   $statusCode,
        array $headers
    ) {
        parent::__construct($stream, $statusCode, $headers);
        $this->stream = $stream;
    }

    /**
     * Get the stream.
     *
     * @return Stream
     */
    public function getStream(): Stream
    {
        return $this->stream;
    }

    public function __toString(): string
    {
        return 'StreamMetadata{' . parent::__toString();
    }
}
