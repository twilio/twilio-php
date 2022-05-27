<?php

namespace Twilio\Tests\Unit\TwiML\Voice;

use Twilio\Tests\Unit\TwiML\TwiMLTest;
use Twilio\TwiML\Voice\Pause;

class PauseTest extends TwiMLTest {

    private $pause;

    protected function setUp(): void {
        $this->pause = new Pause();
    }

    public function testSetLength(): void {
        $this->pause->setLength(100);
        $this->compareXml('<Pause length="100"></Pause>', $this->pause);
    }
}
