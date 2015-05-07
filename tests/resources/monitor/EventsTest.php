<?php

use \Mockery as m;

class MonitorEventsTest extends PHPUnit_Framework_TestCase
{

    function testGet() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/v1/Events/AE123')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'AE123', 'description' => 'Test'))
            ));
        $monitorClient = new Monitor_Services_Twilio('AC123', '123', 'v1', $http);
        $event = $monitorClient->events->get('AE123');
        $this->assertNotNull($event);
        $this->assertEquals('Test', $event->description);
    }

    function testGetList()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/v1/Events?Page=0&PageSize=50')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array(
                    'meta' => array('key' => 'events', 'next_page_url' => null),
                    'events' => array(array('sid' => 'AE123'))
                ))
            ));
        $monitorClient = new Monitor_Services_Twilio('AC123', '123', 'v1', $http);
        foreach ($monitorClient->events->getIterator(0, 50) as $event) {
            $this->assertEquals('AE123', $event->sid);
        }
    }

    function tearDown()
    {
        m::close();
    }
}
