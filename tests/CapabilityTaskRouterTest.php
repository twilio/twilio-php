<?php

require_once 'Twilio/TaskRouter/Workspace/Capability.php';
require_once 'Twilio/TaskRouter/Worker/Capability.php';
require_once 'Twilio/TaskRouter/TaskQueue/Capability.php';
require_once 'Twilio/TaskRouter/Capability.php';

class CapabilityTaskRouter extends PHPUnit_Framework_TestCase {

	public function testDefaultWorker()
	{
		$workerCapability = new Services_Twilio_TaskRouter_Worker_Capability('AC123', 'foobar', 'WS456', 'WK789');
		$token = $workerCapability->generateToken();
		$payload = JWT::decode($token, 'foobar');

		$this->assertEquals('AC123', $payload->iss);
		$this->assertEquals('AC123', $payload->account_sid);
		$this->assertEquals('WK789', $payload->channel);
		$this->assertEquals('WS456', $payload->workspace_sid);
		$this->assertEquals('WK789', $payload->worker_sid);
		$this->assertEquals('v1', $payload->version);

		$policies = $payload->policies;
		$this->assertEquals(7, count($policies));

		$this->assertEquals('https://event-bridge.twilio.com/v1/wschannels/AC123/WK789', $policies[0]->url);
		$this->assertEquals('GET', $policies[0]->method);
		$this->assertObjectNotHasAttribute('query_filter', $policies[0]);
		$this->assertObjectNotHasAttribute('post_filter', $policies[0]);
		$this->assertEquals(true, $policies[0]->allow);

		$this->assertEquals('https://event-bridge.twilio.com/v1/wschannels/AC123/WK789', $policies[1]->url);
		$this->assertEquals('POST', $policies[1]->method);
		$this->assertObjectNotHasAttribute('query_filter', $policies[1]);
		$this->assertObjectNotHasAttribute('post_filter', $policies[1]);
		$this->assertEquals(true, $policies[1]->allow);

		$this->assertEquals('https://taskrouter.twilio.com/v1/Workspaces/WS456/Workers/WK789', $policies[2]->url);
		$this->assertEquals('GET', $policies[2]->method);
		$this->assertObjectNotHasAttribute('query_filter', $policies[2]);
		$this->assertObjectNotHasAttribute('post_filter', $policies[2]);
		$this->assertEquals(true, $policies[2]->allow);

		$this->assertEquals('https://taskrouter.twilio.com/v1/Workspaces/WS456/Activities', $policies[3]->url);
		$this->assertEquals('GET', $policies[3]->method);
		$this->assertObjectNotHasAttribute('query_filter', $policies[3]);
		$this->assertObjectNotHasAttribute('post_filter', $policies[3]);
		$this->assertEquals(true, $policies[3]->allow);

		$this->assertEquals('https://taskrouter.twilio.com/v1/Workspaces/WS456/Tasks/**', $policies[4]->url);
		$this->assertEquals('GET', $policies[4]->method);
		$this->assertObjectNotHasAttribute('query_filter', $policies[4]);
		$this->assertObjectNotHasAttribute('post_filter', $policies[4]);
		$this->assertEquals(true, $policies[4]->allow);

		$this->assertEquals('https://taskrouter.twilio.com/v1/Workspaces/WS456/Workers/WK789/Reservations/**', $policies[5]->url);
		$this->assertEquals('GET', $policies[5]->method);
		$this->assertObjectNotHasAttribute('query_filter', $policies[5]);
		$this->assertObjectNotHasAttribute('post_filter', $policies[5]);
		$this->assertEquals(true, $policies[5]->allow);
		
		$this->assertEquals('https://taskrouter.twilio.com/v1/Workspaces/WS456/Workers/WK789/Channels/**', $policies[6]->url);
		$this->assertEquals('GET', $policies[6]->method);
		$this->assertObjectNotHasAttribute('query_filter', $policies[6]);
		$this->assertObjectNotHasAttribute('post_filter', $policies[6]);
		$this->assertEquals(true, $policies[6]->allow);
    }

