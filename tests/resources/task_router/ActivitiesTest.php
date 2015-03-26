<?php

use \Mockery as m;

class ActivitiesTest extends PHPUnit_Framework_TestCase
{
    function testCreate()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('post')->once()
            ->with('/v1/Workspaces/WS123/Activities',
                array('Content-Type' => 'application/x-www-form-urlencoded'),
                'FriendlyName=Test+Activity&Available=1')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'WA123'))
            ));
        $taskrouterClient = new TaskRouter_Services_Twilio('AC123', '123', 'WS123', 'v1', $http);
        $activity = $taskrouterClient->workspace->activities->create('Test Activity', true);
        $this->assertNotNull($activity);
    }

    function testGet()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/v1/Workspaces/WS123/Activities/WA123')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'WA123', 'friendly_name' => 'Test Activity'))
            ));
        $taskrouterClient = new TaskRouter_Services_Twilio('AC123', '123', 'WS123', 'v1', $http);
        $activity = $taskrouterClient->workspace->activities->get('WA123');
        $this->assertNotNull($activity);
        $this->assertEquals('Test Activity', $activity->friendly_name);
    }

	function testGetPage() {
		$http = m::mock(new Services_Twilio_TinyHttp);
		$http->shouldReceive('get')->once()
			->with('/v1/Workspaces/WS123/Activities?Page=0&PageSize=50')
			->andReturn(array(200, array('Content-Type' => 'application/json'),
							json_encode(array(
								'meta' => array('key' => 'activities', 'next_page_url' => null),
								'activities' => array(array('sid' => 'WA123', 'friendly_name' => 'Test Activity'))
			))));
		$taskrouterClient = new TaskRouter_Services_Twilio('AC123', '123', 'WS123', 'v1', $http);
		$activities = $taskrouterClient->workspace->activities->getPage();
		$activityItems = $activities->getItems();
		$this->assertNotNull($activities);
		$this->assertEquals('Test Activity', $activityItems[0]->friendly_name);
	}

    function tearDown()
    {
        m::close();
    }
}
