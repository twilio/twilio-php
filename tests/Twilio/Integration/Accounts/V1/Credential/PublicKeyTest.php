<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Tests\Integration\Accounts\V1\Credential;

use Twilio\Exceptions\DeserializeException;
use Twilio\Exceptions\TwilioException;
use Twilio\Http\Response;
use Twilio\Tests\HolodeckTestCase;
use Twilio\Tests\Request;

class PublicKeyTest extends HolodeckTestCase {
    public function testReadRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->accounts->v1->credentials
                                       ->publicKey->read();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'get',
            'https://accounts.twilio.com/v1/Credentials/PublicKeys'
        ));
    }

    public function testReadEmptyResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "credentials": [],
                "meta": {
                    "first_page_url": "https://accounts.twilio.com/v1/Credentials/PublicKeys?PageSize=50&Page=0",
                    "key": "credentials",
                    "next_page_url": null,
                    "page": 0,
                    "page_size": 50,
                    "previous_page_url": null,
                    "url": "https://accounts.twilio.com/v1/Credentials/PublicKeys?PageSize=50&Page=0"
                }
            }
            '
        ));

        $actual = $this->twilio->accounts->v1->credentials
                                             ->publicKey->read();

        $this->assertNotNull($actual);
    }

    public function testReadFullResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "credentials": [
                    {
                        "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "date_created": "2015-07-31T04:00:00Z",
                        "date_updated": "2015-07-31T04:00:00Z",
                        "friendly_name": "friendly_name",
                        "sid": "CRaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "url": "https://accounts.twilio.com/v1/Credentials/PublicKeys/CRaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
                    }
                ],
                "meta": {
                    "first_page_url": "https://accounts.twilio.com/v1/Credentials/PublicKeys?PageSize=50&Page=0",
                    "key": "credentials",
                    "next_page_url": null,
                    "page": 0,
                    "page_size": 50,
                    "previous_page_url": null,
                    "url": "https://accounts.twilio.com/v1/Credentials/PublicKeys?PageSize=50&Page=0"
                }
            }
            '
        ));

        $actual = $this->twilio->accounts->v1->credentials
                                             ->publicKey->read();

        $this->assertGreaterThan(0, \count($actual));
    }

    public function testCreateRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->accounts->v1->credentials
                                       ->publicKey->create("publickey");
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $values = ['PublicKey' => "publickey", ];

        $this->assertRequest(new Request(
            'post',
            'https://accounts.twilio.com/v1/Credentials/PublicKeys',
            [],
            $values
        ));
    }

    public function testCreateResponse(): void {
        $this->holodeck->mock(new Response(
            201,
            '
            {
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "date_created": "2015-07-31T04:00:00Z",
                "date_updated": "2015-07-31T04:00:00Z",
                "friendly_name": "friendly_name",
                "sid": "CRaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "url": "https://accounts.twilio.com/v1/Credentials/PublicKeys/CRaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
            }
            '
        ));

        $actual = $this->twilio->accounts->v1->credentials
                                             ->publicKey->create("publickey");

        $this->assertNotNull($actual);
    }

    public function testFetchRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->accounts->v1->credentials
                                       ->publicKey("CRXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->fetch();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'get',
            'https://accounts.twilio.com/v1/Credentials/PublicKeys/CRXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'
        ));
    }

    public function testFetchResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "date_created": "2015-07-31T04:00:00Z",
                "date_updated": "2015-07-31T04:00:00Z",
                "friendly_name": "friendly_name",
                "sid": "CRaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "url": "https://accounts.twilio.com/v1/Credentials/PublicKeys/CRaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
            }
            '
        ));

        $actual = $this->twilio->accounts->v1->credentials
                                             ->publicKey("CRXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->fetch();

        $this->assertNotNull($actual);
    }

    public function testUpdateRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->accounts->v1->credentials
                                       ->publicKey("CRXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->update();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'post',
            'https://accounts.twilio.com/v1/Credentials/PublicKeys/CRXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'
        ));
    }

    public function testUpdateResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "date_created": "2015-07-31T04:00:00Z",
                "date_updated": "2015-07-31T04:00:00Z",
                "friendly_name": "friendly_name",
                "sid": "CRaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "url": "https://accounts.twilio.com/v1/Credentials/PublicKeys/CRaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
            }
            '
        ));

        $actual = $this->twilio->accounts->v1->credentials
                                             ->publicKey("CRXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->update();

        $this->assertNotNull($actual);
    }

    public function testDeleteRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->accounts->v1->credentials
                                       ->publicKey("CRXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->delete();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'delete',
            'https://accounts.twilio.com/v1/Credentials/PublicKeys/CRXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'
        ));
    }

    public function testDeleteResponse(): void {
        $this->holodeck->mock(new Response(
            204,
            null
        ));

        $actual = $this->twilio->accounts->v1->credentials
                                             ->publicKey("CRXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->delete();

        $this->assertTrue($actual);
    }
}