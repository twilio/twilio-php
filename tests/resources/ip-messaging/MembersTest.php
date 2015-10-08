<?php

use \Mockery as m;

class IPMessagingMembersTest extends PHPUnit_Framework_TestCase
{
    protected $formHeaders = array('Content-Type' => 'application/x-www-form-urlencoded');

    function testRead()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/v1/Services/SV123/Channels/CH123/Members?Page=0&PageSize=50')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array(
                    'meta' => array('key' => 'members', 'next_page_url' => null),
                    'members' => array(array('sid' => 'MB123'))
                ))
            ));
        $ipMessagingClient = new IPMessaging_Services_Twilio('AC123', '123', 'v1', $http);
        $service = $ipMessagingClient->services->get('SV123');
        $channel = $service->channels->get('CH123');
        foreach ($channel->members->getIterator(0, 50) as $member) {
            $this->assertEquals('MB123', $member->sid);
        }
    }

    function testFetch() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/v1/Services/SV123/Channels/CH123/Members/MB123')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'MB123', 'friendly_name' => 'Member'))
            ));
        $ipMessagingClient = new IPMessaging_Services_Twilio('AC123', '123', 'v1', $http);
        $service = $ipMessagingClient->services->get('SV123');
        $channel = $service->channels->get('CH123');
        $member = $channel->members->get('MB123');
        $this->assertNotNull($member);
        $this->assertEquals('Member', $member->friendly_name);
    }

    function testCreate() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('post')->once()
            ->with('/v1/Services/SV123/Channels/CH123/Members', $this->formHeaders,
                'FriendlyName=TestUrl')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'MB123'))
            ));
        $ipMessagingClient = new IPMessaging_Services_Twilio('AC123', '123', '2010-04-01', $http);
        $service = $ipMessagingClient->services->get('SV123');
        $channel = $service->channels->get('CH123');
        $member = $channel->members->create(array(
            'FriendlyName' => 'TestUrl'
        ));
        $this->assertSame('MB123', $member->sid);
    }

    function testUpdate() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('post')->once()
            ->with('/v1/Services/SV123/Channels/CH123/Members/MB123', $this->formHeaders,
                'FriendlyName=TestUrl')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'MB123'))
            ));
        $ipMessagingClient = new IPMessaging_Services_Twilio('AC123', '123', '2010-04-01', $http);
        $service = $ipMessagingClient->services->get('SV123');
        $channel = $service->channels->get('CH123');
        $member = $channel->members->get('MB123');
        $member->update(array(
            'FriendlyName' => 'TestUrl'
        ));
        $this->assertSame('MB123', $member->sid);
    }

    function testDelete() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('delete')->once()
            ->with('/v1/Services/SV123/Channels/CH123/Members/MB123')
            ->andReturn(array(204, array('Content-Type' => 'application/json'), ''
        ));
        $ipMessagingClient = new IPMessaging_Services_Twilio('AC123', '123', null, $http);
        $service = $ipMessagingClient->services->get('SV123');
        $channel = $service->channels->get('CH123');
        $channel->members->delete('MB123');
    }

    function tearDown()
    {
        m::close();
    }
}
