<?php

namespace Twilio\Tests\Unit\TwiML\Voice;

use Twilio\Tests\Unit\TwiML\TwiMLTest;
use Twilio\TwiML\Voice\SsmlBreak;

class SsmlBreakTest extends TwiMLTest {

    private $ssmlBreak;

    protected function setUp(): void {
        $this->ssmlBreak = new SsmlBreak();
    }

    public function testSetStrength(): void {
        $this->ssmlBreak->setStrength("test");
        $this->compareXml('<break strength="test"></break>', $this->ssmlBreak);
    }

    public function testSetTime(): void {
        $this->ssmlBreak->setTime("5");
        $this->compareXml('<break time="5"></break>', $this->ssmlBreak);
    }
}
