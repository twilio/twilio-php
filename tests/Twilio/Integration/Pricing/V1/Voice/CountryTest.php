<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Tests\Integration\Pricing\V1\Voice;

use Twilio\Exceptions\DeserializeException;
use Twilio\Exceptions\TwilioException;
use Twilio\Http\Response;
use Twilio\Tests\HolodeckTestCase;
use Twilio\Tests\Request;

class CountryTest extends HolodeckTestCase {
    public function testReadRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->pricing->v1->voice
                                      ->countries->read();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'get',
            'https://pricing.twilio.com/v1/Voice/Countries',
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
                        "country": "Andorra",
                        "iso_country": "AD",
                        "url": "https://pricing.twilio.com/v1/Voice/Countries/AD"
                    }
                ],
                "meta": {
                    "first_page_url": "https://pricing.twilio.com/v1/Voice/Countries?PageSize=50&Page=0",
                    "key": "countries",
                    "next_page_url": null,
                    "page": 0,
                    "page_size": 50,
                    "previous_page_url": null,
                    "url": "https://pricing.twilio.com/v1/Voice/Countries?PageSize=50&Page=0"
                }
            }
            '
        ));

        $actual = $this->twilio->pricing->v1->voice
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
                    "first_page_url": "https://pricing.twilio.com/v1/Voice/Countries?PageSize=50&Page=0",
                    "key": "countries",
                    "next_page_url": null,
                    "page": 0,
                    "page_size": 50,
                    "previous_page_url": null,
                    "url": "https://pricing.twilio.com/v1/Voice/Countries?PageSize=50&Page=0"
                }
            }
            '
        ));

        $actual = $this->twilio->pricing->v1->voice
                                            ->countries->read();

        $this->assertNotNull($actual);
    }

    public function testFetchRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->pricing->v1->voice
                                      ->countries("US")->fetch();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'get',
            'https://pricing.twilio.com/v1/Voice/Countries/US',
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
                "inbound_call_prices": [
                    {
                        "current_price": "0.0085",
                        "number_type": "local",
                        "base_price": "0.0085"
                    },
                    {
                        "current_price": "0.022",
                        "number_type": "toll free",
                        "base_price": "0.022"
                    }
                ],
                "iso_country": "US",
                "outbound_prefix_prices": [
                    {
                        "prefixes": [
                            "1907"
                        ],
                        "current_price": "0.090",
                        "friendly_name": "Programmable Outbound Minute - United States - Alaska",
                        "base_price": "0.090"
                    }
                ],
                "price_unit": "USD",
                "url": "https://pricing.twilio.com/v1/Voice/Countries/US"
            }
            '
        ));

        $actual = $this->twilio->pricing->v1->voice
                                            ->countries("US")->fetch();

        $this->assertNotNull($actual);
    }
}