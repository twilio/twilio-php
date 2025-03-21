<?php


namespace Twilio\Tests\Unit\CredentialProvider;

use Twilio\AuthStrategy\NoAuthStrategy;
use Twilio\CredentialProvider\NoAuthCredentialProvider;
use Twilio\Tests\Unit\UnitTest;

class NoAuthCredentialProviderTest extends UnitTest {
    /*
     * @var NoAuthCredentialProvider
     */
    private $noAuthCredentialProvider;

    public function setUp(): void {
        parent::setUp();
        $this->noAuthCredentialProvider = new NoAuthCredentialProvider();
    }

    public function testAuthTypeIsNoAuth(): void {
        $this->assertEquals('noauth', $this->noAuthCredentialProvider->getAuthType());
    }

    public function testAuthStrategyIsNoAuthStrategy(): void {
        $this->assertInstanceOf(NoAuthStrategy::class, $this->noAuthCredentialProvider->toAuthStrategy());
    }
}
