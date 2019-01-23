<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Tests\Integration\Verify\V1;

use Twilio\Exceptions\DeserializeException;
use Twilio\Exceptions\TwilioException;
use Twilio\Http\Response;
use Twilio\Tests\HolodeckTestCase;
use Twilio\Tests\Request;

class ServiceTest extends HolodeckTestCase {
    public function testCreateRequest() {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->verify->v1->services->create("friendlyName");
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $values = array('FriendlyName' => "friendlyName", );

        $this->assertRequest(new Request(
            'post',
            'https://verify.twilio.com/v1/Services',
            null,
            $values
        ));
    }

    public function testCreateRecordResponse() {
        $this->holodeck->mock(new Response(
            201,
            '
            {
                "sid": "VAaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "friendly_name": "name",
                "code_length": 4,
                "lookup_enabled": false,
                "skip_sms_to_landlines": false,
                "dtmf_input_required": false,
                "tts_name": "name",
                "date_created": "2015-07-30T20:00:00Z",
                "date_updated": "2015-07-30T20:00:00Z",
                "url": "https://verify.twilio.com/v1/Services/VAaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "links": {
                    "verification_checks": "https://verify.twilio.com/v1/Services/VAaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/VerificationCheck",
                    "verifications": "https://verify.twilio.com/v1/Services/VAaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Verifications"
                }
            }
            '
        ));

        $actual = $this->twilio->verify->v1->services->create("friendlyName");

        $this->assertNotNull($actual);
    }

    public function testFetchRequest() {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->verify->v1->services("VAXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->fetch();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'get',
            'https://verify.twilio.com/v1/Services/VAXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'
        ));
    }

    public function testFetchRecordResponse() {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "sid": "VAaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "friendly_name": "name",
                "code_length": 4,
                "lookup_enabled": false,
                "skip_sms_to_landlines": false,
                "dtmf_input_required": false,
                "tts_name": "name",
                "date_created": "2015-07-30T20:00:00Z",
                "date_updated": "2015-07-30T20:00:00Z",
                "url": "https://verify.twilio.com/v1/Services/VAaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "links": {
                    "verification_checks": "https://verify.twilio.com/v1/Services/VAaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/VerificationCheck",
                    "verifications": "https://verify.twilio.com/v1/Services/VAaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Verifications"
                }
            }
            '
        ));

        $actual = $this->twilio->verify->v1->services("VAXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->fetch();

        $this->assertNotNull($actual);
    }

    public function testDeleteRequest() {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->verify->v1->services("VAXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->delete();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'delete',
            'https://verify.twilio.com/v1/Services/VAXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'
        ));
    }

    public function testDeleteResponse() {
        $this->holodeck->mock(new Response(
            204,
            null
        ));

        $actual = $this->twilio->verify->v1->services("VAXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->delete();

        $this->assertTrue($actual);
    }

    public function testReadRequest() {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->verify->v1->services->read();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'get',
            'https://verify.twilio.com/v1/Services'
        ));
    }

    public function testReadAllResponse() {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "meta": {
                    "page": 0,
                    "page_size": 50,
                    "first_page_url": "https://verify.twilio.com/v1/Services?PageSize=50&Page=0",
                    "previous_page_url": null,
                    "next_page_url": null,
                    "key": "services",
                    "url": "https://verify.twilio.com/v1/Services?PageSize=50&Page=0"
                },
                "services": [
                    {
                        "sid": "VAaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "friendly_name": "name",
                        "code_length": 4,
                        "lookup_enabled": false,
                        "skip_sms_to_landlines": false,
                        "dtmf_input_required": false,
                        "tts_name": "name",
                        "date_created": "2015-07-30T20:00:00Z",
                        "date_updated": "2015-07-30T20:00:00Z",
                        "url": "https://verify.twilio.com/v1/Services/VAaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "links": {
                            "verification_checks": "https://verify.twilio.com/v1/Services/VAaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/VerificationCheck",
                            "verifications": "https://verify.twilio.com/v1/Services/VAaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Verifications"
                        }
                    }
                ]
            }
            '
        ));

        $actual = $this->twilio->verify->v1->services->read();

        $this->assertNotNull($actual);
    }

    public function testUpdateRequest() {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->verify->v1->services("VAXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->update();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'post',
            'https://verify.twilio.com/v1/Services/VAXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'
        ));
    }

    public function testUpdateRecordResponse() {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "sid": "VAaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "friendly_name": "name",
                "code_length": 4,
                "lookup_enabled": false,
                "skip_sms_to_landlines": false,
                "dtmf_input_required": false,
                "tts_name": "name",
                "date_created": "2015-07-30T20:00:00Z",
                "date_updated": "2015-07-30T20:00:00Z",
                "url": "https://verify.twilio.com/v1/Services/VAaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "links": {
                    "verification_checks": "https://verify.twilio.com/v1/Services/VAaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/VerificationCheck",
                    "verifications": "https://verify.twilio.com/v1/Services/VAaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Verifications"
                }
            }
            '
        ));

        $actual = $this->twilio->verify->v1->services("VAXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->update();

        $this->assertNotNull($actual);
    }
}