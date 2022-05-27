<?php

namespace Twilio\Tests\Unit\TwiML\Voice;

use Twilio\Tests\Unit\TwiML\TwiMLTest;
use Twilio\TwiML\Voice\Dial;

class DialTest extends TwiMLTest {

    private $dial;

    protected function setUp(): void {
        $this->dial = new Dial();
    }

    public function testAddClient(): void {
        $this->dial->client("identity");
        $this->compareXml('<Dial><Client>identity</Client></Dial>', $this->dial);
    }

    public function testAddConference(): void {
        $this->dial->conference("conference");
        $this->compareXml('<Dial><Conference>conference</Conference></Dial>', $this->dial);
    }

    public function testAddNumber(): void {
        $this->dial->number("number");
        $this->compareXml('<Dial><Number>number</Number></Dial>', $this->dial);
    }

    public function testAddQueue(): void {
        $this->dial->queue("queue");
        $this->compareXml('<Dial><Queue>queue</Queue></Dial>', $this->dial);
    }

    public function testAddSim(): void {
        $this->dial->sim("sim");
        $this->compareXml('<Dial><Sim>sim</Sim></Dial>', $this->dial);
    }

    public function testAddSip(): void {
        $this->dial->sip("sip");
        $this->compareXml('<Dial><Sip>sip</Sip></Dial>', $this->dial);
    }

    public function testSetAction(): void {
        $this->dial->setAction("test");
        $this->compareXml('<Dial action="test"></Dial>', $this->dial);
    }

    public function testSetMethod(): void {
        $this->dial->setMethod("test");
        $this->compareXml('<Dial method="test"></Dial>', $this->dial);
    }

    public function testSetTimeout(): void {
        $this->dial->setTimeout(1);
        $this->compareXml('<Dial timeout="1"></Dial>', $this->dial);
    }

    public function testSetHangupOnStarTrue(): void {
        $this->dial->setHangupOnStar(true);
        $this->compareXml('<Dial hangupOnStar="1"></Dial>', $this->dial);
    }

    public function testSetHangupOnStarFalse(): void {
        $this->dial->setHangupOnStar(false);
        $this->compareXml('<Dial hangupOnStar=""></Dial>', $this->dial);
    }

    public function testSetTimeLimit(): void {
        $this->dial->setTimeLimit(5);
        $this->compareXml('<Dial timeLimit="5"></Dial>', $this->dial);
    }

    public function testSetCallerId(): void {
        $this->dial->setCallerId("test");
        $this->compareXml('<Dial callerId="test"></Dial>', $this->dial);
    }

    public function testSetRecord(): void {
        $this->dial->setRecord("test");
        $this->compareXml('<Dial record="test"></Dial>', $this->dial);
    }

    public function testSetTrim(): void {
        $this->dial->setTrim("test");
        $this->compareXml('<Dial trim="test"></Dial>', $this->dial);
    }

    public function testSetRecordingStatusCallback(): void {
        $this->dial->setRecordingStatusCallback("test");
        $this->compareXml('<Dial recordingStatusCallback="test"></Dial>', $this->dial);
    }

    public function testSetRecordingStatusCallbackMethod(): void {
        $this->dial->setRecordingStatusCallbackMethod("testMethod");
        $this->compareXml('<Dial recordingStatusCallbackMethod="testMethod"></Dial>', $this->dial);
    }

    public function testSetRecordingStatusCallbackEvent(): void {
        $this->dial->setRecordingStatusCallbackEvent("testEvent");
        $this->compareXml('<Dial recordingStatusCallbackEvent="testEvent"></Dial>', $this->dial);
    }

    public function testSetAnswerOnBridgeTrue(): void {
        $this->dial->setAnswerOnBridge(true);
        $this->compareXml('<Dial answerOnBridge="1"></Dial>', $this->dial);
    }

    public function testSetAnswerOnBridgeFalse(): void {
        $this->dial->setAnswerOnBridge(false);
        $this->compareXml('<Dial answerOnBridge=""></Dial>', $this->dial);
    }

    public function testSetRingTone(): void {
        $this->dial->setRingTone("test");
        $this->compareXml('<Dial ringTone="test"></Dial>', $this->dial);
    }

    public function testSetRecordingTrack(): void {
        $this->dial->setRecordingTrack("track");
        $this->compareXml('<Dial recordingTrack="track"></Dial>', $this->dial);
    }

    public function testSetSequential(): void {
        $this->dial->setSequential("sequential");
        $this->compareXml('<Dial sequential="sequential"></Dial>', $this->dial);
    }

    public function testSetReferUrl(): void {
        $this->dial->setReferUrl("url");
        $this->compareXml('<Dial referUrl="url"></Dial>', $this->dial);
    }

    public function testSetReferMethod(): void {
        $this->dial->setReferMethod("test");
        $this->compareXml('<Dial referMethod="test"></Dial>', $this->dial);
    }
}