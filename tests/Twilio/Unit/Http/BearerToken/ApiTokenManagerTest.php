<?php

namespace Twilio\Tests\Unit\Http\BearerToken;

use Twilio\Http\CurlClient;
use Twilio\Http\Response;
use Twilio\Rest\Client;
use Twilio\Tests\Unit\UnitTest;
use Twilio\Http\BearerToken\ApiTokenManager;

class ApiTokenManagerTest extends UnitTest {
    private $options;

    public function setUp(): void {
        parent::setUp();
        $this->options = [
            'grantType' => 'client_credentials',
            'clientId' => 'client_id',
            'clientSecret' => 'client_secret'
        ];
    }

    public function testGetOptions(): void {
        $tokenManager = new ApiTokenManager($this->options);
        $this->assertEquals($this->options, $tokenManager->getOptions());
    }

    public function testFetchToken(): void {
        $curlMock = $this->createMock(CurlClient::class);
        $curlMock->expects($this->once())
            ->method('request')
            ->willReturn(new Response(200, '{"access_token": "access_token"}', []));
        $client = new Client(null, null, null, null, $curlMock, null);
        $tokenManager = new ApiTokenManager($this->options);
        $this->assertEquals('access_token', $tokenManager->fetchToken($client));
    }
}
