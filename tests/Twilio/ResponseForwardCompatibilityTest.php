<?php

namespace Twilio\Tests;

require "vendor/autoload.php";

use Twilio\Rest\Client;
use Twilio\Rest\Api\V2010\Account\MessageInstance;
use Twilio\Rest\Messaging\V2\ChannelsSenderInstance;
use Twilio\Rest\Memory\V1\MemoryRetrievalResponseInstance;

/**
 * Forward compatibility of response models: the API can add fields, stop sending
 * fields, or send values the SDK has never seen before, underneath a pinned SDK
 * version, without breaking deserialization of the fields the SDK already knows
 * about.
 *
 * Instances are built directly from a payload array (mirroring how the generated
 * List/Context classes feed the constructor after decoding the HTTP response), so
 * no network access is required. Covers three shapes of generated response model:
 *  - a flat (non-nested) response: MessageInstance
 *  - a nested response (top-level resource): ChannelsSenderInstance
 *  - a nested, operation-specific response with lists of objects: MemoryRetrievalResponseInstance
 */
class ResponseForwardCompatibilityTest extends \PHPUnit\Framework\TestCase
{
    private static $twilio;
    private static $accountSid = 'ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';

    private static $liveTwilio;
    private static $liveSenderSid;

    public static function setUpBeforeClass(): void
    {
        self::$twilio = new Client(self::$accountSid, 'AUTHTOKEN', self::$accountSid);

        $liveAccountSid = getenv('TWILIO_ACCOUNT_SID');
        $liveApiKey = getenv('TWILIO_API_KEY');
        $liveSecret = getenv('TWILIO_API_SECRET');
        self::$liveSenderSid = getenv('TWILIO_CHANNELS_SENDER_SID') ?: 'XE740e8826014f8f2974470c599f907dbb';
        self::$liveTwilio = new Client($liveApiKey, $liveSecret, $liveAccountSid);
    }

    // ---------------------------------------------------------------
    // Flat response model: MessageInstance
    // ---------------------------------------------------------------

    private static $messageSid = 'SMaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';

    private static function baseMessagePayload(): array
    {
        return [
            'account_sid' => self::$accountSid,
            'body' => 'Hello owl',
            'direction' => 'outbound-api',
            'error_code' => 30007,
            'from' => '+14155552345',
            'price_unit' => 'USD',
            'sid' => self::$messageSid,
            'status' => 'sent',
            'subresource_uris' => [
                'media' => '/2010-04-01/Accounts/' . self::$accountSid . '/Messages/' . self::$messageSid . '/Media.json',
            ],
            'to' => '+14155552345',
        ];
    }

    private static function buildMessage(array $payload): MessageInstance
    {
        return new MessageInstance(self::$twilio->api->v2010, $payload, self::$accountSid, self::$messageSid);
    }

    public function testFlatResponse_UnknownFieldIsIgnored(): void
    {
        $payload = self::baseMessagePayload();
        $payload['delivery_channel'] = 'rcs';
        $payload['engagement'] = ['clicks' => 3, 'links' => [['url' => 'https://twilio.com']]];

        $message = self::buildMessage($payload);

        $this->assertEquals(self::$messageSid, $message->sid);
        $this->assertEquals('Hello owl', $message->body);
        $this->assertEquals('sent', $message->status);
    }

    public function testFlatResponse_RemovedFieldDeserializesToNull(): void
    {
        $payload = self::baseMessagePayload();
        unset($payload['body'], $payload['status'], $payload['subresource_uris']);

        $message = self::buildMessage($payload);

        $this->assertNull($message->body);
        $this->assertNull($message->status);
        $this->assertNull($message->subresourceUris);
        $this->assertEquals(self::$messageSid, $message->sid);
    }

    public function testFlatResponse_UnknownStatusValueIsPreserved(): void
    {
        $payload = self::baseMessagePayload();
        $payload['status'] = 'eagerly_delivered';

        $message = self::buildMessage($payload);

        $this->assertEquals('eagerly_delivered', $message->status);
    }

    public function testFlatResponse_EmptyPayloadDeserializesToEmptyResource(): void
    {
        $message = self::buildMessage([]);

        $this->assertNotNull($message);
        $this->assertNull($message->sid);
        $this->assertNull($message->status);
    }

    // ---------------------------------------------------------------
    // Nested response model: ChannelsSenderInstance
    // ---------------------------------------------------------------

    private static $senderSid = 'XEaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa';

