<?php


namespace Twilio\Tests\Unit\AuthStrategy;

use Twilio\Tests\Unit\UnitTest;
use Twilio\AuthStrategy\NoAuthStrategy;

class NoAuthStrategyTest extends UnitTest {
    /**
     * @var NoAuthStrategy
     */
    private $noAuthStrategy;

    public function setUp(): void {
        parent::setUp();
        $this->noAuthStrategy = new NoAuthStrategy();
    }

    public function testAuthType(): void {
        $this->assertEquals('noauth', $this->noAuthStrategy->getAuthType());
    }

    public function testEmptyAuthString(): void {
        $this->assertEquals('', $this->noAuthStrategy->getAuthString());
    }
}
