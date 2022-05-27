<?php

namespace Twilio\Tests\Unit\TwiML\Voice;

use Twilio\Tests\Unit\TwiML\TwiMLTest;
use Twilio\TwiML\Voice\Connect;

class ConnectTest extends TwiMLTest {

    private $connect;

    protected function setUp(): void {
        $this->connect = new Connect();
    }

    public function testAddRoom(): void {
        $this->connect->room("test",array('key'=>'value'));
        $this->compareXml('<Connect><Room key="value">test</Room></Connect>', $this->connect);
    }

    public function testAddAutopilot(): void {
        $this->connect->autopilot("test");
        $this->compareXml('<Connect><Autopilot>test</Autopilot></Connect>', $this->connect);
    }

    public function testAddStream(): void {
        $this->connect->stream(array('key'=>'value'));
        $this->compareXml('<Connect><Stream key="value"></Stream></Connect>', $this->connect);
    }

    public function testAddVirtualAgent(): void {
        $this->connect->virtualAgent(array('key'=>'value'));
        $this->compareXml('<Connect><VirtualAgent key="value"></VirtualAgent></Connect>', $this->connect);
    }

    public function testSetAction(): void {
        $this->connect->setAction('test');
        $this->compareXml('<Connect action="test"></Connect>', $this->connect);
    }

    public function testSetMethod(): void {
        $this->connect->setMethod('testMethod');
        $this->compareXml('<Connect method="testMethod"></Connect>', $this->connect);
    }
}