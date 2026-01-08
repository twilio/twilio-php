<?php

namespace Twilio\Tests\Unit\Rest\Taskrouter\V1\Workspace;

use Twilio\Exceptions\TwilioException;
use Twilio\Http\Response;
use Twilio\Rest\Taskrouter\V1\Workspace\TaskInstance;
use Twilio\Tests\HolodeckTestCase;
use Twilio\Tests\Request;

class TaskContextTest extends HolodeckTestCase {

    public function testFetchWithNullPayload(): void {
        $this->holodeck->mock(new Response(200, null, []));

        $actual = $this->twilio->taskrouter->v1->workspaces("WSXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                             ->tasks("WTXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                             ->fetch();

        $this->assertInstanceOf(TaskInstance::class, $actual);
    }

    public function testUpdateWithNullPayload(): void {
        $this->holodeck->mock(new Response(200, null, []));

        $actual = $this->twilio->taskrouter->v1->workspaces("WSXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                             ->tasks("WTXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                             ->update(['attributes' => 'test']);

        $this->assertInstanceOf(TaskInstance::class, $actual);
    }

    public function testFetchWithInvalidJsonPayload(): void {
        $this->holodeck->mock(new Response(200, 'invalid json', []));

        $actual = $this->twilio->taskrouter->v1->workspaces("WSXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                             ->tasks("WTXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                             ->fetch();

        $this->assertInstanceOf(TaskInstance::class, $actual);
    }

    public function testUpdateWithInvalidJsonPayload(): void {
        $this->holodeck->mock(new Response(200, 'invalid json', []));

        $actual = $this->twilio->taskrouter->v1->workspaces("WSXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                             ->tasks("WTXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                             ->update(['attributes' => 'test']);

        $this->assertInstanceOf(TaskInstance::class, $actual);
    }
}