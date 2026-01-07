<?php

namespace Twilio\Tests\Unit\Metadata;

use Twilio\Tests\Unit\UnitTest;
use PHPUnit\Framework\MockObject\MockObject;
use Twilio\InstanceResource;
use Twilio\Metadata\ResourceMetadata;

/**
 * Test the ResourceMetadata class
 */
class ResourceMetadataTest extends UnitTest
{
    /** @var InstanceResource|MockObject */
    protected $mockResource;

    /** @var array */
    protected $headers;

    /** @var int */
    protected $statusCode;

    /** @var ResourceMetadata */
    protected $metadata;

    protected function setUp(): void
    {
        $this->mockResource = $this->createMock(InstanceResource::class);
        $this->headers = ['Content-Type' => 'application/json', 'X-API-Version' => '2010-04-01'];
        $this->statusCode = 200;
        $this->metadata = new ResourceMetadata($this->mockResource, $this->statusCode, $this->headers);
    }

    public function testGetResource(): void
    {
        $this->assertSame($this->mockResource, $this->metadata->getResource());
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

    public function testToString(): void
    {
        $expected = 'ResourceMetadata{statusCode=200, headers={"Content-Type":"application\/json","X-API-Version":"2010-04-01"}, resource=' . $this->mockResource . '}';
        $this->assertEquals($expected, (string)$this->metadata);
    }

    public function testNullResourceHandling(): void
    {
        $metadata = new ResourceMetadata(null, $this->statusCode, $this->headers);
        // ResourceMetadata should replace null with true
        $this->assertTrue($metadata->getResource());
    }
}