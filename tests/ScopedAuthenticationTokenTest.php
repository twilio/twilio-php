<?php

require_once 'Twilio/ScopedAuthenticationToken.php';

class ScopedAuthenticationTokenTest extends PHPUnit_Framework_TestCase
{
    function testEmptyGrants()
    {
        $scat = new ScopedAuthenticationToken('SK123', 'AC123');
        $token = $scat->encode('secret');

        $this->assertNotNull($token);

        $payload = JWT::decode($token, 'secret');

        $this->assertEquals('SK123', $payload->iss);
        $this->assertEquals('AC123', $payload->sub);
        $this->assertNotNull($payload->jti);
        $this->assertNotNull($payload->nbf);
        $this->assertNotNull($payload->exp);
        $this->assertEquals($payload->nbf + 3600, $payload->exp);
        $this->assertNotNull($payload->grants);
        $this->assertEquals(0, count($payload->grants));
    }

    function testAddGrant()
    {
        $scat = new ScopedAuthenticationToken('SK123', 'AC123');
        $scat->addGrant('https://api.twilio.com/**');
        $token = $scat->encode('secret');

        $this->assertNotNull($token);

        $payload = JWT::decode($token, 'secret');

        $this->assertEquals('SK123', $payload->iss);
        $this->assertEquals('AC123', $payload->sub);
        $this->assertNotNull($payload->jti);
        $this->assertNotNull($payload->nbf);
        $this->assertNotNull($payload->exp);
        $this->assertEquals($payload->nbf + 3600, $payload->exp);
        $this->assertNotNull($payload->grants);
        $this->assertEquals('https://api.twilio.com/**', $payload->grants[0]->res);
        $this->assertEquals('*', $payload->grants[0]->act[0]);
    }



    function testEndpointGrant()
    {
        $scat = new ScopedAuthenticationToken('SK123', 'AC123');
        $scat->addEndpointGrant('bob');
        $token = $scat->encode('secret');

        $this->assertNotNull($token);

        $payload = JWT::decode($token, 'secret');

        $this->assertEquals('SK123', $payload->iss);
        $this->assertEquals('AC123', $payload->sub);
        $this->assertNotNull($payload->jti);
        $this->assertNotNull($payload->nbf);
        $this->assertNotNull($payload->exp);
        $this->assertEquals($payload->nbf + 3600, $payload->exp);
        $this->assertNotNull($payload->grants);
        $this->assertEquals('sip:bob@AC123.endpoint.twilio.com', $payload->grants[0]->res);
        $this->assertEquals('listen', $payload->grants[0]->act[0]);
        $this->assertEquals('invite', $payload->grants[0]->act[1]);
    }

}
