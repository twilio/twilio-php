<?php

namespace Twilio\Tests\Unit\Jwt;

use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\ChatGrant;
use Twilio\Jwt\Grants\PlaybackGrant;
use Twilio\Jwt\Grants\SyncGrant;
use Twilio\Jwt\Grants\TaskRouterGrant;
use Twilio\Jwt\Grants\VideoGrant;
use Twilio\Jwt\Grants\VoiceGrant;
use Twilio\Jwt\JWT;
use Twilio\Tests\Unit\UnitTest;

class AccessTokenTest extends UnitTest {
    public const SIGNING_KEY_SID = 'SK123';

    public const ACCOUNT_SID = 'AC123';

    protected function validateClaims($payload): void {
        $this->assertEquals(self::SIGNING_KEY_SID, $payload->iss);
        $this->assertEquals(self::ACCOUNT_SID, $payload->sub);

        $this->assertNotNull($payload->exp);

        $this->assertGreaterThanOrEqual(\time(), $payload->exp);

        $this->assertNotNull($payload->jti);
        $this->assertStringStartsWith($payload->iss . '-', $payload->jti);

        $this->assertNotNull($payload->grants);
    }

    public function testEmptyGrants(): void {
        $scat = new AccessToken(self::ACCOUNT_SID, self::SIGNING_KEY_SID, 'secret');
        $token = $scat->toJWT();
        $this->assertNotNull($token);
        $payload = JWT::decode($token, 'secret');
        $this->validateClaims($payload);

        $this->assertEquals('{}', \json_encode($payload->grants));
    }

    public function testMissingRegion(): void {
        $scat = new AccessToken(self::ACCOUNT_SID, self::SIGNING_KEY_SID, 'secret');
        $token = $scat->toJWT();
        $this->assertNotNull($token);
        $header = JWT::getHeader($token);

        $this->assertEquals('twilio-fpa;v=1', $header->cty);
        $this->assertEquals('JWT', $header->typ);
        $this->assertEquals(false, property_exists($header, 'twr'));
    }

    public function testValidRegion(): void {
        $scat = new AccessToken(self::ACCOUNT_SID, self::SIGNING_KEY_SID, 'secret');
        $scat->setRegion('foo');
        $token = $scat->toJWT();
        $this->assertNotNull($token);
        $header = JWT::getHeader($token);

        $this->assertEquals('twilio-fpa;v=1', $header->cty);
        $this->assertEquals('JWT', $header->typ);
        $this->assertEquals('foo', $header->twr);
    }

    public function testNbf(): void {
        $scat = new AccessToken(self::ACCOUNT_SID, self::SIGNING_KEY_SID, 'secret');

        $now = \time();
        $scat->setNbf($now);

        $token = $scat->toJWT();
        $this->assertNotNull($token);
        $payload = JWT::decode($token, 'secret');
        $this->validateClaims($payload);
        $this->assertEquals('{}', \json_encode($payload->grants));
        $this->assertEquals($now, $payload->nbf);
        $this->assertGreaterThan($payload->nbf, $payload->exp);
    }

    public function testChatGrant(): void {
        $scat = new AccessToken(self::ACCOUNT_SID, self::SIGNING_KEY_SID, 'secret');
        $grant = new ChatGrant();
        $grant->setEndpointId('EP123');
        $grant->setServiceSid('IS123');
        $scat->addGrant($grant);

        $token = $scat->toJWT();
        $this->assertNotNull($token);
        $payload = JWT::decode($token, 'secret');
        $this->validateClaims($payload);

        $grants = \json_decode(\json_encode($payload->grants), true);
        $this->assertCount(1, $grants);
        $this->assertArrayHasKey('chat', $grants);
        $this->assertEquals('EP123', $grants['chat']['endpoint_id']);
        $this->assertEquals('IS123', $grants['chat']['service_sid']);
    }

    public function testPlaybackGrant(): void {
        $scat = new AccessToken(self::ACCOUNT_SID, self::SIGNING_KEY_SID, 'secret');
        $grant = new PlaybackGrant();
        $playbackGrant = ['requestCredentials' => NULL,
            'playbackUrl' => 'https://000.us-east-1.playback.live-video.net/api/video/v1/us-east-000.channel.000?token=xxxxx',
            'playerStreamerSid' => 'VJXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'];
        $grant->setGrant($playbackGrant);
        $scat->addGrant($grant);

        $token = $scat->toJWT();
        $this->assertNotNull($token);
        $payload = JWT::decode($token, 'secret');
        $this->validateClaims($payload);

        $grants = \json_decode(\json_encode($payload->grants), true);
        $this->assertCount(1, $grants);
        $this->assertArrayHasKey('player', $grants);
        $this->assertEquals($playbackGrant, $grants['player']);
    }

