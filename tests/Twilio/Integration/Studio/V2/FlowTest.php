<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Tests\Integration\Studio\V2;

use Twilio\Exceptions\DeserializeException;
use Twilio\Exceptions\TwilioException;
use Twilio\Http\Response;
use Twilio\Serialize;
use Twilio\Tests\HolodeckTestCase;
use Twilio\Tests\Request;

class FlowTest extends HolodeckTestCase {
    public function testCreateRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->studio->v2->flows->create("friendly_name", "draft", []);
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $values = [
            'FriendlyName' => "friendly_name",
            'Status' => "draft",
            'Definition' => Serialize::jsonObject([]),
        ];

        $this->assertRequest(new Request(
            'post',
            'https://studio.twilio.com/v2/Flows',
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
                "sid": "FWaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "definition": {
                    "initial_state": "Trigger"
                },
                "friendly_name": "Test Flow",
                "status": "published",
                "revision": 1,
                "commit_message": null,
                "valid": true,
                "errors": [],
                "webhook_url": "http://webhooks.twilio.com/v1/Accounts/ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Flows/FWaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "date_created": "2017-11-06T12:00:00Z",
                "date_updated": null,
                "url": "https://studio.twilio.com/v2/Flows/FWaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "links": {
                    "test_users": "https://studio.twilio.com/v2/Flows/FWaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/TestUsers",
                    "revisions": "https://studio.twilio.com/v2/Flows/FWaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Revisions",
                    "executions": "https://studio.twilio.com/v2/Flows/FWaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Executions"
                }
            }
            '
        ));

        $actual = $this->twilio->studio->v2->flows->create("friendly_name", "draft", []);

        $this->assertNotNull($actual);
    }

    public function testUpdateRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->studio->v2->flows("FWXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->update("draft");
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $values = ['Status' => "draft", ];

        $this->assertRequest(new Request(
            'post',
            'https://studio.twilio.com/v2/Flows/FWXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX',
            [],
            $values,
            []
        ));
    }

    public function testUpdateResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "sid": "FWaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "definition": {
                    "initial_state": "Trigger"
                },
                "friendly_name": "Test Flow",
                "status": "published",
                "revision": 1,
                "commit_message": null,
                "valid": true,
                "errors": [],
                "webhook_url": "http://webhooks.twilio.com/v1/Accounts/ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Flows/FWaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "date_created": "2017-11-06T12:00:00Z",
                "date_updated": "2017-11-06T12:00:00Z",
                "url": "https://studio.twilio.com/v2/Flows/FWaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "links": {
                    "test_users": "https://studio.twilio.com/v2/Flows/FWaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/TestUsers",
                    "revisions": "https://studio.twilio.com/v2/Flows/FWaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Revisions",
                    "executions": "https://studio.twilio.com/v2/Flows/FWaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Executions"
                }
            }
            '
        ));

        $actual = $this->twilio->studio->v2->flows("FWXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->update("draft");

        $this->assertNotNull($actual);
    }

    public function testReadRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->studio->v2->flows->read();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'get',
            'https://studio.twilio.com/v2/Flows',
            [],
            [],
            []
        ));
    }

    public function testReadEmptyResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "meta": {
                    "previous_page_url": null,
                    "next_page_url": null,
                    "url": "https://studio.twilio.com/v2/Flows?PageSize=50&Page=0",
                    "page": 0,
                    "first_page_url": "https://studio.twilio.com/v2/Flows?PageSize=50&Page=0",
                    "page_size": 50,
                    "key": "flows"
                },
                "flows": [
                    {
                        "sid": "FWaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "friendly_name": "Test Flow",
                        "status": "published",
                        "revision": 1,
                        "definition": null,
                        "commit_message": null,
                        "valid": null,
                        "errors": null,
                        "webhook_url": "http://webhooks.twilio.com/v1/Accounts/ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Flows/FWaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "date_created": "2017-11-06T12:00:00Z",
                        "date_updated": "2017-11-06T12:00:00Z",
                        "url": "https://studio.twilio.com/v2/Flows/FWaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "links": {
                            "test_users": "https://studio.twilio.com/v2/Flows/FWaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/TestUsers",
                            "revisions": "https://studio.twilio.com/v2/Flows/FWaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Revisions",
                            "executions": "https://studio.twilio.com/v2/Flows/FWaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Executions"
                        }
                    }
                ]
            }
            '
        ));

        $actual = $this->twilio->studio->v2->flows->read();

        $this->assertNotNull($actual);
    }

    public function testFetchRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->studio->v2->flows("FWXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->fetch();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'get',
            'https://studio.twilio.com/v2/Flows/FWXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX',
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
                "sid": "FWaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "friendly_name": "Test Flow",
                "definition": {
                    "initial_state": "Trigger"
                },
                "status": "published",
                "revision": 1,
                "commit_message": "commit",
                "valid": true,
                "errors": [],
                "webhook_url": "http://webhooks.twilio.com/v1/Accounts/ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Flows/FWaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "date_created": "2017-11-06T12:00:00Z",
                "date_updated": null,
                "url": "https://studio.twilio.com/v2/Flows/FWaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "links": {
                    "test_users": "https://studio.twilio.com/v2/Flows/FWaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/TestUsers",
                    "revisions": "https://studio.twilio.com/v2/Flows/FWaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Revisions",
                    "executions": "https://studio.twilio.com/v2/Flows/FWaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Executions"
                }
            }
            '
        ));

        $actual = $this->twilio->studio->v2->flows("FWXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->fetch();

        $this->assertNotNull($actual);
    }

    public function testDeleteRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->studio->v2->flows("FWXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->delete();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'delete',
            'https://studio.twilio.com/v2/Flows/FWXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX',
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

        $actual = $this->twilio->studio->v2->flows("FWXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->delete();

        $this->assertTrue($actual);
    }
}