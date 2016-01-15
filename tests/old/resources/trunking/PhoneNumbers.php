<?php

use \Mockery as m;

class TrunkingPhoneNumbersTest extends PHPUnit_Framework_TestCase
{
    protected $formHeaders = array('Content-Type' => 'application/x-www-form-urlencoded');

    function testRead()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/v1/Trunks/TK123/PhoneNumbers?Page=0&PageSize=50')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array(
                    'meta' => array('key' => 'phone_numbers', 'next_page_url' => null),
                    'phone_numbers' => array(array('sid' => 'PN123'))
                ))
            ));
        $trunkingClient = new Trunking_Services_Twilio('AC123', '123', 'v1', $http);
        $trunk = $trunkingClient->trunks->get('TK123');
        foreach ($trunk->phone_numbers->getIterator(0, 50) as $phone_number) {
            $this->assertEquals('PN123', $phone_number->sid);
        }
    }

    function testFetch() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/v1/Trunks/TK123/PhoneNumbers/PN123')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'PN123', 'friendly_name' => 'PhoneNumber'))
            ));
        $trunkingClient = new Trunking_Services_Twilio('AC123', '123', 'v1', $http);
        $trunk = $trunkingClient->trunks->get('TK123');
        $phone_number = $trunk->phone_numbers->get('PN123');
        $this->assertNotNull($phone_number);
        $this->assertEquals('PhoneNumber', $phone_number->friendly_name);
    }

    function testCreate() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('post')->once()
            ->with('/v1/Trunks/TK123/PhoneNumbers', $this->formHeaders,
                'PhoneNumberSid=PN123')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'PN123'))
            ));
        $trunkingClient = new Trunking_Services_Twilio('AC123', '123', '2010-04-01', $http);
        $trunk = $trunkingClient->trunks->get('TK123');
        $phone_number = $trunk->phone_numbers->create(array(
            'PhoneNumberSid' => 'PN123'
        ));
        $this->assertSame('PN123', $phone_number->sid);
    }

    function testDelete() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('delete')->once()
            ->with('/v1/Trunks/TK123/PhoneNumbers/PN123')
            ->andReturn(array(204, array('Content-Type' => 'application/json'), ''
        ));
        $trunkingClient = new Trunking_Services_Twilio('AC123', '123', null, $http);
        $trunk = $trunkingClient->trunks->get('TK123');
        $trunk->phone_numbers->delete('PN123');
    }

    function tearDown()
    {
        m::close();
    }
}
