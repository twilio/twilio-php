<?php

namespace Twilio\Tests\Unit\TwiML\Voice;

use Twilio\Tests\Unit\TwiML\TwiMLTest;
use Twilio\TwiML\Voice\Pay;

class PayTest extends TwiMLTest {

    private $pay;

    protected function setUp(): void {
        $this->pay = new Pay();
    }

    public function testAddPrompt(): void {
        $this->pay->prompt(array("key"=>"value"));
        $this->compareXml('<Pay><Prompt key="value"/></Pay>', $this->pay);
    }

    public function testAddParameter(): void {
        $this->pay->parameter(array("key"=>"value"));
        $this->compareXml('<Pay><Parameter key="value"/></Pay>', $this->pay);
    }

    public function testSetInput(): void {
        $this->pay->setInput("input");
        $this->compareXml('<Pay input="input"/>', $this->pay);
    }

    public function testSetAction(): void {
        $this->pay->setAction("action");
        $this->compareXml('<Pay action="action"/>', $this->pay);
    }

    public function testSetBankAccount(): void {
        $this->pay->setBankAccountType("bankAccount");
        $this->compareXml('<Pay bankAccountType="bankAccount"/>', $this->pay);
    }

    public function testSetStatusCallback(): void {
        $this->pay->setStatusCallback("callback");
        $this->compareXml('<Pay statusCallback="callback"/>', $this->pay);
    }

    public function testSetStatusCallbackMethod(): void {
        $this->pay->setStatusCallbackMethod("callbackMethod");
        $this->compareXml('<Pay statusCallbackMethod="callbackMethod"/>', $this->pay);
    }

    public function testSetTimeout(): void {
        $this->pay->setTimeout(5);
        $this->compareXml('<Pay timeout="5"/>', $this->pay);
    }

    public function testSetMaxAttempts(): void {
        $this->pay->setMaxAttempts(1);
        $this->compareXml('<Pay maxAttempts="1"/>', $this->pay);
    }

    public function testSetSecurityCode(): void {
        $this->pay->setSecurityCode(3);
        $this->compareXml('<Pay securityCode="3"/>', $this->pay);
    }

    public function testSetPostalCode(): void {
        $this->pay->setPostalCode(12345);
        $this->compareXml('<Pay postalCode="12345"/>', $this->pay);
    }

    public function testSetMinPostalCodeLength(): void {
        $this->pay->setMinPostalCodeLength(2);
        $this->compareXml('<Pay minPostalCodeLength="2"/>', $this->pay);
    }

    public function testSetPaymentConnector(): void {
        $this->pay->setPaymentConnector("connector");
        $this->compareXml('<Pay paymentConnector="connector"/>', $this->pay);
    }

    public function testSetPaymentMethod(): void {
        $this->pay->setPaymentMethod("method");
        $this->compareXml('<Pay paymentMethod="method"/>', $this->pay);
    }

    public function testSetTokenType(): void {
        $this->pay->setTokenType("tokenType");
        $this->compareXml('<Pay tokenType="tokenType"/>', $this->pay);
    }

    public function testSetChargeAmount(): void {
        $this->pay->setChargeAmount("100");
        $this->compareXml('<Pay chargeAmount="100"/>', $this->pay);
    }

    public function testSetCurrency(): void {
        $this->pay->setCurrency("USD");
        $this->compareXml('<Pay currency="USD"/>', $this->pay);
    }

    public function testSetDescription(): void {
        $this->pay->setDescription("desc");
        $this->compareXml('<Pay description="desc"/>', $this->pay);
    }

    public function testSetValidCardTypes(): void {
        $this->pay->setValidCardTypes("cardTypes");
        $this->compareXml('<Pay validCardTypes="cardTypes"/>', $this->pay);
    }

    public function testSetLanguage(): void {
        $this->pay->setLanguage("english");
        $this->compareXml('<Pay language="english"/>', $this->pay);
    }
}