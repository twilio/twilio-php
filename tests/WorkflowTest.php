<?php

require_once 'Twilio/WorkflowConfiguration.php';

class WorkflowTest extends PHPUnit_Framework_TestCase
{

	public function testDefaultRuleTarget()
	{
		$everyoneQueue = "WQf6724bd5005b30eeb6ea990c3e59e536";
		$defaultTarget = new WorkflowRuleTarget($everyoneQueue);
		$this->assertEquals($defaultTarget->queue, "WQf6724bd5005b30eeb6ea990c3e59e536");
		$this->assertEquals($defaultTarget->priority, null);
		$this->assertEquals($defaultTarget->timeout, null);
		$this->assertEquals($defaultTarget->expression, null);
	}

	public function testSimpleRuleTarget()
	{
		$everyoneQueue = "WQf6724bd5005b30eeb6ea990c3e59e536";
		$priority = 10;
		$timeout = 60;
		$filterWorkerExpression = null;
		$ruleTarget = new WorkflowRuleTarget($everyoneQueue, $priority, $timeout, $filterWorkerExpression);
		$this->assertEquals($ruleTarget->queue, "WQf6724bd5005b30eeb6ea990c3e59e536");
		$this->assertEquals($ruleTarget->priority, $priority);
		$this->assertEquals($ruleTarget->timeout, $timeout);
		$this->assertEquals($ruleTarget->expression, $filterWorkerExpression);
	}

	public function testFilterWorkerRuleTarget()
	{
		$everyoneQueue = "WQf6724bd5005b30eeb6ea990c3e59e536";
		$priority = 10;
		$timeout = 60;
		$filterWorkerExpression = "task.language IN worker.languages";
		$ruleTarget = new WorkflowRuleTarget($everyoneQueue, $priority, $timeout, $filterWorkerExpression);
		$this->assertEquals($ruleTarget->queue, "WQf6724bd5005b30eeb6ea990c3e59e536");
		$this->assertEquals($ruleTarget->priority, $priority);
		$this->assertEquals($ruleTarget->timeout, $timeout);
		$this->assertEquals($ruleTarget->expression, $filterWorkerExpression);
	}

	public function testSimpleRule()
	{
		$salesQueue = "WQf6724bd5005b30eeb6ea990c3e59e536";
		$salesTarget = new WorkflowRuleTarget($salesQueue);
		$expression = "type=='sales'";
		$friendlyName = "Sales";
		$salesTargets[] = $salesTarget;
		$salesRule = new WorkflowRule($expression, $salesTargets, $friendlyName);
		$this->assertEquals($salesRule->expression, $expression);
		$this->assertEquals($salesRule->friendly_name, $friendlyName);
		$this->assertEquals($salesRule->targets[0], $salesTarget);
	}

