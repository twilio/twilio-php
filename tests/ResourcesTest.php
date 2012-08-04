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
        $numsList = $nums->getList(array('AreaCode' => '510'));
        foreach ($numsList as $num) {
            $this->assertEquals('(510) 564-7903', $num->friendly_name);
        }
    }

    function testPagePhoneNumberResource() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/2010-04-01/Accounts/AC123/AvailablePhoneNumbers.json?Page=0&PageSize=50')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array(
                    'total' => 1,
                    'countries' => array(array('country_code' => 'CA'))
                ))
            ));
        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http);
        $page = $client->account->available_phone_numbers->getPage('0');
        $this->assertEquals('CA', $page->countries[0]->country_code);
    }

    function tearDown() {
        m::close();
    }
}

class SandboxTest extends PHPUnit_Framework_TestCase
{
    protected $formHeaders = array('Content-Type' => 'application/x-www-form-urlencoded');
    function testUpdateVoiceUrl()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('post')->once()
            ->with('/2010-04-01/Accounts/AC123/Sandbox.json', $this->formHeaders, 'VoiceUrl=foo')
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
    protected $formHeaders = array('Content-Type' => 'application/x-www-form-urlencoded');
    function testPost()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('post')->once()
            ->with('/2010-04-01/Accounts/AC123/OutgoingCallerIds.json',
                $this->formHeaders, 'PhoneNumber=%2B14158675309&FriendlyName=My+Home+Phone+Number')
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
    protected $formHeaders = array('Content-Type' => 'application/x-www-form-urlencoded');
    function testPost()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('post')->once()
            ->with('/2010-04-01/Accounts/AC123/Applications.json',
                $this->formHeaders, 'FriendlyName=foo&VoiceUrl=bar')
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

class AccountsTest extends PHPUnit_Framework_TestCase
{
    protected $formHeaders = array('Content-Type' => 'application/x-www-form-urlencoded');
    function testPost()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('post')->once()
            ->with('/2010-04-01/Accounts.json',
                $this->formHeaders, 'FriendlyName=foo')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'AC345'))
            ));
        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http);
        $account = $client->accounts->create(array(
            'FriendlyName' => 'foo',
        ));
        $this->assertEquals('AC345', $account->sid);
    }

    function tearDown()
    {
        m::close();
    }
}

class ConnectAppsTest extends PHPUnit_Framework_TestCase
{
    function testUpdateWithArray()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/2010-04-01/Accounts/AC123/ConnectApps/CN123.json')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('friendly_name' => 'foo'))
            ));
        $http->shouldReceive('post')->once()
            ->with('/2010-04-01/Accounts/AC123/ConnectApps/CN123.json', 
            array('Content-Type' => 'application/x-www-form-urlencoded'), 
            'FriendlyName=Bar')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('friendly_name' => 'Bar'))
            ));
        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http);
        $cn = $client->account->connect_apps->get('CN123');
        $this->assertEquals('foo', $cn->friendly_name);
        $cn->update(array('FriendlyName' => 'Bar'));
        $this->assertEquals('Bar', $cn->friendly_name);
    }

    function testUpdateWithOneParam()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/2010-04-01/Accounts/AC123/ConnectApps/CN123.json')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('friendly_name' => 'foo'))
            ));
        $http->shouldReceive('post')->once()
            ->with('/2010-04-01/Accounts/AC123/ConnectApps/CN123.json', 
            array('Content-Type' => 'application/x-www-form-urlencoded'), 
            'FriendlyName=Bar')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('friendly_name' => 'Bar'))
            ));
        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http);
        $cn = $client->account->connect_apps->get('CN123');
        $this->assertEquals('foo', $cn->friendly_name);
        $cn->update('FriendlyName', 'Bar');
        $this->assertEquals('Bar', $cn->friendly_name);
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

class SMSMessagesTest extends PHPUnit_Framework_TestCase
{
    protected $formHeaders = array('Content-Type' => 'application/x-www-form-urlencoded');

    function testCreateMessage() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('post')->once()
            ->with('/2010-04-01/Accounts/AC123/SMS/Messages.json', $this->formHeaders, 
                'From=%2B1222&To=%2B44123&Body=Hi+there')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'SM123'))
            ));
        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http);
        $sms = $client->account->sms_messages->create('+1222', '+44123', 'Hi there');
        $this->assertSame('SM123', $sms->sid);
    }

    function testBadMessageThrowsException() {
        $this->setExpectedException('Services_Twilio_RestException');
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('post')->once()
            ->with('/2010-04-01/Accounts/AC123/SMS/Messages.json', $this->formHeaders, 
                'From=%2B1222&To=%2B44123&Body=' . str_repeat('hi', 81))
            ->andReturn(array(400, array('Content-Type' => 'application/json'),
                json_encode(array(
                    'status' => '400',
                    'message' => 'Too long',
                ))
            ));
        $client = new Services_Twilio('AC123', '123', null, $http);
        $sms = $client->account->sms_messages->create('+1222', '+44123', 
            str_repeat('hi', 81));
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

class MembersTest extends PHPUnit_Framework_TestCase {

    protected $formHeaders = array('Content-Type' => 'application/x-www-form-urlencoded');

    function testFront() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/2010-04-01/Accounts/AC123/Queues/QQ123/Members/Front.json')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('call_sid' => 'CA123', 'position' => 0))
            ));
        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http);
        $queue = $client->account->queues->get('QQ123');
        $firstMember = $queue->members->front();
        $this->assertSame($firstMember->call_sid, 'CA123');
    }

    function testDequeueFront() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('post')->once()
            ->with('/2010-04-01/Accounts/AC123/Queues/QQ123/Members/Front.json',
                $this->formHeaders, 'Url=http%3A%2F%2Ffoo.com&Method=POST')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('call_sid' => 'CA123', 'position' => 0))
            ));
        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http);
        $queue = $client->account->queues->get('QQ123');
        $firstMember = $queue->members->front();
        $firstMember->dequeue('http://foo.com');
    }

    function testDequeueSid() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('post')->once()
            ->with('/2010-04-01/Accounts/AC123/Queues/QQ123/Members/CA123.json',
                $this->formHeaders, 'Url=http%3A%2F%2Ffoo.com&Method=GET')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('call_sid' => 'CA123', 'position' => 0))
            ));
        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http);
        $queue = $client->account->queues->get('QQ123');
        $firstMember = $queue->members->get('CA123');
        $firstMember->dequeue('http://foo.com', 'GET');
    }

    function tearDown() {
        m::close();
    }

}

class QueuesTest extends PHPUnit_Framework_TestCase {

    protected $formHeaders = array('Content-Type' => 'application/x-www-form-urlencoded');

    function testCreate() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('post')->once()
            ->with('/2010-04-01/Accounts/AC123/Queues.json', $this->formHeaders,
                'FriendlyName=foo&MaxSize=123')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'QQ123', 'average_wait_time' => 0))
            ));
        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http);
        $queue = $client->account->queues->create('foo', 
            array('MaxSize' => 123));
        $this->assertSame($queue->sid, 'QQ123');
        $this->assertSame($queue->average_wait_time, 0);
    }

    function tearDown() {
        m::close();
    }
}
