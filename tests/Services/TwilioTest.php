<?php

require dirname(__DIR__) . '/../src/Services/Twilio.php';

class TwilioTest extends \PHPUnit\Framework\TestCase {

    public function testClient() {
        $this->expectException(\PHPUnit\Framework\Error\Warning::class);
        new Services_Twilio('AC123', 'DEF');
    }

    public function testTrunkingClient() {
        $this->expectException(\PHPUnit\Framework\Error\Warning::class);
        new Trunking_Services_Twilio('AC123', 'DEF');
    }
}
