<?php

namespace Twilio\Tests;

use \PHPUnit_Framework_TestCase;
use Twilio\Rest\Client;


class HolodeckTestCase extends PHPUnit_Framework_TestCase
{
    /** @var Holodeck $holodeck */
    protected $holodeck = null;
    /** @var Client $twilio */
    protected $twilio = null;

    protected function setUp() {
        $this->holodeck = new Holodeck();
        $this->twilio = new Client('ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'AUTHTOKEN', null, null, $this->holodeck);
    }

    protected function tearDown() {
        $this->twilio = null;
        $this->holodeck = null;
    }

    public function assertRequest($request) {
        $this->holodeck->assertRequest($request);
        $this->assertTrue(true);
    }
}
