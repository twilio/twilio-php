<?php

namespace Twilio\Tests\Unit\TwiML;

use Twilio\TwiML\FaxResponse;

class FaxResponseTest extends TwiMLTest {

	public function testTextNode() {
		$response = new FaxResponse();
		$response->append('Hey no tags!');

		$this->compareXml('<Response>Hey no tags!</Response>', $response);
	}

	public function testMixedText() {
		$response = new FaxResponse();
		$response->append('before');

		$response->receive(['key1' => 'value1'])
            ->append('Content')
			->setAttribute('key2', 'value2');

		$response->append('after');

		$this->compareXml('<Response>before<Receive key1="value1" key2="value2">Content</Receive>after</Response>', $response);
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
		$response->receive()
			->setAttribute('key', 'value')
            ->append('Content')
			->addChild('generic-node', 'Generic Node', ['tag' => true]);

		$this->compareXml('<Response><Receive key="value">Content<generic-node tag="true">Generic Node</generic-node></Receive></Response>', $response);
	}
}
