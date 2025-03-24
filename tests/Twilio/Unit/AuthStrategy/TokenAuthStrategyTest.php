<?php


namespace AuthStrategy;

use Twilio\AuthStrategy\TokenAuthStrategy;
use Twilio\Http\BearerToken\ApiTokenManager;
use Twilio\Jwt\ClientToken;
use Twilio\Tests\Unit\UnitTest;

class TokenAuthStrategyTest extends UnitTest {
    private $tokenAuthStrategy;

    public function setUp(): void {
        parent::setUp();
        $this->tokenAuthStrategy = new TokenAuthStrategy(new ApiTokenManager());
    }

    public function testAuthType(): void {
        $this->assertEquals('token', $this->tokenAuthStrategy->getAuthType());
    }

    public function testIsTokenExpired(): void {
        $token = new ClientToken('AC123', 'foo');
        $tokenString = $token->generateToken();
        $this->assertFalse($this->tokenAuthStrategy->isTokenExpired($tokenString));
    }
}
