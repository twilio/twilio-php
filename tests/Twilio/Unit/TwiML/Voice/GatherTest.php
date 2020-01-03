<?php

namespace Twilio\Tests\Unit\TwiML\Voice;

use Twilio\Tests\Unit\TwiML\TwiMLTest;
use Twilio\TwiML\Voice\Gather;

class GatherTest extends TwiMLTest {
    public function testAddASayToGather(): void {
        $gather = new Gather();
        $gather->say('Some say');

        $this->compareXml('<Gather><Say>Some say</Say></Gather>', $gather);
    }
}
