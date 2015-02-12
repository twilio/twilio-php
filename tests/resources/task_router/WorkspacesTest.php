<?php

use \Mockery as m;

class WorkspacesTest extends PHPUnit_Framework_TestCase
{

    function testCreate()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('post')->once()
            ->with('/v1/Workspaces',
                array('Content-Type' => 'application/x-www-form-urlencoded'),
                'FriendlyName=Test+Workspace')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'WS123'))
            ));
        $taskrouterClient = new TaskRouter_Services_Twilio('AC123', '123', 'WS123', 'v1', $http);
        $workspace = $taskrouterClient->workspaces->create('Test Workspace');
        $this->assertNotNull($workspace);
    }

    function testGetList()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/v1/Workspaces?Page=0&PageSize=50')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array(
                    'meta' => array('key' => 'workspaces', 'next_page_url' => null),
                    'workspaces' => array(array('sid' => 'WS123'))
                ))
            ));
        $taskrouterClient = new TaskRouter_Services_Twilio('AC123', '123', 'WS123', 'v1', $http);
        $this->assertNotNull($taskrouterClient->workspaces);
        foreach ($taskrouterClient->workspaces->getIterator(0, 50) as $workspace) {
            $this->assertEquals('WS123', $workspace->sid);
        }
    }

    function tearDown()
    {
        m::close();
    }
}
