<?php

use \Mockery as m;

class AvailablePhoneNumbersTest extends PHPUnit_Framework_TestCase {
    function testPartialApplication() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/2010-04-01/Accounts/AC123/AvailablePhoneNumbers/US/Local.json?AreaCode=510')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('available_phone_numbers' => array(
                    'friendly_name' => '(510) 564-7903'
                )))
            ));
        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http);
        $nums = $client->account->available_phone_numbers->getLocal('US');
        foreach ($nums->getList(array('AreaCode' => '510')) as $num) {
            $this->assertEquals('(510) 564-7903', $num->friendly_name);
        }
    }

    function tearDown() {
        m::close();
    }
}

class SandboxTest extends PHPUnit_Framework_TestCase
{
    function testUpdateVoiceUrl()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('post')->once()
            ->with('/2010-04-01/Accounts/AC123/Sandbox.json', m::any(), 'VoiceUrl=foo')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('voice_url' => 'foo'))
            ));
        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http);
        $client->account->sandbox->update('VoiceUrl', 'foo');
        $this->assertEquals('foo', $client->account->sandbox->voice_url);
    }

    function tearDown() {
        m::close();
    }
}

class OutgoingCallerIdsTest extends PHPUnit_Framework_TestCase
{
    function testPost()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('post')->once()
            ->with('/2010-04-01/Accounts/AC123/OutgoingCallerIds.json',
                m::any(), 'PhoneNumber=%2B14158675309&FriendlyName=My+Home+Phone+Number')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array(
                    'account_sid' => 'AC123',
                    'phone_number' => '+14158675309',
                    'friendly_name' => 'My Home Phone Number',
                    'validation_code' => 123456,
                ))
            ));
        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http);
        $request = $client->account->outgoing_caller_ids->create('+14158675309', array(
            'FriendlyName' => 'My Home Phone Number',
        ));
        $this->assertEquals(123456, $request->validation_code);
    }

    function tearDown()
    {
        m::close();
    }
}

class ApplicationsTest extends PHPUnit_Framework_TestCase
{
    function testPost()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('post')->once()
            ->with('/2010-04-01/Accounts/AC123/Applications.json',
                m::any(), 'FriendlyName=foo&VoiceUrl=bar')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'AP123'))
            ));
        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http);
        $app = $client->account->applications->create('foo', array(
            'VoiceUrl' => 'bar',
        ));
        $this->assertEquals('AP123', $app->sid);
    }

    function tearDown()
    {
        m::close();
    }
}

class NotificationTest extends PHPUnit_Framework_TestCase
{
    function testDelete() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('delete')->once()
            ->with('/2010-04-01/Accounts/AC123/Notifications/NO123.json')
            ->andReturn(array(204, array(), ''));
        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http);
        $client->account->notifications->delete('NO123');
    }

    function tearDown()
    {
        m::close();
    }
}


class CallsTest extends PHPUnit_Framework_TestCase
{
	/**
	 * @dataProvider sidProvider
	 */
    function testApplicationSid($sid, $expected)
	{
		$result = Services_Twilio_Rest_Calls::isApplicationSid($sid);
		$this->assertEquals($expected, $result);
	}

    function sidProvider()
	{
		return array(
			array("AP2a0747eba6abf96b7e3c3ff0b4530f6e", true),
			array("CA2a0747eba6abf96b7e3c3ff0b4530f6e", false),
			array("AP2a0747eba6abf96b7e3c3ff0b4530f", false),
			array("http://www.google.com/asdfasdfAP", false),
		);
	}
}
