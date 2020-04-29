<?php


namespace Twilio\Tests\Unit;

use Twilio\Domain;
use Twilio\Exceptions\RestException;
use Twilio\Http\CurlClient;
use Twilio\Http\Response;
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
     * @param int|Values::NONe $expectedPageLimit Expected page limit returned by readLimits
     * @dataProvider readLimitProvider
     */
    public function testReadLimits(string $message, ?int $limit, ?int $pageSize, $expectedLimit, $expectedPageSize, $expectedPageLimit): void {
        $actual = $this->version->readLimits($limit, $pageSize);
        $this->assertEquals($expectedLimit, $actual['limit'], "$message: Limit does not match");
        $this->assertEquals($expectedPageSize, $actual['pageSize'], "$message: PageSize does not match");
        $this->assertEquals($expectedPageLimit, $actual['pageLimit'], "$message: PageLimit does not match");
    }

    public function readLimitProvider(): array {
        return [
            [
                'Nothing Specified',
                null, null,
                Values::NONE, Values::NONE, Values::NONE,
            ],
            [
                'Limit Specified - Under Max Page Size',
                Version::MAX_PAGE_SIZE - 1, null,
                Version::MAX_PAGE_SIZE - 1, Version::MAX_PAGE_SIZE - 1, 1,
            ],
            [
                'Limit Specified - At Max Page Size',
                Version::MAX_PAGE_SIZE, null,
                Version::MAX_PAGE_SIZE, Version::MAX_PAGE_SIZE, 1,
            ],
            [
                'Limit Specified - Over Max Page Size',
                Version::MAX_PAGE_SIZE + 1, null,
                Version::MAX_PAGE_SIZE + 1, Version::MAX_PAGE_SIZE, 2,
            ],
            [
                'Page Size Specified - Under Max Page Size',
                null, Version::MAX_PAGE_SIZE - 1,
                Values::NONE, Version::MAX_PAGE_SIZE - 1, Values::NONE,
            ],
            [
                'Page Size Specified - At Max Page Size',
                null, Version::MAX_PAGE_SIZE,
                Values::NONE, Version::MAX_PAGE_SIZE, Values::NONE,
            ],
            [
                'Page Size Specified - Over Max Page Size',
                null, Version::MAX_PAGE_SIZE + 1,
                Values::NONE, Version::MAX_PAGE_SIZE, Values::NONE
            ],
            [
                'Limit less than Page Size',
                50, 100,
                50, 100, 1,
            ],
            [
                'Limit equal to Page Size',
                100, 100,
                100, 100, 1,
            ],
            [
                'Limit greater than Page Size - evenly divisible',
                100, 50,
                100, 50, 2,
            ],
            [
                'Limit greater than Page Size - not evenly divisible',
                100, 30,
                100, 30, 4
            ],
        ];
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
        $this->assertEquals($expected, $actual, $message);
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
        $this->assertEquals($expected, $actual, $message);
    }

    public function testRestExceptionWithDetails(): void {
        $this->curlClient
            ->expects($this->once())
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
            $this->assertEquals(20001, $rex->getCode());
            $this->assertEquals(400, $rex->getStatusCode());
            $this->assertEquals('[HTTP 400] Unable to fetch record: Bad request', $rex->getMessage());
            $this->assertEquals('https://www.twilio.com/docs/errors/20001', $rex->getMoreInfo());
            $this->assertEquals(["foo" => "bar"], $rex->getDetails());
        }
    }

    public function testRestExceptionWithoutDetails(): void {
        $this->curlClient
            ->expects($this->once())
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
            $this->assertEquals(20001, $rex->getCode());
            $this->assertEquals(400, $rex->getStatusCode());
            $this->assertEquals('[HTTP 400] Unable to fetch record: Bad request', $rex->getMessage());
            $this->assertEquals('https://www.twilio.com/docs/errors/20001', $rex->getMoreInfo());
            $this->assertEmpty($rex->getDetails());
        }
    }

    public function testRestException(): void {
        $this->curlClient
            ->expects($this->once())
            ->method('request')
            ->willReturn(new Response(400, ''));
        try {
            $this->version->fetch('get', 'http://foo.bar');
            self::fail();
        }catch (RestException $rex){
            $this->assertEquals(400, $rex->getCode());
            $this->assertEquals(400, $rex->getStatusCode());
            $this->assertEquals('[HTTP 400] Unable to fetch record', $rex->getMessage());
            $this->assertEquals('', $rex->getMoreInfo());
            $this->assertEmpty($rex->getDetails());
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
