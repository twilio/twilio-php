<?php

namespace Twilio\Tests\Unit\TwiML\Voice;

use Twilio\Tests\Unit\TwiML\TwiMLTest;
use Twilio\TwiML\Voice\SsmlSub;

class SsmlSubTest extends TwiMLTest {

    private $ssmlSub;

    protected function setUp(): void {
        $this->ssmlSub = new ssmlSub("");
    }

    public function testSetAlias(): void {
        $this->ssmlSub->setAlias("test");
        $this->compareXml('<sub alias="test"></sub>', $this->ssmlSub);
    }
}
