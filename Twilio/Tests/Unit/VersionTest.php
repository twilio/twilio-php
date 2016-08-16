<?php


namespace Twilio\Tests\Unit;

use Twilio\Domain;
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
    public function absoluteUrl($uri) {
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
    public function getVersion() {
        return $this->version;
    }

    /**
     * @param string $version
     */
    public function setVersion($version) {
        $this->version = $version;
    }
}

class VersionTest extends UnitTest {
    /** @var \Twilio\Rest\Client $client*/
    protected $client;
    /** @var \Twilio\Tests\Unit\TestDomain $domain */
    protected $domain;
    /** @var \Twilio\Tests\Unit\TestVersion $version */
    protected $version;

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        parent::setUp();
        $this->client = new Client('username', 'password');
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
    public function testReadLimits($message, $limit, $pageSize, $expectedLimit, $expectedPageSize, $expectedPageLimit) {
        $actual = $this->version->readLimits($limit, $pageSize);
        $this->assertEquals($expectedLimit, $actual['limit'], "$message: Limit does not match");
        $this->assertEquals($expectedPageSize, $actual['pageSize'], "$message: PageSize does not match");
        $this->assertEquals($expectedPageLimit, $actual['pageLimit'], "$message: PageLimit does not match");
    }

    public function readLimitProvider() {
        return array(
            array(
                'Nothing Specified',
                null, null,
                Values::NONE, Values::NONE, Values::NONE,
            ),
            array(
                'Limit Specified - Under Max Page Size',
                Version::MAX_PAGE_SIZE - 1, null,
                Version::MAX_PAGE_SIZE - 1, Version::MAX_PAGE_SIZE - 1, 1,
            ),
            array(
                'Limit Specified - At Max Page Size',
                Version::MAX_PAGE_SIZE, null,
                Version::MAX_PAGE_SIZE, Version::MAX_PAGE_SIZE, 1,
            ),
            array(
                'Limit Specified - Over Max Page Size',
                Version::MAX_PAGE_SIZE + 1, null,
                Version::MAX_PAGE_SIZE + 1, Version::MAX_PAGE_SIZE, 2,
            ),
            array(
                'Page Size Specified - Under Max Page Size',
                null, Version::MAX_PAGE_SIZE - 1,
                Values::NONE, Version::MAX_PAGE_SIZE - 1, Values::NONE,
            ),
            array(
                'Page Size Specified - At Max Page Size',
                null, Version::MAX_PAGE_SIZE,
                Values::NONE, Version::MAX_PAGE_SIZE, Values::NONE,
            ),
            array(
                'Page Size Specified - Over Max Page Size',
                null, Version::MAX_PAGE_SIZE + 1,
                Values::NONE, Version::MAX_PAGE_SIZE, Values::NONE
            ),
            array(
                'Limit less than Page Size',
                50, 100,
                50, 100, 1,
            ),
            array(
                'Limit equal to Page Size',
                100, 100,
                100, 100, 1,
            ),
            array(
                'Limit greater than Page Size - evenly divisible',
                100, 50,
                100, 50, 2,
            ),
            array(
                'Limit greater than Page Size - not evenly divisible',
                100, 30,
                100, 30, 4
            ),
        );
    }

    /**
     * @param string $message Case message to display on assertion error
     * @param string $prefix Version prefix to test
     * @param string $uri URI to make relative to the version
     * @param string $expected Expected relative URI
     * @dataProvider relativeUriProvider
     */
    public function testRelativeUri($message, $prefix, $uri, $expected) {
        $this->version->setVersion($prefix);
        $actual = $this->version->relativeUri($uri);
        $this->assertEquals($expected, $actual, $message);
    }

    public function relativeUriProvider() {
        $cases = array();

        $modes = array(
            'normal' => function($x) { return $x; },
            'prepend' => function($x) { return "/$x"; },
            'append' => function($x) { return "$x/"; },
            'surround' => function($x) { return "/$x/"; },
        );

        foreach ($modes as $prefixMode => $prefixFunc) {
            foreach ($modes as $pathMode => $pathFunc) {
                $prefix = $prefixFunc('v1');
                $path = $pathFunc('path');

                $cases[] = array(
                    "Scalar - Prefix $prefixMode - Path $pathMode",
                    $prefix,
                    $path,
                    'v1/path',
                );
            }
        }

        foreach ($modes as $prefixMode => $prefixFunc) {
            foreach ($modes as $pathMode => $pathFunc) {
                $prefix = $prefixFunc('v2');
                $path = $pathFunc('path/to/resource');

                $cases[] = array(
                    "Multipart Path - Prefix $prefixMode - Path $pathMode",
                    $prefix,
                    $path,
                    'v2/path/to/resource',
                );
            }
        }

        foreach ($modes as $prefixMode => $prefixFunc) {
            foreach ($modes as $pathMode => $pathFunc) {
                $prefix = $prefixFunc('v3');
                $path = $pathFunc('path/to/resource.json');

                $cases[] = array(
                    "Multipart Path with Extension - Prefix $prefixMode - Path $pathMode",
                    $prefix,
                    $path,
                    'v3/path/to/resource.json',
                );
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
    public function testAbsoluteUrl($message, $prefix, $uri, $expected) {
        $this->version->setVersion($prefix);
        $actual = $this->version->absoluteUrl($uri);
        $this->assertEquals($expected, $actual, $message);
    }

    public function absoluteUrlProvider() {
        $cases = $this->relativeUriProvider();
        foreach ($cases as &$case) {
            $case[3] = "domain:{$case[3]}";
        }
        return $cases;
    }
}