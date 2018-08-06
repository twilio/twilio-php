<?php

namespace Twilio\Tests\Unit\TwiML\Voice;

use Twilio\Tests\Unit\TwiML\TwiMLTest;
use Twilio\TwiML\Voice\Gather;
use Twilio\TwiML\Voice\Say;

class GatherTest extends TwiMLTest {
    public function testAddASayToGather() {
        $gather = new Gather();
        $gather->say("Some say");

        $this->compareXml("<Gather><Say>Some say</Say></Gather>", $gather);
    }
}