	public function testFullWorkflow()
	{
		$salesQueue = "WQf6724bd5005b30eeb6ea990c3e59e536";
		$marketingQueue = "WQ8c62f84b61ccfa6a333757cd508f0aae";
		$supportQueue = "WQ5940dc0da87eaf6e3321d62041d4403b";
		$everyoneQueue = "WQ6d29383312b24bd898a8df32779fc043";

		$defaultTarget = new WorkflowRuleTarget($everyoneQueue);

		$salesTargets = array();
		$salesTarget = new WorkflowRuleTarget($salesQueue);
		$salesTargets[] = $salesTarget;
		$salesRule = new WorkflowRule("type=='sales'", $salesTargets, 'Sales');

		$marketingTargets = array();
		$marketingTarget = new WorkflowRuleTarget($marketingQueue);
		$marketingTargets[] = $marketingTarget;
		$marketingRule = new WorkflowRule("type=='marketing'", $marketingTargets, 'Marketing');

		$supportTargets = array();
		$supportTarget = new WorkflowRuleTarget($supportQueue);
		$supportTargets[] = $supportTarget;
		$supportRule = new WorkflowRule("type=='support'", $supportTargets, 'Support');

		$rules[] = $salesRule;
		$rules[] = $marketingRule;
		$rules[] = $supportRule;

		$configuration = new WorkflowConfiguration($rules, $defaultTarget);
		$json = $configuration->toJSON();

		$expectedJsonString = "{
				\"task_routing\":{
				  \"filters\":[
					 {
						\"expression\":\"type=='sales'\",
						\"targets\":[
						   {
							  \"queue\":\"WQf6724bd5005b30eeb6ea990c3e59e536\"
						   }
						],
						\"friendly_name\":\"Sales\"
					 },
					 {
						\"expression\":\"type=='marketing'\",
						\"targets\":[
						   {
							  \"queue\":\"WQ8c62f84b61ccfa6a333757cd508f0aae\"
						   }
						],
						\"friendly_name\":\"Marketing\"
					 },
					 {
						\"expression\":\"type=='support'\",
						\"targets\":[
						   {
							  \"queue\":\"WQ5940dc0da87eaf6e3321d62041d4403b\"
						   }
						],
						\"friendly_name\":\"Support\"
					 }
				  ],
				  \"default_filter\":{
					 \"queue\":\"WQ6d29383312b24bd898a8df32779fc043\"
				  }
				}
			}";

		// getting a trimmed, simple string
		$jsonObject = json_decode($expectedJsonString);
		$expectedJson = json_encode($jsonObject);

		$this->assertEquals($json, $expectedJson);
	}

	public function testFullWorkflowWithTimeouts()
	{
		$salesQueue = "WQf6724bd5005b30eeb6ea990c3e59e536";
		$marketingQueue = "WQ8c62f84b61ccfa6a333757cd508f0aae";
		$supportQueue = "WQ5940dc0da87eaf6e3321d62041d4403b";
		$everyoneQueue = "WQ6d29383312b24bd898a8df32779fc043";

		$defaultTarget = new WorkflowRuleTarget($everyoneQueue);

		$salesTargets = array();
		$salesTarget1 = new WorkflowRuleTarget($salesQueue, 5, 30);
		$salesTarget2 = new WorkflowRuleTarget($salesQueue, 10);
		$salesTargets[] = $salesTarget1;
		$salesTargets[] = $salesTarget2;
		$salesRule = new WorkflowRule("type=='sales'", $salesTargets, 'Sales');

		$marketingTargets = array();
		$marketingTarget1 = new WorkflowRuleTarget($marketingQueue, 1, 120);
		$marketingTarget2 = new WorkflowRuleTarget($marketingQueue, 3);
		$marketingTargets[] = $marketingTarget1;
		$marketingTargets[] = $marketingTarget2;
		$marketingRule = new WorkflowRule("type=='marketing'", $marketingTargets, 'Marketing');

		$supportTargets = array();
		$supportTarget1 = new WorkflowRuleTarget($supportQueue, 10, 30);
		$supportTarget2 = new WorkflowRuleTarget($supportQueue, 15);
		$supportTargets[] = $supportTarget1;
		$supportTargets[] = $supportTarget2;
		$supportRule = new WorkflowRule("type=='support'", $supportTargets, 'Support');

		$rules[] = $salesRule;
		$rules[] = $marketingRule;
		$rules[] = $supportRule;

		$configuration = new WorkflowConfiguration($rules, $defaultTarget);
		$json = $configuration->toJSON();

		$expectedJsonString = "{
				\"task_routing\":{
				  \"filters\":[
					 {
						\"expression\":\"type=='sales'\",
						\"targets\":[
						   {
							  \"queue\":\"WQf6724bd5005b30eeb6ea990c3e59e536\",
							  \"priority\": 5,
							  \"timeout\": 30
						   },
						   {
							  \"queue\":\"WQf6724bd5005b30eeb6ea990c3e59e536\",
							  \"priority\": 10
						   }
						],
						\"friendly_name\":\"Sales\"
					 },
					 {
						\"expression\":\"type=='marketing'\",
						\"targets\":[
						   {
							  \"queue\":\"WQ8c62f84b61ccfa6a333757cd508f0aae\",
							  \"priority\": 1,
							  \"timeout\": 120
						   },
						   {
							  \"queue\":\"WQ8c62f84b61ccfa6a333757cd508f0aae\",
							  \"priority\": 3
						   }
						],
						\"friendly_name\":\"Marketing\"
					 },
					 {
						\"expression\":\"type=='support'\",
						\"targets\":[
						   {
							  \"queue\":\"WQ5940dc0da87eaf6e3321d62041d4403b\",
							  \"priority\": 10,
							  \"timeout\": 30
						   },
						   {
							  \"queue\":\"WQ5940dc0da87eaf6e3321d62041d4403b\",
							  \"priority\": 15
						   }
						],
						\"friendly_name\":\"Support\"
					 }
				  ],
				  \"default_filter\":{
					 \"queue\":\"WQ6d29383312b24bd898a8df32779fc043\"
				  }
				}
			}";

		// getting a trimmed, simple string
		$jsonObject = json_decode($expectedJsonString);
		$expectedJson = json_encode($jsonObject);

		$this->assertEquals($json, $expectedJson);
	}
}
