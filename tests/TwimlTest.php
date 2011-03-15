<?php

use \Mockery as m;

require_once 'Twilio/Twiml.php';

class TwimlTest extends PHPUnit_Framework_TestCase {
    function tearDown() {
        m::close();
    }

    function testStuff() {
        $r = new Services_Twilio_Twiml();
        $r->say('hello');
        $r->dial()->number('123', array('sendDigits' => '456'));
        $r->gather(array('timeout' => 15));

        $doc = simplexml_load_string($r);
        $this->assertEquals('Response', $doc->getName());
        $this->assertEquals('hello', (string)$doc->Say);
        $this->assertEquals('456', (string)$doc->Dial->Number['sendDigits']);
        $this->assertEquals('123', (string)$doc->Dial->Number);
        $this->assertEquals('15', (string)$doc->Gather['timeout']);
    }
}
