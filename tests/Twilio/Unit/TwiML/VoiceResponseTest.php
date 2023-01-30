<?php

namespace Twilio\Tests\Unit\TwiML;

use Twilio\TwiML\VoiceResponse;

class VoiceResponseTest extends TwiMLTest {

    public function testTextNode(): void {
        $response = new VoiceResponse();
        $response->append('Hey no tags!');

        $this->compareXml('<Response>Hey no tags!</Response>', $response);
    }

    public function testMixedText(): void {
        $response = new VoiceResponse();
        $response->append('before');

        $response->dial('Content')
            ->setAttribute('key', 'value');

        $response->append('after');

        $this->compareXml('<Response>before<Dial key="value">Content</Dial>after</Response>', $response);
    }

    public function testEmptyResponse(): void {
        $this->compareXml('<Response/>', new VoiceResponse());
    }

    public function testAllowGenericChildNodes(): void {
        $response = new VoiceResponse();
        $response->addChild('generic-node', 'Generic Node', ['tag' => true]);

        $this->compareXml('<Response><generic-node tag="true">Generic Node</generic-node></Response>', $response);
    }

    public function testAllowGenericChildrenOfChildNodes(): void {
        $response = new VoiceResponse();
        $response->dial('Content')
            ->setAttribute('key', 'value')
            ->addChild('generic-node', 'Generic Node', ['tag' => true]);

        $this->compareXml('<Response><Dial key="value">Content<generic-node tag="true">Generic Node</generic-node></Dial></Response>', $response);
    }
}
