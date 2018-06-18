<?php

namespace Twilio\Tests\Unit\TwiML;

use DOMDocument;
use Twilio\Tests\Unit\UnitTest;
use Twilio\TwiML\MessagingResponse;

class MessagingResponseTest extends UnitTest {

    public function compareXml($expected, $result) {
        $expectedDom = new DOMDocument();
        $expectedDom->loadXML($expected);

        $resultDom = new DOMDocument();
        $resultDom->loadXML($result);

        $this->assertEquals($expectedDom, $resultDom);
    }

    public function testTextNode() {
        $response = new MessagingResponse();
        $response->append('Hey no tags!');

        $this->compareXml('<Response>Hey no tags!</Response>', $response);
    }

    public function testMixedText() {
        $response = new MessagingResponse();
        $response->append('before');

        $response->message('Content')
            ->setAttribute('key', 'value');

        $response->append('after');

        $this->compareXml('<Response>before<Message key="value">Content</Message>after</Response>', $response);
    }

    public function testEmptyResponse() {
        $this->compareXml('<Response/>', new MessagingResponse());
    }

	public function testAllowGenericChildNodes() {
		$response = new MessagingResponse();
		$response->addChild('generic-node', 'Generic Node', ['tag' => true]);

		$this->compareXml('<Response><generic-node tag="true">Generic Node</generic-node></Response>', $response);
	}

	public function testAllowGenericChildrenOfChildNodes() {
		$response = new MessagingResponse();
		$response->message('Content')
			->setAttribute('key', 'value')
			->addChild('generic-node', 'Generic Node', ['tag' => true]);

		$this->compareXml('<Response><Message key="value">Content<generic-node tag="true">Generic Node</generic-node></Message></Response>', $response);
	}
}
