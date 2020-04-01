<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Tests\Integration\Numbers\V2\RegulatoryCompliance;

use Twilio\Exceptions\DeserializeException;
use Twilio\Exceptions\TwilioException;
use Twilio\Http\Response;
use Twilio\Tests\HolodeckTestCase;
use Twilio\Tests\Request;

class SupportingDocumentTypeTest extends HolodeckTestCase {
    public function testReadRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->numbers->v2->regulatoryCompliance
                                      ->supportingDocumentTypes->read();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'get',
            'https://numbers.twilio.com/v2/RegulatoryCompliance/SupportingDocumentTypes'
        ));
    }

    public function testReadEmptyResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "supporting_document_types": [],
                "meta": {
                    "page": 0,
                    "page_size": 50,
                    "first_page_url": "https://numbers.twilio.com/v2/RegulatoryCompliance/SupportingDocumentTypes?PageSize=50&Page=0",
                    "previous_page_url": null,
                    "url": "https://numbers.twilio.com/v2/RegulatoryCompliance/SupportingDocumentTypes?PageSize=50&Page=0",
                    "next_page_url": null,
                    "key": "supporting_document_types"
                }
            }
            '
        ));

        $actual = $this->twilio->numbers->v2->regulatoryCompliance
                                            ->supportingDocumentTypes->read();

        $this->assertNotNull($actual);
    }

    public function testReadFullResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "supporting_document_types": [
                    {
                        "sid": "OYaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "friendly_name": "Passport",
                        "machine_name": "passport",
                        "fields": [
                            {
                                "friendly_name": "Last Name",
                                "machine_name": "last_name",
                                "constraint": "String"
                            }
                        ],
                        "url": "https://numbers.twilio.com/v2/RegulatoryCompliance/SupportingDocumentTypes/OYaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
                    }
                ],
                "meta": {
                    "page": 0,
                    "page_size": 50,
                    "first_page_url": "https://numbers.twilio.com/v2/RegulatoryCompliance/SupportingDocumentTypes?PageSize=50&Page=0",
                    "previous_page_url": null,
                    "url": "https://numbers.twilio.com/v2/RegulatoryCompliance/SupportingDocumentTypes?PageSize=50&Page=0",
                    "next_page_url": null,
                    "key": "supporting_document_types"
                }
            }
            '
        ));

        $actual = $this->twilio->numbers->v2->regulatoryCompliance
                                            ->supportingDocumentTypes->read();

        $this->assertGreaterThan(0, \count($actual));
    }

    public function testFetchRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->numbers->v2->regulatoryCompliance
                                      ->supportingDocumentTypes("OYXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->fetch();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'get',
            'https://numbers.twilio.com/v2/RegulatoryCompliance/SupportingDocumentTypes/OYXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX'
        ));
    }

    public function testFetchResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "sid": "OYaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "friendly_name": "Passport",
                "machine_name": "passport",
                "fields": [
                    {
                        "friendly_name": "Last Name",
                        "machine_name": "last_name",
                        "constraint": "String"
                    }
                ],
                "url": "https://numbers.twilio.com/v2/RegulatoryCompliance/SupportingDocumentTypes/OYaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
            }
            '
        ));

        $actual = $this->twilio->numbers->v2->regulatoryCompliance
                                            ->supportingDocumentTypes("OYXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->fetch();

        $this->assertNotNull($actual);
    }
}