<?php

use \Mockery as m;

class TrunkingTrunksTest extends PHPUnit_Framework_TestCase
{
    protected $formHeaders = array('Content-Type' => 'application/x-www-form-urlencoded');

    function testRead()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/v1/Trunks?Page=0&PageSize=50')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array(
                    'meta' => array('key' => 'trunks', 'next_page_url' => null),
                    'trunks' => array(array('sid' => 'TK123'))
                ))
            ));
        $trunkingClient = new Trunking_Services_Twilio('AC123', '123', 'v1', $http);
        foreach ($trunkingClient->trunks->getIterator(0, 50) as $trunk) {
            $this->assertEquals('TK123', $trunk->sid);
        }
    }

    function testFetch() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/v1/Trunks/TK123')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'TK123', 'friendly_name' => 'TestTrunk'))
            ));
        $trunkingClient = new Trunking_Services_Twilio('AC123', '123', 'v1', $http);
        $trunk = $trunkingClient->trunks->get('TK123');
        $this->assertNotNull($trunk);
        $this->assertEquals('TestTrunk', $trunk->friendly_name);
    }

    function testCreate() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('post')->once()
            ->with('/v1/Trunks', $this->formHeaders,
                'FriendlyName=TestTrunk&DomainName=test.pstn.twilio.com')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'TK123'))
            ));
        $trunkingClient = new Trunking_Services_Twilio('AC123', '123', '2010-04-01', $http);
        $trunk = $trunkingClient->trunks->create(array(
            'FriendlyName' => 'TestTrunk',
            'DomainName' => 'test.pstn.twilio.com'
        ));
        $this->assertSame('TK123', $trunk->sid);
    }

    function testUpdate() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('post')->once()
            ->with('/v1/Trunks/TK123', $this->formHeaders,
                'FriendlyName=TestTrunk&DomainName=test.pstn.twilio.com')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'TK123'))
            ));
        $trunkingClient = new Trunking_Services_Twilio('AC123', '123', '2010-04-01', $http);
        $trunk = $trunkingClient->trunks->get('TK123');
        $trunk->update(array(
            'FriendlyName' => 'TestTrunk',
            'DomainName' => 'test.pstn.twilio.com'
        ));
        $this->assertSame('TK123', $trunk->sid);
    }

    function testDelete() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('delete')->once()
            ->with('/v1/Trunks/TK123')
            ->andReturn(array(204, array('Content-Type' => 'application/json'), ''
        ));
        $trunkingClient = new Trunking_Services_Twilio('AC123', '123', null, $http);
        $trunkingClient->trunks->delete('TK123');
    }

    function tearDown()
    {
        m::close();
    }
}
