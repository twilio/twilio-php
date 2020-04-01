<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Tests\Integration\Conversations\V1\Conversation;

use Twilio\Exceptions\DeserializeException;
use Twilio\Exceptions\TwilioException;
use Twilio\Http\Response;
use Twilio\Tests\HolodeckTestCase;
use Twilio\Tests\Request;

class WebhookTest extends HolodeckTestCase {
    public function testReadRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->conversations->v1->conversations("CHXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                            ->webhooks->read();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'get',
            'https://conversations.twilio.com/v1/Conversations/CHXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Webhooks',
            [],
            [],
            []
        ));
    }

    public function testReadFullResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "meta": {
                    "page": 0,
                    "page_size": 5,
                    "first_page_url": "https://conversations.twilio.com/v1/Conversations/CHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Webhooks?PageSize=5&Page=0",
                    "previous_page_url": null,
                    "url": "https://conversations.twilio.com/v1/Conversations/CHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Webhooks?PageSize=5&Page=0",
                    "next_page_url": null,
                    "key": "webhooks"
                },
                "webhooks": [
                    {
                        "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "conversation_sid": "CHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "sid": "WHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "target": "webhook",
                        "configuration": {
                            "url": "https://example.com",
                            "method": "get",
                            "filters": [
                                "onMessageSent",
                                "onConversationDestroyed"
                            ]
                        },
                        "date_created": "2016-03-24T21:05:50Z",
                        "date_updated": "2016-03-24T21:05:50Z",
                        "url": "https://conversations.twilio.com/v1/Conversations/CHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Webhooks/WHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
                    },
                    {
                        "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "conversation_sid": "CHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "sid": "WHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "target": "trigger",
                        "configuration": {
                            "url": "https://example.com",
                            "method": "post",
                            "filters": [
                                "keyword1",
                                "keyword2"
                            ]
                        },
                        "date_created": "2016-03-24T21:05:50Z",
                        "date_updated": "2016-03-24T21:05:50Z",
                        "url": "https://conversations.twilio.com/v1/Conversations/CHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Webhooks/WHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
                    },
                    {
                        "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "conversation_sid": "CHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "sid": "WHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "target": "studio",
                        "configuration": {
                            "flow_sid": "FWaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
                        },
                        "date_created": "2016-03-24T21:05:50Z",
                        "date_updated": "2016-03-24T21:05:50Z",
                        "url": "https://conversations.twilio.com/v1/Conversations/CHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Webhooks/WHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
                    }
                ]
            }
            '
        ));

        $actual = $this->twilio->conversations->v1->conversations("CHXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                                  ->webhooks->read();

        $this->assertGreaterThan(0, \count($actual));
    }

    public function testReadEmptyResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "meta": {
                    "page": 0,
                    "page_size": 5,
                    "first_page_url": "https://conversations.twilio.com/v1/Conversations/CHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Webhooks?PageSize=5&Page=0",
                    "url": "https://conversations.twilio.com/v1/Conversations/CHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Webhooks?PageSize=5&Page=0",
                    "previous_page_url": null,
                    "next_page_url": null,
                    "key": "webhooks"
                },
                "webhooks": []
            }
            '
        ));

        $actual = $this->twilio->conversations->v1->conversations("CHXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                                  ->webhooks->read();

        $this->assertNotNull($actual);
    }

    public function testFetchRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->conversations->v1->conversations("CHXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                            ->webhooks("WHXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->fetch();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'get',
            'https://conversations.twilio.com/v1/Conversations/CHXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Webhooks/WHXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX',
            [],
            [],
            []
        ));
    }

    public function testFetchResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "conversation_sid": "CHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "sid": "WHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "target": "studio",
                "configuration": {
                    "flow_sid": "FWaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
                },
                "date_created": "2016-03-24T21:05:50Z",
                "date_updated": "2016-03-24T21:05:50Z",
                "url": "https://conversations.twilio.com/v1/Conversations/CHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Webhooks/WHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
            }
            '
        ));

        $actual = $this->twilio->conversations->v1->conversations("CHXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                                  ->webhooks("WHXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->fetch();

        $this->assertNotNull($actual);
    }

    public function testCreateRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->conversations->v1->conversations("CHXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                            ->webhooks->create("webhook");
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $values = ['Target' => "webhook", ];

        $this->assertRequest(new Request(
            'post',
            'https://conversations.twilio.com/v1/Conversations/CHXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Webhooks',
            [],
            $values,
            []
        ));
    }

    public function testCreateResponse(): void {
        $this->holodeck->mock(new Response(
            201,
            '
            {
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "conversation_sid": "CHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "sid": "WHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "target": "webhook",
                "configuration": {
                    "url": "https://example.com",
                    "method": "get",
                    "filters": [
                        "onMessageSent",
                        "onConversationDestroyed"
                    ]
                },
                "date_created": "2016-03-24T21:05:50Z",
                "date_updated": "2016-03-24T21:05:50Z",
                "url": "https://conversations.twilio.com/v1/Conversations/CHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Webhooks/WHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
            }
            '
        ));

        $actual = $this->twilio->conversations->v1->conversations("CHXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                                  ->webhooks->create("webhook");

        $this->assertNotNull($actual);
    }

    public function testUpdateRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->conversations->v1->conversations("CHXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                            ->webhooks("WHXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->update();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'post',
            'https://conversations.twilio.com/v1/Conversations/CHXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Webhooks/WHXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX',
            [],
            [],
            []
        ));
    }

    public function testUpdateResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "conversation_sid": "CHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "sid": "WHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "target": "trigger",
                "configuration": {
                    "url": "https://example.com",
                    "method": "post",
                    "filters": [
                        "keyword1",
                        "keyword2"
                    ]
                },
                "date_created": "2016-03-24T21:05:50Z",
                "date_updated": "2016-03-24T21:05:51Z",
                "url": "https://conversations.twilio.com/v1/Conversations/CHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Webhooks/WHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
            }
            '
        ));

        $actual = $this->twilio->conversations->v1->conversations("CHXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                                  ->webhooks("WHXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->update();

        $this->assertNotNull($actual);
    }

    public function testDeleteRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->conversations->v1->conversations("CHXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                            ->webhooks("WHXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->delete();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'delete',
            'https://conversations.twilio.com/v1/Conversations/CHXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Webhooks/WHXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX',
            [],
            [],
            []
        ));
    }

    public function testDeleteResponse(): void {
        $this->holodeck->mock(new Response(
            204,
            null
        ));

        $actual = $this->twilio->conversations->v1->conversations("CHXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                                  ->webhooks("WHXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->delete();

        $this->assertTrue($actual);
    }
}