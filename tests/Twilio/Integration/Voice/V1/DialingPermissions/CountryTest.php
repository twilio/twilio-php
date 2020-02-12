<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Tests\Integration\Voice\V1\DialingPermissions;

use Twilio\Exceptions\DeserializeException;
use Twilio\Exceptions\TwilioException;
use Twilio\Http\Response;
use Twilio\Tests\HolodeckTestCase;
use Twilio\Tests\Request;

class CountryTest extends HolodeckTestCase {
    public function testFetchRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->voice->v1->dialingPermissions
                                    ->countries("US")->fetch();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'get',
            'https://voice.twilio.com/v1/DialingPermissions/Countries/US'
        ));
    }

    public function testFetchResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "iso_code": "US",
                "name": "United States/Canada",
                "country_codes": [
                    "+1"
                ],
                "continent": "NORTH_AMERICA",
                "low_risk_numbers_enabled": false,
                "high_risk_special_numbers_enabled": false,
                "high_risk_tollfraud_numbers_enabled": false,
                "url": "https://voice.twilio.com/v1/DialingPermissions/Countries/US",
                "links": {
                    "highrisk_special_prefixes": "https://voice.twilio.com/v1/DialingPermissions/Countries/US/HighRiskSpecialPrefixes"
                }
            }
            '
        ));

        $actual = $this->twilio->voice->v1->dialingPermissions
                                          ->countries("US")->fetch();

        $this->assertNotNull($actual);
    }

    public function testReadRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->voice->v1->dialingPermissions
                                    ->countries->read();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'get',
            'https://voice.twilio.com/v1/DialingPermissions/Countries'
        ));
    }

    public function testReadUsResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "content": [
                    {
                        "iso_code": "US",
                        "name": "United States/Canada",
                        "country_codes": [
                            "+1"
                        ],
                        "continent": "NORTH_AMERICA",
                        "low_risk_numbers_enabled": false,
                        "high_risk_special_numbers_enabled": false,
                        "high_risk_tollfraud_numbers_enabled": false,
                        "url": "https://voice.twilio.com/v1/DialingPermissions/Countries/US",
                        "links": {
                            "highrisk_special_prefixes": "https://voice.twilio.com/v1/DialingPermissions/Countries/US/HighRiskSpecialPrefixes"
                        }
                    }
                ],
                "meta": {
                    "first_page_url": "https://voice.twilio.com/v1/DialingPermissions/Countries?IsoCode=US&PageSize=50&Page=0",
                    "key": "content",
                    "next_page_url": null,
                    "page": 0,
                    "page_size": 50,
                    "previous_page_url": null,
                    "url": "https://voice.twilio.com/v1/DialingPermissions/Countries?IsoCode=US&PageSize=50&Page=0"
                }
            }
            '
        ));

        $actual = $this->twilio->voice->v1->dialingPermissions
                                          ->countries->read();

        $this->assertNotNull($actual);
    }
}