<?php

namespace Twilio\Tests\Unit\TwiML\Voice;

use Twilio\Tests\Unit\TwiML\TwiMLTest;
use Twilio\TwiML\Voice\Room;

class RoomTest extends TwiMLTest {

    private $room;

    protected function setUp(): void {
        $this->room = new Room("room");
    }

    public function testAddSip(): void {
        $this->room->setParticipantIdentity("identity");
        $this->compareXml('<Room participantIdentity="identity">room</Room>', $this->room);
    }
}
