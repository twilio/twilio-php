<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Tests\Integration\Preview\Sync\Service\SyncList;

use Twilio\Exceptions\DeserializeException;
use Twilio\Exceptions\TwilioException;
use Twilio\Http\Response;
use Twilio\Serialize;
use Twilio\Tests\HolodeckTestCase;
use Twilio\Tests\Request;

class SyncListItemTest extends HolodeckTestCase {
    public function testFetchRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->preview->sync->services("ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                        ->syncLists("ESXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                        ->syncListItems(1)->fetch();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'get',
            'https://preview.twilio.com/Sync/Services/ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Lists/ESXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Items/1',
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
                "created_by": "created_by",
                "data": {},
                "date_created": "2015-07-30T20:00:00Z",
                "date_updated": "2015-07-30T20:00:00Z",
                "index": 100,
                "list_sid": "ESaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "revision": "revision",
                "service_sid": "ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "url": "https://preview.twilio.com/Sync/Services/ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Lists/ESaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Items/100"
            }
            '
        ));

        $actual = $this->twilio->preview->sync->services("ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                              ->syncLists("ESXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                              ->syncListItems(1)->fetch();

        $this->assertNotNull($actual);
    }

    public function testDeleteRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        $options = ['ifMatch' => "if_match", ];

        try {
            $this->twilio->preview->sync->services("ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                        ->syncLists("ESXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                        ->syncListItems(1)->delete($options);
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $headers = ['If-Match' => "if_match", ];

        $this->assertRequest(new Request(
            'delete',
            'https://preview.twilio.com/Sync/Services/ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Lists/ESXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Items/1',
            [],
            [],
            $headers
        ));
    }

    public function testDeleteResponse(): void {
        $this->holodeck->mock(new Response(
            204,
            null
        ));

        $actual = $this->twilio->preview->sync->services("ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                              ->syncLists("ESXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                              ->syncListItems(1)->delete();

        $this->assertTrue($actual);
    }

    public function testCreateRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->preview->sync->services("ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                        ->syncLists("ESXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                        ->syncListItems->create([]);
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $values = ['Data' => Serialize::jsonObject([]), ];

        $this->assertRequest(new Request(
            'post',
            'https://preview.twilio.com/Sync/Services/ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Lists/ESXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Items',
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
                "created_by": "created_by",
                "data": {},
                "date_created": "2015-07-30T20:00:00Z",
                "date_updated": "2015-07-30T20:00:00Z",
                "index": 100,
                "list_sid": "ESaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "revision": "revision",
                "service_sid": "ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "url": "https://preview.twilio.com/Sync/Services/ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Lists/ESaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Items/100"
            }
            '
        ));

        $actual = $this->twilio->preview->sync->services("ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                              ->syncLists("ESXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                              ->syncListItems->create([]);

        $this->assertNotNull($actual);
    }

    public function testReadRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->preview->sync->services("ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                        ->syncLists("ESXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                        ->syncListItems->read();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'get',
            'https://preview.twilio.com/Sync/Services/ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Lists/ESXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Items',
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
                "items": [],
                "meta": {
                    "first_page_url": "https://preview.twilio.com/Sync/Services/ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Lists/ESaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Items?From=from&Bounds=inclusive&Order=asc&PageSize=50&Page=0",
                    "key": "items",
                    "next_page_url": null,
                    "page": 0,
                    "page_size": 50,
                    "previous_page_url": null,
                    "url": "https://preview.twilio.com/Sync/Services/ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Lists/ESaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Items?From=from&Bounds=inclusive&Order=asc&PageSize=50&Page=0"
                }
            }
            '
        ));

        $actual = $this->twilio->preview->sync->services("ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                              ->syncLists("ESXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                              ->syncListItems->read();

        $this->assertNotNull($actual);
    }

    public function testReadFullResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "items": [
                    {
                        "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "created_by": "created_by",
                        "data": {},
                        "date_created": "2015-07-30T20:00:00Z",
                        "date_updated": "2015-07-30T20:00:00Z",
                        "index": 100,
                        "list_sid": "ESaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "revision": "revision",
                        "service_sid": "ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "url": "https://preview.twilio.com/Sync/Services/ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Lists/ESaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Items/100"
                    }
                ],
                "meta": {
                    "first_page_url": "https://preview.twilio.com/Sync/Services/ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Lists/ESaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Items?From=from&Bounds=inclusive&Order=asc&PageSize=50&Page=0",
                    "key": "items",
                    "next_page_url": null,
                    "page": 0,
                    "page_size": 50,
                    "previous_page_url": null,
                    "url": "https://preview.twilio.com/Sync/Services/ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Lists/ESaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Items?From=from&Bounds=inclusive&Order=asc&PageSize=50&Page=0"
                }
            }
            '
        ));

        $actual = $this->twilio->preview->sync->services("ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                              ->syncLists("ESXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                              ->syncListItems->read();

        $this->assertGreaterThan(0, \count($actual));
    }

    public function testUpdateRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        $options = ['ifMatch' => "if_match", ];

        try {
            $this->twilio->preview->sync->services("ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                        ->syncLists("ESXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                        ->syncListItems(1)->update([], $options);
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $values = ['Data' => Serialize::jsonObject([]), ];

        $headers = ['If-Match' => "if_match", ];

        $this->assertRequest(new Request(
            'post',
            'https://preview.twilio.com/Sync/Services/ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Lists/ESXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Items/1',
            [],
            $values,
            $headers
        ));
    }

    public function testUpdateResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "created_by": "created_by",
                "data": {},
                "date_created": "2015-07-30T20:00:00Z",
                "date_updated": "2015-07-30T20:00:00Z",
                "index": 100,
                "list_sid": "ESaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "revision": "revision",
                "service_sid": "ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "url": "https://preview.twilio.com/Sync/Services/ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Lists/ESaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Items/100"
            }
            '
        ));

        $actual = $this->twilio->preview->sync->services("ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                              ->syncLists("ESXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                              ->syncListItems(1)->update([]);

        $this->assertNotNull($actual);
    }
}