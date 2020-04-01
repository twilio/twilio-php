<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Tests\Integration\Wireless\V1;

use Twilio\Exceptions\DeserializeException;
use Twilio\Exceptions\TwilioException;
use Twilio\Http\Response;
use Twilio\Tests\HolodeckTestCase;
use Twilio\Tests\Request;

class CommandTest extends HolodeckTestCase {
    public function testFetchRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->wireless->v1->commands("DCXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->fetch();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'get',
            'https://wireless.twilio.com/v1/Commands/DCXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'
        ));
    }

    public function testFetchCommandSmsResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "command": "command",
                "command_mode": "text",
                "date_created": "2015-07-30T20:00:00Z",
                "date_updated": "2015-07-30T20:00:00Z",
                "delivery_receipt_requested": true,
                "sim_sid": "DEaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "direction": "from_sim",
                "sid": "DCaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "status": "queued",
                "transport": "sms",
                "url": "https://wireless.twilio.com/v1/Commands/DCaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
            }
            '
        ));

        $actual = $this->twilio->wireless->v1->commands("DCXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->fetch();

        $this->assertNotNull($actual);
    }

    public function testFetchCommandIpResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "command": "command",
                "command_mode": "text",
                "date_created": "2015-07-30T20:00:00Z",
                "date_updated": "2015-07-30T20:00:00Z",
                "delivery_receipt_requested": false,
                "sim_sid": "DEaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "direction": "to_sim",
                "sid": "DCaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "status": "queued",
                "transport": "ip",
                "url": "https://wireless.twilio.com/v1/Commands/DCaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
            }
            '
        ));

        $actual = $this->twilio->wireless->v1->commands("DCXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->fetch();

        $this->assertNotNull($actual);
    }

    public function testReadRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->wireless->v1->commands->read();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'get',
            'https://wireless.twilio.com/v1/Commands'
        ));
    }

    public function testReadEmptyResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "commands": [],
                "meta": {
                    "first_page_url": "https://wireless.twilio.com/v1/Commands?Status=queued&Direction=from_sim&Sim=sim&PageSize=50&Page=0",
                    "key": "commands",
                    "next_page_url": null,
                    "page": 0,
                    "page_size": 50,
                    "previous_page_url": null,
                    "url": "https://wireless.twilio.com/v1/Commands?Status=queued&Direction=from_sim&Sim=sim&PageSize=50&Page=0"
                }
            }
            '
        ));

        $actual = $this->twilio->wireless->v1->commands->read();

        $this->assertNotNull($actual);
    }

    public function testReadFullResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "commands": [
                    {
                        "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "command": "command",
                        "command_mode": "text",
                        "date_created": "2015-07-30T20:00:00Z",
                        "date_updated": "2015-07-30T20:00:00Z",
                        "delivery_receipt_requested": true,
                        "sim_sid": "DEaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "direction": "from_sim",
                        "sid": "DCaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "status": "queued",
                        "transport": "sms",
                        "url": "https://wireless.twilio.com/v1/Commands/DCaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
                    }
                ],
                "meta": {
                    "first_page_url": "https://wireless.twilio.com/v1/Commands?Status=queued&Direction=from_sim&Sim=sim&PageSize=50&Page=0",
                    "key": "commands",
                    "next_page_url": null,
                    "page": 0,
                    "page_size": 50,
                    "previous_page_url": null,
                    "url": "https://wireless.twilio.com/v1/Commands?Status=queued&Direction=from_sim&Sim=sim&PageSize=50&Page=0"
                }
            }
            '
        ));

        $actual = $this->twilio->wireless->v1->commands->read();

        $this->assertGreaterThan(0, \count($actual));
    }

    public function testReadIpResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "commands": [
                    {
                        "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "command": "command",
                        "command_mode": "not_confirmable",
                        "date_created": "2015-07-30T20:00:00Z",
                        "date_updated": "2015-07-30T20:00:00Z",
                        "delivery_receipt_requested": true,
                        "sim_sid": "DEaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "direction": "to_sim",
                        "sid": "DCaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "status": "queued",
                        "transport": "ip",
                        "url": "https://wireless.twilio.com/v1/Commands/DCaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
                    }
                ],
                "meta": {
                    "first_page_url": "https://wireless.twilio.com/v1/Commands?Status=queued&Direction=to_sim&Transport=ip&Sim=sim&PageSize=50&Page=0",
                    "key": "commands",
                    "next_page_url": null,
                    "page": 0,
                    "page_size": 50,
                    "previous_page_url": null,
                    "url": "https://wireless.twilio.com/v1/Commands?Status=queued&Direction=to_sim&Transport=ip&Sim=sim&PageSize=50&Page=0"
                }
            }
            '
        ));

        $actual = $this->twilio->wireless->v1->commands->read();

        $this->assertNotNull($actual);
    }

    public function testCreateRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->wireless->v1->commands->create("command");
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $values = ['Command' => "command", ];

        $this->assertRequest(new Request(
            'post',
            'https://wireless.twilio.com/v1/Commands',
            [],
            $values
        ));
    }

    public function testCreateCommandSmsResponse(): void {
        $this->holodeck->mock(new Response(
            201,
            '
            {
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "command": "command",
                "command_mode": "text",
                "date_created": "2015-07-30T20:00:00Z",
                "date_updated": "2015-07-30T20:00:00Z",
                "delivery_receipt_requested": true,
                "sim_sid": "DEaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "direction": "from_sim",
                "sid": "DCaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "status": "queued",
                "transport": "sms",
                "url": "https://wireless.twilio.com/v1/Commands/DCaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
            }
            '
        ));

        $actual = $this->twilio->wireless->v1->commands->create("command");

        $this->assertNotNull($actual);
    }

    public function testCreateCommandIpResponse(): void {
        $this->holodeck->mock(new Response(
            201,
            '
            {
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "command": "command",
                "command_mode": "binary",
                "date_created": "2015-07-30T20:00:00Z",
                "date_updated": "2015-07-30T20:00:00Z",
                "delivery_receipt_requested": true,
                "direction": "to_sim",
                "sid": "DCaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "sim_sid": "DEaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "status": "queued",
                "transport": "ip",
                "url": "https://wireless.twilio.com/v1/Commands/DCaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
            }
            '
        ));

        $actual = $this->twilio->wireless->v1->commands->create("command");

        $this->assertNotNull($actual);
    }

    public function testDeleteRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->wireless->v1->commands("DCXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->delete();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'delete',
            'https://wireless.twilio.com/v1/Commands/DCXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'
        ));
    }

    public function testDeleteResponse(): void {
        $this->holodeck->mock(new Response(
            204,
            null
        ));

        $actual = $this->twilio->wireless->v1->commands("DCXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->delete();

        $this->assertTrue($actual);
    }
}