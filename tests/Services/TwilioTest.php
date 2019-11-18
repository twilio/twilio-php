<?php

require \dirname(__DIR__) . '/../src/Services/Twilio.php';

class TwilioTest extends \Twilio\Tests\Unit\UnitTest {

    public function testClient()
    {
        $exceptionClass = 'PHPUnit_Framework_Error_Warning';
        if (!$this->isLegacyPHPUnit()) {
            $exceptionClass = \PHPUnit\Framework\Error\Warning::class;
        }

        $this->expectException($exceptionClass);

        new Services_Twilio('AC123', 'DEF');
    }

    public function testTrunkingClient() {
        $exceptionClass = 'PHPUnit_Framework_Error_Warning';
        if (!$this->isLegacyPHPUnit()) {
            $exceptionClass = \PHPUnit\Framework\Error\Warning::class;
        }

        $this->expectException($exceptionClass);

        new Trunking_Services_Twilio('AC123', 'DEF');
    }
}
