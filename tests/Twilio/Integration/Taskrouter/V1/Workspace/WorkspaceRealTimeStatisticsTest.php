<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Tests\Integration\Taskrouter\V1\Workspace;

use Twilio\Exceptions\DeserializeException;
use Twilio\Exceptions\TwilioException;
use Twilio\Http\Response;
use Twilio\Tests\HolodeckTestCase;
use Twilio\Tests\Request;

class WorkspaceRealTimeStatisticsTest extends HolodeckTestCase {
    public function testFetchRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->taskrouter->v1->workspaces("WSXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                         ->realTimeStatistics()->fetch();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'get',
            'https://taskrouter.twilio.com/v1/Workspaces/WSXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/RealTimeStatistics',
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
                "url": "https://taskrouter.twilio.com/v1/Workspaces/WSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/RealTimeStatistics",
                "tasks_by_priority": {},
                "activity_statistics": [
                    {
                        "friendly_name": "Idle",
                        "workers": 0,
                        "sid": "WAaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
                    },
                    {
                        "friendly_name": "Busy",
                        "workers": 9,
                        "sid": "WAaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
                    },
                    {
                        "friendly_name": "Offline",
                        "workers": 6,
                        "sid": "WAaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
                    },
                    {
                        "friendly_name": "Reserved",
                        "workers": 0,
                        "sid": "WAaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa"
                    }
                ],
                "workspace_sid": "WSaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "longest_task_waiting_age": 100,
                "longest_task_waiting_sid": "WTaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "total_workers": 100,
                "total_tasks": 100,
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "tasks_by_status": {}
            }
            '
        ));

        $actual = $this->twilio->taskrouter->v1->workspaces("WSXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                               ->realTimeStatistics()->fetch();

        $this->assertNotNull($actual);
    }
}