<?php


namespace Twilio\Tests\Unit\Jwt;


use Twilio\Jwt\ClientToken;
use Twilio\Jwt\JWT;
use Twilio\Tests\Unit\UnitTest;

class ClientTokenTest extends UnitTest {
    public function testNoPermissions() {
        $token = new ClientToken('AC123', 'foo');
        $payload = JWT::decode($token->generateToken(), 'foo');
        $this->assertEquals($payload->iss, 'AC123');
        $this->assertEquals($payload->scope, '');
    }

    public function testInboundPermissions() {
        $token = new ClientToken('AC123', 'foo');
        $token->allowClientIncoming('andy');
        $payload = JWT::decode($token->generateToken(), 'foo');

        $eurl = 'scope:client:incoming?clientName=andy';
        $this->assertEquals($payload->scope, $eurl);
    }

    public function testOutboundPermissions() {
        $token = new ClientToken('AC123', 'foo');
        $token->allowClientOutgoing('AP123');
        $payload = JWT::decode($token->generateToken(), 'foo');
        $eurl = 'scope:client:outgoing?appSid=AP123';
        $this->assertStringContainsString($eurl, $payload->scope);
    }

    public function testOutboundPermissionsParams() {
        $token = new ClientToken('AC123', 'foo');
        $token->allowClientOutgoing('AP123', ['foobar' => 3]);
        $payload = JWT::decode($token->generateToken(), 'foo');

        $eurl = 'scope:client:outgoing?appSid=AP123&appParams=foobar%3D3';
        $this->assertEquals($payload->scope, $eurl);
    }

    public function testEvents() {
        $token = new ClientToken('AC123', 'foo');
        $token->allowEventStream();
        $payload = JWT::decode($token->generateToken(), 'foo');

        $event_uri = 'scope:stream:subscribe?path=%2F2010'
            . '-04-01%2FEvents&params=';
        $this->assertEquals($payload->scope, $event_uri);
    }

    public function testEventsWithFilters() {
        $token = new ClientToken('AC123', 'foo');
        $token->allowEventStream(['foobar' => 'hey']);
        $payload = JWT::decode($token->generateToken(), 'foo');

        $event_uri = 'scope:stream:subscribe?path=%2F2010-'
            . '04-01%2FEvents&params=foobar%3Dhey';
        $this->assertEquals($payload->scope, $event_uri);
    }

    public function testCustomClaims() {
        $token = new ClientToken('AC123', 'foo');
        $token->addClaim('find', 'me');
        $token->addClaim('iss', 'redefined');
        $payload = JWT::decode($token->generateToken(), 'foo');
        $this->assertSame('me', $payload->find);
        $this->assertNotSame('redefined', $payload->iss);
    }


    public function testDecode() {
        $token = new ClientToken('AC123', 'foo');
        $token->allowClientOutgoing('AP123', ['foobar' => 3]);
        $token->allowClientIncoming('andy');
        $token->allowEventStream();

        $outgoing_uri = 'scope:client:outgoing?appSid='
            . 'AP123&appParams=foobar%3D3&clientName=andy';
        $incoming_uri = 'scope:client:incoming?clientName=andy';
        $event_uri = 'scope:stream:subscribe?path=%2F2010-04-01%2FEvents';

        $payload = JWT::decode($token->generateToken(), 'foo');
        $scope = $payload->scope;

        $this->assertStringContainsString($outgoing_uri, $scope);
        $this->assertStringContainsString($incoming_uri, $scope);
        $this->assertStringContainsString($event_uri, $scope);
    }


    function testDecodeWithAuthToken() {
        try {
            $token = new ClientToken('AC123', 'foo');
            $payload = JWT::decode($token->generateToken(), 'foo');
            $this->assertSame($payload->iss, 'AC123');
        } catch (\UnexpectedValueException $e) {
            $this->assertTrue(false, "Could not decode with 'foo'");
        }
    }

    function testClientNameValidation() {
        $this->expectException('InvalidArgumentException');
        $token = new ClientToken('AC123', 'foo');
        $token->allowClientIncoming('@');
        $this->fail('exception should have been raised');
    }

    function zeroLengthNameInvalid() {
        $this->expectException('InvalidArgumentException');
        $token = new ClientToken('AC123', 'foo');
        $token->allowClientIncoming('');
        $this->fail('exception should have been raised');
    }
}
