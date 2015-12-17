<?php

use \Mockery as m;

class IPMessagingCredentialsTest extends PHPUnit_Framework_TestCase
{
    protected $formHeaders = array('Content-Type' => 'application/x-www-form-urlencoded');

    function testRead()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/v1/Credentials?Page=0&PageSize=50')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array(
                    'meta' => array('key' => 'credentials', 'next_page_url' => null),
                    'credentials' => array(array('sid' => 'CR123'))
                ))
            ));
        $ipMessagingClient = new IPMessaging_Services_Twilio('AC123', '123', 'v1', $http);
        foreach ($ipMessagingClient->credentials->getIterator(0, 50) as $credential) {
            $this->assertEquals('CR123', $credential->sid);
        }
    }

    function testFetch() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/v1/Credentials/CR123')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'CR123', 'friendly_name' => 'TestCredential'))
            ));
        $ipMessagingClient = new IPMessaging_Services_Twilio('AC123', '123', 'v1', $http);
        $credential = $ipMessagingClient->credentials->get('CR123');
        $this->assertNotNull($credential);
        $this->assertEquals('TestCredential', $credential->friendly_name);
    }

    function testCreate() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('post')->once()
            ->with('/v1/Credentials', $this->formHeaders,
                'FriendlyName=TestCredential&DomainName=test.pstn.twilio.com')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'CR123'))
            ));
        $ipMessagingClient = new IPMessaging_Services_Twilio('AC123', '123', '2010-04-01', $http);
        $credential = $ipMessagingClient->credentials->create(array(
            'FriendlyName' => 'TestCredential',
            'DomainName' => 'test.pstn.twilio.com'
        ));
        $this->assertSame('CR123', $credential->sid);
    }

    function testUpdate() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('post')->once()
            ->with('/v1/Credentials/CR123', $this->formHeaders,
                'FriendlyName=TestCredential')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'CR123'))
            ));
        $ipMessagingClient = new IPMessaging_Services_Twilio('AC123', '123', '2010-04-01', $http);
        $credential = $ipMessagingClient->credentials->get('CR123');
        $credential->update(array(
            'FriendlyName' => 'TestCredential'
        ));
        $this->assertSame('CR123', $credential->sid);
    }

    function testDelete() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('delete')->once()
            ->with('/v1/Credentials/CR123')
            ->andReturn(array(204, array('Content-Type' => 'application/json'), ''
        ));
        $ipMessagingClient = new IPMessaging_Services_Twilio('AC123', '123', null, $http);
        $ipMessagingClient->credentials->delete('CR123');
    }

    function tearDown()
    {
        m::close();
    }
}
