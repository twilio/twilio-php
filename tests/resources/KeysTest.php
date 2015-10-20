<?php

use \Mockery as m;

class KeysTest extends PHPUnit_Framework_TestCase
{

    protected $formHeaders = array('Content-Type' => 'application/x-www-form-urlencoded');

    function testDelete()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('delete')->once()
            ->with('/2010-04-01/Accounts/AC123/Keys/SK123.json')
            ->andReturn(array(204, array('Content-Type' => 'application/json'), ''
            ));
        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http);
        $client->account->keys->delete('SK123');
    }

    function testGet()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/2010-04-01/Accounts/AC123/Keys/SK123.json')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'SK123', 'friendly_name' => 'foo'))
            ));
        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http);
        $key = $client->account->keys->get('SK123');
        $this->assertNotNull($key);
        $this->assertEquals('foo', $key->friendly_name);
    }

    function testPost()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('post')->once()
            ->with('/2010-04-01/Accounts/AC123/Keys.json',
                $this->formHeaders, 'FriendlyName=foo')
            ->andReturn(array(201, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'SK123', 'secret' => 'SomeSecret'))
            ));
        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http);
        $key = $client->account->keys->create(array('FriendlyName' => 'foo'));
        $this->assertEquals('SK123', $key->sid);
        $this->assertEquals('SomeSecret', $key->secret);
    }

    function tearDown()
    {
        m::close();
    }
}