    private static function baseSenderPayload(): array
    {
        return [
            'sid' => self::$senderSid,
            'status' => 'ONLINE',
            'configuration' => [
                'waba_id' => '1234567890',
                'verification_method' => 'sms',
            ],
            'profile' => ['name' => 'Owl Shop'],
            'offline_reasons' => [
                ['code' => '63024', 'message' => 'Sender is offline'],
            ],
            'compliance' => [
                'countries' => [
                    [
                        'country' => 'US',
                        'status' => 'ONLINE',
                        'carriers' => [['name' => 'AT&T', 'status' => 'APPROVED']],
                    ],
                ],
            ],
        ];
    }

    private static function buildSender(array $payload): ChannelsSenderInstance
    {
        return new ChannelsSenderInstance(self::$twilio->messaging->v2, $payload, self::$senderSid);
    }

    public function testNestedResponse_UnknownFieldAtNestedLevelIsIgnored(): void
    {
        $payload = self::baseSenderPayload();
        $payload['configuration']['waba_tier'] = 'TIER_2';
        $payload['compliance']['countries'][0]['carriers'][0]['launch_date'] = '2025-03-01';

        $sender = self::buildSender($payload);

        $this->assertEquals('1234567890', $sender->configuration['waba_id']);
        $this->assertEquals('AT&T', $sender->compliance['countries'][0]['carriers'][0]['name']);
    }

    public function testNestedResponse_RemovedFieldInsideNestedObjectStillLeavesSiblingsIntact(): void
    {
        $payload = self::baseSenderPayload();
        unset($payload['configuration']['waba_id']);
        unset($payload['compliance']['countries'][0]['carriers']);

        $sender = self::buildSender($payload);

        $this->assertArrayNotHasKey('waba_id', $sender->configuration);
        $this->assertEquals('sms', $sender->configuration['verification_method']);
        $this->assertArrayNotHasKey('carriers', $sender->compliance['countries'][0]);
        $this->assertEquals('US', $sender->compliance['countries'][0]['country']);
    }

    public function testNestedResponse_RemovedWholeNestedObjectDeserializesToNull(): void
    {
        $payload = self::baseSenderPayload();
        unset($payload['configuration'], $payload['compliance']);

        $sender = self::buildSender($payload);

        $this->assertNull($sender->configuration);
        $this->assertNull($sender->compliance);
        $this->assertEquals('Owl Shop', $sender->profile['name']);
    }

    public function testNestedResponse_NewItemInNestedListIsKept(): void
    {
        $payload = self::baseSenderPayload();
        $payload['offline_reasons'][] = ['code' => '63999', 'message' => 'Brand new reason', 'remediation' => 'Contact support'];

        $sender = self::buildSender($payload);

        $this->assertCount(2, $sender->offlineReasons);
        $this->assertEquals('Brand new reason', $sender->offlineReasons[1]['message']);
    }

    public function testNestedResponse_UnknownStatusValueAtNestedLevelIsPreserved(): void
    {
        $payload = self::baseSenderPayload();
        $payload['compliance']['countries'][0]['carriers'][0]['status'] = 'LAUNCHING';

        $sender = self::buildSender($payload);

        $this->assertEquals('LAUNCHING', $sender->compliance['countries'][0]['carriers'][0]['status']);
    }

    public function testNestedResponse_AccessingUnknownPropertyThrows(): void
    {
        $sender = self::buildSender(self::baseSenderPayload());

        $this->expectException(\Twilio\Exceptions\TwilioException::class);
        $this->expectExceptionMessage('Unknown property: nonExistentProperty');

        $_ = $sender->nonExistentProperty;
    }

    /**
     * Live smoke test: fetches a real ChannelsSender from the API and confirms
     * that whatever nested fields it currently returns deserialize without
     * throwing, even if the API has added fields since this SDK was generated.
     * Requires TWILIO_ACCOUNT_SID/TWILIO_API_KEY/TWILIO_API_SECRET; skipped otherwise.
     */
    public function testNestedResponse_LiveFetchDoesNotThrowOnCurrentApiShape(): void
    {
        if (!getenv('TWILIO_ACCOUNT_SID') || !getenv('TWILIO_API_KEY') || !getenv('TWILIO_API_SECRET')) {
            $this->markTestSkipped('TWILIO_ACCOUNT_SID/TWILIO_API_KEY/TWILIO_API_SECRET not set');
        }

        $sender = self::$liveTwilio->messaging->v2->channelsSenders(self::$liveSenderSid)->fetch();

        $this->assertInstanceOf(ChannelsSenderInstance::class, $sender);
        $this->assertEquals(self::$liveSenderSid, $sender->sid);
        $this->assertNotNull($sender->status);
        $this->assertNotNull($sender->senderId);

        if ($sender->profile !== null) {
            $this->assertIsArray($sender->profile);
        }
        if ($sender->configuration !== null) {
            $this->assertIsArray($sender->configuration);
        }
        if ($sender->webhook !== null) {
            $this->assertIsArray($sender->webhook);
        }
    }

