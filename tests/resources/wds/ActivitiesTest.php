<?php

use \Mockery as m;

class ActivitiesTest extends PHPUnit_Framework_TestCase
{
    function testCreate()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('post')->once()
            ->with('/v1/Accounts/AC123/Workspaces/WS123/Activities.json',
                array('Content-Type' => 'application/x-www-form-urlencoded'),
                'FriendlyName=Test+Activity&Available=1')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'WA123'))
            ));
        $wdsClient = new Wds_Services_Twilio('AC123', '123', 'WS123', 'v1', $http);
        $activity = $wdsClient->workspace->activities->create('Test Activity', true);
        $this->assertNotNull($activity);
    }

    function testGet()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/v1/Accounts/AC123/Workspaces/WS123/Activities/WA123.json')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'WA123', 'friendly_name' => 'Test Activity'))
            ));
        $wdsClient = new Wds_Services_Twilio('AC123', '123', 'WS123', 'v1', $http);
        $activity = $wdsClient->workspace->activities->get('WA123');
        $this->assertNotNull($activity);
        $this->assertEquals('Test Activity', $activity->friendly_name);
    }

    function tearDown()
    {
        m::close();
    }
}
