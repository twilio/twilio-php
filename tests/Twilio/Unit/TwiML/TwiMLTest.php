<?php

namespace Twilio\Tests\Unit\TwiML;

use DOMDocument;
use Twilio\Tests\Unit\UnitTest;

abstract class TwiMLTest extends UnitTest {
    public function compareXml(string $expected, string $result): void {
        $expectedDom = new DOMDocument();
        $expectedDom->loadXML($expected);

        $resultDom = new DOMDocument();
        $resultDom->loadXML($result);

        $this->assertEquals($expectedDom, $resultDom);
    }
}
