<?php

use \Mockery as m;

class TrunkingIpAccessControlListsTest extends PHPUnit_Framework_TestCase
{
    protected $formHeaders = array('Content-Type' => 'application/x-www-form-urlencoded');

    function testRead()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/v1/Trunks/TK123/IpAccessControlLists?Page=0&PageSize=50')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array(
                    'meta' => array('key' => 'ip_access_control_lists', 'next_page_url' => null),
                    'ip_access_control_lists' => array(array('sid' => 'AL123'))
                ))
            ));
        $trunkingClient = new Trunking_Services_Twilio('AC123', '123', 'v1', $http);
        $trunk = $trunkingClient->trunks->get('TK123');
        foreach ($trunk->ip_access_control_lists->getIterator(0, 50) as $ip_access_control_list) {
            $this->assertEquals('AL123', $ip_access_control_list->sid);
        }
    }

    function testFetch() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/v1/Trunks/TK123/IpAccessControlLists/AL123')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'AL123', 'friendly_name' => 'IpAccessControlList'))
            ));
        $trunkingClient = new Trunking_Services_Twilio('AC123', '123', 'v1', $http);
        $trunk = $trunkingClient->trunks->get('TK123');
        $ip_access_control_list = $trunk->ip_access_control_lists->get('AL123');
        $this->assertNotNull($ip_access_control_list);
        $this->assertEquals('IpAccessControlList', $ip_access_control_list->friendly_name);
    }

    function testCreate() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('post')->once()
            ->with('/v1/Trunks/TK123/IpAccessControlLists', $this->formHeaders,
                'IpAccessControlListSid=AL123')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'AL123'))
            ));
        $trunkingClient = new Trunking_Services_Twilio('AC123', '123', '2010-04-01', $http);
        $trunk = $trunkingClient->trunks->get('TK123');
        $ip_access_control_list = $trunk->ip_access_control_lists->create(array(
            'IpAccessControlListSid' => 'AL123'
        ));
        $this->assertSame('AL123', $ip_access_control_list->sid);
    }

    function testDelete() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('delete')->once()
            ->with('/v1/Trunks/TK123/IpAccessControlLists/AL123')
            ->andReturn(array(204, array('Content-Type' => 'application/json'), ''
        ));
        $trunkingClient = new Trunking_Services_Twilio('AC123', '123', null, $http);
        $trunk = $trunkingClient->trunks->get('TK123');
        $trunk->ip_access_control_lists->delete('AL123');
    }

    function tearDown()
    {
        m::close();
    }
}
