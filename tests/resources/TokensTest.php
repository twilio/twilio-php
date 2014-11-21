<?php

use \Mockery as m;

class TokensTest extends PHPUnit_Framework_TestCase
{
    protected $formHeaders = array('Content-Type' => 'application/x-www-form-urlencoded');

    function testCreateToken() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('post')->once()
            ->with('/2010-04-01/Accounts/AC123/Tokens.json', $this->formHeaders, '')
            ->andReturn(array(201, array('Content-Type' => 'application/json'),
                json_encode(array(
                    'username' => 'user',
                    'password' => 'pass',
                    'ttl' => 86400,
                    'account_sid' => 'AC123',
                    'ice_servers' => array('example.com'),
                    'date_created' => 'yesterday',
                    'date_updated' => 'right now')
                )
        ));
        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http);
        $token = $client->account->tokens->create();
        $this->assertSame('user', $token->username);

    }
}
