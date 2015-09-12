<?php

use \Mockery as m;

class IPMessagingRolesTest extends PHPUnit_Framework_TestCase
{
    protected $formHeaders = array('Content-Type' => 'application/x-www-form-urlencoded');

    function testRead()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/v1/Services/SV123/Roles?Page=0&PageSize=50')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array(
                    'meta' => array('key' => 'roles', 'next_page_url' => null),
                    'roles' => array(array('sid' => 'RL123'))
                ))
            ));
        $ipMessagingClient = new IPMessaging_Services_Twilio('AC123', '123', 'v1', $http);
        $service = $ipMessagingClient->services->get('SV123');
        foreach ($service->roles->getIterator(0, 50) as $role) {
            $this->assertEquals('RL123', $role->sid);
        }
    }

    function testFetch() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/v1/Services/SV123/Roles/RL123')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'RL123', 'friendly_name' => 'Role'))
            ));
        $ipMessagingClient = new IPMessaging_Services_Twilio('AC123', '123', 'v1', $http);
        $service = $ipMessagingClient->services->get('SV123');
        $role = $service->roles->get('RL123');
        $this->assertNotNull($role);
        $this->assertEquals('Role', $role->friendly_name);
    }

    function testCreate() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('post')->once()
            ->with('/v1/Services/SV123/Roles', $this->formHeaders,
                'FriendlyName=TestUrl')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'RL123'))
            ));
        $ipMessagingClient = new IPMessaging_Services_Twilio('AC123', '123', '2010-04-01', $http);
        $service = $ipMessagingClient->services->get('SV123');
        $role = $service->roles->create(array(
            'FriendlyName' => 'TestUrl'
        ));
        $this->assertSame('RL123', $role->sid);
    }

    function testUpdate() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('post')->once()
            ->with('/v1/Services/SV123/Roles/RL123', $this->formHeaders,
                'FriendlyName=TestUrl')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'RL123'))
            ));
        $ipMessagingClient = new IPMessaging_Services_Twilio('AC123', '123', '2010-04-01', $http);
        $service = $ipMessagingClient->services->get('SV123');
        $role = $service->roles->get('RL123');
        $role->update(array(
            'FriendlyName' => 'TestUrl'
        ));
        $this->assertSame('RL123', $role->sid);
    }

    function testDelete() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('delete')->once()
            ->with('/v1/Services/SV123/Roles/RL123')
            ->andReturn(array(204, array('Content-Type' => 'application/json'), ''
        ));
        $ipMessagingClient = new IPMessaging_Services_Twilio('AC123', '123', null, $http);
        $service = $ipMessagingClient->services->get('SV123');
        $service->roles->delete('RL123');
    }

    function tearDown()
    {
        m::close();
    }
}