	public function testAllowWorkerUpdates()
	{
		$workerCapability = new Services_Twilio_TaskRouter_Worker_Capability('AC123', 'foobar', 'WS456', 'WK789');
		$workerCapability->allowActivityUpdates();
		$token = $workerCapability->generateToken();
		$payload = JWT::decode($token, 'foobar');

		$this->assertEquals('AC123', $payload->iss);
		$this->assertEquals('AC123', $payload->account_sid);
		$this->assertEquals('WK789', $payload->channel);
		$this->assertEquals('WS456', $payload->workspace_sid);
		$this->assertEquals('WK789', $payload->worker_sid);
		$this->assertEquals('v1', $payload->version);

		$policies = $payload->policies;
		$this->assertEquals(8, count($policies));
		$this->assertEquals('https://taskrouter.twilio.com/v1/Workspaces/WS456/Workers/WK789', $policies[7]->url);
		$this->assertEquals('POST', $policies[7]->method);
		$this->assertEquals(new stdClass(), $policies[7]->query_filter);
		$this->assertEquals(true, $policies[7]->post_filter->ActivitySid->required);
		$this->assertEquals(true, $policies[7]->allow);
	}

	public function testAllowReservationUpdates()
	{
		$workerCapability = new Services_Twilio_TaskRouter_Worker_Capability('AC123', 'foobar', 'WS456', 'WK789');
		$workerCapability->allowActivityUpdates();
		$workerCapability->allowReservationUpdates();
		$token = $workerCapability->generateToken();
		$payload = JWT::decode($token, 'foobar');

		$this->assertEquals('AC123', $payload->iss);
		$this->assertEquals('AC123', $payload->account_sid);
		$this->assertEquals('WK789', $payload->channel);
		$this->assertEquals('WS456', $payload->workspace_sid);
		$this->assertEquals('WK789', $payload->worker_sid);
		$this->assertEquals('v1', $payload->version);

		$policies = $payload->policies;
		$this->assertEquals(10, count($policies));

		$this->assertEquals('https://taskrouter.twilio.com/v1/Workspaces/WS456/Tasks/**', $policies[8]->url);
		$this->assertEquals('POST', $policies[8]->method);
		$this->assertEquals(new stdClass(), $policies[8]->query_filter);
		$this->assertEquals(new stdClass(), $policies[8]->post_filter);
		$this->assertEquals(true, $policies[8]->allow);

		$this->assertEquals('https://taskrouter.twilio.com/v1/Workspaces/WS456/Workers/WK789/Reservations/**', $policies[9]->url);
		$this->assertEquals('POST', $policies[9]->method);
		$this->assertEquals(new stdClass(), $policies[9]->query_filter);
		$this->assertEquals(new stdClass(), $policies[9]->post_filter);
		$this->assertEquals(true, $policies[9]->allow);
	}

	public function testDefaultWorkspace()
	{
		$workspaceCapability = new Services_Twilio_TaskRouter_Workspace_Capability('AC123', 'foobar', 'WS456');
		$token = $workspaceCapability->generateToken();
		$payload = JWT::decode($token, 'foobar');

		$this->assertEquals('AC123', $payload->iss);
		$this->assertEquals('AC123', $payload->account_sid);
		$this->assertEquals('WS456', $payload->channel);
		$this->assertEquals('WS456', $payload->workspace_sid);
		$this->assertEquals('v1', $payload->version);

		$policies = $payload->policies;
		$this->assertEquals(3, count($policies));

		$this->assertEquals('https://event-bridge.twilio.com/v1/wschannels/AC123/WS456', $policies[0]->url);
		$this->assertEquals('GET', $policies[0]->method);
		$this->assertObjectNotHasAttribute('query_filter', $policies[0]);
		$this->assertObjectNotHasAttribute('post_filter', $policies[0]);
		$this->assertEquals(true, $policies[0]->allow);

		$this->assertEquals('https://event-bridge.twilio.com/v1/wschannels/AC123/WS456', $policies[1]->url);
		$this->assertEquals('POST', $policies[1]->method);
		$this->assertObjectNotHasAttribute('query_filter', $policies[1]);
		$this->assertObjectNotHasAttribute('post_filter', $policies[1]);
		$this->assertEquals(true, $policies[1]->allow);

		$this->assertEquals('https://taskrouter.twilio.com/v1/Workspaces/WS456', $policies[2]->url);
		$this->assertEquals('GET', $policies[2]->method);
		$this->assertObjectNotHasAttribute('query_filter', $policies[2]);
		$this->assertObjectNotHasAttribute('post_filter', $policies[2]);
		$this->assertEquals(true, $policies[2]->allow);
	}

