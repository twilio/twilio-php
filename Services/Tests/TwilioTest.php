<?php

require 'Services/Twilio.php';

class TwilioTest extends PHPUnit_Framework_TestCase {

    public function testClient() {
        $this->setExpectedException('PHPUnit_Framework_Error_Warning');
        new Services_Twilio('AC123', 'DEF');
    }

    public function testTrunkingClient() {
        $this->setExpectedException('PHPUnit_Framework_Error_Warning');
        new Trunking_Services_Twilio('AC123', 'DEF');
    }

}
