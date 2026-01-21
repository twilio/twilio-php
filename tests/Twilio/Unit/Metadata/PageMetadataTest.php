<?php

namespace Twilio\Tests\Unit\Metadata;

use Twilio\Tests\Unit\UnitTest;
use PHPUnit\Framework\MockObject\MockObject;
use Twilio\Http\Response;
use Twilio\Page;
use Twilio\Metadata\PageMetadata;

/**
 * Test the PageMetadata class
 */
class PageMetadataTest extends UnitTest
{
    /** @var Page|MockObject */
    protected $mockPage;

    /** @var array */
    protected $headers;

    /** @var int */
    protected $statusCode;

    /** @var PageMetadata */
    protected $metadata;

    protected function setUp(): void
    {
        $this->mockPage = $this->getMockBuilder(Page::class)
            ->disableOriginalConstructor()
            ->getMock();

        $this->headers = ['Content-Type' => 'application/json', 'X-API-Version' => '2010-04-01'];
        $this->statusCode = 200;
        $this->metadata = new PageMetadata($this->mockPage, $this->statusCode, $this->headers);
    }

    public function testGetPage(): void
    {
        $this->assertSame($this->mockPage, $this->metadata->getPage());
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

        $this->mockPage->expects($this->once())
            ->method('current')
            ->willReturn($currentValue);

        $this->mockPage->expects($this->once())
            ->method('key')
            ->willReturn($keyValue);

        $this->mockPage->expects($this->once())
            ->method('next');

        $this->mockPage->expects($this->exactly(2))
            ->method('valid')
            ->willReturnOnConsecutiveCalls(true, false);

        $this->mockPage->expects($this->once())
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
        $expected = 'ArrayMetadata{statusCode=200, headers={"Content-Type":"application\/json","X-API-Version":"2010-04-01"}, array=' . json_encode($this->mockPage) . '}';
        $this->assertEquals($expected, (string)$this->metadata);
    }

    public function testNextPageWhenNull(): void
    {
        $this->mockPage->expects($this->once())
            ->method('getNextPageUrl')
            ->willReturn(null);

        $this->assertNull($this->metadata->nextPage());
    }

    public function testNextPage(): void
    {
        $nextUrl = 'http://api.twilio.com/next-page';
        $nextPageMock = $this->getMockBuilder(Page::class)
            ->disableOriginalConstructor()
            ->getMock();

        $responseMock = $this->getMockBuilder(Response::class)
            ->disableOriginalConstructor()
            ->getMock();

        $responseMock->expects($this->once())
            ->method('getStatusCode')
            ->willReturn(200);

        $responseMock->expects($this->once())
            ->method('getHeaders')
            ->willReturn(['Next-Page-Header' => 'value']);

        $this->mockPage->expects($this->once())
            ->method('getNextPageUrl')
            ->willReturn($nextUrl);

        $this->mockPage->expects($this->once())
            ->method('getResponse')
            ->with($nextUrl)
            ->willReturn($responseMock);

        $this->mockPage->expects($this->once())
            ->method('createPage')
            ->with($responseMock)
            ->willReturn($nextPageMock);

        $nextPageMetadata = $this->metadata->nextPage();
        $this->assertInstanceOf(PageMetadata::class, $nextPageMetadata);
        $this->assertSame($nextPageMock, $nextPageMetadata->getPage());
        $this->assertEquals(200, $nextPageMetadata->getStatusCode());
        $this->assertEquals(['Next-Page-Header' => 'value'], $nextPageMetadata->getHeaders());
    }

    public function testPreviousPageWhenNull(): void
    {
        $this->mockPage->expects($this->once())
            ->method('getPreviousPageUrl')
            ->willReturn(null);

        $this->assertNull($this->metadata->previousPage());
    }

    public function testPreviousPage(): void
    {
        $prevUrl = 'http://api.twilio.com/prev-page';
        $prevPageMock = $this->getMockBuilder(Page::class)
            ->disableOriginalConstructor()
            ->getMock();

        $responseMock = $this->getMockBuilder(Response::class)
            ->disableOriginalConstructor()
            ->getMock();

        $responseMock->expects($this->once())
            ->method('getStatusCode')
            ->willReturn(200);

        $responseMock->expects($this->once())
            ->method('getHeaders')
            ->willReturn(['Prev-Page-Header' => 'value']);

        $this->mockPage->expects($this->once())
            ->method('getPreviousPageUrl')
            ->willReturn($prevUrl);

        $this->mockPage->expects($this->once())
            ->method('getResponse')
            ->with($prevUrl)
            ->willReturn($responseMock);

        $this->mockPage->expects($this->once())
            ->method('createPage')
            ->with($responseMock)
            ->willReturn($prevPageMock);

        $prevPageMetadata = $this->metadata->previousPage();
        $this->assertInstanceOf(PageMetadata::class, $prevPageMetadata);
        $this->assertSame($prevPageMock, $prevPageMetadata->getPage());
        $this->assertEquals(200, $prevPageMetadata->getStatusCode());
        $this->assertEquals(['Prev-Page-Header' => 'value'], $prevPageMetadata->getHeaders());
    }
}