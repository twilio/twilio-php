<?php


namespace Twilio\Tests\Unit;

use Twilio\Domain;
use Twilio\Rest\Client;
use Twilio\Values;
use Twilio\Version;

class TestDomain extends Domain {}
class TestVersion extends Version {}

class VersionTest extends UnitTest {

    /**
     * @param $message
     * @param $limit
     * @param $pageSize
     * @param $expectedLimit
     * @param $expectedPageSize
     * @param $expectedPageLimit
     * @dataProvider readLimitProvider
     */
    public function testReadLimits($message, $limit, $pageSize, $expectedLimit, $expectedPageSize, $expectedPageLimit) {
        $version = new TestVersion(new TestDomain(new Client('username', 'password')));
        $actual = $version->readLimits($limit, $pageSize);
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
}