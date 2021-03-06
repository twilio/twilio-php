<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Tests\Integration\Messaging\V1\Service;

use Twilio\Exceptions\DeserializeException;
use Twilio\Exceptions\TwilioException;
use Twilio\Http\Response;
use Twilio\Tests\HolodeckTestCase;
use Twilio\Tests\Request;

class UsAppToPersonUsecaseTest extends HolodeckTestCase {
    public function testFetchRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->messaging->v1->services("MGXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                        ->usAppToPersonUsecases->fetch();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'get',
            'https://messaging.twilio.com/v1/Services/MGXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Compliance/Usa2p/Usecases'
        ));
    }

    public function testFetchResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "us_app_to_person_usecases": [
                    {
                        "code": "MARKETING",
                        "name": "Marketing",
                        "description": "Send marketing messages about sales and offers to opted in customers."
                    },
                    {
                        "code": "DELIVERY_NOTIFICATION",
                        "name": "Delivery Notification",
                        "description": "Information about the status of the delivery of a product or service."
                    }
                ]
            }
            '
        ));

        $actual = $this->twilio->messaging->v1->services("MGXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                              ->usAppToPersonUsecases->fetch();

        $this->assertNotNull($actual);
    }
}