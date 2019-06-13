<?php

namespace Twilio\Tests;

use PHPUnit\Framework\TestCase;
use Twilio\Rest\Client;

class HolodeckTestCase extends TestCase
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
