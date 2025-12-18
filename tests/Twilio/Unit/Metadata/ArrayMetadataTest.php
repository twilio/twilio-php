<?php

namespace Twilio\Tests\Unit\Metadata;

use Twilio\Tests\Unit\UnitTest;
use Twilio\Metadata\ArrayMetadata;
use ArrayIterator;

/**
 * Test the ArrayMetadata class
 */
class ArrayMetadataTest extends UnitTest
{
    /** @var array */
    protected $testArray;

    /** @var array */
    protected $headers;

    /** @var int */
    protected $statusCode;

    /** @var ArrayMetadata */
    protected $metadata;

    protected function setUp(): void
    {
        $this->testArray = [
            ['id' => '1', 'name' => 'Test 1'],
            ['id' => '2', 'name' => 'Test 2'],
            ['id' => '3', 'name' => 'Test 3'],
        ];
        $this->headers = ['Content-Type' => 'application/json', 'X-API-Version' => '2010-04-01'];
        $this->statusCode = 200;
        $this->metadata = new ArrayMetadata($this->testArray, $this->statusCode, $this->headers);
    }

    public function testGetArray(): void
    {
        $this->assertEquals($this->testArray, $this->metadata->getArray());
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

    public function testIteratorBehavior(): void
    {
        // Test that ArrayMetadata can be iterated
        $items = [];
        foreach ($this->metadata as $key => $item) {
            $items[$key] = $item;
        }

        $this->assertEquals($this->testArray, $items);
    }

    public function testIteratorMethods(): void
    {
        // Test individual iterator methods
        $this->metadata->rewind();

        // First item
        $this->assertTrue($this->metadata->valid());
        $this->assertEquals(0, $this->metadata->key());
        $this->assertEquals(['id' => '1', 'name' => 'Test 1'], $this->metadata->current());

        // Second item
        $this->metadata->next();
        $this->assertTrue($this->metadata->valid());
        $this->assertEquals(1, $this->metadata->key());
        $this->assertEquals(['id' => '2', 'name' => 'Test 2'], $this->metadata->current());

        // Third item
        $this->metadata->next();
        $this->assertTrue($this->metadata->valid());
        $this->assertEquals(2, $this->metadata->key());
        $this->assertEquals(['id' => '3', 'name' => 'Test 3'], $this->metadata->current());

        // End of iteration
        $this->metadata->next();
        $this->assertFalse($this->metadata->valid());

        // Rewind and check first item again
        $this->metadata->rewind();
        $this->assertTrue($this->metadata->valid());
        $this->assertEquals(0, $this->metadata->key());
        $this->assertEquals(['id' => '1', 'name' => 'Test 1'], $this->metadata->current());
    }

    public function testToString(): void
    {
        $expected = 'ArrayMetadata{statusCode=200, headers={"Content-Type":"application\/json","X-API-Version":"2010-04-01"}, array=' . json_encode(new ArrayIterator($this->testArray)) . '}';
        $this->assertEquals($expected, (string)$this->metadata);
    }

    public function testEmptyArray(): void
    {
        $emptyArray = [];
        $metadata = new ArrayMetadata($emptyArray, $this->statusCode, $this->headers);

        $this->assertEquals($emptyArray, $metadata->getArray());

        // Iterator should not have any items
        $metadata->rewind();
        $this->assertFalse($metadata->valid());
    }
}