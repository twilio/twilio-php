<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Tests\Integration\Video\V1;

use Twilio\Exceptions\DeserializeException;
use Twilio\Exceptions\TwilioException;
use Twilio\Http\Response;
use Twilio\Tests\HolodeckTestCase;
use Twilio\Tests\Request;

class RecordingSettingsTest extends HolodeckTestCase {
    public function testFetchRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->video->v1->recordingSettings()->fetch();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'get',
            'https://video.twilio.com/v1/RecordingSettings/Default'
        ));
    }

    public function testFetchResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "friendly_name": "string",
                "aws_credentials_sid": "CRaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "encryption_key_sid": "CRaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "aws_s3_url": "https://www.twilio.com",
                "aws_storage_enabled": true,
                "encryption_enabled": true,
                "url": "https://video.twilio.com/v1/RecordingSettings/Default"
            }
            '
        ));

        $actual = $this->twilio->video->v1->recordingSettings()->fetch();

        $this->assertNotNull($actual);
    }

    public function testCreateRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->video->v1->recordingSettings()->create("friendly_name");
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $values = ['FriendlyName' => "friendly_name", ];

        $this->assertRequest(new Request(
            'post',
            'https://video.twilio.com/v1/RecordingSettings/Default',
            [],
            $values
        ));
    }

    public function testCreateResponse(): void {
        $this->holodeck->mock(new Response(
            201,
            '
            {
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "friendly_name": "friendly_name",
                "aws_credentials_sid": "CRaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "encryption_key_sid": "CRaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "aws_s3_url": "https://www.twilio.com",
                "aws_storage_enabled": true,
                "encryption_enabled": true,
                "url": "https://video.twilio.com/v1/RecordingSettings/Default"
            }
            '
        ));

        $actual = $this->twilio->video->v1->recordingSettings()->create("friendly_name");

        $this->assertNotNull($actual);
    }
}