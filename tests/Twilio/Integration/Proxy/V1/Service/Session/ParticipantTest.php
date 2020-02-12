<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Tests\Integration\Proxy\V1\Service\Session;

use Twilio\Exceptions\DeserializeException;
use Twilio\Exceptions\TwilioException;
use Twilio\Http\Response;
use Twilio\Tests\HolodeckTestCase;
use Twilio\Tests\Request;

class ParticipantTest extends HolodeckTestCase {
    public function testFetchRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->proxy->v1->services("KSXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                    ->sessions("KCXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                    ->participants("KPXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->fetch();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'get',
            'https://proxy.twilio.com/v1/Services/KSXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Sessions/KCXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Participants/KPXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'
        ));
    }

    public function testFetchResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "sid": "KPaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "session_sid": "KCaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "service_sid": "KSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "identifier": "+14155551212",
                "proxy_identifier": "+14155559999",
                "proxy_identifier_sid": "PNaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "friendly_name": "friendly_name",
                "date_deleted": "2015-07-30T20:00:00Z",
                "date_updated": "2015-07-30T20:00:00Z",
                "date_created": "2015-07-30T20:00:00Z",
                "url": "https://proxy.twilio.com/v1/Services/KSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Sessions/KCaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Participants/KPaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "links": {
                    "message_interactions": "https://proxy.twilio.com/v1/Services/KSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Sessions/KCaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Participants/KPaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/MessageInteractions"
                }
            }
            '
        ));

        $actual = $this->twilio->proxy->v1->services("KSXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                          ->sessions("KCXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                          ->participants("KPXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->fetch();

        $this->assertNotNull($actual);
    }

    public function testFetchChannelResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "sid": "KPaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "session_sid": "KCaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "service_sid": "KSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "identifier": "messenger:14155551212",
                "proxy_identifier": "messenger:14155559999",
                "proxy_identifier_sid": "XEaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "friendly_name": "a facebook user",
                "date_deleted": "2015-07-30T20:00:00Z",
                "date_updated": "2015-07-30T20:00:00Z",
                "date_created": "2015-07-30T20:00:00Z",
                "url": "https://proxy.twilio.com/v1/Services/KSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Sessions/KCaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Participants/KPaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "links": {
                    "message_interactions": "https://proxy.twilio.com/v1/Services/KSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Sessions/KCaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Participants/KPaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/MessageInteractions"
                }
            }
            '
        ));

        $actual = $this->twilio->proxy->v1->services("KSXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                          ->sessions("KCXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                          ->participants("KPXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->fetch();

        $this->assertNotNull($actual);
    }

    public function testReadRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->proxy->v1->services("KSXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                    ->sessions("KCXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                    ->participants->read();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'get',
            'https://proxy.twilio.com/v1/Services/KSXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Sessions/KCXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Participants'
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
                    "url": "https://proxy.twilio.com/v1/Services/KSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Sessions/KCaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Participants?PageSize=50&Page=0",
                    "page": 0,
                    "first_page_url": "https://proxy.twilio.com/v1/Services/KSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Sessions/KCaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Participants?PageSize=50&Page=0",
                    "page_size": 50,
                    "key": "participants"
                },
                "participants": []
            }
            '
        ));

        $actual = $this->twilio->proxy->v1->services("KSXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                          ->sessions("KCXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                          ->participants->read();

        $this->assertNotNull($actual);
    }

    public function testCreateRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->proxy->v1->services("KSXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                    ->sessions("KCXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                    ->participants->create("identifier");
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $values = ['Identifier' => "identifier", ];

        $this->assertRequest(new Request(
            'post',
            'https://proxy.twilio.com/v1/Services/KSXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Sessions/KCXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Participants',
            null,
            $values
        ));
    }

    public function testCreateResponse(): void {
        $this->holodeck->mock(new Response(
            201,
            '
            {
                "sid": "KPaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "session_sid": "KCaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "service_sid": "KSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "identifier": "+14155551212",
                "proxy_identifier": "+14155559999",
                "proxy_identifier_sid": "PNaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "friendly_name": "friendly_name",
                "date_deleted": "2015-07-30T20:00:00Z",
                "date_updated": "2015-07-30T20:00:00Z",
                "date_created": "2015-07-30T20:00:00Z",
                "url": "https://proxy.twilio.com/v1/Services/KSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Sessions/KCaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Participants/KPaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "links": {
                    "message_interactions": "https://proxy.twilio.com/v1/Services/KSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Sessions/KCaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Participants/KPaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/MessageInteractions"
                }
            }
            '
        ));

        $actual = $this->twilio->proxy->v1->services("KSXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                          ->sessions("KCXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                          ->participants->create("identifier");

        $this->assertNotNull($actual);
    }

    public function testCreateChannelResponse(): void {
        $this->holodeck->mock(new Response(
            201,
            '
            {
                "sid": "KPaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "session_sid": "KCaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "service_sid": "KSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "identifier": "messenger:123456",
                "proxy_identifier": "messenger:987654532",
                "proxy_identifier_sid": "XEaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "friendly_name": "a facebook user",
                "date_deleted": "2015-07-30T20:00:00Z",
                "date_updated": "2015-07-30T20:00:00Z",
                "date_created": "2015-07-30T20:00:00Z",
                "url": "https://proxy.twilio.com/v1/Services/KSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Sessions/KCaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Participants/KPaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "links": {
                    "message_interactions": "https://proxy.twilio.com/v1/Services/KSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Sessions/KCaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Participants/KPaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/MessageInteractions"
                }
            }
            '
        ));

        $actual = $this->twilio->proxy->v1->services("KSXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                          ->sessions("KCXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                          ->participants->create("identifier");

        $this->assertNotNull($actual);
    }

    public function testDeleteRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->proxy->v1->services("KSXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                    ->sessions("KCXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                    ->participants("KPXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->delete();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'delete',
            'https://proxy.twilio.com/v1/Services/KSXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Sessions/KCXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Participants/KPXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'
        ));
    }

    public function testDeleteResponse(): void {
        $this->holodeck->mock(new Response(
            204,
            null
        ));

        $actual = $this->twilio->proxy->v1->services("KSXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                          ->sessions("KCXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                          ->participants("KPXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->delete();

        $this->assertTrue($actual);
    }
}