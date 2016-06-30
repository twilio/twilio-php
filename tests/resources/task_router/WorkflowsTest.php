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

    function testCreateWithBuilder()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $config = '%7B%22task_routing%22%3A%7B%22filters%22%3A%5B%7B%22expression%22%3A%22type%3D%3D%27sales%27%22%2C%22targets%22%3A%5B%7B%22queue%22%3A%22WQ1%22%7D%5D%2C%22friendly_name%22%3A%22Sales%22%7D%2C%7B%22expression%22%3A%22type%3D%3D%27marketing%27%22%2C%22targets%22%3A%5B%7B%22queue%22%3A%22WQ2%22%7D%5D%2C%22friendly_name%22%3A%22Marketing%22%7D%2C%7B%22expression%22%3A%22type%3D%3D%27support%27%22%2C%22targets%22%3A%5B%7B%22queue%22%3A%22WQ3%22%7D%5D%2C%22friendly_name%22%3A%22Support%22%7D%5D%2C%22default_filter%22%3A%7B%22queue%22%3A%22WQ4%22%7D%7D%7D';
        $http->shouldReceive('post')->once()
            ->with('/v1/Workspaces/WS123/Workflows',
                array('Content-Type' => 'application/x-www-form-urlencoded'),
                'FriendlyName=TestWorkflow&'+
                'Configuration='.$config.'&'+
                'AssignmentCallbackUrl=http%3A%2F%2Fwww.example.com&'+
                'FallbackAssignmentCallbackUrl=http%3A%2F%2Fwww.example2.com&'+
                'TaskReservationTimeout=30')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'WF123'))
            ));
        $taskrouterClient = new TaskRouter_Services_Twilio('AC123', '123', 'WS123', 'v1', $http);

        $salesQueue = "WQ1";
        $marketingQueue = "WQ2";
        $supportQueue = "WQ3";
        $everyoneQueue = "WQ4";

        $defaultTarget = new Services_Twilio_TaskRouter_WorkflowRuleTarget($everyoneQueue);

        $salesTargets = array();
        $salesTarget = new Services_Twilio_TaskRouter_WorkflowRuleTarget($salesQueue);
        $salesTargets[] = $salesTarget;
        $salesRule = new Services_Twilio_TaskRouter_WorkflowRule("type=='sales'", $salesTargets, 'Sales');

        $marketingTargets = array();
        $marketingTarget = new Services_Twilio_TaskRouter_WorkflowRuleTarget($marketingQueue);
        $marketingTargets[] = $marketingTarget;
        $marketingRule = new Services_Twilio_TaskRouter_WorkflowRule("type=='marketing'", $marketingTargets, 'Marketing');

        $supportTargets = array();
        $supportTarget = new Services_Twilio_TaskRouter_WorkflowRuleTarget($supportQueue);
        $supportTargets[] = $supportTarget;
        $supportRule = new Services_Twilio_TaskRouter_WorkflowRule("type=='support'", $supportTargets, 'Support');

        $rules[] = $salesRule;
        $rules[] = $marketingRule;
        $rules[] = $supportRule;

        $configuration = new Services_Twilio_TaskRouter_WorkflowConfiguration($rules, $defaultTarget);
        $json = $configuration->toJSON();
        $this->assertNotNull($json);

        $expectedJson = "{
           \"task_routing\":{
              \"filters\":[
                 {
                    \"expression\":\"type=='sales'\",
                    \"targets\":[
                       {
                          \"queue\":\"WQ1\"
                       }
                    ],
                    \"friendly_name\":\"Sales\"
                 },
                 {
                    \"expression\":\"type=='marketing'\",
                    \"targets\":[
                       {
                          \"queue\":\"WQ2\"
                       }
                    ],
                    \"friendly_name\":\"Marketing\"
                 },
                 {
                    \"expression\":\"type=='support'\",
                    \"targets\":[
                       {
                          \"queue\":\"WQ3\"
                       }
                    ],
                    \"friendly_name\":\"Support\"
                 }
              ],
              \"default_filter\":{
                 \"queue\":\"WQ4\"
              }
           }
        }";

        $noWhitespaceJson = preg_replace('/\s+/', '', $expectedJson);
        $expectedNoWhitespaceJson = "{\"task_routing\":{\"filters\":[{\"expression\":\"type=='sales'\",\"targets\":[{\"queue\":\"WQ1\"}],\"friendly_name\":\"Sales\"},{\"expression\":\"type=='marketing'\",\"targets\":[{\"queue\":\"WQ2\"}],\"friendly_name\":\"Marketing\"},{\"expression\":\"type=='support'\",\"targets\":[{\"queue\":\"WQ3\"}],\"friendly_name\":\"Support\"}],\"default_filter\":{\"queue\":\"WQ4\"}}}";
        $this->assertEquals($expectedNoWhitespaceJson, $noWhitespaceJson);
        $this->assertEquals($noWhitespaceJson, $json);

        $params = array();
        $params["FallbackAssignmentCallbackUrl"] = "http://example2.com";
        $params["TaskReservationTimeout"] = 30;

        $workflow = $taskrouterClient->workspace->workflows->create("TestWorkflow", $json, "http://example.com", $params);
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
