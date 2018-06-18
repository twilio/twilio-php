<?php

namespace Twilio\Tests\Unit\TwiML;

use DOMDocument;
use Twilio\Tests\Unit\UnitTest;
use Twilio\TwiML\FaxResponse;

class FaxResponseTest extends UnitTest {

	public function compareXml($expected, $result) {
		$expectedDom = new DOMDocument();
		$expectedDom->loadXML($expected);

		$resultDom = new DOMDocument();
		$resultDom->loadXML($result);

		$this->assertEquals($expectedDom, $resultDom);
	}

	public function testTextNode() {
		$response = new FaxResponse();
		$response->append('Hey no tags!');

		$this->compareXml('<Response>Hey no tags!</Response>', $response);
	}

	public function testMixedText() {
		$response = new FaxResponse();
		$response->append('before');

		$response->receive('Content')
			->setAttribute('key', 'value');

		$response->append('after');

		$this->compareXml('<Response>before<Receive key="value">Content</Receive>after</Response>', $response);
	}

	public function testEmptyResponse() {
		$this->compareXml('<Response/>', new FaxResponse());
	}

	public function testAllowGenericChildNodes() {
		$response = new FaxResponse();
		$response->addChild('generic-node', 'Generic Node', ['tag' => true]);

		$this->compareXml('<Response><generic-node tag="true">Generic Node</generic-node></Response>', $response);
	}

	public function testAllowGenericChildrenOfChildNodes() {
		$response = new FaxResponse();
		$response->receive('Content')
			->setAttribute('key', 'value')
			->addChild('generic-node', 'Generic Node', ['tag' => true]);

		$this->compareXml('<Response><Receive key="value">Content<generic-node tag="true">Generic Node</generic-node></Receive></Response>', $response);
	}
}
