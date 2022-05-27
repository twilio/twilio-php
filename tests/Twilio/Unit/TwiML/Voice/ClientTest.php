<?php

namespace Twilio\Tests\Unit\TwiML\Voice;

use Twilio\Tests\Unit\TwiML\TwiMLTest;
use Twilio\TwiML\Voice\Client;

class ClientTest extends TwiMLTest {

    private $client;

    protected function setUp(): void {
        $this->client = new Client();
    }

    public function testAddIdentity(): void {
        $this->client->identity("test");
        $this->compareXml('<Client><Identity>test</Identity></Client>', $this->client);
    }

    public function testAddParameter(): void {
        $this->client->parameter(array('key'=>'value'));
        $this->compareXml('<Client><Parameter key="value"/></Client>', $this->client);
    }

    public function testSetUrl(): void {
        $this->client->setUrl("test");
        $this->compareXml('<Client url="test"/>', $this->client);
    }

    public function testSetMethod(): void {
        $this->client->setMethod("testMethod");
        $this->compareXml('<Client method="testMethod"/>', $this->client);
    }

    public function testSetStatusCallbackEvent(): void {
        $this->client->setStatusCallbackEvent("testEvent");
        $this->compareXml('<Client statusCallbackEvent="testEvent"/>', $this->client);
    }

    public function testSetStatusCallback(): void {
        $this->client->setStatusCallback("test");
        $this->compareXml('<Client statusCallback="test"/>', $this->client);
    }

    public function testSetStatusCallbackMethod(): void {
        $this->client->setStatusCallbackMethod("testMethod");
        $this->compareXml('<Client statusCallbackMethod="testMethod"/>', $this->client);
    }
}