<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Tests\Integration\Serverless\V1\Service\Environment;

use Twilio\Exceptions\DeserializeException;
use Twilio\Exceptions\TwilioException;
use Twilio\Http\Response;
use Twilio\Tests\HolodeckTestCase;
use Twilio\Tests\Request;

class DeploymentTest extends HolodeckTestCase {
    public function testReadRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->serverless->v1->services("ZSXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                         ->environments("ZEXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                         ->deployments->read();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'get',
            'https://serverless.twilio.com/v1/Services/ZSXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Environments/ZEXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Deployments'
        ));
    }

    public function testReadEmptyResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "deployments": [],
                "meta": {
                    "first_page_url": "https://serverless.twilio.com/v1/Services/ZS00000000000000000000000000000000/Environments/ZE00000000000000000000000000000000/Deployments?PageSize=50&Page=0",
                    "key": "deployments",
                    "next_page_url": null,
                    "page": 0,
                    "page_size": 50,
                    "previous_page_url": null,
                    "url": "https://serverless.twilio.com/v1/Services/ZS00000000000000000000000000000000/Environments/ZE00000000000000000000000000000000/Deployments?PageSize=50&Page=0"
                }
            }
            '
        ));

        $actual = $this->twilio->serverless->v1->services("ZSXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                               ->environments("ZEXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                               ->deployments->read();

        $this->assertNotNull($actual);
    }

    public function testFetchRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->serverless->v1->services("ZSXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                         ->environments("ZEXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                         ->deployments("ZDXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->fetch();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'get',
            'https://serverless.twilio.com/v1/Services/ZSXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Environments/ZEXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Deployments/ZDXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'
        ));
    }

    public function testFetchResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "sid": "ZD00000000000000000000000000000000",
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "service_sid": "ZS00000000000000000000000000000000",
                "environment_sid": "ZE00000000000000000000000000000000",
                "build_sid": "ZB00000000000000000000000000000000",
                "date_created": "2018-11-10T20:00:00Z",
                "date_updated": "2018-11-10T20:00:00Z",
                "url": "https://serverless.twilio.com/v1/Services/ZS00000000000000000000000000000000/Environments/ZE00000000000000000000000000000000/Deployments/ZD00000000000000000000000000000000"
            }
            '
        ));

        $actual = $this->twilio->serverless->v1->services("ZSXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                               ->environments("ZEXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                               ->deployments("ZDXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->fetch();

        $this->assertNotNull($actual);
    }

    public function testCreateRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->serverless->v1->services("ZSXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                         ->environments("ZEXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                         ->deployments->create("ZBXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX");
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $values = ['BuildSid' => "ZBXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX", ];

        $this->assertRequest(new Request(
            'post',
            'https://serverless.twilio.com/v1/Services/ZSXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Environments/ZEXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Deployments',
            null,
            $values
        ));
    }

    public function testCreateResponse(): void {
        $this->holodeck->mock(new Response(
            201,
            '
            {
                "sid": "ZD00000000000000000000000000000000",
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "service_sid": "ZS00000000000000000000000000000000",
                "environment_sid": "ZE00000000000000000000000000000000",
                "build_sid": "ZB00000000000000000000000000000000",
                "date_created": "2018-11-10T20:00:00Z",
                "date_updated": "2018-11-10T20:00:00Z",
                "url": "https://serverless.twilio.com/v1/Services/ZS00000000000000000000000000000000/Environments/ZE00000000000000000000000000000000/Deployments/ZD00000000000000000000000000000000"
            }
            '
        ));

        $actual = $this->twilio->serverless->v1->services("ZSXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                               ->environments("ZEXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                               ->deployments->create("ZBXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX");

        $this->assertNotNull($actual);
    }
}