<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Tests\Integration\Pricing\V1\PhoneNumber;

use Twilio\Exceptions\DeserializeException;
use Twilio\Exceptions\TwilioException;
use Twilio\Http\Response;
use Twilio\Tests\HolodeckTestCase;
use Twilio\Tests\Request;

class CountryTest extends HolodeckTestCase {
    public function testReadRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->pricing->v1->phoneNumbers
                                      ->countries->read();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'get',
            'https://pricing.twilio.com/v1/PhoneNumbers/Countries',
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
                "countries": [
                    {
                        "country": "Austria",
                        "iso_country": "AT",
                        "url": "https://pricing.twilio.com/v1/PhoneNumbers/Countries/AT"
                    }
                ],
                "meta": {
                    "page": 0,
                    "page_size": 50,
                    "first_page_url": "https://pricing.twilio.com/v1/PhoneNumbers/Countries?PageSize=50&Page=0",
                    "previous_page_url": null,
                    "url": "https://pricing.twilio.com/v1/PhoneNumbers/Countries?PageSize=50&Page=0",
                    "next_page_url": null,
                    "key": "countries"
                }
            }
            '
        ));

        $actual = $this->twilio->pricing->v1->phoneNumbers
                                            ->countries->read();

        $this->assertGreaterThan(0, \count($actual));
    }

    public function testReadEmptyResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "countries": [],
                "meta": {
                    "first_page_url": "https://pricing.twilio.com/v1/PhoneNumbers/Countries?PageSize=50&Page=0",
                    "key": "countries",
                    "next_page_url": null,
                    "page": 0,
                    "page_size": 50,
                    "previous_page_url": null,
                    "url": "https://pricing.twilio.com/v1/PhoneNumbers/Countries?PageSize=50&Page=0"
                }
            }
            '
        ));

        $actual = $this->twilio->pricing->v1->phoneNumbers
                                            ->countries->read();

        $this->assertNotNull($actual);
    }

    public function testFetchRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->pricing->v1->phoneNumbers
                                      ->countries("US")->fetch();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'get',
            'https://pricing.twilio.com/v1/PhoneNumbers/Countries/US',
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
                "country": "United States",
                "iso_country": "US",
                "phone_number_prices": [
                    {
                        "number_type": "local",
                        "base_price": "1.00",
                        "current_price": "1.00"
                    },
                    {
                        "number_type": "toll free",
                        "base_price": "2.00",
                        "current_price": "2.00"
                    }
                ],
                "price_unit": "USD",
                "url": "https://pricing.twilio.com/v1/PhoneNumbers/Countries/US"
            }
            '
        ));

        $actual = $this->twilio->pricing->v1->phoneNumbers
                                            ->countries("US")->fetch();

        $this->assertNotNull($actual);
    }
}