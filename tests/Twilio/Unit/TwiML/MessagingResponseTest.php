<?php

namespace Twilio\Tests\Unit\TwiML;

use Twilio\TwiML\MessagingResponse;

class MessagingResponseTest extends TwiMLTest {

    public function testTextNode(): void {
        $response = new MessagingResponse();
        $response->append('Hey no tags!');

        $this->compareXml('<Response>Hey no tags!</Response>', $response);
    }

    public function testMixedText(): void {
        $response = new MessagingResponse();
        $response->append('before');

        $response->message('Content')
            ->setAttribute('key', 'value');

        $response->append('after');

        $this->compareXml('<Response>before<Message key="value">Content</Message>after</Response>', $response);
    }

    public function testEmptyResponse(): void {
        $this->compareXml('<Response/>', new MessagingResponse());
    }

    public function testAllowGenericChildNodes(): void {
        $response = new MessagingResponse();
        $response->addChild('generic-node', 'Generic Node', ['tag' => true]);

        $this->compareXml('<Response><generic-node tag="true">Generic Node</generic-node></Response>', $response);
    }

    public function testAllowGenericChildrenOfChildNodes(): void {
        $response = new MessagingResponse();
        $response->message('Content')
            ->setAttribute('key', 'value')
            ->addChild('generic-node', 'Generic Node', ['tag' => true]);

        $this->compareXml('<Response><Message key="value">Content<generic-node tag="true">Generic Node</generic-node></Message></Response>', $response);
    }

    public function testGenericMixedText(): void {
        $response = new MessagingResponse();
        $response->append('before')
            ->addChild('Child')->append('content');

        $response->append('after');

        $this->compareXml('<Response>before<Child>content</Child>after</Response>', $response);
    }
}
