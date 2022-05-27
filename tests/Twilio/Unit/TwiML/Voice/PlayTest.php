<?php

namespace Twilio\Tests\Unit\TwiML\Voice;

use Twilio\Tests\Unit\TwiML\TwiMLTest;
use Twilio\TwiML\Voice\Play;

class PlayTest extends TwiMLTest {

    private $play;

    protected function setUp(): void {
        $this->play = new Play("");
    }

    public function testSetLoop(): void {
        $this->play->setLoop(10);
        $this->compareXml('<Play loop="10"/>', $this->play);
    }

    public function testSetDigits(): void {
        $this->play->setDigits("test");
        $this->compareXml('<Play digits="test"/>', $this->play);
    }
}