<?php

use \Mockery as m;

class ConversationsConversationsTest extends PHPUnit_Framework_TestCase
{

    function testGet() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/v1/Conversations/CV123')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'CV123', 'duration' => '100'))
            ));
        $conversationsClient = new Conversations_Services_Twilio('AC123', '123', 'v1', $http);
        $conversation = $conversationsClient->conversations->get('CV123');
        $this->assertNotNull($conversation);
        $this->assertEquals('100', $conversation->duration);
    }

    function testGetParticipant() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/v1/Conversations/CV123')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'CV123', 'duration' => '100'))
            ));
        $conversationsClient = new Conversations_Services_Twilio('AC123', '123', 'v1', $http);
        $conversation = $conversationsClient->conversations->get('CV123');
        $this->assertNotNull($conversation);
        $this->assertEquals('100', $conversation->duration);

        $http->shouldReceive('get')->once()
            ->with('/v1/Conversations/CV123/Participants/CP123')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'CP123', 'address' => 'bob@AC123.endpoint.twilio.com'))
            ));
        $participant = $conversation->participants->get('CP123');
        $this->assertNotNull($participant);
        $this->assertEquals('bob@AC123.endpoint.twilio.com', $participant->address);
    }

    function testGetParticipants() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/v1/Conversations/CV123')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'CV123', 'duration' => '100'))
            ));
        $conversationsClient = new Conversations_Services_Twilio('AC123', '123', 'v1', $http);
        $conversation = $conversationsClient->conversations->get('CV123');
        $this->assertNotNull($conversation);
        $this->assertEquals('100', $conversation->duration);

        $http->shouldReceive('get')->once()
            ->with('/v1/Conversations/CV123/Participants?Page=0&PageSize=50')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array(
                    'meta' => array('key' => 'participants', 'next_page_url' => null),
                    'participants' => array(array('sid' => 'CP123'))
                ))
            ));
        foreach ($conversation->participants->getIterator(0, 50) as $participant) {
            $this->assertEquals('CP123', $participant->sid);
        }
    }

    function testGetList()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/v1/Conversations?Page=0&PageSize=50')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array(
                    'meta' => array('key' => 'conversations', 'next_page_url' => null),
                    'conversations' => array(array('sid' => 'CV123'))
                ))
            ));
        $conversationsClient = new Conversations_Services_Twilio('AC123', '123', 'v1', $http);
        foreach ($conversationsClient->conversations->getIterator(0, 50) as $conversation) {
            $this->assertEquals('CV123', $conversation->sid);
        }
    }

    function testGetInProgressList()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/v1/Conversations/InProgress?Page=0&PageSize=50')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array(
                    'meta' => array('key' => 'conversations', 'next_page_url' => null),
                    'conversations' => array(array('sid' => 'CV123'))
                ))
            ));
        $conversationsClient = new Conversations_Services_Twilio('AC123', '123', 'v1', $http);
        foreach ($conversationsClient->conversations->inProgress->getIterator(0, 50) as $conversation) {
            $this->assertEquals('CV123', $conversation->sid);
        }
    }

    function testGetCompletedList()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/v1/Conversations/Completed?Page=0&PageSize=50')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array(
                    'meta' => array('key' => 'conversations', 'next_page_url' => null),
                    'conversations' => array(array('sid' => 'CV123'))
                ))
            ));
        $conversationsClient = new Conversations_Services_Twilio('AC123', '123', 'v1', $http);
        foreach ($conversationsClient->conversations->completed->getIterator(0, 50) as $conversation) {
            $this->assertEquals('CV123', $conversation->sid);
        }
    }

    function tearDown()
    {
        m::close();
    }
}
