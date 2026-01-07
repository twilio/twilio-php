<?php

namespace Twilio\Tests\Unit\Metadata;

use Twilio\Tests\Unit\UnitTest;
use PHPUnit\Framework\MockObject\MockObject;
use Twilio\Stream;
use Twilio\Metadata\StreamMetadata;

/**
 * Test the StreamMetadata class
 */
class StreamMetadataTest extends UnitTest
{
    /** @var Stream|MockObject */
    protected $mockStream;

    /** @var array */
    protected $headers;

    /** @var int */
    protected $statusCode;

    /** @var StreamMetadata */
    protected $metadata;

    protected function setUp(): void
    {
        $this->mockStream = $this->getMockBuilder(Stream::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->headers = ['Content-Type' => 'application/json', 'X-API-Version' => '2010-04-01'];
        $this->statusCode = 200;
        $this->metadata = new StreamMetadata($this->mockStream, $this->statusCode, $this->headers);
    }

    public function testGetStream(): void
    {
        $this->assertSame($this->mockStream, $this->metadata->getStream());
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

        $this->mockStream->expects($this->once())
            ->method('current')
            ->willReturn($currentValue);

        $this->mockStream->expects($this->once())
            ->method('key')
            ->willReturn($keyValue);

        $this->mockStream->expects($this->once())
            ->method('next');

        $this->mockStream->expects($this->exactly(2))
            ->method('valid')
            ->willReturnOnConsecutiveCalls(true, false);

        $this->mockStream->expects($this->once())
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
        $expected = 'StreamMetadata{statusCode=200, headers={"Content-Type":"application\/json","X-API-Version":"2010-04-01"}, array=' . json_encode($this->mockStream) . '}';
        $this->assertEquals($expected, (string)$this->metadata);
    }
}