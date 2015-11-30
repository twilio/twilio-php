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
        $scat = new Services_Twilio_AccessToken(self::ACCOUNT_SID, self::SIGNING_KEY_SID, 'secret');
        $token = $scat->toJWT();
        $this->assertNotNull($token);
        $payload = JWT::decode($token, 'secret');
        $this->validateClaims($payload);
        $this->assertEquals(0, count($payload->grants));
    }

    function testConversationGrant()
    {
        $scat = new Services_Twilio_AccessToken(self::ACCOUNT_SID, self::SIGNING_KEY_SID, 'secret');
        $grant = new Services_Twilio_Auth_ConversationsGrant();
        $grant->setConfigurationProfileSid("CP123");
        $scat->addGrant($grant);

        $token = $scat->toJWT();
        $this->assertNotNull($token);
        $payload = JWT::decode($token, 'secret');
        $this->validateClaims($payload);

        $grants = json_decode(json_encode($payload->grants), true);
        $this->assertEquals(1, count($grants));
        $this->assertArrayHasKey("rtc", $grants);
        $this->assertEquals("CP123", $grants['rtc']['configuration_profile_sid']);
    }

    function testIpMessagingGrant()
    {
        $scat = new Services_Twilio_AccessToken(self::ACCOUNT_SID, self::SIGNING_KEY_SID, 'secret');
        $grant = new Services_Twilio_Auth_IpMessagingGrant();
        $grant->setEndpointId("EP123");
        $grant->setServiceSid("IS123");
        $scat->addGrant($grant);

        $token = $scat->toJWT();
        $this->assertNotNull($token);
        $payload = JWT::decode($token, 'secret');
        $this->validateClaims($payload);

        $grants = json_decode(json_encode($payload->grants), true);
        $this->assertEquals(1, count($grants));
        $this->assertArrayHasKey("ip_messaging", $grants);
        $this->assertEquals("EP123", $grants['ip_messaging']['endpoint_id']);
        $this->assertEquals("IS123", $grants['ip_messaging']['service_sid']);
    }

    function testGrants()
    {
        $scat = new Services_Twilio_AccessToken(self::ACCOUNT_SID, self::SIGNING_KEY_SID, 'secret');
        $scat->setIdentity('test identity');
        $scat->addGrant(new Services_Twilio_Auth_ConversationsGrant());
        $scat->addGrant(new Services_Twilio_Auth_IpMessagingGrant());

        $token = $scat->toJWT();
        $this->assertNotNull($token);
        $payload = JWT::decode($token, 'secret');
        $this->validateClaims($payload);

        $grants = json_decode(json_encode($payload->grants), true);
        $this->assertEquals(3, count($grants));
        $this->assertEquals('test identity', $grants['identity']);
        $this->assertArrayHasKey("rtc", $grants);
        $this->assertEquals(json_decode(json_encode('{}')), $grants['rtc']);
        $this->assertArrayHasKey("ip_messaging", $grants);
        $this->assertEquals(json_decode(json_encode('{}')), $grants['ip_messaging']);
    }

}
