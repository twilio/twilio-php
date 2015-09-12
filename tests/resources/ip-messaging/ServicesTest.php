<?php

use \Mockery as m;

class IPMessagingServicesTest extends PHPUnit_Framework_TestCase
{
    protected $formHeaders = array('Content-Type' => 'application/x-www-form-urlencoded');

    function testRead()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/v1/Services?Page=0&PageSize=50')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array(
                    'meta' => array('key' => 'services', 'next_page_url' => null),
                    'services' => array(array('sid' => 'SV123'))
                ))
            ));
        $ipMessagingClient = new IPMessaging_Services_Twilio('AC123', '123', 'v1', $http);
        foreach ($ipMessagingClient->services->getIterator(0, 50) as $service) {
            $this->assertEquals('SV123', $service->sid);
        }
    }

    function testFetch() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/v1/Services/SV123')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'SV123', 'friendly_name' => 'TestService'))
            ));
        $ipMessagingClient = new IPMessaging_Services_Twilio('AC123', '123', 'v1', $http);
        $service = $ipMessagingClient->services->get('SV123');
        $this->assertNotNull($service);
        $this->assertEquals('TestService', $service->friendly_name);
    }

    function testCreate() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('post')->once()
            ->with('/v1/Services', $this->formHeaders,
                'FriendlyName=TestService&DomainName=test.pstn.twilio.com')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'SV123'))
            ));
        $ipMessagingClient = new IPMessaging_Services_Twilio('AC123', '123', '2010-04-01', $http);
        $service = $ipMessagingClient->services->create(array(
            'FriendlyName' => 'TestService',
            'DomainName' => 'test.pstn.twilio.com'
        ));
        $this->assertSame('SV123', $service->sid);
    }

    function testUpdate() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('post')->once()
            ->with('/v1/Services/SV123', $this->formHeaders,
                'FriendlyName=TestService')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'SV123'))
            ));
        $ipMessagingClient = new IPMessaging_Services_Twilio('AC123', '123', '2010-04-01', $http);
        $service = $ipMessagingClient->services->get('SV123');
        $service->update(array(
            'FriendlyName' => 'TestService'
        ));
        $this->assertSame('SV123', $service->sid);
    }

    function testDelete() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('delete')->once()
            ->with('/v1/Services/SV123')
            ->andReturn(array(204, array('Content-Type' => 'application/json'), ''
        ));
        $ipMessagingClient = new IPMessaging_Services_Twilio('AC123', '123', null, $http);
        $ipMessagingClient->services->delete('SV123');
    }

    function tearDown()
    {
        m::close();
    }
}
