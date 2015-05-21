<?php

require_once 'Twilio/AccessToken.php';

class AccessTokenTest extends PHPUnit_Framework_TestCase
{
    const SIGNING_KEY_SID = 'SK123';

    const ACCOUNT_SID = 'AC123';

    protected function validateClaims($payload)
    {
        $this->assertEquals(self::SIGNING_KEY_SID, $payload->iss);
        $this->assertEquals(self::ACCOUNT_SID, $payload->sub);
        $this->assertNotNull($payload->nbf);
        $this->assertNotNull($payload->exp);
        $this->assertEquals($payload->nbf + 3600, $payload->exp);
        $this->assertNotNull($payload->jti);
        $this->assertEquals($payload->iss . '-' . $payload->nbf, $payload->jti);
        $this->assertNotNull($payload->grants);
    }

    function testEmptyGrants()
    {
        $scat = new Services_Twilio_AccessToken(self::SIGNING_KEY_SID, self::ACCOUNT_SID, 'secret');
        $token = $scat->toJWT();
        $this->assertNotNull($token);
        $payload = JWT::decode($token, 'secret');
        $this->validateClaims($payload);
        $this->assertEquals(0, count($payload->grants));
    }

    function testAddGrant()
    {
        $scat = new Services_Twilio_AccessToken(self::SIGNING_KEY_SID, self::ACCOUNT_SID, 'secret');
        $scat->addGrant('https://api.twilio.com/**');
        $token = $scat->toJWT();
        $this->assertNotNull($token);
        $payload = JWT::decode($token, 'secret');
        $this->validateClaims($payload);
        $this->assertEquals(1, count($payload->grants));
        $grant = $payload->grants[0];
        $this->assertEquals('https://api.twilio.com/**', $grant->res);
        $this->assertEquals(array('*'), $grant->act);
    }



    function testEndpointGrant()
    {
        $scat = new Services_Twilio_AccessToken(self::SIGNING_KEY_SID, self::ACCOUNT_SID, 'secret');
        $scat->addEndpointGrant('bob');
        $token = $scat->toJWT();
        $this->assertNotNull($token);
        $payload = JWT::decode($token, 'secret');
        $this->validateClaims($payload);
        $this->assertEquals(1, count($payload->grants));
        $grant = $payload->grants[0];
        $this->assertEquals('sip:bob@AC123.endpoint.twilio.com', $grant->res);
        $this->assertEquals(array('listen', 'invite'), $grant->act);
    }

    function testRestGrant()
    {
        $scat = new Services_Twilio_AccessToken(self::SIGNING_KEY_SID, self::ACCOUNT_SID, 'secret');
        $scat->addRestGrant('/Apps');
        $token = $scat->toJWT();
        $this->assertNotNull($token);
        $payload = JWT::decode($token, 'secret');
        $this->validateClaims($payload);
        $this->assertEquals(1, count($payload->grants));
        $grant = $payload->grants[0];
        $this->assertEquals('https://api.twilio.com/2010-04-01/Accounts/AC123/Apps', $grant->res);
        $this->assertEquals(array('*'), $grant->act);
    }

    function testEnableNTS()
    {
        $scat = new Services_Twilio_AccessToken(self::SIGNING_KEY_SID, self::ACCOUNT_SID, 'secret');
        $scat->enableNTS();
        $token = $scat->toJWT();
        $this->assertNotNull($token);
        $payload = JWT::decode($token, 'secret');
        $this->validateClaims($payload);
        $this->assertEquals(1, count($payload->grants));
        $grant = $payload->grants[0];
        $this->assertEquals('https://api.twilio.com/2010-04-01/Accounts/AC123/Tokens.json', $grant->res);
        $this->assertEquals(array('POST'), $grant->act);
    }


}
