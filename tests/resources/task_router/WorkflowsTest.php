<?php

use \Mockery as m;

class WorkflowsTest extends PHPUnit_Framework_TestCase
{
    function testCreate()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('post')->once()
            ->with('/v1/Workspaces/WS123/Workflows',
                array('Content-Type' => 'application/x-www-form-urlencoded'),
                'FriendlyName=Test+Workflow&Configuration=configuration&AssignmentCallbackUrl=http%3A%2F%2Fwww.example.com')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'WF123'))
            ));
        $taskrouterClient = new TaskRouter_Services_Twilio('AC123', '123', 'WS123', 'v1', $http);
        $workflow = $taskrouterClient->workspace->workflows->create('Test Workflow', 'configuration', 'http://www.example.com');
        $this->assertNotNull($workflow);
    }

    function testGet()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/v1/Workspaces/WS123/Workflows/WF123')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'WF123', 'friendly_name' => 'Test Workflow'))
            ));
        $taskrouterClient = new TaskRouter_Services_Twilio('AC123', '123', 'WS123', 'v1', $http);
        $workflow = $taskrouterClient->workspace->workflows->get('WF123');
        $this->assertNotNull($workflow);
        $this->assertEquals('Test Workflow', $workflow->friendly_name);
    }

    function tearDown()
    {
        m::close();
    }
}
