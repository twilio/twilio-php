<?php

namespace Twilio\Tests\Unit\TwiML\Voice;

use Twilio\Tests\Unit\TwiML\TwiMLTest;
use Twilio\TwiML\Voice\Stop;

class StopTest extends TwiMLTest {

    private $stop;

    protected function setUp(): void {
        $this->stop = new Stop();
    }

    public function testAddStream(): void {
        $this->stop->stream(array('key'=>'value'));
        $this->compareXml('<Stop><Stream key="value"></Stream></Stop>', $this->stop);
    }

    public function testAddSiprec(): void {
        $this->stop->siprec(array('key'=>'value'));
        $this->compareXml('<Stop><Siprec key="value"></Siprec></Stop>', $this->stop);
    }
}
