<?php

namespace TwiML;

use Twilio\Tests\Unit\TwiML\TwiMLTest;
use Twilio\TwiML\Comment;
use Twilio\TwiML\VoiceResponse;

class CommentTest extends TwiMLTest {
    public function testCommentToResponse(): void {
        $response = new VoiceResponse();
        $response->nest(new Comment('this is a comment'));

        $this->compareXml('<Response><!--this is a comment--></Response>', $response);
    }
    public function testSketchyCommentToResponse(): void {
        $response = new VoiceResponse();
        $response->nest(new Comment('this is --- a sketchy ---- comment'));

        $this->compareXml('<Response><!--this is - a sketchy - comment--></Response>', $response);
    }
}