    public function testSyncGrant(): void {
        $scat = new AccessToken(self::ACCOUNT_SID, self::SIGNING_KEY_SID, 'secret');
        $grant = new SyncGrant();
        $grant->setEndpointId('EP123');
        $grant->setServiceSid('IS123');
        $scat->addGrant($grant);

        $token = $scat->toJWT();
        $this->assertNotNull($token);
        $payload = JWT::decode($token, 'secret');
        $this->validateClaims($payload);

        $grants = \json_decode(\json_encode($payload->grants), true);
        $this->assertCount(1, $grants);
        $this->assertArrayHasKey('data_sync', $grants);
        $this->assertEquals('EP123', $grants['data_sync']['endpoint_id']);
        $this->assertEquals('IS123', $grants['data_sync']['service_sid']);
    }

    public function testVideoGrant(): void {
        $scat = new AccessToken(self::ACCOUNT_SID, self::SIGNING_KEY_SID, 'secret');
        $grant = new VideoGrant();
        $grant->setRoom('RM123');
        $scat->addGrant($grant);

        $token = $scat->toJWT();
        $this->assertNotNull($token);
        $payload = JWT::decode($token, 'secret');
        $this->validateClaims($payload);

        $grants = \json_decode(\json_encode($payload->grants), true);
        $this->assertCount(1, $grants);
        $this->assertArrayHasKey('video', $grants);
        $this->assertEquals('RM123', $grants['video']['room']);
    }

    public function testGrants(): void {
        $scat = new AccessToken(self::ACCOUNT_SID, self::SIGNING_KEY_SID, 'secret');
        $scat->setIdentity('test identity');
        $scat->addGrant(new VideoGrant());
        $scat->addGrant(new TaskRouterGrant());

        $token = $scat->toJWT();

        $this->assertNotNull($token);
        $payload = JWT::decode($token, 'secret');
        $this->validateClaims($payload);

        $grants = \json_decode(\json_encode($payload->grants), true);
        $this->assertCount(3, $grants);
        $this->assertEquals('test identity', $payload->grants->identity);
        $this->assertEquals('{}', \json_encode($payload->grants->video));
        $this->assertEquals('{}', \json_encode($payload->grants->task_router));
    }

    public function testVoiceGrant(): void {
        $scat = new AccessToken(self::ACCOUNT_SID, self::SIGNING_KEY_SID, 'secret');
        $scat->setIdentity('test identity');

        $pvg = new VoiceGrant();
        $pvg->setIncomingAllow(true);
        $pvg->setOutgoingApplication('AP123', ['foo' => 'bar']);

        $scat->addGrant($pvg);

        $token = $scat->toJWT();

        $this->assertNotNull($token);
        $payload = JWT::decode($token, 'secret');
        $this->validateClaims($payload);

        $grants = \json_decode(\json_encode($payload->grants), true);
        $this->assertCount(2, $grants);
        $this->assertEquals('test identity', $payload->grants->identity);

        $decodedGrant = $grants['voice'];
        $incoming = $decodedGrant['incoming'];
        $this->assertEquals(true, $incoming['allow']);

        $outgoing = $decodedGrant['outgoing'];
        $this->assertEquals('AP123', $outgoing['application_sid']);

        $params = $outgoing['params'];
        $this->assertEquals('bar', $params['foo']);
    }

    public function testTaskRouterGrant(): void {
        $scat = new AccessToken(self::ACCOUNT_SID, self::SIGNING_KEY_SID, 'secret');
        $grant = new TaskRouterGrant();
        $grant->setWorkspaceSid('WS123');
        $grant->setWorkerSid('WK123');
        $grant->setRole('worker');
        $scat->addGrant($grant);

        $token = $scat->toJWT();
        $this->assertNotNull($token);
        $payload = JWT::decode($token, 'secret');
        $this->validateClaims($payload);

        $grants = \json_decode(\json_encode($payload->grants), true);
        $this->assertCount(1, $grants);
        $this->assertArrayHasKey('task_router', $grants);
        $this->assertEquals('WS123', $grants['task_router']['workspace_sid']);
        $this->assertEquals('WK123', $grants['task_router']['worker_sid']);
        $this->assertEquals('worker', $grants['task_router']['role']);
    }

    public function testCustomClaims(): void {
        $scat = new AccessToken(self::ACCOUNT_SID, self::SIGNING_KEY_SID, 'secret');
        $scat->addClaim('find', 'me');
        $scat->addClaim('sub', 'redefined');
        $payload = JWT::decode($scat->toJWT(), 'secret');
        $this->assertSame('me', $payload->find);
        $this->assertNotSame('redefined', $payload->sub);
    }
}
