<?php

namespace Twilio\Metadata;

use Iterator;
use ArrayIterator;

/**
 * Wrapper containing an array along with HTTP response metadata (headers, status code).
 * Allows access to response headers while maintaining backward compatibility.
 *
 * @template T of array
 */
class ArrayMetadata extends IteratorMetadata
{
    /**
     * @var array
     */
    private $array;

    /**
     * Create array metadata wrapper.
     *
     * @param array $array the array returned by read()
     * @param int $statusCode HTTP status code
     * @param array<string, string> $headers HTTP response headers
     */
    public function __construct(
        array $array,
        int $statusCode,
        array $headers
    ) {
        $this->array = $array;
        // Convert array to ArrayIterator to satisfy parent constructor
        $arrayIterator = new ArrayIterator($array);
        parent::__construct($arrayIterator, $statusCode, $headers);
    }

    /**
     * Get the original array.
     *
     * @return array
     */
    public function getArray(): array
    {
        return $this->array;
    }

    /**
     * String representation of the array metadata.
     *
     * @return string
     */
    public function __toString(): string
    {
        return 'ArrayMetadata{' . parent::__toString();
    }
}
