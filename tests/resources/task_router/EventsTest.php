<?php

use \Mockery as m;

class EventsTest extends PHPUnit_Framework_TestCase
{

    function testGet() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/v1/Accounts/AC123/Workspaces/WS123/Events/EV123.json')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'EV123', 'description' => 'Test Worker'))
            ));
        $taskrouterClient = new TaskRouter_Services_Twilio('AC123', '123', 'WS123', 'v1', $http);
        $worker = $taskrouterClient->workspace->events->get('EV123');
        $this->assertNotNull($worker);
        $this->assertEquals('Test Worker', $worker->description);
    }

    function testGetList()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/v1/Accounts/AC123/Workspaces/WS123/Events.json?Page=0&PageSize=50')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array(
                    'meta' => array('key' => 'events'),
                    'events' => array(array('sid' => 'EV123'))
                ))
            ));
        $http->shouldReceive('get')->once()
            ->with('/v1/Accounts/AC123/Workspaces/WS123/Events.json?Page=1&PageSize=50')
            ->andReturn(array(400, array('Content-Type' => 'application/json'),
                '{"status":400,"message":"foo", "code": "20006"}'
            ));
        $taskrouterClient = new TaskRouter_Services_Twilio('AC123', '123', 'WS123', 'v1', $http);
        foreach ($taskrouterClient->workspace->events->getIterator(0, 50) as $event) {
            $this->assertEquals('EV123', $event->sid);
        }
    }

    function tearDown()
    {
        m::close();
    }
}
