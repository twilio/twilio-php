<?php

namespace Twilio\Tests\Unit\TwiML\Voice;

use Twilio\Tests\Unit\TwiML\TwiMLTest;
use Twilio\TwiML\Voice\Parameter;

class ParameterTest extends TwiMLTest {

    private $parameter;

    protected function setUp(): void {
        $this->parameter = new Parameter();
    }

    public function testSetName(): void {
        $this->parameter->setName("test");
        $this->compareXml('<Parameter name="test"></Parameter>', $this->parameter);
    }

    public function testSetValue(): void {
        $this->parameter->setValue("value");
        $this->compareXml('<Parameter value="value"></Parameter>', $this->parameter);
    }
}
