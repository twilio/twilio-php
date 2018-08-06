<?php

namespace Twilio\Tests\Unit\TwiML\Messaging;

use DOMDocument;
use Twilio\Tests\Unit\TwiML\TwiMLTest;
use Twilio\TwiML\Messaging\Message;

class MessageTest extends TwiMLTest {
    public function testAddBodyToMessage() {
        $message = new Message("Some body");
        $message->body("Some more body");

        $this->compareXml("<Message>Some body<Body>Some more body</Body></Message>", $message);
    }
}
