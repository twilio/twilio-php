<?php

namespace Twilio\Tests\Unit\TwiML\Messaging;

use Twilio\Tests\Unit\TwiML\TwiMLTest;
use Twilio\TwiML\Messaging\Message;

class MessageTest extends TwiMLTest {
    public function testAddBodyToMessage(): void {
        $message = new Message('Some body');
        $message->body('Some more body');

        $this->compareXml('<Message>Some body<Body>Some more body</Body></Message>', $message);
    }
}
