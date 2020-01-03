<?php


namespace Twilio\Tests\Unit\Jwt\TaskRouter;


use Twilio\Jwt\JWT;
use Twilio\Jwt\TaskRouter\TaskQueueCapability;
use Twilio\Jwt\TaskRouter\WorkerCapability;
use Twilio\Jwt\TaskRouter\WorkspaceCapability;
use Twilio\Tests\Unit\UnitTest;

class CapabilityTokenTest extends UnitTest {
    public function testDefaultWorker(): void {
        $workerCapability = new WorkerCapability('AC123', 'foobar', 'WS456', 'WK789');
        $token = $workerCapability->generateToken();
        $payload = JWT::decode($token, 'foobar');

        $this->assertEquals('AC123', $payload->iss);
        $this->assertEquals('AC123', $payload->account_sid);
        $this->assertEquals('WK789', $payload->channel);
        $this->assertEquals('WS456', $payload->workspace_sid);
        $this->assertEquals('WK789', $payload->worker_sid);
        $this->assertEquals('v1', $payload->version);

        $policies = $payload->policies;
        $this->assertCount(6, $policies);

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
    }

    public function testAllowWorkerUpdates(): void {
        $workerCapability = new WorkerCapability('AC123', 'foobar', 'WS456', 'WK789');
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
        $this->assertCount(7, $policies);

        $this->assertEquals('https://taskrouter.twilio.com/v1/Workspaces/WS456/Workers/WK789', $policies[6]->url);
        $this->assertEquals('POST', $policies[6]->method);
        $this->assertEquals(new \stdClass(), $policies[6]->query_filter);
        $this->assertEquals(true, $policies[6]->post_filter->ActivitySid->required);
        $this->assertEquals(true, $policies[6]->allow);
    }

    public function testAllowReservationUpdates(): void {
        $workerCapability = new WorkerCapability('AC123', 'foobar', 'WS456', 'WK789');
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
        $this->assertCount(9, $policies);

        $this->assertEquals('https://taskrouter.twilio.com/v1/Workspaces/WS456/Tasks/**', $policies[7]->url);
        $this->assertEquals('POST', $policies[7]->method);
        $this->assertEquals(new \stdClass(), $policies[7]->query_filter);
        $this->assertEquals(new \stdClass(), $policies[7]->post_filter);
        $this->assertEquals(true, $policies[7]->allow);

        $this->assertEquals('https://taskrouter.twilio.com/v1/Workspaces/WS456/Workers/WK789/Reservations/**', $policies[8]->url);
        $this->assertEquals('POST', $policies[8]->method);
        $this->assertEquals(new \stdClass(), $policies[8]->query_filter);
        $this->assertEquals(new \stdClass(), $policies[8]->post_filter);
        $this->assertEquals(true, $policies[8]->allow);
    }

    public function testDefaultWorkspace(): void {
        $workspaceCapability = new WorkspaceCapability('AC123', 'foobar', 'WS456');
        $token = $workspaceCapability->generateToken();
        $payload = JWT::decode($token, 'foobar');

        $this->assertEquals('AC123', $payload->iss);
        $this->assertEquals('AC123', $payload->account_sid);
        $this->assertEquals('WS456', $payload->channel);
        $this->assertEquals('WS456', $payload->workspace_sid);
        $this->assertEquals('v1', $payload->version);

        $policies = $payload->policies;
        $this->assertCount(3, $policies);

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

    public function testWorkspaceFetchAll(): void {
        $workspaceCapability = new WorkspaceCapability('AC123', 'foobar', 'WS456');
        $workspaceCapability->allowFetchSubresources();
        $token = $workspaceCapability->generateToken();
        $payload = JWT::decode($token, 'foobar');

        $this->assertEquals('AC123', $payload->iss);
        $this->assertEquals('AC123', $payload->account_sid);
        $this->assertEquals('WS456', $payload->channel);
        $this->assertEquals('WS456', $payload->workspace_sid);
        $this->assertEquals('v1', $payload->version);

        $policies = $payload->policies;
        $this->assertCount(4, $policies);

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
        $this->assertEquals(new \stdClass(), $policies[3]->query_filter);
        $this->assertEquals(new \stdClass(), $policies[3]->post_filter);
        $this->assertEquals(true, $policies[3]->allow);
    }

    public function testDefaultTaskQueue(): void {
        $taskQueueCapability = new TaskQueueCapability('AC123', 'foobar', 'WS456', 'WQ789');
        $token = $taskQueueCapability->generateToken();
        $payload = JWT::decode($token, 'foobar');

        $this->assertEquals('AC123', $payload->iss);
        $this->assertEquals('AC123', $payload->account_sid);
        $this->assertEquals('WQ789', $payload->channel);
        $this->assertEquals('WS456', $payload->workspace_sid);
        $this->assertEquals('WQ789', $payload->taskqueue_sid);
        $this->assertEquals('v1', $payload->version);

        $policies = $payload->policies;
        $this->assertCount(3, $policies);

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
