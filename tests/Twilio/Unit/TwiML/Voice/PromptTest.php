<?php

namespace Twilio\Tests\Unit\TwiML\Voice;

use Twilio\Tests\Unit\TwiML\TwiMLTest;
use Twilio\TwiML\Voice\Prompt;

class PromptTest extends TwiMLTest {

    private $prompt;

    protected function setUp(): void {
        $this->prompt = new Prompt();
    }

    public function testAddSay(): void {
        $this->prompt->say("hello world", array('key'=>'value'));
        $this->compareXml('<Prompt><Say key="value">hello world</Say></Prompt>', $this->prompt);
    }

    public function testAddPlay(): void {
        $this->prompt->play("testUrl", array('key'=>'value'));
        $this->compareXml('<Prompt><Play key="value">testUrl</Play></Prompt>', $this->prompt);
    }

    public function testAddPause(): void {
        $this->prompt->pause(array('key'=>'value'));
        $this->compareXml('<Prompt><Pause key="value"></Pause></Prompt>', $this->prompt);
    }

    public function testSetFor(): void {
        $this->prompt->setFor_("test");
        $this->compareXml('<Prompt for_="test"></Prompt>', $this->prompt);
    }

    public function testSetErrorType(): void {
        $this->prompt->setErrorType("error");
        $this->compareXml('<Prompt errorType="error"></Prompt>', $this->prompt);
    }

    public function testSetCardType(): void {
        $this->prompt->setCardType("testCardType");
        $this->compareXml('<Prompt cardType="testCardType"></Prompt>', $this->prompt);
    }

    public function testSetAttempt(): void {
        $this->prompt->setAttempt(4);
        $this->compareXml('<Prompt attempt="4"></Prompt>', $this->prompt);
    }
}
