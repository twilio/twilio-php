<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Tests\Integration\Fax\V1;

use Twilio\Exceptions\DeserializeException;
use Twilio\Exceptions\TwilioException;
use Twilio\Http\Response;
use Twilio\Tests\HolodeckTestCase;
use Twilio\Tests\Request;

class FaxTest extends HolodeckTestCase {
    public function testFetchRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->fax->v1->faxes("FXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->fetch();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'get',
            'https://fax.twilio.com/v1/Faxes/FXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX',
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
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "api_version": "v1",
                "date_created": "2015-07-30T20:00:00Z",
                "date_updated": "2015-07-30T20:00:00Z",
                "direction": "outbound",
                "from": "+14155551234",
                "media_url": "https://www.example.com/fax.pdf",
                "media_sid": "MEaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "num_pages": null,
                "price": null,
                "price_unit": null,
                "quality": null,
                "sid": "FXaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "status": "queued",
                "to": "+14155554321",
                "duration": null,
                "links": {
                    "media": "https://fax.twilio.com/v1/Faxes/FXaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Media"
                },
                "url": "https://fax.twilio.com/v1/Faxes/FXaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
            }
            '
        ));

        $actual = $this->twilio->fax->v1->faxes("FXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->fetch();

        $this->assertNotNull($actual);
    }

    public function testReadRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->fax->v1->faxes->read();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'get',
            'https://fax.twilio.com/v1/Faxes',
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
                "faxes": [],
                "meta": {
                    "first_page_url": "https://fax.twilio.com/v1/Faxes?DateCreatedOnOrBefore=2017-04-01T00%3A00%3A00Z&To=%2B14155554321&DateCreatedAfter=2017-03-31T00%3A00%3A00Z&From=%2B14155551234&PageSize=50&Page=0",
                    "key": "faxes",
                    "next_page_url": null,
                    "page": 0,
                    "page_size": 50,
                    "previous_page_url": null,
                    "url": "https://fax.twilio.com/v1/Faxes?DateCreatedOnOrBefore=2017-04-01T00%3A00%3A00Z&To=%2B14155554321&DateCreatedAfter=2017-03-31T00%3A00%3A00Z&From=%2B14155551234&PageSize=50&Page=0"
                }
            }
            '
        ));

        $actual = $this->twilio->fax->v1->faxes->read();

        $this->assertNotNull($actual);
    }

    public function testReadFullResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "faxes": [
                    {
                        "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "api_version": "v1",
                        "date_created": "2015-07-30T20:00:00Z",
                        "date_updated": "2015-07-30T20:00:00Z",
                        "direction": "outbound",
                        "from": "+14155551234",
                        "media_url": "https://www.example.com/fax.pdf",
                        "media_sid": "MEaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "num_pages": null,
                        "price": null,
                        "price_unit": null,
                        "quality": null,
                        "sid": "FXaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "status": "queued",
                        "to": "+14155554321",
                        "duration": null,
                        "links": {
                            "media": "https://fax.twilio.com/v1/Faxes/FXaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Media"
                        },
                        "url": "https://fax.twilio.com/v1/Faxes/FXaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
                    }
                ],
                "meta": {
                    "first_page_url": "https://fax.twilio.com/v1/Faxes?To=%2B14155554321&From=%2B14155551234&PageSize=50&Page=0",
                    "key": "faxes",
                    "next_page_url": null,
                    "page": 0,
                    "page_size": 50,
                    "previous_page_url": null,
                    "url": "https://fax.twilio.com/v1/Faxes?To=%2B14155554321&From=%2B14155551234&PageSize=50&Page=0"
                }
            }
            '
        ));

        $actual = $this->twilio->fax->v1->faxes->read();

        $this->assertGreaterThan(0, \count($actual));
    }

    public function testCreateRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->fax->v1->faxes->create("to", "https://example.com");
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $values = ['To' => "to", 'MediaUrl' => "https://example.com", ];

        $this->assertRequest(new Request(
            'post',
            'https://fax.twilio.com/v1/Faxes',
            [],
            $values,
            []
        ));
    }

    public function testCreateResponse(): void {
        $this->holodeck->mock(new Response(
            201,
            '
            {
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "api_version": "v1",
                "date_created": "2015-07-30T20:00:00Z",
                "date_updated": "2015-07-30T20:00:00Z",
                "direction": "outbound",
                "from": "+14155551234",
                "media_url": null,
                "media_sid": null,
                "num_pages": null,
                "price": null,
                "price_unit": null,
                "quality": "superfine",
                "sid": "FXaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "status": "queued",
                "to": "+14155554321",
                "duration": null,
                "links": {
                    "media": "https://fax.twilio.com/v1/Faxes/FXaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Media"
                },
                "url": "https://fax.twilio.com/v1/Faxes/FXaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
            }
            '
        ));

        $actual = $this->twilio->fax->v1->faxes->create("to", "https://example.com");

        $this->assertNotNull($actual);
    }

    public function testUpdateRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->fax->v1->faxes("FXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->update();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'post',
            'https://fax.twilio.com/v1/Faxes/FXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX',
            [],
            [],
            []
        ));
    }

    public function testUpdateResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "api_version": "v1",
                "date_created": "2015-07-30T20:00:00Z",
                "date_updated": "2015-07-30T20:00:00Z",
                "direction": "outbound",
                "from": "+14155551234",
                "media_url": null,
                "media_sid": null,
                "num_pages": null,
                "price": null,
                "price_unit": null,
                "quality": null,
                "sid": "FXaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "status": "canceled",
                "to": "+14155554321",
                "duration": null,
                "links": {
                    "media": "https://fax.twilio.com/v1/Faxes/FXaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Media"
                },
                "url": "https://fax.twilio.com/v1/Faxes/FXaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
            }
            '
        ));

        $actual = $this->twilio->fax->v1->faxes("FXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->update();

        $this->assertNotNull($actual);
    }

    public function testDeleteRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->fax->v1->faxes("FXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->delete();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'delete',
            'https://fax.twilio.com/v1/Faxes/FXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX',
            [],
            [],
            []
        ));
    }

    public function testDeleteResponse(): void {
        $this->holodeck->mock(new Response(
            204,
            null
        ));

        $actual = $this->twilio->fax->v1->faxes("FXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->delete();

        $this->assertTrue($actual);
    }
}