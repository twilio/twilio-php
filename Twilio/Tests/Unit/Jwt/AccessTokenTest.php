<?php

namespace Twilio\Tests\Unit\Jwt;

use Twilio\Jwt\Grants\ChatGrant;
use Twilio\Jwt\Grants\ConversationsGrant;
use Twilio\Jwt\Grants\IpMessagingGrant;
use Twilio\Jwt\Grants\VideoGrant;
use Twilio\Jwt\Grants\VoiceGrant;
use Twilio\Jwt\Grants\SyncGrant;
use Twilio\Jwt\Grants\TaskRouterGrant;
use Twilio\Jwt\JWT;
use Twilio\Tests\Unit\UnitTest;
use Twilio\Jwt\AccessToken;

class AccessTokenTest extends UnitTest {
    const SIGNING_KEY_SID = 'SK123';

    const ACCOUNT_SID = 'AC123';

    protected function validateClaims($payload) {
        $this->assertEquals(self::SIGNING_KEY_SID, $payload->iss);
        $this->assertEquals(self::ACCOUNT_SID, $payload->sub);

        $this->assertNotNull($payload->exp);

        $this->assertGreaterThanOrEqual(time(), $payload->exp);

        $this->assertNotNull($payload->jti);
        $this->assertStringStartsWith($payload->iss . '-', $payload->jti);

        $this->assertNotNull($payload->grants);
    }

    function testEmptyGrants() {
        $scat = new AccessToken(self::ACCOUNT_SID, self::SIGNING_KEY_SID, 'secret');
        $token = $scat->toJWT();
        $this->assertNotNull($token);
        $payload = JWT::decode($token, 'secret');
        $this->validateClaims($payload);

        $this->assertEquals('{}', json_encode($payload->grants));
    }

    function testNbf() {
        $scat = new AccessToken(self::ACCOUNT_SID, self::SIGNING_KEY_SID, 'secret');

        $now = time();
        $scat->setNbf($now);

        $token = $scat->toJWT();
        $this->assertNotNull($token);
        $payload = JWT::decode($token, 'secret');
        $this->validateClaims($payload);
        $this->assertEquals('{}', json_encode($payload->grants));
        $this->assertEquals($now, $payload->nbf);
        $this->assertGreaterThan($payload->nbf, $payload->exp);
    }

    function testIpMessagingGrant() {
        $scat = new AccessToken(self::ACCOUNT_SID, self::SIGNING_KEY_SID, 'secret');
        @$grant = new IpMessagingGrant();
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

    function testChatGrant() {
        $scat = new AccessToken(self::ACCOUNT_SID, self::SIGNING_KEY_SID, 'secret');
        $grant = new ChatGrant();
        $grant->setEndpointId("EP123");
        $grant->setServiceSid("IS123");
        $scat->addGrant($grant);

        $token = $scat->toJWT();
        $this->assertNotNull($token);
        $payload = JWT::decode($token, 'secret');
        $this->validateClaims($payload);

        $grants = json_decode(json_encode($payload->grants), true);
        $this->assertEquals(1, count($grants));
        $this->assertArrayHasKey("chat", $grants);
        $this->assertEquals("EP123", $grants['chat']['endpoint_id']);
        $this->assertEquals("IS123", $grants['chat']['service_sid']);
    }

    function testSyncGrant()
    {
        $scat = new AccessToken(self::ACCOUNT_SID, self::SIGNING_KEY_SID, 'secret');
        $grant = new SyncGrant();
        $grant->setEndpointId("EP123");
        $grant->setServiceSid("IS123");
        $scat->addGrant($grant);

        $token = $scat->toJWT();
        $this->assertNotNull($token);
        $payload = JWT::decode($token, 'secret');
        $this->validateClaims($payload);

        $grants = json_decode(json_encode($payload->grants), true);
        $this->assertEquals(1, count($grants));
        $this->assertArrayHasKey("data_sync", $grants);
        $this->assertEquals("EP123", $grants['data_sync']['endpoint_id']);
        $this->assertEquals("IS123", $grants['data_sync']['service_sid']);
    }

    function testVideoGrant()
    {
        $scat = new AccessToken(self::ACCOUNT_SID, self::SIGNING_KEY_SID, 'secret');
        $grant = new VideoGrant();
        $grant->setRoom("RM123");
        $scat->addGrant($grant);

        $token = $scat->toJWT();
        $this->assertNotNull($token);
        $payload = JWT::decode($token, 'secret');
        $this->validateClaims($payload);

        $grants = json_decode(json_encode($payload->grants), true);
        $this->assertEquals(1, count($grants));
        $this->assertArrayHasKey("video", $grants);
        $this->assertEquals("RM123", $grants['video']['room']);
    }

    function testGrants() {
        $scat = new AccessToken(self::ACCOUNT_SID, self::SIGNING_KEY_SID, 'secret');
        $scat->setIdentity('test identity');
        @$scat->addGrant(new IpMessagingGrant());
        $scat->addGrant(new VideoGrant());
        $scat->addGrant(new TaskRouterGrant());

        $token = $scat->toJWT();

        $this->assertNotNull($token);
        $payload = JWT::decode($token, 'secret');
        $this->validateClaims($payload);

        $grants = json_decode(json_encode($payload->grants), true);
        $this->assertEquals(4, count($grants));
        $this->assertEquals('test identity', $payload->grants->identity);
        $this->assertEquals('{}', json_encode($payload->grants->ip_messaging));
        $this->assertEquals('{}', json_encode($payload->grants->video));
        $this->assertEquals('{}', json_encode($payload->grants->task_router));
    }

    function testVoiceGrant() {
        $scat = new AccessToken(self::ACCOUNT_SID, self::SIGNING_KEY_SID, 'secret');
        $scat->setIdentity('test identity');

        $pvg = new VoiceGrant();
        $pvg->setOutgoingApplication('AP123', array('foo' => 'bar'));

        $scat->addGrant($pvg);

        $token = $scat->toJWT();

        $this->assertNotNull($token);
        $payload = JWT::decode($token, 'secret');
        $this->validateClaims($payload);

        $grants = json_decode(json_encode($payload->grants), true);
        $this->assertEquals(2, count($grants));
        $this->assertEquals('test identity', $payload->grants->identity);

        $decodedGrant = $grants['voice'];
        $outgoing = $decodedGrant['outgoing'];
        $this->assertEquals('AP123', $outgoing['application_sid']);

        $params = $outgoing['params'];
        $this->assertEquals('bar', $params['foo']);
    }

    function testTaskRouterGrant() {
        $scat = new AccessToken(self::ACCOUNT_SID, self::SIGNING_KEY_SID, 'secret');
        $grant = new TaskRouterGrant();
        $grant->setWorkspaceSid("WS123");
        $grant->setWorkerSid("WK123");
        $grant->setRole("worker");
        $scat->addGrant($grant);

        $token = $scat->toJWT();
        $this->assertNotNull($token);
        $payload = JWT::decode($token, 'secret');
        $this->validateClaims($payload);

        $grants = json_decode(json_encode($payload->grants), true);
        $this->assertEquals(1, count($grants));
        $this->assertArrayHasKey("task_router", $grants);
        $this->assertEquals("WS123", $grants['task_router']['workspace_sid']);
        $this->assertEquals("WK123", $grants['task_router']['worker_sid']);
        $this->assertEquals("worker", $grants['task_router']['role']);
    }

}
