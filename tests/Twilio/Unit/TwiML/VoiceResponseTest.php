<?php

namespace Twilio\Tests\Unit\TwiML;

use Twilio\TwiML\VoiceResponse;

class VoiceResponseTest extends TwiMLTest {

    private $response;

    protected function setUp(): void {
        $this->response = new VoiceResponse("");
    }

    public function testTextNode(): void {
        $this->response->append('Hey no tags!');
        $this->compareXml('<Response>Hey no tags!</Response>', $this->response);
    }

    public function testMixedText(): void {
        $this->response->append('before');
        $this->response->dial('Content')
            ->setAttribute('key', 'value');
        $this->response->append('after');
        $this->compareXml('<Response>before<Dial key="value">Content</Dial>after</Response>', $this->response);
    }

    public function testEmptyResponse(): void {
        $this->compareXml('<Response/>', new VoiceResponse());
    }

    public function testAllowGenericChildNodes(): void {
        $this->response->addChild('generic-node', 'Generic Node', ['tag' => true]);
        $this->compareXml('<Response><generic-node tag="true">Generic Node</generic-node></Response>', $this->response);
    }

    public function testAllowGenericChildrenOfChildNodes(): void {
        $this->response->dial('Content')
            ->setAttribute('key', 'value')
            ->addChild('generic-node', 'Generic Node', ['tag' => true]);
        $this->compareXml('<Response><Dial key="value">Content<generic-node tag="true">Generic Node</generic-node></Dial></Response>', $this->response);
    }

    public function testAddConnect(): void {
        $this->response->connect(array("key"=>"value"));
        $this->compareXml('<Response><Connect key="value"></Connect></Response>', $this->response);
    }

    public function testAddEcho(): void {
        $this->response->echo_();
        $this->compareXml('<Response><Echo></Echo></Response>', $this->response);
    }

    public function testAddEnqueue(): void {
        $this->response->enqueue("enqueue",array("key"=>"value"));
        $this->compareXml('<Response><Enqueue key="value">enqueue</Enqueue></Response>', $this->response);
    }

    public function testAddGather(): void {
        $this->response->gather(array("key"=>"value"));
        $this->compareXml('<Response><Gather key="value"></Gather></Response>', $this->response);
    }

    public function testAddHangup(): void {
        $this->response->hangup();
        $this->compareXml('<Response><Hangup></Hangup></Response>', $this->response);
    }

    public function testAddLeave(): void {
        $this->response->leave();
        $this->compareXml('<Response><Leave></Leave></Response>', $this->response);
    }

    public function testAddPause(): void {
        $this->response->pause(array("key"=>"value"));
        $this->compareXml('<Response><Pause key="value"></Pause></Response>', $this->response);
    }

    public function testAddPlay(): void {
        $this->response->play("url",array("key"=>"value"));
        $this->compareXml('<Response><Play key="value">url</Play></Response>', $this->response);
    }

    public function testAddQueue(): void {
        $this->response->queue("queue",array("key"=>"value"));
        $this->compareXml('<Response><Queue key="value">queue</Queue></Response>', $this->response);
    }

    public function testAddRecord(): void {
        $this->response->record(array("key"=>"value"));
        $this->compareXml('<Response><Record key="value"></Record></Response>', $this->response);
    }

    public function testAddRedirect(): void {
        $this->response->redirect("url",array("key"=>"value"));
        $this->compareXml('<Response><Redirect key="value">url</Redirect></Response>', $this->response);
    }

    public function testAddReject(): void {
        $this->response->reject(array("key"=>"value"));
        $this->compareXml('<Response><Reject key="value"></Reject></Response>', $this->response);
    }

    public function testAddSay(): void {
        $this->response->say("test",array("key"=>"value"));
        $this->compareXml('<Response><Say key="value">test</Say></Response>', $this->response);
    }

    public function testAddSms(): void {
        $this->response->sms("sms",array("key"=>"value"));
        $this->compareXml('<Response><Sms key="value">sms</Sms></Response>', $this->response);
    }

    public function testAddPay(): void {
        $this->response->pay(array("key"=>"value"));
        $this->compareXml('<Response><Pay key="value"></Pay></Response>', $this->response);
    }

    public function testAddPrompt(): void {
        $this->response->prompt(array("key"=>"value"));
        $this->compareXml('<Response><Prompt key="value"></Prompt></Response>', $this->response);
    }

    public function testAddStart(): void {
        $this->response->start(array("key"=>"value"));
        $this->compareXml('<Response><Start key="value"></Start></Response>', $this->response);
    }

    public function testAddStop(): void {
        $this->response->stop();
        $this->compareXml('<Response><Stop></Stop></Response>', $this->response);
    }

    public function testAddRefer(): void {
        $this->response->refer(array("key"=>"value"));
        $this->compareXml('<Response><Refer key="value"></Refer></Response>', $this->response);
    }
}

