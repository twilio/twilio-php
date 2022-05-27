<?php

namespace Twilio\Tests\Unit\TwiML\Voice;

use Twilio\Tests\Unit\TwiML\TwiMLTest;
use Twilio\TwiML\Voice\Number;

class NumberTest extends TwiMLTest {

    private $number;

    protected function setUp(): void {
        $this->number = new Number("");
    }

    public function testSetAction(): void {
        $this->number->setSendDigits("0");
        $this->compareXml('<Number sendDigits="0"></Number>', $this->number);
    }

    public function testSetUrl(): void {
        $this->number->setUrl("test");
        $this->compareXml('<Number url="test"></Number>', $this->number);
    }

    public function testSetStatusCallbackEvent(): void {
        $this->number->setStatusCallbackEvent("callbackEvent");
        $this->compareXml('<Number statusCallbackEvent="callbackEvent"></Number>', $this->number);
    }

    public function testSetStatusCallback(): void {
        $this->number->setStatusCallback("callback");
        $this->compareXml('<Number statusCallback="callback"></Number>', $this->number);
    }

    public function testSetStatusCallbackMethod(): void {
        $this->number->setStatusCallbackMethod("callbackEventMethod");
        $this->compareXml('<Number statusCallbackMethod="callbackEventMethod"></Number>', $this->number);
    }

    public function testSetByoc(): void {
        $this->number->setByoc("byoc");
        $this->compareXml('<Number byoc="byoc"></Number>', $this->number);
    }
}