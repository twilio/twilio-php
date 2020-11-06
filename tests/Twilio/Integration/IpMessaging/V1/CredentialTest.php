<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Tests\Integration\IpMessaging\V1;

use Twilio\Exceptions\DeserializeException;
use Twilio\Exceptions\TwilioException;
use Twilio\Http\Response;
use Twilio\Tests\HolodeckTestCase;
use Twilio\Tests\Request;

class CredentialTest extends HolodeckTestCase {
    public function testReadRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->ipMessaging->v1->credentials->read();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'get',
            'https://ip-messaging.twilio.com/v1/Credentials'
        ));
    }

    public function testReadFullResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "credentials": [
                    {
                        "sid": "CRaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "friendly_name": "Test slow create",
                        "type": "apn",
                        "sandbox": "False",
                        "date_created": "2015-10-07T17:50:01Z",
                        "date_updated": "2015-10-07T17:50:01Z",
                        "url": "https://ip-messaging.twilio.com/v1/Credentials/CRaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
                    }
                ],
                "meta": {
                    "page": 0,
                    "page_size": 1,
                    "first_page_url": "https://ip-messaging.twilio.com/v1/Credentials?PageSize=1&Page=0",
                    "previous_page_url": null,
                    "url": "https://ip-messaging.twilio.com/v1/Credentials?PageSize=1&Page=0",
                    "next_page_url": null,
                    "key": "credentials"
                }
            }
            '
        ));

        $actual = $this->twilio->ipMessaging->v1->credentials->read();

        $this->assertGreaterThan(0, \count($actual));
    }

    public function testReadEmptyResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "credentials": [],
                "meta": {
                    "page": 0,
                    "page_size": 1,
                    "first_page_url": "https://ip-messaging.twilio.com/v1/Credentials?PageSize=1&Page=0",
                    "previous_page_url": null,
                    "url": "https://ip-messaging.twilio.com/v1/Credentials?PageSize=1&Page=0",
                    "next_page_url": null,
                    "key": "credentials"
                }
            }
            '
        ));

        $actual = $this->twilio->ipMessaging->v1->credentials->read();

        $this->assertNotNull($actual);
    }

    public function testCreateRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->ipMessaging->v1->credentials->create("gcm");
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $values = ['Type' => "gcm", ];

        $this->assertRequest(new Request(
            'post',
            'https://ip-messaging.twilio.com/v1/Credentials',
            null,
            $values
        ));
    }

    public function testCreateResponse(): void {
        $this->holodeck->mock(new Response(
            201,
            '
            {
                "sid": "CRaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "friendly_name": "Test slow create",
                "type": "apn",
                "sandbox": "False",
                "date_created": "2015-10-07T17:50:01Z",
                "date_updated": "2015-10-07T17:50:01Z",
                "url": "https://ip-messaging.twilio.com/v1/Credentials/CRaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
            }
            '
        ));

        $actual = $this->twilio->ipMessaging->v1->credentials->create("gcm");

        $this->assertNotNull($actual);
    }

    public function testFetchRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->ipMessaging->v1->credentials("CRXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->fetch();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'get',
            'https://ip-messaging.twilio.com/v1/Credentials/CRXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'
        ));
    }

    public function testFetchResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "sid": "CRaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "friendly_name": "Test slow create",
                "type": "apn",
                "sandbox": "False",
                "date_created": "2015-10-07T17:50:01Z",
                "date_updated": "2015-10-07T17:50:01Z",
                "url": "https://ip-messaging.twilio.com/v1/Credentials/CRaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
            }
            '
        ));

        $actual = $this->twilio->ipMessaging->v1->credentials("CRXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->fetch();

        $this->assertNotNull($actual);
    }

    public function testUpdateRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->ipMessaging->v1->credentials("CRXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->update();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'post',
            'https://ip-messaging.twilio.com/v1/Credentials/CRXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'
        ));
    }

    public function testUpdateResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "sid": "CRaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "friendly_name": "Test slow create",
                "type": "apn",
                "sandbox": "False",
                "date_created": "2015-10-07T17:50:01Z",
                "date_updated": "2015-10-07T17:50:01Z",
                "url": "https://ip-messaging.twilio.com/v1/Credentials/CRaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
            }
            '
        ));

        $actual = $this->twilio->ipMessaging->v1->credentials("CRXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->update();

        $this->assertNotNull($actual);
    }

    public function testDeleteRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->ipMessaging->v1->credentials("CRXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->delete();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'delete',
            'https://ip-messaging.twilio.com/v1/Credentials/CRXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'
        ));
    }

    public function testDeleteResponse(): void {
        $this->holodeck->mock(new Response(
            204,
            null
        ));

        $actual = $this->twilio->ipMessaging->v1->credentials("CRXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->delete();

        $this->assertTrue($actual);
    }
}