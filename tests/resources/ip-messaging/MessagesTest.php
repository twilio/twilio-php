<?php

use \Mockery as m;

class IPMessagingMessagesTest extends PHPUnit_Framework_TestCase
{
    protected $formHeaders = array('Content-Type' => 'application/x-www-form-urlencoded');

    function testRead()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/v1/Services/SV123/Channels/CH123/Messages?Page=0&PageSize=50')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array(
                    'meta' => array('key' => 'messages', 'next_page_url' => null),
                    'messages' => array(array('sid' => 'IM123'))
                ))
            ));
        $ipMessagingClient = new IPMessaging_Services_Twilio('AC123', '123', 'v1', $http);
        $service = $ipMessagingClient->services->get('SV123');
        $channel = $service->channels->get('CH123');
        foreach ($channel->messages->getIterator(0, 50) as $message) {
            $this->assertEquals('IM123', $message->sid);
        }
    }

    function testFetch() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/v1/Services/SV123/Channels/CH123/Messages/IM123')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'IM123', 'friendly_name' => 'Message'))
            ));
        $ipMessagingClient = new IPMessaging_Services_Twilio('AC123', '123', 'v1', $http);
        $service = $ipMessagingClient->services->get('SV123');
        $channel = $service->channels->get('CH123');
        $message = $channel->messages->get('IM123');
        $this->assertNotNull($message);
        $this->assertEquals('Message', $message->friendly_name);
    }

    function testCreate() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('post')->once()
            ->with('/v1/Services/SV123/Channels/CH123/Messages', $this->formHeaders,
                'FriendlyName=TestUrl')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'IM123'))
            ));
        $ipMessagingClient = new IPMessaging_Services_Twilio('AC123', '123', '2010-04-01', $http);
        $service = $ipMessagingClient->services->get('SV123');
        $channel = $service->channels->get('CH123');
        $message = $channel->messages->create(array(
            'FriendlyName' => 'TestUrl'
        ));
        $this->assertSame('IM123', $message->sid);
    }

    function testUpdate() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('post')->once()
            ->with('/v1/Services/SV123/Channels/CH123/Messages/IM123', $this->formHeaders,
                'FriendlyName=TestUrl')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'IM123'))
            ));
        $ipMessagingClient = new IPMessaging_Services_Twilio('AC123', '123', '2010-04-01', $http);
        $service = $ipMessagingClient->services->get('SV123');
        $channel = $service->channels->get('CH123');
        $message = $channel->messages->get('IM123');
        $message->update(array(
            'FriendlyName' => 'TestUrl'
        ));
        $this->assertSame('IM123', $message->sid);
    }

    function testDelete() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('delete')->once()
            ->with('/v1/Services/SV123/Channels/CH123/Messages/IM123')
            ->andReturn(array(204, array('Content-Type' => 'application/json'), ''
        ));
        $ipMessagingClient = new IPMessaging_Services_Twilio('AC123', '123', null, $http);
        $service = $ipMessagingClient->services->get('SV123');
        $channel = $service->channels->get('CH123');
        $channel->messages->delete('IM123');
    }

    function tearDown()
    {
        m::close();
    }
}
