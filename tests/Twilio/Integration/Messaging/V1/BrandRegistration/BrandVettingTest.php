<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Tests\Integration\Messaging\V1\BrandRegistration;

use Twilio\Exceptions\DeserializeException;
use Twilio\Exceptions\TwilioException;
use Twilio\Http\Response;
use Twilio\Tests\HolodeckTestCase;
use Twilio\Tests\Request;

class BrandVettingTest extends HolodeckTestCase {
    public function testCreateRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->messaging->v1->brandRegistrations("BNXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                        ->brandVettings->create("campaign-verify");
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $values = ['VettingProvider' => "campaign-verify", ];

        $this->assertRequest(new Request(
            'post',
            'https://messaging.twilio.com/v1/a2p/BrandRegistrations/BNXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Vettings',
            null,
            $values
        ));
    }

    public function testCreateResponse(): void {
        $this->holodeck->mock(new Response(
            201,
            '
            {
                "account_sid": "AC78e8e67fc0246521490fb9907fd0c165",
                "brand_sid": "BN0044409f7e067e279523808d267e2d85",
                "brand_vetting_sid": "VT12445353",
                "vetting_provider": "CAMPAIGN_VERIFY",
                "vetting_id": "cv|1.0|10DLC|NHDHBD",
                "vetting_class": "POLITICAL",
                "vetting_status": "PENDING",
                "date_created": "2021-01-27T14:18:35Z",
                "date_updated": "2021-01-27T14:18:35Z",
                "url": "https://messaging.twilio.com/v1/a2p/BrandRegistrations/BN0044409f7e067e279523808d267e2d85/Vettings/VT12445353"
            }
            '
        ));

        $actual = $this->twilio->messaging->v1->brandRegistrations("BNXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                              ->brandVettings->create("campaign-verify");

        $this->assertNotNull($actual);
    }

    public function testReadRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->messaging->v1->brandRegistrations("BNXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                        ->brandVettings->read();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'get',
            'https://messaging.twilio.com/v1/a2p/BrandRegistrations/BNXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Vettings'
        ));
    }

    public function testReadResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "meta": {
                    "page": 0,
                    "page_size": 50,
                    "first_page_url": "https://messaging.twilio.com/v1/a2p/BrandRegistrations/BN0044409f7e067e279523808d267e2d85/Vettings?PageSize=50&Page=0",
                    "previous_page_url": null,
                    "next_page_url": null,
                    "key": "data",
                    "url": "https://messaging.twilio.com/v1/a2p/BrandRegistrations/BN0044409f7e067e279523808d267e2d85/Vettings?PageSize=50&Page=0"
                },
                "data": [
                    {
                        "account_sid": "AC78e8e67fc0246521490fb9907fd0c165",
                        "brand_sid": "BN0044409f7e067e279523808d267e2d85",
                        "brand_vetting_sid": "VT12445353",
                        "vetting_provider": "CAMPAIGN_VERIFY",
                        "vetting_id": "cv|1.0|10DLC|NHDHBD",
                        "vetting_class": "POLITICAL",
                        "vetting_status": "PENDING",
                        "date_created": "2021-01-27T14:18:35Z",
                        "date_updated": "2021-01-27T14:18:35Z",
                        "url": "https://messaging.twilio.com/v1/a2p/BrandRegistrations/BN0044409f7e067e279523808d267e2d85/Vettings/VT12445353"
                    }
                ]
            }
            '
        ));

        $actual = $this->twilio->messaging->v1->brandRegistrations("BNXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                              ->brandVettings->read();

        $this->assertNotNull($actual);
    }
}