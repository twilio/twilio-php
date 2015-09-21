<?php

use \Mockery as m;

class TrunkingOriginationUrlsTest extends PHPUnit_Framework_TestCase
{
    protected $formHeaders = array('Content-Type' => 'application/x-www-form-urlencoded');

    function testRead()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/v1/Trunks/TK123/OriginationUrls?Page=0&PageSize=50')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array(
                    'meta' => array('key' => 'origination_urls', 'next_page_url' => null),
                    'origination_urls' => array(array('sid' => 'OU123'))
                ))
            ));
        $trunkingClient = new Trunking_Services_Twilio('AC123', '123', 'v1', $http);
        $trunk = $trunkingClient->trunks->get('TK123');
        foreach ($trunk->origination_urls->getIterator(0, 50) as $origination_url) {
            $this->assertEquals('OU123', $origination_url->sid);
        }
    }

    function testFetch() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/v1/Trunks/TK123/OriginationUrls/OU123')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'OU123', 'friendly_name' => 'OriginationUrl'))
            ));
        $trunkingClient = new Trunking_Services_Twilio('AC123', '123', 'v1', $http);
        $trunk = $trunkingClient->trunks->get('TK123');
        $origination_url = $trunk->origination_urls->get('OU123');
        $this->assertNotNull($origination_url);
        $this->assertEquals('OriginationUrl', $origination_url->friendly_name);
    }

    function testCreate() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('post')->once()
            ->with('/v1/Trunks/TK123/OriginationUrls', $this->formHeaders,
                'FriendlyName=TestUrl')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'OU123'))
            ));
        $trunkingClient = new Trunking_Services_Twilio('AC123', '123', '2010-04-01', $http);
        $trunk = $trunkingClient->trunks->get('TK123');
        $origination_url = $trunk->origination_urls->create(array(
            'FriendlyName' => 'TestUrl'
        ));
        $this->assertSame('OU123', $origination_url->sid);
    }

    function testUpdate() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('post')->once()
            ->with('/v1/Trunks/TK123/OriginationUrls/OU123', $this->formHeaders,
                'FriendlyName=TestUrl&SipUrl=http://sip.com')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'OU123'))
            ));
        $trunkingClient = new Trunking_Services_Twilio('AC123', '123', '2010-04-01', $http);
        $trunk = $trunkingClient->trunks->get('TK123');
        $origination_url = $trunk->origination_urls->get('OU123');
        $origination_url->update(array(
            'FriendlyName' => 'TestUrl',
            'SipUrl' => 'http://sip.com'
        ));
        $this->assertSame('OU123', $orignation_url->sid);
    }

    function testDelete() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('delete')->once()
            ->with('/v1/Trunks/TK123/OriginationUrls/OU123')
            ->andReturn(array(204, array('Content-Type' => 'application/json'), ''
        ));
        $trunkingClient = new Trunking_Services_Twilio('AC123', '123', null, $http);
        $trunk = $trunkingClient->trunks->get('TK123');
        $trunk->origination_urls->delete('OU123');
    }

    function tearDown()
    {
        m::close();
    }
}
