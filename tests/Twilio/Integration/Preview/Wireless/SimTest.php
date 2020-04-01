<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Tests\Integration\Preview\Wireless;

use Twilio\Exceptions\DeserializeException;
use Twilio\Exceptions\TwilioException;
use Twilio\Http\Response;
use Twilio\Tests\HolodeckTestCase;
use Twilio\Tests\Request;

class SimTest extends HolodeckTestCase {
    public function testFetchRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->preview->wireless->sims("DEXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->fetch();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'get',
            'https://preview.twilio.com/wireless/Sims/DEXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX',
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
                "unique_name": "unique_name",
                "commands_callback_method": "http_method",
                "commands_callback_url": "http://www.example.com",
                "date_created": "2015-07-30T20:00:00Z",
                "date_updated": "2015-07-30T20:00:00Z",
                "friendly_name": "friendly_name",
                "sms_fallback_method": "http_method",
                "sms_fallback_url": "http://www.example.com",
                "sms_method": "http_method",
                "sms_url": "http://www.example.com",
                "voice_fallback_method": "http_method",
                "voice_fallback_url": "http://www.example.com",
                "voice_method": "http_method",
                "voice_url": "http://www.example.com",
                "links": {
                    "usage": "https://preview.twilio.com/wireless/Sims/DEaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Usage",
                    "rate_plan": "https://preview.twilio.com/wireless/RatePlans/WPaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
                },
                "rate_plan_sid": "WPaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "sid": "DEaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "iccid": "iccid",
                "e_id": "e_id",
                "status": "status",
                "url": "https://preview.twilio.com/wireless/Sims/DEaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
            }
            '
        ));

        $actual = $this->twilio->preview->wireless->sims("DEXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->fetch();

        $this->assertNotNull($actual);
    }

    public function testReadRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->preview->wireless->sims->read();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'get',
            'https://preview.twilio.com/wireless/Sims',
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
                "sims": [],
                "meta": {
                    "first_page_url": "https://preview.twilio.com/wireless/Sims?Status=status&Iccid=iccid&RatePlan=rate_plan&PageSize=50&Page=0",
                    "key": "sims",
                    "next_page_url": null,
                    "page": 0,
                    "page_size": 50,
                    "previous_page_url": null,
                    "url": "https://preview.twilio.com/wireless/Sims?Status=status&Iccid=iccid&RatePlan=rate_plan&PageSize=50&Page=0"
                }
            }
            '
        ));

        $actual = $this->twilio->preview->wireless->sims->read();

        $this->assertNotNull($actual);
    }

    public function testReadFullResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "sims": [
                    {
                        "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "unique_name": "unique_name",
                        "commands_callback_method": "http_method",
                        "commands_callback_url": "http://www.example.com",
                        "date_created": "2015-07-30T20:00:00Z",
                        "date_updated": "2015-07-30T20:00:00Z",
                        "friendly_name": "friendly_name",
                        "links": {
                            "usage": "https://preview.twilio.com/wireless/Sims/DEaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Usage",
                            "rate_plan": "https://preview.twilio.com/wireless/RatePlans/WPaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
                        },
                        "rate_plan_sid": "WPaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "sid": "DEaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "iccid": "iccid",
                        "e_id": "e_id",
                        "status": "status",
                        "sms_fallback_method": "http_method",
                        "sms_fallback_url": "http://www.example.com",
                        "sms_method": "http_method",
                        "sms_url": "http://www.example.com",
                        "voice_fallback_method": "http_method",
                        "voice_fallback_url": "http://www.example.com",
                        "voice_method": "http_method",
                        "voice_url": "http://www.example.com",
                        "url": "https://preview.twilio.com/wireless/Sims/DEaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
                    }
                ],
                "meta": {
                    "first_page_url": "https://preview.twilio.com/wireless/Sims?Status=status&Iccid=iccid&RatePlan=rate_plan&PageSize=50&Page=0",
                    "key": "sims",
                    "next_page_url": null,
                    "page": 0,
                    "page_size": 50,
                    "previous_page_url": null,
                    "url": "https://preview.twilio.com/wireless/Sims?Status=status&Iccid=iccid&RatePlan=rate_plan&PageSize=50&Page=0"
                }
            }
            '
        ));

        $actual = $this->twilio->preview->wireless->sims->read();

        $this->assertGreaterThan(0, \count($actual));
    }

    public function testUpdateRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->preview->wireless->sims("DEXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->update();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'post',
            'https://preview.twilio.com/wireless/Sims/DEXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX',
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
                "unique_name": "unique_name",
                "commands_callback_method": "http_method",
                "commands_callback_url": "http://www.example.com",
                "date_created": "2015-07-30T20:00:00Z",
                "date_updated": "2015-07-30T20:00:00Z",
                "friendly_name": "friendly_name",
                "links": {
                    "usage": "https://preview.twilio.com/wireless/Sims/DEaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Usage",
                    "rate_plan": "https://preview.twilio.com/wireless/RatePlans/WPaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
                },
                "rate_plan_sid": "WPaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "sid": "DEaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "iccid": "iccid",
                "e_id": "e_id",
                "status": "status",
                "sms_fallback_method": "http_method",
                "sms_fallback_url": "http://www.example.com",
                "sms_method": "http_method",
                "sms_url": "http://www.example.com",
                "voice_fallback_method": "http_method",
                "voice_fallback_url": "http://www.example.com",
                "voice_method": "http_method",
                "voice_url": "http://www.example.com",
                "url": "https://preview.twilio.com/wireless/Sims/DEaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
            }
            '
        ));

        $actual = $this->twilio->preview->wireless->sims("DEXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->update();

        $this->assertNotNull($actual);
    }
}