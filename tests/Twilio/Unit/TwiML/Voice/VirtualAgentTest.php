<?php

namespace Twilio\Tests\Unit\TwiML\Voice;

use Twilio\Tests\Unit\TwiML\TwiMLTest;
use Twilio\TwiML\Voice\VirtualAgent;

class VirtualAgentTest extends TwiMLTest {

    private $virtualAgent;

    protected function setUp(): void {
        $this->virtualAgent = new VirtualAgent();
    }

    public function testSetConnectorName(): void {
        $this->virtualAgent->setConnectorName("test");
        $this->compareXml('<VirtualAgent connectorName="test"></VirtualAgent>', $this->virtualAgent);
    }

    public function testSetLanguage(): void {
        $this->virtualAgent->setLanguage("eng");
        $this->compareXml('<VirtualAgent language="eng"></VirtualAgent>', $this->virtualAgent);
    }

    public function testSetSentimentAnalysisTrue(): void {
        $this->virtualAgent->setSentimentAnalysis(true);
        $this->compareXml('<VirtualAgent sentimentAnalysis="1"></VirtualAgent>', $this->virtualAgent);
    }

    public function testSetSentimentAnalysisFalse(): void {
        $this->virtualAgent->setSentimentAnalysis(false);
        $this->compareXml('<VirtualAgent sentimentAnalysis=""></VirtualAgent>', $this->virtualAgent);
    }

    public function testSetStatusCallback(): void {
        $this->virtualAgent->setStatusCallback("test");
        $this->compareXml('<VirtualAgent statusCallback="test"></VirtualAgent>', $this->virtualAgent);
    }
}
