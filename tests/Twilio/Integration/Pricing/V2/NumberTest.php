<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Tests\Integration\Pricing\V2;

use Twilio\Exceptions\DeserializeException;
use Twilio\Exceptions\TwilioException;
use Twilio\Http\Response;
use Twilio\Tests\HolodeckTestCase;
use Twilio\Tests\Request;

class NumberTest extends HolodeckTestCase {
    public function testFetchRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->pricing->v2->numbers("+15017122661")->fetch();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'get',
            'https://pricing.twilio.com/v2/Trunking/Numbers/%2B15017122661'
        ));
    }

    public function testFetchResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "country": "United States",
                "destination_number": "+18001234567",
                "originating_call_price": {
                    "base_price": null,
                    "current_price": null,
                    "number_type": null
                },
                "iso_country": "US",
                "origination_number": null,
                "terminating_prefix_prices": [
                    {
                        "base_price": null,
                        "current_price": "0.013",
                        "destination_prefixes": [
                            "1800"
                        ],
                        "friendly_name": "Trunking Outbound Minute - United States Zone 1b",
                        "origination_prefixes": [
                            "ALL"
                        ]
                    }
                ],
                "price_unit": "USD",
                "url": "https://pricing.twilio.com/v2/Trunking/Numbers/+18001234567"
            }
            '
        ));

        $actual = $this->twilio->pricing->v2->numbers("+15017122661")->fetch();

        $this->assertNotNull($actual);
    }

    public function testFetchWithOriginationResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "country": "United States",
                "destination_number": "+18001234567",
                "originating_call_price": {
                    "base_price": null,
                    "current_price": "0.013",
                    "number_type": "tollfree"
                },
                "iso_country": "US",
                "origination_number": "+15105556789",
                "terminating_prefix_prices": [
                    {
                        "base_price": null,
                        "current_price": "0.001",
                        "destination_prefixes": [
                            "1800"
                        ],
                        "friendly_name": "Trunking Outbound Minute - United States - Toll Free",
                        "origination_prefixes": [
                            "ALL"
                        ]
                    }
                ],
                "price_unit": "USD",
                "url": "https://pricing.twilio.com/v2/Trunking/Numbers/+18001234567"
            }
            '
        ));

        $actual = $this->twilio->pricing->v2->numbers("+15017122661")->fetch();

        $this->assertNotNull($actual);
    }
}