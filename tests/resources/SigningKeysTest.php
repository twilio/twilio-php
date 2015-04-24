<?php

use \Mockery as m;

class SigningKeysTest extends PHPUnit_Framework_TestCase
{

    protected $formHeaders = array('Content-Type' => 'application/x-www-form-urlencoded');

    function testDelete()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('delete')->once()
            ->with('/2010-04-01/Accounts/AC123/SigningKeys/SK123.json')
            ->andReturn(array(204, array('Content-Type' => 'application/json'), ''
            ));
        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http);
        $client->account->signing_keys->delete('SK123');
    }

    function testGet()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/2010-04-01/Accounts/AC123/SigningKeys/SK123.json')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'SK123', 'friendly_name' => 'foo'))
            ));
        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http);
        $signingKey = $client->account->signing_keys->get('SK123');
        $this->assertNotNull($signingKey);
        $this->assertEquals('foo', $signingKey->friendly_name);
    }

    function testPost()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('post')->once()
            ->with('/2010-04-01/Accounts/AC123/SigningKeys.json',
                $this->formHeaders, 'FriendlyName=foo')
            ->andReturn(array(201, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'SK123', 'secret' => 'SomeSecret'))
            ));
        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http);
        $signingKey = $client->account->signing_keys->create(array('FriendlyName' => 'foo'));
        $this->assertEquals('SK123', $signingKey->sid);
        $this->assertEquals('SomeSecret', $signingKey->secret);
    }

    function tearDown()
    {
        m::close();
    }
}
