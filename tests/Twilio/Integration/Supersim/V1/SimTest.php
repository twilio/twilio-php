<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Tests\Integration\Supersim\V1;

use Twilio\Exceptions\DeserializeException;
use Twilio\Exceptions\TwilioException;
use Twilio\Http\Response;
use Twilio\Tests\HolodeckTestCase;
use Twilio\Tests\Request;

class SimTest extends HolodeckTestCase {
    public function testFetchRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->supersim->v1->sims("HSXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->fetch();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'get',
            'https://supersim.twilio.com/v1/Sims/HSXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'
        ));
    }

    public function testFetchResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "sid": "HSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "unique_name": "My SIM",
                "status": "new",
                "fleet_sid": null,
                "iccid": "iccid",
                "date_created": "2015-07-30T20:00:00Z",
                "date_updated": "2015-07-30T20:00:00Z",
                "url": "https://supersim.twilio.com/v1/Sims/HSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
            }
            '
        ));

        $actual = $this->twilio->supersim->v1->sims("HSXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->fetch();

        $this->assertNotNull($actual);
    }

    public function testUpdateRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->supersim->v1->sims("HSXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->update();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'post',
            'https://supersim.twilio.com/v1/Sims/HSXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'
        ));
    }

    public function testUpdateUniqueNameResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "sid": "HSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "unique_name": "MySIM",
                "status": "new",
                "fleet_sid": null,
                "iccid": "iccid",
                "date_created": "2015-07-30T20:00:00Z",
                "date_updated": "2015-07-30T20:00:00Z",
                "url": "https://supersim.twilio.com/v1/Sims/HSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
            }
            '
        ));

        $actual = $this->twilio->supersim->v1->sims("HSXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->update();

        $this->assertNotNull($actual);
    }

    public function testUpdateStatusResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "sid": "HSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "unique_name": null,
                "status": "scheduled",
                "fleet_sid": null,
                "iccid": "iccid",
                "date_created": "2015-07-30T20:00:00Z",
                "date_updated": "2015-07-30T20:00:00Z",
                "url": "https://supersim.twilio.com/v1/Sims/HSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
            }
            '
        ));

        $actual = $this->twilio->supersim->v1->sims("HSXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->update();

        $this->assertNotNull($actual);
    }

    public function testUpdateFleetWithSidResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "sid": "HSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "unique_name": null,
                "status": "new",
                "fleet_sid": "HFaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "iccid": "iccid",
                "date_created": "2015-07-30T20:00:00Z",
                "date_updated": "2015-07-30T20:00:00Z",
                "url": "https://supersim.twilio.com/v1/Sims/HSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
            }
            '
        ));

        $actual = $this->twilio->supersim->v1->sims("HSXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->update();

        $this->assertNotNull($actual);
    }

    public function testUpdateFleetWithUniqueNameResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "sid": "HSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "unique_name": null,
                "status": "new",
                "fleet_sid": "HFaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "iccid": "iccid",
                "date_created": "2015-07-30T20:00:00Z",
                "date_updated": "2015-07-30T20:00:00Z",
                "url": "https://supersim.twilio.com/v1/Sims/HSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
            }
            '
        ));

        $actual = $this->twilio->supersim->v1->sims("HSXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->update();

        $this->assertNotNull($actual);
    }

    public function testReadRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->supersim->v1->sims->read();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'get',
            'https://supersim.twilio.com/v1/Sims'
        ));
    }

    public function testReadEmptyResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "sims": [],
                "meta": {
                    "first_page_url": "https://supersim.twilio.com/v1/Sims?Status=new&Fleet=HFaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa&Iccid=11111111111111111111&PageSize=50&Page=0",
                    "key": "sims",
                    "next_page_url": null,
                    "page": 0,
                    "page_size": 50,
                    "previous_page_url": null,
                    "url": "https://supersim.twilio.com/v1/Sims?Status=new&Fleet=HFaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa&Iccid=11111111111111111111&PageSize=50&Page=0"
                }
            }
            '
        ));

        $actual = $this->twilio->supersim->v1->sims->read();

        $this->assertNotNull($actual);
    }

    public function testReadFullResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "meta": {
                    "first_page_url": "https://supersim.twilio.com/v1/Sims?Status=new&Fleet=MyFleet&Iccid=11111111111111111111&PageSize=50&Page=0",
                    "key": "sims",
                    "next_page_url": null,
                    "page": 0,
                    "page_size": 50,
                    "previous_page_url": null,
                    "url": "https://supersim.twilio.com/v1/Sims?Status=new&Fleet=MyFleet&Iccid=11111111111111111111&PageSize=50&Page=0"
                },
                "sims": [
                    {
                        "sid": "HSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "unique_name": "My SIM",
                        "status": "new",
                        "fleet_sid": null,
                        "iccid": "iccid",
                        "date_created": "2015-07-30T20:00:00Z",
                        "date_updated": "2015-07-30T20:00:00Z",
                        "url": "https://supersim.twilio.com/v1/Sims/HSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
                    }
                ]
            }
            '
        ));

        $actual = $this->twilio->supersim->v1->sims->read();

        $this->assertGreaterThan(0, \count($actual));
    }
}