<?php

use \Mockery as m;

class TaskQueuesStatisticsTest extends PHPUnit_Framework_TestCase
{

    function testGet()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/v1/Workspaces/WS123/TaskQueues/Statistics?Minutes=60')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('account_sid' => 'AC123'))
            ));
        $taskrouterClient = new TaskRouter_Services_Twilio('AC123', '123', 'WS123', 'v1', $http);
        $stats = $taskrouterClient->getTaskQueuesStatistics(array('Minutes' => 60));
        $this->assertNotNull($stats);
        $this->assertEquals('AC123', $stats->account_sid);
    }

	function testGetViaTaskQueues()
	{
		$http = m::mock(new Services_Twilio_TinyHttp);
		$http->shouldReceive('get')->once()
			->with('/v1/Workspaces/WS123/TaskQueues/Statistics?Page=0&PageSize=50&Minutes=60')
			->andReturn(array(200, array('Content-Type' => 'application/json'),
				json_encode(array(
					'meta' => array('key' => 'task_queues_statistics', 'next_page_url' => null),
					'task_queues_statistics' => array(array('task_queue_sid' => 'WQ123'))
				))
			));
		$taskrouterClient = new TaskRouter_Services_Twilio('AC123', '123', 'WS123', 'v1', $http);
		$stats = $taskrouterClient->workspace->task_queues->statistics->getPage(0, 50, array('Minutes' => 60));
		$this->assertNotNull($stats);
		foreach ($stats->getItems() as $stat) {
			$this->assertEquals('WQ123', $stat->task_queue_sid);
		}
	}

    function tearDown()
    {
        m::close();
    }
}
