<?php

use \Mockery as m;

class TrunkingCredentialListsTest extends PHPUnit_Framework_TestCase
{
    protected $formHeaders = array('Content-Type' => 'application/x-www-form-urlencoded');

    function testRead()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/v1/Trunks/TK123/CredentialLists?Page=0&PageSize=50')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array(
                    'meta' => array('key' => 'credential_lists', 'next_page_url' => null),
                    'credential_lists' => array(array('sid' => 'CL123'))
                ))
            ));
        $trunkingClient = new Trunking_Services_Twilio('AC123', '123', 'v1', $http);
        $trunk = $trunkingClient->trunks->get('TK123');
        foreach ($trunk->credential_lists->getIterator(0, 50) as $credential_list) {
            $this->assertEquals('CL123', $credential_list->sid);
        }
    }

    function testFetch() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/v1/Trunks/TK123/CredentialLists/CL123')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'CL123', 'friendly_name' => 'CredentialList'))
            ));
        $trunkingClient = new Trunking_Services_Twilio('AC123', '123', 'v1', $http);
        $trunk = $trunkingClient->trunks->get('TK123');
        $credential_list = $trunk->credential_lists->get('CL123');
        $this->assertNotNull($credential_list);
        $this->assertEquals('CredentialList', $credential_list->friendly_name);
    }

    function testCreate() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('post')->once()
            ->with('/v1/Trunks/TK123/CredentialLists', $this->formHeaders,
                'CredentialListSid=CL123')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'CL123'))
            ));
        $trunkingClient = new Trunking_Services_Twilio('AC123', '123', '2010-04-01', $http);
        $trunk = $trunkingClient->trunks->get('TK123');
        $credential_list = $trunk->credential_lists->create(array(
            'CredentialListSid' => 'CL123'
        ));
        $this->assertSame('CL123', $credential_list->sid);
    }

    function testDelete() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('delete')->once()
            ->with('/v1/Trunks/TK123/CredentialLists/CL123')
            ->andReturn(array(204, array('Content-Type' => 'application/json'), ''
        ));
        $trunkingClient = new Trunking_Services_Twilio('AC123', '123', null, $http);
        $trunk = $trunkingClient->trunks->get('TK123');
        $trunk->credential_lists->delete('CL123');
    }

    function tearDown()
    {
        m::close();
    }
}
