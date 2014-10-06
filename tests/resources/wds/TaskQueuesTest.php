<?php

use \Mockery as m;

class TaskQueuesTest extends PHPUnit_Framework_TestCase
{

    function testCreate()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('post')->once()
            ->with('/v1/Accounts/AC123/Workspaces/WS123/TaskQueues.json',
                array('Content-Type' => 'application/x-www-form-urlencoded'),
                'FriendlyName=Test+Queue&AssignmentActivitySid=WA123&ReservationActivitySid=WR123')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'WQ123'))
            ));
        $wdsClient = new Wds_Services_Twilio('AC123', '123', 'WS123', 'v1', $http);
        $queue = $wdsClient->workspace->task_queues->create('Test Queue', 'WA123', 'WR123');
        $this->assertNotNull($queue);
    }

    function testGet() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/v1/Accounts/AC123/Workspaces/WS123/TaskQueues/WQ123.json')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'WQ123', 'friendly_name' => 'Test Queue'))
            ));
        $wdsClient = new Wds_Services_Twilio('AC123', '123', 'WS123', 'v1', $http);
        $queue = $wdsClient->workspace->task_queues->get('WQ123');
        $this->assertNotNull($queue);
        $this->assertEquals('Test Queue', $queue->friendly_name);
    }

    function tearDown()
    {
        m::close();
    }
}
