<?php

namespace Twilio\Tests\Unit\TwiML\Voice;

use Twilio\Tests\Unit\TwiML\TwiMLTest;
use Twilio\TwiML\Voice\Record;

class RecordTest extends TwiMLTest {

    private $record;

    protected function setUp(): void {
        $this->record = new Record();
    }

    public function testSetAction(): void {
        $this->record->setAction("test");
        $this->compareXml('<Record action="test"/>', $this->record);
    }

    public function testSetMethod(): void {
        $this->record->setMethod("method");
        $this->compareXml('<Record method="method"/>', $this->record);
    }

    public function testSetTimeout(): void {
        $this->record->setTimeout(3);
        $this->compareXml('<Record timeout="3"/>', $this->record);
    }

    public function testSetFinishOnKey(): void {
        $this->record->setFinishOnKey("test");
        $this->compareXml('<Record finishOnKey="test"/>', $this->record);
    }

    public function testSetMaxLength(): void {
        $this->record->setMaxLength(5);
        $this->compareXml('<Record maxLength="5"/>', $this->record);
    }

    public function testSetPlayBeepTrue(): void {
        $this->record->setPlayBeep(true);
        $this->compareXml('<Record playBeep="1"/>', $this->record);
    }

    public function testSetPlayBeepFalse(): void {
        $this->record->setPlayBeep(false);
        $this->compareXml('<Record playBeep=""/>', $this->record);
    }

    public function testSetTrim(): void {
        $this->record->setTrim("trim");
        $this->compareXml('<Record trim="trim"/>', $this->record);
    }

    public function testSetRecordingStatusCallback(): void {
        $this->record->setRecordingStatusCallback("callback");
        $this->compareXml('<Record recordingStatusCallback="callback"/>', $this->record);
    }

    public function testSetRecordingStatusCallbackMethod(): void {
        $this->record->setRecordingStatusCallbackMethod("callbackMethod");
        $this->compareXml('<Record recordingStatusCallbackMethod="callbackMethod"/>', $this->record);
    }

    public function testSetRecordingStatusCallbackEvent(): void {
        $this->record->setRecordingStatusCallbackEvent("callbackEvent");
        $this->compareXml('<Record recordingStatusCallbackEvent="callbackEvent"/>', $this->record);
    }

    public function testSetTranscribeTrue(): void {
        $this->record->setTranscribe(true);
        $this->compareXml('<Record transcribe="1"/>', $this->record);
    }

    public function testSetTranscribeFalse(): void {
        $this->record->setTranscribe(false);
        $this->compareXml('<Record transcribe=""/>', $this->record);
    }

    public function testSetTranscribeCallback(): void {
        $this->record->setTranscribeCallback("callback");
        $this->compareXml('<Record transcribeCallback="callback"/>', $this->record);
    }
}