<?php

use \Mockery as m;

class IPMessagingUsersTest extends PHPUnit_Framework_TestCase
{
    protected $formHeaders = array('Content-Type' => 'application/x-www-form-urlencoded');

    function testRead()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/v1/Services/SV123/Users?Page=0&PageSize=50')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array(
                    'meta' => array('key' => 'users', 'next_page_url' => null),
                    'users' => array(array('sid' => 'US123'))
                ))
            ));
        $ipMessagingClient = new IPMessaging_Services_Twilio('AC123', '123', 'v1', $http);
        $service = $ipMessagingClient->services->get('SV123');
        foreach ($service->users->getIterator(0, 50) as $user) {
            $this->assertEquals('US123', $user->sid);
        }
    }

    function testFetch() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/v1/Services/SV123/Users/US123')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'US123', 'friendly_name' => 'User'))
            ));
        $ipMessagingClient = new IPMessaging_Services_Twilio('AC123', '123', 'v1', $http);
        $service = $ipMessagingClient->services->get('SV123');
        $user = $service->users->get('US123');
        $this->assertNotNull($user);
        $this->assertEquals('User', $user->friendly_name);
    }

    function testCreate() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('post')->once()
            ->with('/v1/Services/SV123/Users', $this->formHeaders,
                'FriendlyName=TestUrl')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'US123'))
            ));
        $ipMessagingClient = new IPMessaging_Services_Twilio('AC123', '123', '2010-04-01', $http);
        $service = $ipMessagingClient->services->get('SV123');
        $user = $service->users->create(array(
            'FriendlyName' => 'TestUrl'
        ));
        $this->assertSame('US123', $user->sid);
    }

    function testUpdate() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('post')->once()
            ->with('/v1/Services/SV123/Users/US123', $this->formHeaders,
                'FriendlyName=TestUrl')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'US123'))
            ));
        $ipMessagingClient = new IPMessaging_Services_Twilio('AC123', '123', '2010-04-01', $http);
        $service = $ipMessagingClient->services->get('SV123');
        $user = $service->users->get('US123');
        $user->update(array(
            'FriendlyName' => 'TestUrl'
        ));
        $this->assertSame('US123', $user->sid);
    }

    function testDelete() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('delete')->once()
            ->with('/v1/Services/SV123/Users/US123')
            ->andReturn(array(204, array('Content-Type' => 'application/json'), ''
        ));
        $ipMessagingClient = new IPMessaging_Services_Twilio('AC123', '123', null, $http);
        $service = $ipMessagingClient->services->get('SV123');
        $service->users->delete('US123');
    }

    function tearDown()
    {
        m::close();
    }
}
