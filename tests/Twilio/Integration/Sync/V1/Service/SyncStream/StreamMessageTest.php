<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Tests\Integration\Sync\V1\Service\SyncStream;

use Twilio\Exceptions\DeserializeException;
use Twilio\Exceptions\TwilioException;
use Twilio\Http\Response;
use Twilio\Serialize;
use Twilio\Tests\HolodeckTestCase;
use Twilio\Tests\Request;

class StreamMessageTest extends HolodeckTestCase {
    public function testCreateRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->sync->v1->services("ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                   ->syncStreams("TOXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                   ->streamMessages->create([]);
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $values = ['Data' => Serialize::jsonObject([]), ];

        $this->assertRequest(new Request(
            'post',
            'https://sync.twilio.com/v1/Services/ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Streams/TOXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Messages',
            null,
            $values
        ));
    }

    public function testCreateResponse(): void {
        $this->holodeck->mock(new Response(
            201,
            '
            {
                "sid": "TZaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "data": {}
            }
            '
        ));

        $actual = $this->twilio->sync->v1->services("ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                         ->syncStreams("TOXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                         ->streamMessages->create([]);

        $this->assertNotNull($actual);
    }
}