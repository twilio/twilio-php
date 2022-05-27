<?php

namespace Twilio\Tests\Unit\TwiML\Voice;

use Twilio\Tests\Unit\TwiML\TwiMLTest;
use Twilio\TwiML\Voice\Refer;

class ReferTest extends TwiMLTest {

    private $refer;

    protected function setUp(): void {
        $this->refer = new Refer();
    }

    public function testAddSip(): void {
        $this->refer->sip("test");
        $this->compareXml('<Refer><Sip>test</Sip></Refer>', $this->refer);
    }

    public function testSetAction(): void {
        $this->refer->setAction("test");
        $this->compareXml('<Refer action="test"></Refer>', $this->refer);
    }

    public function testSetMethod(): void {
        $this->refer->setMethod("testMethod");
        $this->compareXml('<Refer method="testMethod"></Refer>', $this->refer);
    }
}
