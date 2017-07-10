<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Tests\Integration\Taskrouter\V1;

use Twilio\Exceptions\DeserializeException;
use Twilio\Exceptions\TwilioException;
use Twilio\Http\Response;
use Twilio\Tests\HolodeckTestCase;
use Twilio\Tests\Request;

class WorkspaceTest extends HolodeckTestCase
{
    public function testFetchRequest()
    {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->taskrouter->v1->workspaces("WSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")->fetch();
        } catch (DeserializeException $e) {
        } catch (TwilioException $e) {
        }

        $this->assertRequest(new Request(
            'get',
            'https://taskrouter.twilio.com/v1/Workspaces/WSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa'
        ));
    }

    public function testFetchResponse()
    {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "date_created": "2016-08-01T22:10:40Z",
                "date_updated": "2016-08-01T22:10:40Z",
                "default_activity_name": "Offline",
                "default_activity_sid": "WAaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "event_callback_url": "",
                "events_filter": null,
                "friendly_name": "new",
                "links": {
                    "activities": "https://taskrouter.twilio.com/v1/Workspaces/WSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Activities",
                    "statistics": "https://taskrouter.twilio.com/v1/Workspaces/WSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Statistics",
                    "task_queues": "https://taskrouter.twilio.com/v1/Workspaces/WSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/TaskQueues",
                    "tasks": "https://taskrouter.twilio.com/v1/Workspaces/WSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Tasks",
                    "workers": "https://taskrouter.twilio.com/v1/Workspaces/WSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Workers",
                    "workflows": "https://taskrouter.twilio.com/v1/Workspaces/WSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Workflows",
                    "task_channels": "https://taskrouter.twilio.com/v1/Workspaces/WSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/TaskChannels",
                    "events": "https://taskrouter.twilio.com/v1/Workspaces/WSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Events"
                },
                "multi_task_enabled": false,
                "prioritize_queue_order": "FIFO",
                "sid": "WSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "timeout_activity_name": "Offline",
                "timeout_activity_sid": "WAaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "url": "https://taskrouter.twilio.com/v1/Workspaces/WSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
            }
            '
        ));

        $actual = $this->twilio->taskrouter->v1->workspaces("WSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")->fetch();

        $this->assertNotNull($actual);
    }

    public function testUpdateRequest()
    {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->taskrouter->v1->workspaces("WSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")->update();
        } catch (DeserializeException $e) {
        } catch (TwilioException $e) {
        }

        $this->assertRequest(new Request(
            'post',
            'https://taskrouter.twilio.com/v1/Workspaces/WSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa'
        ));
    }

    public function testUpdateResponse()
    {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "date_created": "2016-08-01T22:10:40Z",
                "date_updated": "2016-08-01T22:10:40Z",
                "default_activity_name": "Offline",
                "default_activity_sid": "WAaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "event_callback_url": "",
                "events_filter": null,
                "friendly_name": "new",
                "links": {
                    "activities": "https://taskrouter.twilio.com/v1/Workspaces/WSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Activities",
                    "statistics": "https://taskrouter.twilio.com/v1/Workspaces/WSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Statistics",
                    "task_queues": "https://taskrouter.twilio.com/v1/Workspaces/WSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/TaskQueues",
                    "tasks": "https://taskrouter.twilio.com/v1/Workspaces/WSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Tasks",
                    "workers": "https://taskrouter.twilio.com/v1/Workspaces/WSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Workers",
                    "workflows": "https://taskrouter.twilio.com/v1/Workspaces/WSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Workflows",
                    "task_channels": "https://taskrouter.twilio.com/v1/Workspaces/WSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/TaskChannels",
                    "events": "https://taskrouter.twilio.com/v1/Workspaces/WSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Events"
                },
                "multi_task_enabled": false,
                "prioritize_queue_order": "FIFO",
                "sid": "WSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "timeout_activity_name": "Offline",
                "timeout_activity_sid": "WAaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "url": "https://taskrouter.twilio.com/v1/Workspaces/WSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
            }
            '
        ));

        $actual = $this->twilio->taskrouter->v1->workspaces("WSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")->update();

        $this->assertNotNull($actual);
    }

    public function testReadRequest()
    {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->taskrouter->v1->workspaces->read();
        } catch (DeserializeException $e) {
        } catch (TwilioException $e) {
        }

        $this->assertRequest(new Request(
            'get',
            'https://taskrouter.twilio.com/v1/Workspaces'
        ));
    }

    public function testReadFullResponse()
    {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "meta": {
                    "first_page_url": "https://taskrouter.twilio.com/v1/Workspaces?PageSize=50&Page=0",
                    "key": "workspaces",
                    "next_page_url": null,
                    "page": 0,
                    "page_size": 50,
                    "previous_page_url": null,
                    "url": "https://taskrouter.twilio.com/v1/Workspaces?PageSize=50&Page=0"
                },
                "workspaces": [
                    {
                        "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "date_created": "2016-08-01T22:10:40Z",
                        "date_updated": "2016-08-01T22:10:40Z",
                        "default_activity_name": "Offline",
                        "default_activity_sid": "WAaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "event_callback_url": "",
                        "events_filter": null,
                        "friendly_name": "new",
                        "links": {
                            "activities": "https://taskrouter.twilio.com/v1/Workspaces/WSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Activities",
                            "statistics": "https://taskrouter.twilio.com/v1/Workspaces/WSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Statistics",
                            "task_queues": "https://taskrouter.twilio.com/v1/Workspaces/WSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/TaskQueues",
                            "tasks": "https://taskrouter.twilio.com/v1/Workspaces/WSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Tasks",
                            "workers": "https://taskrouter.twilio.com/v1/Workspaces/WSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Workers",
                            "workflows": "https://taskrouter.twilio.com/v1/Workspaces/WSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Workflows",
                            "task_channels": "https://taskrouter.twilio.com/v1/Workspaces/WSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/TaskChannels",
                            "events": "https://taskrouter.twilio.com/v1/Workspaces/WSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Events"
                        },
                        "multi_task_enabled": false,
                        "prioritize_queue_order": "FIFO",
                        "sid": "WSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "timeout_activity_name": "Offline",
                        "timeout_activity_sid": "WAaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                        "url": "https://taskrouter.twilio.com/v1/Workspaces/WSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
                    }
                ]
            }
            '
        ));

        $actual = $this->twilio->taskrouter->v1->workspaces->read();

        $this->assertGreaterThan(0, count($actual));
    }

    public function testReadEmptyResponse()
    {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "meta": {
                    "first_page_url": "https://taskrouter.twilio.com/v1/Workspaces?PageSize=50&Page=0",
                    "key": "workspaces",
                    "next_page_url": null,
                    "page": 0,
                    "page_size": 50,
                    "previous_page_url": null,
                    "url": "https://taskrouter.twilio.com/v1/Workspaces?PageSize=50&Page=0"
                },
                "workspaces": []
            }
            '
        ));

        $actual = $this->twilio->taskrouter->v1->workspaces->read();

        $this->assertNotNull($actual);
    }

    public function testCreateRequest()
    {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->taskrouter->v1->workspaces->create("friendlyName");
        } catch (DeserializeException $e) {
        } catch (TwilioException $e) {
        }

        $values = array(
            'FriendlyName' => "friendlyName",
        );

        $this->assertRequest(new Request(
            'post',
            'https://taskrouter.twilio.com/v1/Workspaces',
            null,
            $values
        ));
    }

    public function testCreateResponse()
    {
        $this->holodeck->mock(new Response(
            201,
            '
            {
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "date_created": "2016-08-01T22:10:40Z",
                "date_updated": "2016-08-01T22:10:40Z",
                "default_activity_name": "Offline",
                "default_activity_sid": "WAaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "event_callback_url": "",
                "events_filter": null,
                "friendly_name": "new",
                "links": {
                    "activities": "https://taskrouter.twilio.com/v1/Workspaces/WSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Activities",
                    "statistics": "https://taskrouter.twilio.com/v1/Workspaces/WSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Statistics",
                    "task_queues": "https://taskrouter.twilio.com/v1/Workspaces/WSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/TaskQueues",
                    "tasks": "https://taskrouter.twilio.com/v1/Workspaces/WSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Tasks",
                    "workers": "https://taskrouter.twilio.com/v1/Workspaces/WSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Workers",
                    "workflows": "https://taskrouter.twilio.com/v1/Workspaces/WSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Workflows",
                    "task_channels": "https://taskrouter.twilio.com/v1/Workspaces/WSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/TaskChannels",
                    "events": "https://taskrouter.twilio.com/v1/Workspaces/WSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Events"
                },
                "multi_task_enabled": false,
                "prioritize_queue_order": "FIFO",
                "sid": "WSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "timeout_activity_name": "Offline",
                "timeout_activity_sid": "WAaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "url": "https://taskrouter.twilio.com/v1/Workspaces/WSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
            }
            '
        ));

        $actual = $this->twilio->taskrouter->v1->workspaces->create("friendlyName");

        $this->assertNotNull($actual);
    }

    public function testDeleteRequest()
    {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->taskrouter->v1->workspaces("WSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")->delete();
        } catch (DeserializeException $e) {
        } catch (TwilioException $e) {
        }

        $this->assertRequest(new Request(
            'delete',
            'https://taskrouter.twilio.com/v1/Workspaces/WSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa'
        ));
    }

    public function testDeleteResponse()
    {
        $this->holodeck->mock(new Response(
            204,
            null
        ));

        $actual = $this->twilio->taskrouter->v1->workspaces("WSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa")->delete();

        $this->assertTrue($actual);
    }
}
