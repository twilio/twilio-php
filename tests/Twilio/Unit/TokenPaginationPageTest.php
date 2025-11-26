<?php

namespace Twilio\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Twilio\Domain;
use Twilio\Exceptions\KeyErrorException;
use Twilio\Http\CurlClient;
use Twilio\Http\Response;
use Twilio\Rest\Client;
use Twilio\Version;
use Twilio\TokenPaginationPage;

/**
 * Concrete implementation of TokenPaginationPage for testing
 */
class TestableTokenPaginationPage extends TokenPaginationPage {
    public function buildInstance(array $payload): array {
        return $payload;
    }

    // Expose protected properties for testing
    public function getKey(): ?string {
        return $this->key;
    }

    public function getPageSize(): int {
        return $this->pageSize;
    }

    public function getNextToken(): ?string {
        return $this->nextToken;
    }

    public function getPreviousToken(): ?string {
        return $this->previousToken;
    }

    public function getBaseUrl(): string {
        return $this->url;
    }

    public function getQueryStringForTest(?string $pageToken): string {
        return $this->getQueryString($pageToken);
    }

    // Force URL for testing specific scenarios
    public function setBaseUrl(string $url): void {
        $this->url = $url;
    }

    public function setTokens(?string $nextToken, ?string $previousToken): void {
        $this->nextToken = $nextToken;
        $this->previousToken = $previousToken;
        // Reset cached URLs to force regeneration
        $this->nextPageUrl = null;
        $this->previousPageUrl = null;
    }

    public function setPageSize(int $pageSize): void {
        $this->pageSize = $pageSize;
    }
}

class TokenPaginationPageTest extends TestCase
{
    protected $domain;
    protected $version;
    protected $httpClient;
    protected $curlClient;

