<?php

namespace Twilio\Tests\Unit\TwiML\Voice;

use Twilio\Tests\Unit\TwiML\TwiMLTest;
use Twilio\TwiML\Voice\Reject;

class RejectTest extends TwiMLTest {

    private $reject;

    protected function setUp(): void {
        $this->reject = new Reject();
    }

    public function testSetReason(): void {
        $this->reject->setReason("test");
        $this->compareXml('<Reject reason="test"></Reject>', $this->reject);
    }
}
