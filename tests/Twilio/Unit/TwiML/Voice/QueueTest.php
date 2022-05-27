<?php

namespace Twilio\Tests\Unit\TwiML\Voice;

use Twilio\Tests\Unit\TwiML\TwiMLTest;
use Twilio\TwiML\Voice\Queue;

class QueueTest extends TwiMLTest {

    private $queue;

    protected function setUp(): void {
        $this->queue = new Queue("");
    }

    public function testSetUrl(): void {
        $this->queue->setUrl("test");
        $this->compareXml('<Queue url="test"></Queue>', $this->queue);
    }

    public function testSetMethod(): void {
        $this->queue->setMethod("method");
        $this->compareXml('<Queue method="method"></Queue>', $this->queue);
    }

    public function testSetReservationSid(): void {
        $this->queue->setReservationSid("reservation");
        $this->compareXml('<Queue reservationSid="reservation"></Queue>', $this->queue);
    }

    public function testSetPostWorkActivitySid(): void {
        $this->queue->setPostWorkActivitySid("test");
        $this->compareXml('<Queue postWorkActivitySid="test"></Queue>', $this->queue);
    }
}