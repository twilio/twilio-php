<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Tests\Integration\Conversations\V1\Service\Conversation;

use Twilio\Exceptions\DeserializeException;
use Twilio\Exceptions\TwilioException;
use Twilio\Http\Response;
use Twilio\Tests\HolodeckTestCase;
use Twilio\Tests\Request;

class MessageTest extends HolodeckTestCase {
    public function testCreateRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        $options = ['xTwilioWebhookEnabled' => "true", ];

        try {
            $this->twilio->conversations->v1->services("ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                            ->conversations("CHXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                            ->messages->create($options);
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $headers = ['X-Twilio-Webhook-Enabled' => "true", ];

        $this->assertRequest(new Request(
            'post',
            'https://conversations.twilio.com/v1/Services/ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Conversations/CHXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Messages',
            [],
            [],
            $headers
        ));
    }

    public function testCreateResponse(): void {
        $this->holodeck->mock(new Response(
            201,
            '
            {
                "sid": "IMaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "chat_service_sid": "ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "conversation_sid": "CHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "body": "Hello",
                "media": null,
                "author": "message author",
                "participant_sid": "MBaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "attributes": "{ \\"importance\\": \\"high\\" }",
                "date_created": "2015-12-16T22:18:37Z",
                "date_updated": "2015-12-16T22:18:38Z",
                "index": 0,
                "delivery": {
                    "total": 2,
                    "sent": "all",
                    "delivered": "some",
                    "read": "some",
                    "failed": "none",
                    "undelivered": "none"
                },
                "url": "https://conversations.twilio.com/v1/Services/ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Conversations/CHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Messages/IMaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "links": {
                    "delivery_receipts": "https://conversations.twilio.com/v1/Services/ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Conversations/CHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Messages/IMaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Receipts"
                }
            }
            '
        ));

        $actual = $this->twilio->conversations->v1->services("ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                                  ->conversations("CHXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                                  ->messages->create();

        $this->assertNotNull($actual);
    }

    public function testCreateWithMediaResponse(): void {
        $this->holodeck->mock(new Response(
            201,
            '
            {
                "sid": "IMaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "chat_service_sid": "ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "conversation_sid": "CHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "body": null,
                "media": [
                    {
                        "sid": "MEaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "size": 42056,
                        "content_type": "image/jpeg",
                        "filename": "car.jpg"
                    }
                ],
                "author": "message author",
                "participant_sid": "MBaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "attributes": "{ \\"importance\\": \\"high\\" }",
                "date_created": "2015-12-16T22:18:37Z",
                "date_updated": "2015-12-16T22:18:38Z",
                "index": 0,
                "delivery": {
                    "total": 2,
                    "sent": "all",
                    "delivered": "some",
                    "read": "some",
                    "failed": "none",
                    "undelivered": "none"
                },
                "url": "https://conversations.twilio.com/v1/Services/ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Conversations/CHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Messages/IMaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "links": {
                    "delivery_receipts": "https://conversations.twilio.com/v1/Services/ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Conversations/CHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Messages/IMaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Receipts"
                }
            }
            '
        ));

        $actual = $this->twilio->conversations->v1->services("ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                                  ->conversations("CHXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                                  ->messages->create();

        $this->assertNotNull($actual);
    }

    public function testCreateNoAttributesResponse(): void {
        $this->holodeck->mock(new Response(
            201,
            '
            {
                "sid": "IMaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "chat_service_sid": "ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "conversation_sid": "CHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "body": "Hello",
                "media": null,
                "author": "message author",
                "participant_sid": "MBaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "attributes": "{}",
                "date_created": "2020-07-01T22:18:37Z",
                "date_updated": "2020-07-01T22:18:37Z",
                "index": 0,
                "delivery": {
                    "total": 2,
                    "sent": "all",
                    "delivered": "some",
                    "read": "some",
                    "failed": "none",
                    "undelivered": "none"
                },
                "url": "https://conversations.twilio.com/v1/Services/ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Conversations/CHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Messages/IMaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "links": {
                    "delivery_receipts": "https://conversations.twilio.com/v1/Services/ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Conversations/CHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Messages/IMaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Receipts"
                }
            }
            '
        ));

        $actual = $this->twilio->conversations->v1->services("ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                                  ->conversations("CHXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                                  ->messages->create();

        $this->assertNotNull($actual);
    }

    public function testUpdateRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        $options = ['xTwilioWebhookEnabled' => "true", ];

        try {
            $this->twilio->conversations->v1->services("ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                            ->conversations("CHXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                            ->messages("IMXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->update($options);
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $headers = ['X-Twilio-Webhook-Enabled' => "true", ];

        $this->assertRequest(new Request(
            'post',
            'https://conversations.twilio.com/v1/Services/ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Conversations/CHXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Messages/IMXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX',
            [],
            [],
            $headers
        ));
    }

    public function testUpdateResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "sid": "IMaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "chat_service_sid": "ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "conversation_sid": "CHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "body": "Hello",
                "media": null,
                "author": "message author",
                "participant_sid": "MBaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "attributes": "{ \\"importance\\": \\"high\\" }",
                "date_created": "2015-12-16T22:18:37Z",
                "date_updated": "2015-12-16T22:18:38Z",
                "index": 0,
                "delivery": {
                    "total": 2,
                    "sent": "all",
                    "delivered": "some",
                    "read": "some",
                    "failed": "none",
                    "undelivered": "none"
                },
                "url": "https://conversations.twilio.com/v1/Services/ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Conversations/CHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Messages/IMaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "links": {
                    "delivery_receipts": "https://conversations.twilio.com/v1/Services/ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Conversations/CHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Messages/IMaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Receipts"
                }
            }
            '
        ));

        $actual = $this->twilio->conversations->v1->services("ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                                  ->conversations("CHXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                                  ->messages("IMXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->update();

        $this->assertNotNull($actual);
    }

    public function testDeleteRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        $options = ['xTwilioWebhookEnabled' => "true", ];

        try {
            $this->twilio->conversations->v1->services("ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                            ->conversations("CHXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                            ->messages("IMXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->delete($options);
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $headers = ['X-Twilio-Webhook-Enabled' => "true", ];

        $this->assertRequest(new Request(
            'delete',
            'https://conversations.twilio.com/v1/Services/ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Conversations/CHXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Messages/IMXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX',
            [],
            [],
            $headers
        ));
    }

    public function testDeleteResponse(): void {
        $this->holodeck->mock(new Response(
            204,
            null
        ));

        $actual = $this->twilio->conversations->v1->services("ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                                  ->conversations("CHXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                                  ->messages("IMXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->delete();

        $this->assertTrue($actual);
    }

    public function testFetchRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->conversations->v1->services("ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                            ->conversations("CHXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                            ->messages("IMXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->fetch();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'get',
            'https://conversations.twilio.com/v1/Services/ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Conversations/CHXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Messages/IMXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'
        ));
    }

    public function testFetchResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "sid": "IMaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "chat_service_sid": "ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "conversation_sid": "CHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "body": "Welcome!",
                "media": null,
                "author": "system",
                "participant_sid": null,
                "attributes": "{ \\"importance\\": \\"high\\" }",
                "date_created": "2016-03-24T20:37:57Z",
                "date_updated": "2016-03-24T20:37:57Z",
                "index": 0,
                "delivery": {
                    "total": 2,
                    "sent": "all",
                    "delivered": "some",
                    "read": "some",
                    "failed": "none",
                    "undelivered": "none"
                },
                "url": "https://conversations.twilio.com/v1/Services/ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Conversations/CHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Messages/IMaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "links": {
                    "delivery_receipts": "https://conversations.twilio.com/v1/Services/ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Conversations/CHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Messages/IMaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Receipts"
                }
            }
            '
        ));

        $actual = $this->twilio->conversations->v1->services("ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                                  ->conversations("CHXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                                  ->messages("IMXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->fetch();

        $this->assertNotNull($actual);
    }

    public function testReadRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->conversations->v1->services("ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                            ->conversations("CHXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                            ->messages->read();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'get',
            'https://conversations.twilio.com/v1/Services/ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Conversations/CHXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Messages'
        ));
    }

    public function testReadFullResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "meta": {
                    "page": 0,
                    "page_size": 50,
                    "first_page_url": "https://conversations.twilio.com/v1/Services/ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Conversations/CHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Messages?PageSize=50&Page=0",
                    "previous_page_url": null,
                    "url": "https://conversations.twilio.com/v1/Services/ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Conversations/CHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Messages?PageSize=50&Page=0",
                    "next_page_url": null,
                    "key": "messages"
                },
                "messages": [
                    {
                        "sid": "IMaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "chat_service_sid": "ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "conversation_sid": "CHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "body": "I like pie.",
                        "media": null,
                        "author": "pie_preferrer",
                        "participant_sid": "MBaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "attributes": "{ \\"importance\\": \\"high\\" }",
                        "date_created": "2016-03-24T20:37:57Z",
                        "date_updated": "2016-03-24T20:37:57Z",
                        "index": 0,
                        "delivery": {
                            "total": 2,
                            "sent": "all",
                            "delivered": "some",
                            "read": "some",
                            "failed": "none",
                            "undelivered": "none"
                        },
                        "url": "https://conversations.twilio.com/v1/Services/ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Conversations/CHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Messages/IMaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "links": {
                            "delivery_receipts": "https://conversations.twilio.com/v1/Services/ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Conversations/CHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Messages/IMaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Receipts"
                        }
                    },
                    {
                        "sid": "IMaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "chat_service_sid": "ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "conversation_sid": "CHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "body": "Cake is my favorite!",
                        "media": null,
                        "author": "cake_lover",
                        "participant_sid": "MBaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "attributes": "{ \\"importance\\": \\"high\\" }",
                        "date_created": "2016-03-24T20:38:21Z",
                        "date_updated": "2016-03-24T20:38:21Z",
                        "index": 0,
                        "delivery": {
                            "total": 2,
                            "sent": "all",
                            "delivered": "some",
                            "read": "some",
                            "failed": "none",
                            "undelivered": "none"
                        },
                        "url": "https://conversations.twilio.com/v1/Services/ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Conversations/CHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Messages/IMaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "links": {
                            "delivery_receipts": "https://conversations.twilio.com/v1/Services/ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Conversations/CHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Messages/IMaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Receipts"
                        }
                    },
                    {
                        "sid": "IMaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "chat_service_sid": "ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "conversation_sid": "CHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "body": null,
                        "media": [
                            {
                                "sid": "MEaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                                "size": 42056,
                                "content_type": "image/jpeg",
                                "filename": "car.jpg"
                            }
                        ],
                        "author": "cake_lover",
                        "participant_sid": "MBaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "attributes": "{ \\"importance\\": \\"high\\" }",
                        "date_created": "2016-03-24T20:38:21Z",
                        "date_updated": "2016-03-24T20:38:21Z",
                        "index": 0,
                        "delivery": {
                            "total": 2,
                            "sent": "all",
                            "delivered": "some",
                            "read": "some",
                            "failed": "none",
                            "undelivered": "none"
                        },
                        "url": "https://conversations.twilio.com/v1/Services/ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Conversations/CHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Messages/IMaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "links": {
                            "delivery_receipts": "https://conversations.twilio.com/v1/Services/ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Conversations/CHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Messages/IMaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Receipts"
                        }
                    }
                ]
            }
            '
        ));

        $actual = $this->twilio->conversations->v1->services("ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                                  ->conversations("CHXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                                  ->messages->read();

        $this->assertGreaterThan(0, \count($actual));
    }

    public function testReadLastMessageResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "meta": {
                    "page": 0,
                    "page_size": 1,
                    "first_page_url": "https://conversations.twilio.com/v1/Services/ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Conversations/CHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Messages?Order=desc&PageSize=1&Page=0",
                    "previous_page_url": null,
                    "url": "https://conversations.twilio.com/v1/Services/ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Conversations/CHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Messages?Order=desc&PageSize=1&Page=0",
                    "next_page_url": null,
                    "key": "messages"
                },
                "messages": [
                    {
                        "sid": "IMaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "chat_service_sid": "ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "conversation_sid": "CHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "body": null,
                        "media": [
                            {
                                "sid": "MEaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                                "size": 42056,
                                "content_type": "image/jpeg",
                                "filename": "car.jpg"
                            }
                        ],
                        "author": "cake_lover",
                        "participant_sid": "MBaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "attributes": "{ \\"importance\\": \\"high\\" }",
                        "date_created": "2016-03-24T20:38:21Z",
                        "date_updated": "2016-03-24T20:38:21Z",
                        "index": 9,
                        "delivery": {
                            "total": 2,
                            "sent": "all",
                            "delivered": "some",
                            "read": "some",
                            "failed": "none",
                            "undelivered": "none"
                        },
                        "url": "https://conversations.twilio.com/v1/Services/ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Conversations/CHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Messages/IMaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "links": {
                            "delivery_receipts": "https://conversations.twilio.com/v1/Services/ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Conversations/CHaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Messages/IMaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Receipts"
                        }
                    }
                ]
            }
            '
        ));

        $actual = $this->twilio->conversations->v1->services("ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                                  ->conversations("CHXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                                  ->messages->read();

        $this->assertNotNull($actual);
    }
}