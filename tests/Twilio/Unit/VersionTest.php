<?php


namespace Twilio\Tests\Unit;

use Twilio\Domain;
use Twilio\Exceptions\RestException;
use Twilio\Http\CurlClient;
use Twilio\Http\Response;
use Twilio\Page;
use Twilio\Rest\Client;
use Twilio\Values;
use Twilio\Version;

/**
 * Simplified Domain for testing
 * @package Twilio\Tests\Unit
 */
class TestDomain extends Domain {

    /**
     * Translate version relative URIs into absolute URLs
     * Since this test file is about testing the behaviors of Version
     * the Domain methods are all simplified.
     *
     * @param string $uri Version relative URI
     * @return string Absolute URL for this domain
     */
    public function absoluteUrl(string $uri): string {
        return "domain:$uri";
    }

}

/**
 * TestVersion is used for testing Version behaviors
 * @package Twilio\Tests\Unit
 */
class TestVersion extends Version {
    /**
     * @return string
     */
    public function getVersion(): string {
        return $this->version;
    }

    /**
     * @param string $version
     */
    public function setVersion(string $version): void {
        $this->version = $version;
    }
}


class TestPage extends Page {
    public function buildInstance(array $payload): array {
        return $payload;
    }
}

class VersionTest extends UnitTest {
    protected $curlClient;
    /** @var Client $client */
    protected $client;
    /** @var TestDomain $domain */
    protected $domain;
    /** @var TestVersion $version */
    protected $version;

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void {
        $this->curlClient = $this->createMock(CurlClient::class);
        $this->client = new Client('username', 'password', null, null, $this->curlClient, null);
        $this->domain = new TestDomain($this->client);
        $this->version = new TestVersion($this->domain);
    }

    /**
     * @param string $message Case message to display on assertion error
     * @param int|null $limit Limit provided by the user
     * @param int|null $pageSize PageSize provided by the user
     * @param int|Values::NONE $expectedLimit Expected limit returned by readLimits
     * @param int|Values::NONE $expectedPageSize Expected page size returned by readLimits
     * @dataProvider readLimitProvider
     */
    public function testReadLimits(string $message, ?int $limit, ?int $pageSize, $expectedLimit, $expectedPageSize): void {
        $actual = $this->version->readLimits($limit, $pageSize);
        self::assertEquals($expectedLimit, $actual['limit'], "$message: Limit does not match");
        self::assertEquals($expectedPageSize, $actual['pageSize'], "$message: PageSize does not match");
    }

    public function readLimitProvider(): array {
        return [
            [
                'Nothing Specified',
                null, null,
                Values::NONE, Values::NONE,
            ],
            [
                'Limit Specified - Under Max Page Size',
                Version::MAX_PAGE_SIZE - 1, null,
                Version::MAX_PAGE_SIZE - 1, Version::MAX_PAGE_SIZE - 1,
            ],
            [
                'Limit Specified - At Max Page Size',
                Version::MAX_PAGE_SIZE, null,
                Version::MAX_PAGE_SIZE, Version::MAX_PAGE_SIZE,
            ],
            [
                'Limit Specified - Over Max Page Size',
                Version::MAX_PAGE_SIZE + 1, null,
                Version::MAX_PAGE_SIZE + 1, Version::MAX_PAGE_SIZE,
            ],
            [
                'Page Size Specified - Under Max Page Size',
                null, Version::MAX_PAGE_SIZE - 1,
                Values::NONE, Version::MAX_PAGE_SIZE - 1
            ],
            [
                'Page Size Specified - At Max Page Size',
                null, Version::MAX_PAGE_SIZE,
                Values::NONE, Version::MAX_PAGE_SIZE
            ],
            [
                'Page Size Specified - Over Max Page Size',
                null, Version::MAX_PAGE_SIZE + 1,
                Values::NONE, Version::MAX_PAGE_SIZE
            ],
        ];
    }

    /**
     * @param string $message Case message to display on assertion error
     * @param int|null $limit Limit provided by the user
     * @param int|null $pageLimit Page limit provided by the user
     * @param int $expectedCount Expected record count returned by stream
     * @dataProvider streamProvider
     */
    public function testStream(string $message, ?int $limit, ?int $pageLimit, int $expectedCount): void {
        $this->curlClient
            ->method('request')
            ->will(self::onConsecutiveCalls(
                new Response(
                    200,
                    '{
                        "next_page_uri": "/2010-04-01/Accounts/AC123/Messages.json?Page=1",
                        "messages": [{"body": "payload0"}, {"body": "payload1"}]
                    }'),
                new Response(
                    200,
                    '{
                        "next_page_uri": "/2010-04-01/Accounts/AC123/Messages.json?Page=2",
                        "messages": [{"body": "payload2"}, {"body": "payload3"}]
                    }'),
                new Response(
                    200,
                    '{
                        "next_page_uri": null,
                        "messages": [{"body": "payload4"}]
                    }')
            ));

        $response = $this->version->page('GET', '/Accounts/AC123/Messages.json');
        $page = new TestPage($this->version, $response);
        $messages = $this->version->stream($page, $limit, $pageLimit);

        self::assertEquals($expectedCount, \iterator_count($messages), "$message: Count does not match");
    }

    public function streamProvider(): array {
        return [
            ['No limits', null, null, 5],
            ['Item limit', 3, null, 3],
            ['Page limit', null, 1, 2],
        ];
    }