	public function testWorkspaceFetchAll()
	{
		$workspaceCapability = new Services_Twilio_TaskRouter_Workspace_Capability('AC123', 'foobar', 'WS456');
		$workspaceCapability->allowFetchSubresources();
		$token = $workspaceCapability->generateToken();
		$payload = JWT::decode($token, 'foobar');

		$this->assertEquals('AC123', $payload->iss);
		$this->assertEquals('AC123', $payload->account_sid);
		$this->assertEquals('WS456', $payload->channel);
		$this->assertEquals('WS456', $payload->workspace_sid);
		$this->assertEquals('v1', $payload->version);

		$policies = $payload->policies;
		$this->assertEquals(4, count($policies));

		$this->assertEquals('https://event-bridge.twilio.com/v1/wschannels/AC123/WS456', $policies[0]->url);
		$this->assertEquals('GET', $policies[0]->method);
		$this->assertObjectNotHasAttribute('query_filter', $policies[0]);
		$this->assertObjectNotHasAttribute('post_filter', $policies[0]);
		$this->assertEquals(true, $policies[0]->allow);

		$this->assertEquals('https://event-bridge.twilio.com/v1/wschannels/AC123/WS456', $policies[1]->url);
		$this->assertEquals('POST', $policies[1]->method);
		$this->assertObjectNotHasAttribute('query_filter', $policies[1]);
		$this->assertObjectNotHasAttribute('post_filter', $policies[1]);
		$this->assertEquals(true, $policies[1]->allow);

		$this->assertEquals('https://taskrouter.twilio.com/v1/Workspaces/WS456', $policies[2]->url);
		$this->assertEquals('GET', $policies[2]->method);
		$this->assertObjectNotHasAttribute('query_filter', $policies[2]);
		$this->assertObjectNotHasAttribute('post_filter', $policies[2]);
		$this->assertEquals(true, $policies[2]->allow);

		$this->assertEquals('https://taskrouter.twilio.com/v1/Workspaces/WS456/**', $policies[3]->url);
		$this->assertEquals('GET', $policies[3]->method);
		$this->assertEquals(new stdClass(), $policies[3]->query_filter);
		$this->assertEquals(new stdClass(), $policies[3]->post_filter);
		$this->assertEquals(true, $policies[3]->allow);
	}

	public function testDefaultTaskQueue()
	{
		$taskQueueCapability = new Services_Twilio_TaskRouter_TaskQueue_Capability('AC123', 'foobar', 'WS456', 'WQ789');
		$token = $taskQueueCapability->generateToken();
		$payload = JWT::decode($token, 'foobar');

		$this->assertEquals('AC123', $payload->iss);
		$this->assertEquals('AC123', $payload->account_sid);
		$this->assertEquals('WQ789', $payload->channel);
		$this->assertEquals('WS456', $payload->workspace_sid);
		$this->assertEquals('WQ789', $payload->taskqueue_sid);
		$this->assertEquals('v1', $payload->version);

		$policies = $payload->policies;
		$this->assertEquals(3, count($policies));

		$this->assertEquals('https://event-bridge.twilio.com/v1/wschannels/AC123/WQ789', $policies[0]->url);
		$this->assertEquals('GET', $policies[0]->method);
		$this->assertObjectNotHasAttribute('query_filter', $policies[0]);
		$this->assertObjectNotHasAttribute('post_filter', $policies[0]);
		$this->assertEquals(true, $policies[0]->allow);

		$this->assertEquals('https://event-bridge.twilio.com/v1/wschannels/AC123/WQ789', $policies[1]->url);
		$this->assertEquals('POST', $policies[1]->method);
		$this->assertObjectNotHasAttribute('query_filter', $policies[1]);
		$this->assertObjectNotHasAttribute('post_filter', $policies[1]);
		$this->assertEquals(true, $policies[1]->allow);

		$this->assertEquals('https://taskrouter.twilio.com/v1/Workspaces/WS456/TaskQueues/WQ789', $policies[2]->url);
		$this->assertEquals('GET', $policies[2]->method);
		$this->assertObjectNotHasAttribute('query_filter', $policies[2]);
		$this->assertObjectNotHasAttribute('post_filter', $policies[2]);
		$this->assertEquals(true, $policies[2]->allow);
	}
}
