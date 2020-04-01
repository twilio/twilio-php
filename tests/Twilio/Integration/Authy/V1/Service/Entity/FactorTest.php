<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Tests\Integration\Authy\V1\Service\Entity;

use Twilio\Exceptions\DeserializeException;
use Twilio\Exceptions\TwilioException;
use Twilio\Http\Response;
use Twilio\Tests\HolodeckTestCase;
use Twilio\Tests\Request;

class FactorTest extends HolodeckTestCase {
    public function testCreateRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        $options = [
            'twilioAuthySandboxMode' => "twilio_authy_sandbox_mode",
            'authorization' => "authorization",
        ];

        try {
            $this->twilio->authy->v1->services("ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                    ->entities("identity")
                                    ->factors->create("binding", "friendly_name", "app-push", "config", $options);
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $values = [
            'Binding' => "binding",
            'FriendlyName' => "friendly_name",
            'FactorType' => "app-push",
            'Config' => "config",
        ];

        $headers = [
            'Twilio-Authy-Sandbox-Mode' => "twilio_authy_sandbox_mode",
            'Authorization' => "authorization",
        ];

        $this->assertRequest(new Request(
            'post',
            'https://authy.twilio.com/v1/Services/ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Entities/identity/Factors',
            [],
            $values,
            $headers
        ));
    }

    public function testCreateResponse(): void {
        $this->holodeck->mock(new Response(
            201,
            '
            {
                "sid": "YFaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "service_sid": "ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "entity_sid": "YEaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "identity": "ff483d1ff591898a9942916050d2ca3f",
                "date_created": "2015-07-30T20:00:00Z",
                "date_updated": "2015-07-30T20:00:00Z",
                "friendly_name": "friendly_name",
                "status": "unverified",
                "factor_type": "push",
                "config": {
                    "sdk_version": "1.0",
                    "app_id": "com.authy.authy",
                    "notification_platform": "fcm",
                    "notification_token": "test_token"
                },
                "url": "https://authy.twilio.com/v1/Services/ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Entities/ff483d1ff591898a9942916050d2ca3f/Factors/YFaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "links": {
                    "challenges": "https://authy.twilio.com/v1/Services/ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Entities/ff483d1ff591898a9942916050d2ca3f/Factors/YFaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Challenges"
                }
            }
            '
        ));

        $actual = $this->twilio->authy->v1->services("ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                          ->entities("identity")
                                          ->factors->create("binding", "friendly_name", "app-push", "config");

        $this->assertNotNull($actual);
    }

    public function testDeleteRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        $options = ['twilioAuthySandboxMode' => "twilio_authy_sandbox_mode", ];

        try {
            $this->twilio->authy->v1->services("ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                    ->entities("identity")
                                    ->factors("YFXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->delete($options);
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $headers = ['Twilio-Authy-Sandbox-Mode' => "twilio_authy_sandbox_mode", ];

        $this->assertRequest(new Request(
            'delete',
            'https://authy.twilio.com/v1/Services/ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Entities/identity/Factors/YFXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX',
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

        $actual = $this->twilio->authy->v1->services("ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                          ->entities("identity")
                                          ->factors("YFXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->delete();

        $this->assertTrue($actual);
    }

    public function testFetchRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        $options = ['twilioAuthySandboxMode' => "twilio_authy_sandbox_mode", ];

        try {
            $this->twilio->authy->v1->services("ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                    ->entities("identity")
                                    ->factors("YFXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->fetch($options);
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $headers = ['Twilio-Authy-Sandbox-Mode' => "twilio_authy_sandbox_mode", ];

        $this->assertRequest(new Request(
            'get',
            'https://authy.twilio.com/v1/Services/ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Entities/identity/Factors/YFXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX',
            [],
            [],
            $headers
        ));
    }

    public function testFetchResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "sid": "YFaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "service_sid": "ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "entity_sid": "YEaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "identity": "ff483d1ff591898a9942916050d2ca3f",
                "date_created": "2015-07-30T20:00:00Z",
                "date_updated": "2015-07-30T20:00:00Z",
                "friendly_name": "friendly_name",
                "status": "unverified",
                "factor_type": "push",
                "config": {
                    "sdk_version": "1.0",
                    "app_id": "com.authy.authy",
                    "notification_platform": "fcm",
                    "notification_token": "test_token"
                },
                "url": "https://authy.twilio.com/v1/Services/ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Entities/ff483d1ff591898a9942916050d2ca3f/Factors/YFaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "links": {
                    "challenges": "https://authy.twilio.com/v1/Services/ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Entities/ff483d1ff591898a9942916050d2ca3f/Factors/YFaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Challenges"
                }
            }
            '
        ));

        $actual = $this->twilio->authy->v1->services("ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                          ->entities("identity")
                                          ->factors("YFXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->fetch();

        $this->assertNotNull($actual);
    }

    public function testReadRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        $options = ['twilioAuthySandboxMode' => "twilio_authy_sandbox_mode", ];

        try {
            $this->twilio->authy->v1->services("ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                    ->entities("identity")
                                    ->factors->read($options);
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $headers = ['Twilio-Authy-Sandbox-Mode' => "twilio_authy_sandbox_mode", ];

        $this->assertRequest(new Request(
            'get',
            'https://authy.twilio.com/v1/Services/ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Entities/identity/Factors',
            [],
            [],
            $headers
        ));
    }

    public function testReadEmptyResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "factors": [],
                "meta": {
                    "page": 0,
                    "page_size": 50,
                    "first_page_url": "https://authy.twilio.com/v1/Services/ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Entities/ff483d1ff591898a9942916050d2ca3f/Factors?PageSize=50&Page=0",
                    "previous_page_url": null,
                    "url": "https://authy.twilio.com/v1/Services/ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Entities/ff483d1ff591898a9942916050d2ca3f/Factors?PageSize=50&Page=0",
                    "next_page_url": null,
                    "key": "factors"
                }
            }
            '
        ));

        $actual = $this->twilio->authy->v1->services("ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                          ->entities("identity")
                                          ->factors->read();

        $this->assertNotNull($actual);
    }

    public function testReadFullResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "factors": [
                    {
                        "sid": "YFaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "service_sid": "ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "entity_sid": "YEaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "identity": "ff483d1ff591898a9942916050d2ca3f",
                        "date_created": "2015-07-30T20:00:00Z",
                        "date_updated": "2015-07-30T20:00:00Z",
                        "friendly_name": "friendly_name",
                        "status": "unverified",
                        "factor_type": "push",
                        "config": {
                            "sdk_version": "1.0",
                            "app_id": "com.authy.authy",
                            "notification_platform": "fcm",
                            "notification_token": "test_token"
                        },
                        "url": "https://authy.twilio.com/v1/Services/ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Entities/ff483d1ff591898a9942916050d2ca3f/Factors/YFaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "links": {
                            "challenges": "https://authy.twilio.com/v1/Services/ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Entities/ff483d1ff591898a9942916050d2ca3f/Factors/YFaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Challenges"
                        }
                    }
                ],
                "meta": {
                    "page": 0,
                    "page_size": 50,
                    "first_page_url": "https://authy.twilio.com/v1/Services/ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Entities/ff483d1ff591898a9942916050d2ca3f/Factors?PageSize=50&Page=0",
                    "previous_page_url": null,
                    "url": "https://authy.twilio.com/v1/Services/ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Entities/ff483d1ff591898a9942916050d2ca3f/Factors?PageSize=50&Page=0",
                    "next_page_url": null,
                    "key": "factors"
                }
            }
            '
        ));

