<?php

use \Mockery as m;

class IPMessagingChannelsTest extends PHPUnit_Framework_TestCase
{
    protected $formHeaders = array('Content-Type' => 'application/x-www-form-urlencoded');

    function testRead()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/v1/Services/SV123/Channels?Page=0&PageSize=50')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array(
                    'meta' => array('key' => 'channels', 'next_page_url' => null),
                    'channels' => array(array('sid' => 'CH123'))
                ))
            ));
        $ipMessagingClient = new IPMessaging_Services_Twilio('AC123', '123', 'v1', $http);
        $service = $ipMessagingClient->services->get('SV123');
        foreach ($service->channels->getIterator(0, 50) as $channel) {
            $this->assertEquals('CH123', $channel->sid);
        }
    }

    function testFetch() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/v1/Services/SV123/Channels/CH123')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'CH123', 'friendly_name' => 'Channel'))
            ));
        $ipMessagingClient = new IPMessaging_Services_Twilio('AC123', '123', 'v1', $http);
        $service = $ipMessagingClient->services->get('SV123');
        $channel = $service->channels->get('CH123');
        $this->assertNotNull($channel);
        $this->assertEquals('Channel', $channel->friendly_name);
    }

    function testCreate() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('post')->once()
            ->with('/v1/Services/SV123/Channels', $this->formHeaders,
                'FriendlyName=TestUrl')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'CH123'))
            ));
        $ipMessagingClient = new IPMessaging_Services_Twilio('AC123', '123', '2010-04-01', $http);
        $service = $ipMessagingClient->services->get('SV123');
        $channel = $service->channels->create(array(
            'FriendlyName' => 'TestUrl'
        ));
        $this->assertSame('CH123', $channel->sid);
    }

    function testUpdate() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('post')->once()
            ->with('/v1/Services/SV123/Channels/CH123', $this->formHeaders,
                'FriendlyName=TestUrl')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'CH123'))
            ));
        $ipMessagingClient = new IPMessaging_Services_Twilio('AC123', '123', '2010-04-01', $http);
        $service = $ipMessagingClient->services->get('SV123');
        $channel = $service->channels->get('CH123');
        $channel->update(array(
            'FriendlyName' => 'TestUrl'
        ));
        $this->assertSame('CH123', $channel->sid);
    }

    function testDelete() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('delete')->once()
            ->with('/v1/Services/SV123/Channels/CH123')
            ->andReturn(array(204, array('Content-Type' => 'application/json'), ''
        ));
        $ipMessagingClient = new IPMessaging_Services_Twilio('AC123', '123', null, $http);
        $service = $ipMessagingClient->services->get('SV123');
        $service->channels->delete('CH123');
    }

    function tearDown()
    {
        m::close();
    }
}
