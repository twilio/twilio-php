<?php

namespace Twilio\Tests;

use Twilio\Rest\Client;
use Twilio\Tests\Unit\UnitTest;

class HolodeckTestCase extends UnitTest {
    /** @var Holodeck $holodeck */
    protected $holodeck;
    /** @var Client $twilio */
    protected $twilio;

    protected function setUp(): void {
        $this->holodeck = new Holodeck();
        $this->twilio = new Client('ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'AUTHTOKEN', null, null, $this->holodeck);
    }

    protected function tearDown(): void {
        $this->twilio = null;
        $this->holodeck = null;
    }

    public function assertRequest(Request $request): void {
        $this->holodeck->assertRequest($request);
        $this->assertTrue(true);
    }
}
