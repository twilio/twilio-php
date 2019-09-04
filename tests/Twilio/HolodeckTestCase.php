<?php

namespace Twilio\Tests;

use Twilio\Rest\Client;
use Twilio\Tests\Unit\UnitTest;

class HolodeckTestCase extends UnitTest
{
    /** @var Holodeck $holodeck */
    protected $holodeck = null;
    /** @var Client $twilio */
    protected $twilio = null;

    protected function doSetUp() {
        $this->holodeck = new Holodeck();
        $this->twilio = new Client('ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'AUTHTOKEN', null, null, $this->holodeck);
    }

    protected function doTearDown() {
        $this->twilio = null;
        $this->holodeck = null;
    }

    public function assertRequest($request) {
        $this->holodeck->assertRequest($request);
        $this->assertTrue(true);
    }
}
