<?php

namespace Twilio\Tests\Unit\TwiML;

use DOMDocument;
use Twilio\Tests\Unit\UnitTest;
use Twilio\TwiML\VoiceResponse;

class VoiceResponseTest extends UnitTest {

	public function compareXml($expected, $result) {
		$expectedDom = new DOMDocument();
		$expectedDom->loadXML($expected);

		$resultDom = new DOMDocument();
		$resultDom->loadXML($result);

		$this->assertEquals($expectedDom, $resultDom);
	}

	public function testTextNode() {
		$response = new VoiceResponse();
		$response->append('Hey no tags!');

		$this->compareXml('<Response>Hey no tags!</Response>', $response);
	}

	public function testMixedText() {
		$response = new VoiceResponse();
		$response->append('before');

		$response->dial('Content')
			->setAttribute('key', 'value');

		$response->append('after');

		$this->compareXml('<Response>before<Dial key="value">Content</Dial>after</Response>', $response);
	}

	public function testEmptyResponse() {
		$this->compareXml('<Response/>', new VoiceResponse());
	}

	public function testAllowGenericChildNodes() {
		$response = new VoiceResponse();
		$response->addChild('generic-node', 'Generic Node', ['tag' => true]);

		$this->compareXml('<Response><generic-node tag="true">Generic Node</generic-node></Response>', $response);
	}

	public function testAllowGenericChildrenOfChildNodes() {
		$response = new VoiceResponse();
		$response->dial('Content')
			->setAttribute('key', 'value')
			->addChild('generic-node', 'Generic Node', ['tag' => true]);

		$this->compareXml('<Response><Dial key="value">Content<generic-node tag="true">Generic Node</generic-node></Dial></Response>', $response);
	}
}
