<?php

namespace Twilio\Tests\Unit\TwiML\Voice;

use Twilio\Tests\Unit\TwiML\TwiMLTest;
use Twilio\TwiML\Voice\Gather;

class GatherTest extends TwiMLTest {

    private $gather;

    protected function setUp(): void {
        $this->gather = new Gather();
    }

    public function testAddASayToGather(): void {
        $this->gather->say('Some say');
        $this->compareXml('<Gather><Say>Some say</Say></Gather>', $this->gather);
    }

    public function testAddAPauseToGather(): void {
        $this->gather->pause();
        $this->compareXml('<Gather><Pause></Pause></Gather>', $this->gather);
    }

    public function testAddAPlayWithUrl(): void {
        $this->gather->play("https://api.twilio.com");
        $this->compareXml('<Gather><Play>https://api.twilio.com</Play></Gather>', $this->gather);
    }

    public function testSetInput(): void {
        $this->gather->setInput("testInput");
        $this->compareXml('<Gather input="testInput"/>', $this->gather);
    }

    public function testSetAction(): void {
        $this->gather->setAction("testAction");
        $this->compareXml('<Gather action="testAction"/>', $this->gather);
    }

    public function testSetMethod(): void {
        $this->gather->setMethod("testMethod");
        $this->compareXml('<Gather method="testMethod"/>', $this->gather);
    }

    public function testSetTimeout(): void {
        $this->gather->setTimeout(3);
        $this->compareXml('<Gather timeout="3"/>', $this->gather);
    }

    public function testSetSpeechTimeout(): void {
        $this->gather->setSpeechTimeout(5);
        $this->compareXml('<Gather speechTimeout="5"/>', $this->gather);
    }

    public function testSetMaxSpeechTime(): void {
        $this->gather->setMaxSpeechTime(1);
        $this->compareXml('<Gather maxSpeechTime="1"/>', $this->gather);
    }

    public function testSetProfanityFilterTrue(): void {
        $this->gather->setProfanityFilter(true);
        $this->compareXml('<Gather profanityFilter="1"/>', $this->gather);
    }

    public function testSetProfanityFilterFalse(): void {
        $this->gather->setProfanityFilter(false);
        $this->compareXml('<Gather profanityFilter=""/>', $this->gather);
    }

    public function testSetFinishOnKey(): void {
        $this->gather->setFinishOnKey("test");
        $this->compareXml('<Gather finishOnKey="test"/>', $this->gather);
    }

    public function testSetNumDigits(): void {
        $this->gather->setNumDigits(6);
        $this->compareXml('<Gather numDigits="6"/>', $this->gather);
    }

    public function testSetPartialResultCallback(): void {
        $this->gather->setPartialResultCallback("https://api.twilio.com");
        $this->compareXml('<Gather partialResultCallback="https://api.twilio.com"/>', $this->gather);
    }

    public function testSetPartialResultCallbackMethod(): void {
        $this->gather->setPartialResultCallbackMethod("testMethod");
        $this->compareXml('<Gather partialResultCallbackMethod="testMethod"/>', $this->gather);
    }

    public function testSetLanguage(): void {
        $this->gather->setLanguage("English");
        $this->compareXml('<Gather language="English"/>', $this->gather);
    }

    public function testSetHints(): void {
        $this->gather->setHints("testHints");
        $this->compareXml('<Gather hints="testHints"/>', $this->gather);
    }

    public function testSetBargeInTrue(): void {
        $this->gather->setBargeIn(true);
        $this->compareXml('<Gather bargeIn="1"/>', $this->gather);
    }

    public function testSetBargeInFalse(): void {
        $this->gather->setBargeIn(false);
        $this->compareXml('<Gather bargeIn=""/>', $this->gather);
    }

    public function testSetDebugTrue(): void {
        $this->gather->setDebug(true);
        $this->compareXml('<Gather debug="1"/>', $this->gather);
    }

    public function testSetDebugFalse(): void {
        $this->gather->setDebug(false);
        $this->compareXml('<Gather debug=""/>', $this->gather);
    }

    public function testSetActionOnEmptyResultTrue(): void {
        $this->gather->setActionOnEmptyResult(true);
        $this->compareXml('<Gather actionOnEmptyResult="1"/>', $this->gather);
    }

    public function testSetActionOnEmptyResultFalse(): void {
        $this->gather->setActionOnEmptyResult(false);
        $this->compareXml('<Gather actionOnEmptyResult=""/>', $this->gather);
    }

    public function testSetSpeechModel(): void {
        $this->gather->setSpeechModel("testModel");
        $this->compareXml('<Gather speechModel="testModel"/>', $this->gather);
    }

    public function testSetEnhancedTrue(): void {
        $this->gather->setEnhanced(true);
        $this->compareXml('<Gather enhanced="1"/>', $this->gather);
    }

    public function testSetEnhancedFalse(): void {
        $this->gather->setEnhanced(false);
        $this->compareXml('<Gather enhanced=""/>', $this->gather);
    }
}
