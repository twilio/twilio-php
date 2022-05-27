<?php

namespace Twilio\Tests\Unit\TwiML\Voice;

use Twilio\Tests\Unit\TwiML\TwiMLTest;
use Twilio\TwiML\Voice\Redirect;

class RedirectTest extends TwiMLTest {

    private $redirect;

    protected function setUp(): void {
        $this->redirect = new Redirect("testUrl");
    }

    public function testSetMethod(): void {
        $this->redirect->setMethod("test");
        $this->compareXml('<Redirect method="test">testUrl</Redirect>', $this->redirect);
    }
}
