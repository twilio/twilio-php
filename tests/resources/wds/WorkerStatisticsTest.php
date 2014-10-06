<?php

use \Mockery as m;

class WorkerStatisticsTest extends PHPUnit_Framework_TestCase
{

    function testGet()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/v1/Accounts/AC123/Workspaces/WS123/Statistics/Workers/WK123.json?Minutes=60')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('account_sid' => 'AC123'))
            ));
        $wdsClient = new Wds_Services_Twilio('AC123', '123', 'WS123', 'v1', $http);
        $stats = $wdsClient->getWorkerStatistics('WK123', array('Minutes' => 60));
        $this->assertNotNull($stats);
        $this->assertEquals('AC123', $stats->account_sid);
    }

    function tearDown()
    {
        m::close();
    }
}
