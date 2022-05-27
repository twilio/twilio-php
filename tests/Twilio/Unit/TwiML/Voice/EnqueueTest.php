<?php

namespace Twilio\Tests\Unit\TwiML\Voice;

use Twilio\Tests\Unit\TwiML\TwiMLTest;
use Twilio\TwiML\Voice\Enqueue;

class EnqueueTest extends TwiMLTest {

    private $enqueue;

    protected function setUp(): void {
        $this->enqueue = new Enqueue();
    }

    public function testAddTask(): void {
        $this->enqueue->task("test",array('key'=>'value'));
        $this->compareXml('<Enqueue><Task key="value">test</Task></Enqueue>', $this->enqueue);
    }

    public function testSetAction(): void {
        $this->enqueue->setAction('test');
        $this->compareXml('<Enqueue action="test"></Enqueue>', $this->enqueue);
    }

    public function testSetMethod(): void {
        $this->enqueue->setMethod('testMethod');
        $this->compareXml('<Enqueue method="testMethod"></Enqueue>', $this->enqueue);
    }

    public function testSetWaitUrl(): void {
        $this->enqueue->setWaitUrl('testUrl');
        $this->compareXml('<Enqueue waitUrl="testUrl"></Enqueue>', $this->enqueue);
    }

    public function testSetWaitUrlMethod(): void {
        $this->enqueue->setWaitUrlMethod('testUrlMethod');
        $this->compareXml('<Enqueue waitUrlMethod="testUrlMethod"></Enqueue>', $this->enqueue);
    }

    public function testSetWorkflowSid(): void {
        $this->enqueue->setWorkflowSid('testSid');
        $this->compareXml('<Enqueue workflowSid="testSid"></Enqueue>', $this->enqueue);
    }
}