    /**
     * Test HTTP 307 redirect for Deactivations API
     */
    public function testHttp307Redirect(): void {
        $this->curlClient
            ->expects(self::once())
            ->method('request')
            ->willReturn(new Response(307, '{
                "redirect_to": "https://com-twilio-dev-messaging-deactivations.s3.amazonaws.com"
            }'));
        $response = $this->version->fetch('GET', 'http://foo.bar/Deactivations');
    }

    /**
     * @param string $message Case message to display on assertion error
     * @param string $prefix Version prefix to test
     * @param string $uri URI to make relative to the version
     * @param string $expected Expected relative URI
     * @dataProvider relativeUriProvider
     */
    public function testRelativeUri(string $message, string $prefix, string $uri, string $expected): void {
        $this->version->setVersion($prefix);
        $actual = $this->version->relativeUri($uri);
        self::assertEquals($expected, $actual, $message);
    }

    public function relativeUriProvider(): array {
        $cases = [];

        $modes = [
            'normal' => static function($x) { return $x; },
            'prepend' => static function($x) { return "/$x"; },
            'append' => static function($x) { return "$x/"; },
            'surround' => static function($x) { return "/$x/"; },
        ];

        foreach ($modes as $prefixMode => $prefixFunc) {
            foreach ($modes as $pathMode => $pathFunc) {
                $prefix = $prefixFunc('v1');
                $path = $pathFunc('path');

                $cases[] = [
                    "Scalar - Prefix $prefixMode - Path $pathMode",
                    $prefix,
                    $path,
                    'v1/path',
                ];
            }
        }

        foreach ($modes as $prefixMode => $prefixFunc) {
            foreach ($modes as $pathMode => $pathFunc) {
                $prefix = $prefixFunc('v2');
                $path = $pathFunc('path/to/resource');

                $cases[] = [
                    "Multipart Path - Prefix $prefixMode - Path $pathMode",
                    $prefix,
                    $path,
                    'v2/path/to/resource',
                ];
            }
        }

        foreach ($modes as $prefixMode => $prefixFunc) {
            foreach ($modes as $pathMode => $pathFunc) {
                $prefix = $prefixFunc('v3');
                $path = $pathFunc('path/to/resource.json');

                $cases[] = [
                    "Multipart Path with Extension - Prefix $prefixMode - Path $pathMode",
                    $prefix,
                    $path,
                    'v3/path/to/resource.json',
                ];
            }
        }

        return $cases;
    }

    /**
     * @param string $message Case message to display on assertion error
     * @param string $prefix Version prefix to test
     * @param string $uri URI to make absolute to the domain
     * @param string $expected Expected absolute URL
     * @dataProvider absoluteUrlProvider
     */
    public function testAbsoluteUrl(string $message, string $prefix, string $uri, string $expected): void {
        $this->version->setVersion($prefix);
        $actual = $this->version->absoluteUrl($uri);
        self::assertEquals($expected, $actual, $message);
    }

    public function testRestExceptionWithDetails(): void {
        $this->curlClient
            ->expects(self::once())
            ->method('request')
            ->willReturn(new Response(400, '{
                                    "code": 20001,
                                    "message": "Bad request",
                                    "more_info": "https://www.twilio.com/docs/errors/20001",
                                    "status": 400,
                                    "details": {
                                        "foo": "bar" }
                                    }'));
        try {
            $this->version->fetch('get', 'http://foo.bar');
            self::fail();
        }catch (RestException $rex){
            self::assertEquals(20001, $rex->getCode());
            self::assertEquals(400, $rex->getStatusCode());
            self::assertEquals('[HTTP 400] Unable to fetch record: Bad request', $rex->getMessage());
            self::assertEquals('https://www.twilio.com/docs/errors/20001', $rex->getMoreInfo());
            self::assertEquals(["foo" => "bar"], $rex->getDetails());
        }
    }

    public function testRestExceptionWithoutDetails(): void {
        $this->curlClient
            ->expects(self::once())
            ->method('request')
            ->willReturn(new Response(400, '{
                                    "code": 20001,
                                    "message": "Bad request",
                                    "more_info": "https://www.twilio.com/docs/errors/20001",
                                    "status": 400
                                    }'));
        try {
            $this->version->fetch('get', 'http://foo.bar');
            self::fail();
        }catch (RestException $rex){
            self::assertEquals(20001, $rex->getCode());
            self::assertEquals(400, $rex->getStatusCode());
            self::assertEquals('[HTTP 400] Unable to fetch record: Bad request', $rex->getMessage());
            self::assertEquals('https://www.twilio.com/docs/errors/20001', $rex->getMoreInfo());
            self::assertEmpty($rex->getDetails());
        }
    }

    public function testRestException(): void {
        $this->curlClient
            ->expects(self::once())
            ->method('request')
            ->willReturn(new Response(400, ''));
        try {
            $this->version->fetch('get', 'http://foo.bar');
            self::fail();
        }catch (RestException $rex){
            self::assertEquals(400, $rex->getCode());
            self::assertEquals(400, $rex->getStatusCode());
            self::assertEquals('[HTTP 400] Unable to fetch record', $rex->getMessage());
            self::assertEquals('', $rex->getMoreInfo());
            self::assertEmpty($rex->getDetails());
        }
    }

    public function absoluteUrlProvider(): array {
        $cases = $this->relativeUriProvider();
        foreach ($cases as &$case) {
            $case[3] = "domain:{$case[3]}";
        }
        return $cases;
    }
}