    protected function setUp(): void {
        // Create the CurlClient mock
        $this->curlClient = $this->createMock(CurlClient::class);

        // Add lastRequest property for URL extraction
        $this->curlClient->lastRequest = [
            CURLOPT_URL => 'https://test.twilio.com/v1/Accounts'
        ];

        // Create a mock Client that will return our mock CurlClient
        $this->mockClient = $this->getMockBuilder(Client::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getHttpClient'])
            ->getMock();

        // Configure the mock Client to return our mock CurlClient
        $this->mockClient->method('getHttpClient')
            ->willReturn($this->curlClient);

        // Create a mock Domain that will return our mock Client
        $this->domain = $this->getMockBuilder(Domain::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getClient'])
            ->getMock();

        // Configure the mock Domain to return our mock Client
        $this->domain->method('getClient')
            ->willReturn($this->mockClient);

        // Create a mock Version that will return our mock Domain
        $this->version = $this->getMockBuilder(Version::class)
            ->disableOriginalConstructor()
            ->onlyMethods(['getDomain'])
            ->getMock();

        // Configure the mock Version to return our mock Domain
        $this->version->method('getDomain')
            ->willReturn($this->domain);
    }

    /**
     * Test constructor with valid response and token data
     */
    public function testConstructor(): void
    {
        // Create a response with token pagination metadata
        $response = new Response(200, '{"meta": {"key": "items", "pageSize": 25, "nextToken": "next123", "previousToken": "prev456"}, "items": [{"id": 1}]}');

        $page = new TestableTokenPaginationPage($this->version, $response);

        // Check that metadata was properly extracted
        $this->assertEquals('items', $page->getKey());
        $this->assertEquals(25, $page->getPageSize());
        $this->assertEquals('next123', $page->getNextToken());
        $this->assertEquals('prev456', $page->getPreviousToken());

        // Check URL extraction from curl client
        $this->assertEquals('https://test.twilio.com/v1/Accounts', $page->getBaseUrl());
    }

    /**
     * Test constructor with no metadata
     */
    public function testConstructorWithNoMetadata(): void
    {
        // Create a response without metadata
        $response = new Response(200, '{"items": [{"id": 1}]}');

        // This should throw since key is required
        $this->expectException(KeyErrorException::class);
        $page = new TestableTokenPaginationPage($this->version, $response);
    }

    /**
     * Test constructor with empty response
     */
    public function testConstructorWithEmptyResponse(): void
    {
        $response = new Response(200, '{}');

        // This should throw since key is required
        $this->expectException(KeyErrorException::class);
        $page = new TestableTokenPaginationPage($this->version, $response);
    }

    /**
     * Test loadPage with valid key
     */
    public function testLoadPageWithValidKey(): void
    {
        $response = new Response(200, '{"meta": {"key": "items", "pageSize": 25}, "items": [{"id": 1}]}');

        $page = new TestableTokenPaginationPage($this->version, $response);

        // Get reflection to access protected method
        $reflector = new \ReflectionObject($page);
        $method = $reflector->getMethod('loadPage');
        $method->setAccessible(true);

        $result = $method->invoke($page);
        $this->assertEquals([['id' => 1]], $result);
    }

    /**
     * Test getQueryString with pageSize only
     */
    public function testGetQueryStringWithPageSizeOnly(): void
    {
        $response = new Response(200, '{"meta": {"key": "items", "pageSize": 25}, "items": [{"id": 1}]}');
        $page = new TestableTokenPaginationPage($this->version, $response);

        $this->assertEquals('?pageSize=25', $page->getQueryStringForTest(null));
    }

    /**
     * Test getQueryString with token only
     */
    public function testGetQueryStringWithTokenOnly(): void
    {
        $response = new Response(200, '{"meta": {"key": "items", "pageSize": 0}, "items": [{"id": 1}]}');
        $page = new TestableTokenPaginationPage($this->version, $response);

        $this->assertEquals('?pageToken=test123', $page->getQueryStringForTest('test123'));
    }

    /**
     * Test getQueryString with both pageSize and token
     */
    public function testGetQueryStringWithBoth(): void
    {
        $response = new Response(200, '{"meta": {"key": "items", "pageSize": 25}, "items": [{"id": 1}]}');
        $page = new TestableTokenPaginationPage($this->version, $response);

        $this->assertEquals('?pageSize=25&pageToken=test123', $page->getQueryStringForTest('test123'));
    }

    /**
     * Test getQueryString with empty token
     */
    public function testGetQueryStringWithEmptyToken(): void
    {
        $response = new Response(200, '{"meta": {"key": "items", "pageSize": 25}, "items": [{"id": 1}]}');
        $page = new TestableTokenPaginationPage($this->version, $response);

        $this->assertEquals('?pageSize=25', $page->getQueryStringForTest(''));
    }

    /**
     * Test getNextPageUrl with valid nextToken
     */
    public function testGetNextPageUrl(): void
    {
        $response = new Response(200, '{"meta": {"key": "items", "pageSize": 25, "nextToken": "next123"}, "items": [{"id": 1}]}');
        $page = new TestableTokenPaginationPage($this->version, $response);

        $expectedUrl = 'https://test.twilio.com/v1/Accounts?pageSize=25&pageToken=next123';
        $this->assertEquals($expectedUrl, $page->getNextPageUrl());

        // Call again to test caching
        $this->assertEquals($expectedUrl, $page->getNextPageUrl());
    }

    /**
     * Test getNextPageUrl with null nextToken
     */
    public function testGetNextPageUrlWithNullToken(): void
    {
        $response = new Response(200, '{"meta": {"key": "items", "pageSize": 25}, "items": [{"id": 1}]}');
        $page = new TestableTokenPaginationPage($this->version, $response);

        $this->assertNull($page->getNextPageUrl());
    }

    /**
     * Test getPreviousPageUrl with valid previousToken
     */
    public function testGetPreviousPageUrl(): void
    {
        $response = new Response(200, '{"meta": {"key": "items", "pageSize": 25, "previousToken": "prev456"}, "items": [{"id": 1}]}');
        $page = new TestableTokenPaginationPage($this->version, $response);

        $expectedUrl = 'https://test.twilio.com/v1/Accounts?pageSize=25&pageToken=prev456';
        $this->assertEquals($expectedUrl, $page->getPreviousPageUrl());

        // Call again to test caching
        $this->assertEquals($expectedUrl, $page->getPreviousPageUrl());
    }

    /**
     * Test getPreviousPageUrl with null previousToken
     */
    public function testGetPreviousPageUrlWithNullToken(): void
    {
        $response = new Response(200, '{"meta": {"key": "items", "pageSize": 25}, "items": [{"id": 1}]}');
        $page = new TestableTokenPaginationPage($this->version, $response);

        $this->assertNull($page->getPreviousPageUrl());
    }

    /**
     * Test with empty base URL
     */
    public function testWithEmptyBaseUrl(): void
    {
        $response = new Response(200, '{"meta": {"key": "items", "pageSize": 25, "nextToken": "next123"}, "items": [{"id": 1}]}');

        // Remove lastRequest for this test to simulate missing URL
        $this->curlClient->lastRequest = null;

        $page = new TestableTokenPaginationPage($this->version, $response);

        // URL should be empty
        $this->assertEquals('', $page->getBaseUrl());

        // getNextPageUrl should return empty string
        $this->assertEquals('?pageSize=25&pageToken=next123', $page->getNextPageUrl());
    }

    /**
     * Test __toString method
     */
    public function testToString(): void
    {
        $response = new Response(200, '{"meta": {"key": "items", "pageSize": 25}, "items": [{"id": 1}]}');
        $page = new TestableTokenPaginationPage($this->version, $response);
        $this->assertEquals('[TokenPaginationPage]', (string)$page);
    }

}
