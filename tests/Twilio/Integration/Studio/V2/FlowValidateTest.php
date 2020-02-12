<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Tests\Integration\Studio\V2;

use Twilio\Exceptions\DeserializeException;
use Twilio\Exceptions\TwilioException;
use Twilio\Http\Response;
use Twilio\Serialize;
use Twilio\Tests\HolodeckTestCase;
use Twilio\Tests\Request;

class FlowValidateTest extends HolodeckTestCase {
    public function testUpdateRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->studio->v2->flowValid->update("friendly_name", "draft", []);
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $values = [
            'FriendlyName' => "friendly_name",
            'Status' => "draft",
            'Definition' => Serialize::jsonObject([]),
        ];

        $this->assertRequest(new Request(
            'post',
            'https://studio.twilio.com/v2/Flows/Validate',
            null,
            $values
        ));
    }

    public function testUpdateResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "valid": true
            }
            '
        ));

        $actual = $this->twilio->studio->v2->flowValid->update("friendly_name", "draft", []);

        $this->assertNotNull($actual);
    }
}