        $actual = $this->twilio->authy->v1->services("ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                          ->entities("identity")
                                          ->factors->read();

        $this->assertGreaterThan(0, \count($actual));
    }

    public function testUpdateRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        $options = ['twilioAuthySandboxMode' => "twilio_authy_sandbox_mode", ];

        try {
            $this->twilio->authy->v1->services("ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                    ->entities("identity")
                                    ->factors("YFXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->update($options);
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $headers = ['Twilio-Authy-Sandbox-Mode' => "twilio_authy_sandbox_mode", ];

        $this->assertRequest(new Request(
            'post',
            'https://authy.twilio.com/v1/Services/ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Entities/identity/Factors/YFXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX',
            [],
            [],
            $headers
        ));
    }

    public function testVerifyResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "sid": "YFaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "service_sid": "ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "entity_sid": "YEaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "identity": "ff483d1ff591898a9942916050d2ca3f",
                "date_created": "2015-07-30T20:00:00Z",
                "date_updated": "2015-07-30T20:00:00Z",
                "friendly_name": "friendly_name",
                "status": "verified",
                "factor_type": "push",
                "config": {
                    "sdk_version": "1.0",
                    "app_id": "com.authy.authy",
                    "notification_platform": "fcm",
                    "notification_token": "test_token"
                },
                "url": "https://authy.twilio.com/v1/Services/ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Entities/ff483d1ff591898a9942916050d2ca3f/Factors/YFaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "links": {
                    "challenges": "https://authy.twilio.com/v1/Services/ISaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Entities/ff483d1ff591898a9942916050d2ca3f/Factors/YFaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Challenges"
                }
            }
            '
        ));

        $actual = $this->twilio->authy->v1->services("ISXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                          ->entities("identity")
                                          ->factors("YFXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")->update();

        $this->assertNotNull($actual);
    }
}