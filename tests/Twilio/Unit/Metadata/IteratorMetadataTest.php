<?php

namespace Twilio\Tests\Unit\Metadata;

use Twilio\Tests\Unit\UnitTest;
use PHPUnit\Framework\MockObject\MockObject;
use Iterator;
use Twilio\Metadata\IteratorMetadata;

/**
 * Test the IteratorMetadata abstract class
 */
class IteratorMetadataTest extends UnitTest
{
    /**
     * A concrete implementation of IteratorMetadata for testing purposes
     */
    private static function getTestIteratorMetadata($iterator, $statusCode, $headers): IteratorMetadata
    {
        return new class($iterator, $statusCode, $headers) extends IteratorMetadata {
            public function __toString(): string
            {
                return 'TestIteratorMetadata{' . parent::__toString();
            }
        };
    }

    /** @var Iterator|MockObject */
    protected $mockIterator;

    /** @var array */
    protected $headers;

    /** @var int */
    protected $statusCode;

    /** @var IteratorMetadata */
    protected $metadata;

    protected function setUp(): void
    {
        $this->mockIterator = $this->createMock(Iterator::class);
        $this->headers = ['Content-Type' => 'application/json', 'X-API-Version' => '2010-04-01'];
        $this->statusCode = 200;
        $this->metadata = self::getTestIteratorMetadata($this->mockIterator, $this->statusCode, $this->headers);
    }

    public function testGetIterator(): void
    {
        $this->assertSame($this->mockIterator, $this->metadata->getIterator());
    }

    public function testGetHeaders(): void
    {
        $this->assertEquals($this->headers, $this->metadata->getHeaders());
    }

    public function testGetStatusCode(): void
    {
        $this->assertEquals($this->statusCode, $this->metadata->getStatusCode());
    }

    public function testGetHeader(): void
    {
        $this->assertEquals('application/json', $this->metadata->getHeader('Content-Type'));
        $this->assertEquals('2010-04-01', $this->metadata->getHeader('X-API-Version'));
        $this->assertNull($this->metadata->getHeader('Nonexistent-Header'));
    }

    public function testIteratorDelegation(): void
    {
        // Setup expectations for iterator methods
        $currentValue = ['key' => 'value'];
        $keyValue = 0;

        $this->mockIterator->expects($this->once())
            ->method('current')
            ->willReturn($currentValue);

        $this->mockIterator->expects($this->once())
            ->method('key')
            ->willReturn($keyValue);

        $this->mockIterator->expects($this->once())
            ->method('next');

        $this->mockIterator->expects($this->exactly(2))
            ->method('valid')
            ->willReturnOnConsecutiveCalls(true, false);

        $this->mockIterator->expects($this->once())
            ->method('rewind');

        // Test that the methods are properly delegated
        $this->assertSame($currentValue, $this->metadata->current());
        $this->assertSame($keyValue, $this->metadata->key());

        $this->metadata->next();

        $this->assertTrue($this->metadata->valid()); // First call
        $this->assertFalse($this->metadata->valid()); // Second call

        $this->metadata->rewind();
    }

    public function testToString(): void
    {
        $expected = 'TestIteratorMetadata{statusCode=200, headers={"Content-Type":"application\/json","X-API-Version":"2010-04-01"}, array={}}';
        $this->assertEquals($expected, (string)$this->metadata);
    }
}
