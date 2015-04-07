<?php

require_once 'Twilio/ScopedAuthenticationToken.php';

class ScopedAuthenticationTokenTest extends PHPUnit_Framework_TestCase
{

    function testAddGrant()
    {
        $scopedAuthenticationToken = new ScopedAuthenticationToken(
            'SK123',
            'AC123',
            'Token1',
            3600,
            array(
                new Grant('https://api.twilio.com/**')
            )
        );

        $grants = $scopedAuthenticationToken->addGrant(new Grant('https://taskrouter.twilio.com'));
        $this->assertEquals(2, count($grants));
    }

    function testGenerateToken()
    {
        $scopedAuthenticationToken = new ScopedAuthenticationToken(
            'SK123',
            'AC123',
            'Token1',
            3600,
            array(
                new Grant('https://api.twilio.com/**')
            )
        );
        $token = $scopedAuthenticationToken->generateToken('secret');

        $this->assertNotNull($token);

        $decodedToken = JWT::decode($token, 'secret');

        $this->assertEquals('Token1', $decodedToken->jti);
        $this->assertEquals('SK123', $decodedToken->iss);
        $this->assertEquals('AC123', $decodedToken->sub);
        $this->assertNotNull($decodedToken->nbf);
        $this->assertNotNull($decodedToken->exp);
        $this->assertEquals($decodedToken->nbf + 3600, $decodedToken->exp);
        $this->assertNotNull($decodedToken->grants);
        $this->assertEquals('https://api.twilio.com/**', $decodedToken->grants[0]->res);
        $this->assertEquals('*', $decodedToken->grants[0]->act[0]);
    }

    function testGenerateTokenWithoutGrants()
    {
        $scopedAuthenticationToken = new ScopedAuthenticationToken(
            'SK123',
            'AC123',
            'Token1',
            3600
        );
        $token = $scopedAuthenticationToken->generateToken('secret');

        $this->assertNotNull($token);

        $decodedToken = JWT::decode($token, 'secret');

        $this->assertEquals('Token1', $decodedToken->jti);
        $this->assertEquals('SK123', $decodedToken->iss);
        $this->assertEquals('AC123', $decodedToken->sub);
        $this->assertNotNull($decodedToken->nbf);
        $this->assertNotNull($decodedToken->exp);
        $this->assertEquals($decodedToken->nbf + 3600, $decodedToken->exp);
        $this->assertNotNull($decodedToken->grants);
        $this->assertEquals(0, count($decodedToken->grants));
    }

    function testGenerateTokenWithoutTokenId()
    {
        $scopedAuthenticationToken = new ScopedAuthenticationToken(
            'SK123',
            'AC123',
            null,
            3600,
            array(
                new Grant('https://api.twilio.com/**', array(Action::POST))
            )
        );
        $token = $scopedAuthenticationToken->generateToken('secret');

        $this->assertNotNull($token);

        $decodedToken = JWT::decode($token, 'secret');

        $this->assertNotNull($decodedToken->jti);
        $this->assertEquals('SK123', $decodedToken->iss);
        $this->assertEquals('AC123', $decodedToken->sub);
        $this->assertNotNull($decodedToken->nbf);
        $this->assertNotNull($decodedToken->exp);
        $this->assertEquals($decodedToken->nbf + 3600, $decodedToken->exp);
        $this->assertNotNull($decodedToken->grants);
        $this->assertEquals('https://api.twilio.com/**', $decodedToken->grants[0]->res);
        $this->assertEquals('POST', $decodedToken->grants[0]->act[0]);
    }

}
