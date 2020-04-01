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

class LogTest extends HolodeckTestCase {
    public function testReadRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->serverless->v1->services("ZSXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                         ->environments("ZEXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                         ->logs->read();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'get',
            'https://serverless.twilio.com/v1/Services/ZSXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Environments/ZEXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Logs',
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
                "logs": [],
                "meta": {
                    "first_page_url": "https://serverless.twilio.com/v1/Services/ZS00000000000000000000000000000000/Environments/ZE00000000000000000000000000000000/Logs?StartDate=2018-11-10T20%3A00%3A00Z&EndDate=2018-12-10T20%3A00%3A00Z&FunctionSid=ZH00000000000000000000000000000000&PageSize=50&Page=0",
                    "key": "logs",
                    "next_page_url": null,
                    "page": 0,
                    "page_size": 50,
                    "previous_page_url": null,
                    "url": "https://serverless.twilio.com/v1/Services/ZS00000000000000000000000000000000/Environments/ZE00000000000000000000000000000000/Logs?StartDate=2018-11-10T20%3A00%3A00Z&EndDate=2018-12-10T20%3A00%3A00Z&FunctionSid=ZH00000000000000000000000000000000&PageSize=50&Page=0"
                }
            }
            '
        ));

        $actual = $this->twilio->serverless->v1->services("ZSXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                               ->environments("ZEXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                               ->logs->read();

        $this->assertNotNull($actual);
    }

    public function testFetchRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->serverless->v1->services("ZSXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                         ->environments("ZEXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                         ->logs("NOXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->fetch();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'get',
            'https://serverless.twilio.com/v1/Services/ZSXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Environments/ZEXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Logs/NOXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX',
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
                "sid": "NO00000000000000000000000000000000",
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "service_sid": "ZS00000000000000000000000000000000",
                "environment_sid": "ZE00000000000000000000000000000000",
                "deployment_sid": "ZD00000000000000000000000000000000",
                "function_sid": "ZH00000000000000000000000000000000",
                "request_sid": "RQ00000000000000000000000000000000",
                "level": "warn",
                "message": "This is a warning",
                "date_created": "2018-11-10T20:00:00Z",
                "url": "https://serverless.twilio.com/v1/Services/ZS00000000000000000000000000000000/Environments/ZE00000000000000000000000000000000/Logs/NO00000000000000000000000000000000"
            }
            '
        ));

        $actual = $this->twilio->serverless->v1->services("ZSXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                               ->environments("ZEXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                               ->logs("NOXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->fetch();

        $this->assertNotNull($actual);
    }
}