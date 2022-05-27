<?php

namespace Twilio\Tests\Unit\TwiML\Voice;

use Twilio\Tests\Unit\TwiML\TwiMLTest;
use Twilio\TwiML\Voice\Conference;

class ConferenceTest extends TwiMLTest {

    private $conference;

    protected function setUp(): void {
        $this->conference = new Conference("");
    }

    public function testSetMutedTrue(): void {
        $this->conference->setMuted(true);
        $this->compareXml('<Conference muted="1"></Conference>', $this->conference);
    }

    public function testSetMutedFalse(): void {
        $this->conference->setMuted(false);
        $this->compareXml('<Conference muted=""></Conference>', $this->conference);
    }

    public function testSetBeep(): void {
        $this->conference->setBeep("beep");
        $this->compareXml('<Conference beep="beep"></Conference>', $this->conference);
    }

    public function testSetStartConferenceOnEnterTrue(): void {
        $this->conference->setStartConferenceOnEnter(true);
        $this->compareXml('<Conference startConferenceOnEnter="1"></Conference>', $this->conference);
    }

    public function testSetStartConferenceOnEnterFalse(): void {
        $this->conference->setStartConferenceOnEnter(false);
        $this->compareXml('<Conference startConferenceOnEnter=""></Conference>', $this->conference);
    }

    public function testSetEndConferenceOnExitTrue(): void {
        $this->conference->setEndConferenceOnExit(true);
        $this->compareXml('<Conference endConferenceOnExit="1"></Conference>', $this->conference);
    }

    public function testSetEndConferenceOnExitFalse(): void {
        $this->conference->setEndConferenceOnExit(false);
        $this->compareXml('<Conference endConferenceOnExit=""></Conference>', $this->conference);
    }

    public function testSetWaitUrl(): void {
        $this->conference->setWaitUrl("https://api.twilio.com");
        $this->compareXml('<Conference waitUrl="https://api.twilio.com"></Conference>', $this->conference);
    }

    public function testSetWaitMethod(): void {
        $this->conference->setWaitMethod("test");
        $this->compareXml('<Conference waitMethod="test"></Conference>', $this->conference);
    }

    public function testSetMaxParticipants(): void {
        $this->conference->setMaxParticipants(2);
        $this->compareXml('<Conference maxParticipants="2"></Conference>', $this->conference);
    }

    public function testSetRecord(): void {
        $this->conference->setRecord("test");
        $this->compareXml('<Conference record="test"></Conference>', $this->conference);
    }

    public function testSetRegion(): void {
        $this->conference->setRegion("US-1");
        $this->compareXml('<Conference region="US-1"></Conference>', $this->conference);
    }

    public function testSetCoach(): void {
        $this->conference->setCoach("coach");
        $this->compareXml('<Conference coach="coach"></Conference>', $this->conference);
    }

    public function testSetTrim(): void {
        $this->conference->setTrim("trim");
        $this->compareXml('<Conference trim="trim"></Conference>', $this->conference);
    }

    public function testSetStatusCallbackEvent(): void {
        $this->conference->setStatusCallbackEvent("test");
        $this->compareXml('<Conference statusCallbackEvent="test"></Conference>', $this->conference);
    }

    public function testSetStatusCallback(): void {
        $this->conference->setStatusCallback("test");
        $this->compareXml('<Conference statusCallback="test"></Conference>', $this->conference);
    }

    public function testSetStatusCallbackMethod(): void {
        $this->conference->setStatusCallbackMethod("test");
        $this->compareXml('<Conference statusCallbackMethod="test"></Conference>', $this->conference);
    }

    public function testSetRecordingStatusCallback(): void {
        $this->conference->setRecordingStatusCallback("https://api.twilio.com");
        $this->compareXml('<Conference recordingStatusCallback="https://api.twilio.com"></Conference>', $this->conference);
    }

    public function testSetRecordingStatusCallbackMethod(): void {
        $this->conference->setRecordingStatusCallbackMethod("test");
        $this->compareXml('<Conference recordingStatusCallbackMethod="test"></Conference>', $this->conference);
    }

    public function testSetRecordingStatusCallbackEvent(): void {
        $this->conference->setRecordingStatusCallbackEvent("test");
        $this->compareXml('<Conference recordingStatusCallbackEvent="test"></Conference>', $this->conference);
    }

    public function testSetEventCallbackUrl(): void {
        $this->conference->setEventCallbackUrl("https://api.twilio.com");
        $this->compareXml('<Conference eventCallbackUrl="https://api.twilio.com"></Conference>', $this->conference);
    }

    public function testSetJitterBufferSize(): void {
        $this->conference->setJitterBufferSize("off");
        $this->compareXml('<Conference jitterBufferSize="off"></Conference>', $this->conference);
    }

    public function testSetParticipantLabel(): void {
        $this->conference->setParticipantLabel("label");
        $this->compareXml('<Conference participantLabel="label"></Conference>', $this->conference);
    }
}