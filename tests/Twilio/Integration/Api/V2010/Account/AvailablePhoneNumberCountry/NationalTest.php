<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Tests\Integration\Api\V2010\Account\AvailablePhoneNumberCountry;

use Twilio\Exceptions\DeserializeException;
use Twilio\Exceptions\TwilioException;
use Twilio\Http\Response;
use Twilio\Tests\HolodeckTestCase;
use Twilio\Tests\Request;

class NationalTest extends HolodeckTestCase {
    public function testReadRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->api->v2010->accounts("ACXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                     ->availablePhoneNumbers("US")
                                     ->national->read();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'get',
            'https://api.twilio.com/2010-04-01/Accounts/ACXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/AvailablePhoneNumbers/US/National.json',
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
                "available_phone_numbers": [
                    {
                        "address_requirements": "none",
                        "beta": false,
                        "capabilities": {
                            "mms": false,
                            "sms": true,
                            "voice": false
                        },
                        "friendly_name": "+4759440374",
                        "iso_country": "NO",
                        "lata": null,
                        "latitude": null,
                        "locality": null,
                        "longitude": null,
                        "phone_number": "+4759440374",
                        "postal_code": null,
                        "rate_center": null,
                        "region": null
                    }
                ],
                "end": 1,
                "first_page_uri": "/2010-04-01/Accounts/ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/AvailablePhoneNumbers/US/National.json?PageSize=50&Page=0",
                "last_page_uri": "/2010-04-01/Accounts/ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/AvailablePhoneNumbers/US/National.json?PageSize=50&Page=0",
                "next_page_uri": null,
                "num_pages": 1,
                "page": 0,
                "page_size": 50,
                "previous_page_uri": null,
                "start": 0,
                "total": 1,
                "uri": "/2010-04-01/Accounts/ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/AvailablePhoneNumbers/US/National.json?PageSize=1"
            }
            '
        ));

        $actual = $this->twilio->api->v2010->accounts("ACXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                           ->availablePhoneNumbers("US")
                                           ->national->read();

        $this->assertGreaterThan(0, \count($actual));
    }

    public function testReadEmptyResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "available_phone_numbers": [],
                "first_page_uri": "/2010-04-01/Accounts/ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/AvailablePhoneNumbers/US/National.json?PageSize=50&Page=0",
                "last_page_uri": "/2010-04-01/Accounts/ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/AvailablePhoneNumbers/US/National.json?PageSize=50&Page=0",
                "next_page_uri": null,
                "num_pages": 1,
                "page": 0,
                "page_size": 50,
                "previous_page_uri": null,
                "start": 0,
                "total": 1,
                "uri": "/2010-04-01/Accounts/ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/AvailablePhoneNumbers/US/National.json?PageSize=1"
            }
            '
        ));

        $actual = $this->twilio->api->v2010->accounts("ACXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                           ->availablePhoneNumbers("US")
                                           ->national->read();

        $this->assertNotNull($actual);
    }
}