    /**
     * Live smoke test: lists real ChannelsSenders and confirms nested fields on
     * each result deserialize without throwing on whatever shape the API
     * currently returns. Requires the same env vars as the fetch test above.
     */
    public function testNestedResponse_LiveListDoesNotThrowOnCurrentApiShape(): void
    {
        if (!getenv('TWILIO_ACCOUNT_SID') || !getenv('TWILIO_API_KEY') || !getenv('TWILIO_API_SECRET')) {
            $this->markTestSkipped('TWILIO_ACCOUNT_SID/TWILIO_API_KEY/TWILIO_API_SECRET not set');
        }

        $senders = self::$liveTwilio->messaging->v2->channelsSenders->read([], 3);

        $this->assertNotEmpty($senders);

        foreach ($senders as $sender) {
            $this->assertInstanceOf(ChannelsSenderInstance::class, $sender);
            $this->assertNotNull($sender->sid);
            $this->assertNotNull($sender->status);

            if ($sender->profile !== null) {
                $this->assertIsArray($sender->profile);
            }
            if ($sender->configuration !== null) {
                $this->assertIsArray($sender->configuration);
            }
        }
    }

    // ---------------------------------------------------------------
    // Nested, operation-specific response model: MemoryRetrievalResponseInstance
    // (ProfileCreateResource-equivalent is too thin - id/message only - so this
    // uses the Recall response instead: it carries lists of nested objects and an
    // object nested two levels deep, communications[].author.)
    // ---------------------------------------------------------------

    private static $storeId = 'ST_aaaaaaaaaaaaaaaaaaaaaaaaaa';
    private static $profileId = 'PR_aaaaaaaaaaaaaaaaaaaaaaaaaa';

    private static function baseRecallPayload(): array
    {
        return [
            'observations' => [
                ['content' => 'Customer asked about owl feed', 'occurredAt' => '2026-01-01T00:00:00Z', 'id' => 'OB1'],
            ],
            'communications' => [
                [
                    'id' => 'CM1',
                    'content' => ['text' => 'Hello, how can I help?'],
                    'author' => ['id' => 'PT1', 'name' => 'Agent Owl', 'channel' => 'SMS', 'type' => 'HUMAN_AGENT'],
                    'channelId' => 'CH1',
                ],
            ],
            'meta' => ['queryTime' => 120],
        ];
    }

    private static function buildRecall(array $payload): MemoryRetrievalResponseInstance
    {
        return new MemoryRetrievalResponseInstance(self::$twilio->memory->v1, $payload, self::$storeId, self::$profileId);
    }

    public function testOperationSpecificResponse_UnknownFieldAtParentAndNestedLevelIsIgnored(): void
    {
        $payload = self::baseRecallPayload();
        $payload['queryId'] = 'QR1';
        $payload['meta']['cacheHit'] = true;
        $payload['communications'][0]['deliveryReceipt'] = ['seenAt' => '2026-01-01T00:01:00Z'];

        $recall = self::buildRecall($payload);

        $this->assertEquals(120, $recall->meta['queryTime']);
        $this->assertEquals('Agent Owl', $recall->communications[0]['author']['name']);
    }

    public function testOperationSpecificResponse_RemovedFieldAtParentAndNestedLevelDeserializesToNull(): void
    {
        $payload = self::baseRecallPayload();
        unset($payload['meta']);
        unset($payload['communications'][0]['author']['name']);

        $recall = self::buildRecall($payload);

        $this->assertNull($recall->meta);
        $this->assertArrayNotHasKey('name', $recall->communications[0]['author']);
        $this->assertEquals('PT1', $recall->communications[0]['author']['id']);
        $this->assertEquals('SMS', $recall->communications[0]['author']['channel']);
    }

    public function testOperationSpecificResponse_UnknownEnumValueInNestedListItemIsPreserved(): void
    {
        $payload = self::baseRecallPayload();
        $payload['communications'][0]['author']['channel'] = 'RCS_BUSINESS_MESSAGING';

        $recall = self::buildRecall($payload);

        $this->assertEquals('RCS_BUSINESS_MESSAGING', $recall->communications[0]['author']['channel']);
    }
}
