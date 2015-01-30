<?php

use \Mockery as m;

class TasksTest extends PHPUnit_Framework_TestCase
{
    function testCreate()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('post')->once()
            ->with('/v1/Accounts/AC123/Workspaces/WS123/Tasks.json',
                array('Content-Type' => 'application/x-www-form-urlencoded'),
                'Attributes=attribute&WorkflowSid=WF123')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'WT123'))
            ));
        $taskrouterClient = new TaskRouter_Services_Twilio('AC123', '123', 'WS123', 'v1', $http);
        $activity = $taskrouterClient->workspace->tasks->create('attribute', 'WF123');
        $this->assertNotNull($activity);
    }

    function testGet() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/v1/Accounts/AC123/Workspaces/WS123/Tasks/WT123.json')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'WT123', 'workflow_sid' => 'WF123'))
            ));
        $taskrouterClient = new TaskRouter_Services_Twilio('AC123', '123', 'WS123', 'v1', $http);
        $task = $taskrouterClient->workspace->tasks->get('WT123');
        $this->assertNotNull($task);
        $this->assertEquals('WF123', $task->workflow_sid);
    }

    function tearDown()
    {
        m::close();
    }
}
