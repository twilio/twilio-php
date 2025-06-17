<?php


namespace AuthStrategy;

use Twilio\AuthStrategy\TokenAuthStrategy;
use Twilio\Http\BearerToken\ApiTokenManager;
use Twilio\Http\CurlClient;
use Twilio\Http\Response;
use Twilio\Jwt\AccessToken;
use Twilio\Rest\Client;
use Twilio\Tests\Unit\UnitTest;

class TokenAuthStrategyTest extends UnitTest {
    private $tokenAuthStrategy;

    public function setUp(): void {
        parent::setUp();
        $this->options = [
            'grantType' => 'client_credentials',
            'clientId' => 'client_id',
            'clientSecret' => 'client_secret'
        ];
        $this->tokenAuthStrategy = new TokenAuthStrategy(new ApiTokenManager($this->options));
    }

    public function testAuthType(): void {
        $this->assertEquals('token', $this->tokenAuthStrategy->getAuthType());
    }

    public function testIsTokenExpired(): void {
        $token = new AccessToken('AC123', 'foo', 'secret');
        $tokenString = $token->toJWT();
        $this->assertFalse($this->tokenAuthStrategy->isTokenExpired($tokenString));
    }

    public function testAuthString(): void {
        $curlMock = $this->createMock(CurlClient::class);
        $curlMock->expects($this->once())
            ->method('request')
            ->willReturn(new Response(200, '{"access_token": "access_token"}', []));
        $client = new Client(null, null, null, null, $curlMock, null);
        $token = $this->tokenAuthStrategy->getAuthString($client);
        $this->assertEquals("Bearer access_token", $token);
    }
}
