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

class IncomingPhoneNumbersTest extends PHPUnit_Framework_TestCase {

    protected $apiResponse = array(
        'end' => '0',
        'incoming_phone_numbers' => array(
            array(
                'sid' => 'PN123',
                'sms_fallback_method' => 'POST',
                'voice_method' => 'POST',
            )
        ),
        'next_page_uri' => 'null',
        'start' => 0,
    );

    function testGetNumberWithResult() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/2010-04-01/Accounts/AC123/IncomingPhoneNumbers.json?Page=0&PageSize=1&PhoneNumber=%2B14105551234')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode($this->apiResponse)
            )
        );
        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http);
        $number = $client->account->incoming_phone_numbers->getNumber('+14105551234');
        $this->assertEquals('PN123', $number->sid);
    }

    function testGetNumberNoResults() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/2010-04-01/Accounts/AC123/IncomingPhoneNumbers.json?Page=0&PageSize=1&PhoneNumber=%2B14105551234')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array(
                    'incoming_phone_numbers' => array(),
                    'page' => 0,
                    'page_size' => 1,
                ))
            )
        );
        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http);
        $number = $client->account->incoming_phone_numbers->getNumber('+14105551234');
        $this->assertNull($number);
    }
}

class SandboxTest extends PHPUnit_Framework_TestCase {
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

class ShortCodesTest extends PHPUnit_Framework_TestCase {

    function testShortcodeResource() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/2010-04-01/Accounts/AC123/SMS/ShortCodes/SC123.json')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'SC123', 'short_code' => '1234'))
            ));
        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http);
        $sms = $client->account->short_codes->get('SC123');
        $this->assertSame('1234', $sms->short_code);
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

    function testMemberIterate() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $resp = json_encode(
                    array(
                        'queue_members' => array(
                            array('call_sid' => 'CA123', 'wait_time' => 30)
                        ),
                        'end' => 1,
                    )
                );
        $http->shouldReceive('get')->once()
            ->with('/2010-04-01/Accounts/AC123/Queues/QQ123/Members.json?Page=0&PageSize=50')
            ->andReturn(array(200, array('Content-Type' => 'application/json'), $resp
            ));
        $http->shouldReceive('get')->once()
            ->with('/2010-04-01/Accounts/AC123/Queues/QQ123/Members.json?Page=1&PageSize=50')
            ->andReturn(array(400, array('Content-Type' => 'application/json'),
                '{"status":400,"message":"foo", "code": "20006"}'
            ));
        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http);
        $queue = $client->account->queues->get('QQ123');
        foreach($queue->members as $member) {
            $this->assertSame($member->call_sid, 'CA123');
            $this->assertSame($member->wait_time, 30);
        }
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

class RecordsTest extends PHPUnit_Framework_TestCase {

    function testGetBaseRecord() {

        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/2010-04-01/Accounts/AC123/Usage/Records.json?Page=0&PageSize=50')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('usage_records' => array(
                    array(
                        'category' => 'sms',
                        'count' => 5,
                        'end_date' => '2012-08-01',
                    ),
                    array(
                        'category' => 'calleridlookups',
                        'count' => 5,
                        'end_date' => '2012-08-01',
                    ))
                ))
            ));
        $http->shouldReceive('get')->once()
            ->with('/2010-04-01/Accounts/AC123/Usage/Records.json?Page=1&PageSize=50')
            ->andReturn(array(400, array('Content-Type' => 'application/json'),
                '{"status":400,"message":"foo", "code": "20006"}'
            ));

        $client = new Services_Twilio('AC123', '456bef', '2010-04-01', $http);
        foreach ($client->account->usage_records as $record) {
            $this->assertSame(5, $record->count);
        }
    }

    function testUsageRecordSubresource() {

        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/2010-04-01/Accounts/AC123/Usage/Records/LastMonth.json?Page=0&PageSize=50')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('usage_records' => array(
                    array(
                        'category' => 'sms',
                        'count' => 4,
                        'end_date' => '2012-08-01',
                    ),
                    array(
                        'category' => 'calleridlookups',
                        'count' => 4,
                        'end_date' => '2012-08-01',
                    ))
                ))
            ));
        $http->shouldReceive('get')->once()
            ->with('/2010-04-01/Accounts/AC123/Usage/Records/LastMonth.json?Page=1&PageSize=50')
            ->andReturn(array(400, array('Content-Type' => 'application/json'),
                '{"status":400,"message":"foo", "code": "20006"}'
            ));

        $client = new Services_Twilio('AC123', '456bef', '2010-04-01', $http);
        foreach ($client->account->usage_records->last_month as $record) {
            $this->assertSame('2012-08-01', $record->end_date);
        }
    }

    function testGetCategory() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/2010-04-01/Accounts/AC123/Usage/Records.json?Page=0&PageSize=1&Category=calls')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('usage_records' => array(
                    array(
                        'category' => 'calls',
                        'count' => 4,
                        'price' => '100.30',
                        'end_date' => '2012-08-01',
                    )),
                ))
            ));
        $client = new Services_Twilio('AC123', '456bef', '2010-04-01', $http);
        $callRecord = $client->account->usage_records->getCategory('calls');
        $this->assertSame('100.30', $callRecord->price);
    }

    function testFilterUsageRecords() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $params = 'Page=0&PageSize=50&StartDate=2012-08-01&EndDate=2012-08-31';
        $http->shouldReceive('get')->once()
            ->with('/2010-04-01/Accounts/AC123/Usage/Records.json?' . $params)
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('usage_records' => array(
                    array(
                        'category' => 'sms',
                        'count' => 4,
                        'price' => '300.30',
                    ),
                    array(
                        'category' => 'calls',
                        'count' => 4,
                        'price' => '100.30',
                    )),
                ))
            ));
        $params = 'Page=1&PageSize=50&StartDate=2012-08-01&EndDate=2012-08-31';
        $http->shouldReceive('get')->once()
            ->with('/2010-04-01/Accounts/AC123/Usage/Records.json?' . $params)
            ->andReturn(array(400, array('Content-Type' => 'application/json'),
                '{"status":400,"message":"foo", "code": "20006"}'
            ));
        $client = new Services_Twilio('AC123', '456bef', '2010-04-01', $http);
        foreach ($client->account->usage_records->getIterator(0, 50, array(
            'StartDate' => '2012-08-01',
            'EndDate'   => '2012-08-31',
        )) as $record) {
            $this->assertSame(4, $record->count);
        }
    }

    function testGetCategoryOnSubresource() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $params = 'Page=0&PageSize=1&Category=sms';
        $http->shouldReceive('get')->once()
            ->with('/2010-04-01/Accounts/AC123/Usage/Records/Today.json?' . $params)
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('usage_records' => array(
                    array(
                        'category' => 'sms',
                        'count' => 4,
                        'price' => '100.30',
                        'end_date' => '2012-08-30'
                    )),
                ))
            ));
        $client = new Services_Twilio('AC123', '456bef', '2010-04-01', $http);
        $smsRecord = $client->account->usage_records->today->getCategory('sms');
        $this->assertSame($smsRecord->end_date, '2012-08-30');
    }

    function testTimeSeriesFilters() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $params = 'Page=0&PageSize=50&StartDate=2012-08-01&EndDate=2012-08-31&Category=recordings';
        $http->shouldReceive('get')->once()
            ->with('/2010-04-01/Accounts/AC123/Usage/Records/Daily.json?' . $params)
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('usage_records' => array(
                    array(
                        'category' => 'recordings',
                        'count' => 4,
                        'price' => '100.30',
                        'end_date' => '2012-08-31'
                    ),
                    array(
                        'category' => 'recordings',
                        'count' => 4,
                        'price' => '100.30',
                        'end_date' => '2012-08-30'
                    )),
                ))
            ));
        $params = 'Page=1&PageSize=50&StartDate=2012-08-01&EndDate=2012-08-31&Category=recordings';
        $http->shouldReceive('get')->once()
            ->with('/2010-04-01/Accounts/AC123/Usage/Records/Daily.json?' . $params)
            ->andReturn(array(400, array('Content-Type' => 'application/json'),
                '{"status":400,"message":"foo", "code": "20006"}'
            ));
        $client = new Services_Twilio('AC123', '456bef', '2010-04-01', $http);
        foreach ($client->account->usage_records->daily->getIterator(0, 50, array(
            'StartDate' => '2012-08-01',
            'EndDate'   => '2012-08-31',
            'Category'  => 'recordings',
        )) as $record) {
            $this->assertSame($record->category, 'recordings');
            $this->assertSame($record->price, '100.30');
        }
    }
}

class UsageTriggersTest extends PHPUnit_Framework_TestCase {
    function testRetrieveTrigger() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/2010-04-01/Accounts/AC123/Usage/Triggers/UT123.json')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array(
                    'sid' => 'UT123',
                    'date_created' => 'Tue, 09 Oct 2012 19:27:24 +0000',
                    'recurring' => null,
                    'usage_category' => 'totalprice',
                ))
            ));
        $client = new Services_Twilio('AC123', '456bef', '2010-04-01', $http);
        $usageSid = 'UT123';
        $usageTrigger = $client->account->usage_triggers->get($usageSid);
        $this->assertSame('totalprice', $usageTrigger->usage_category);
    }

    protected $formHeaders = array('Content-Type' => 'application/x-www-form-urlencoded');

    function testUpdateTrigger() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $usageSid = 'UT123';
        $http->shouldReceive('post')->once()
            ->with('/2010-04-01/Accounts/AC123/Usage/Triggers/UT123.json', 
                $this->formHeaders, 'FriendlyName=new')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array(
                    'friendly_name' => 'new', 
                    'sid' => 'UT123',
                    'uri' => '/2010-04-01/Accounts/AC123/Usage/Triggers/UT123.json'
                ))
            ));
        $http->shouldReceive('get')->once()
            ->with('/2010-04-01/Accounts/AC123/Usage/Triggers/UT123.json')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array(
                    'sid' => 'UT123',
                    'friendly_name' => 'new',
                ))
            ));
        $client = new Services_Twilio('AC123', '456bef', '2010-04-01', $http);
        $usageTrigger = $client->account->usage_triggers->get($usageSid);
        $usageTrigger->update(array(
            'FriendlyName' => 'new',
        ));
        $usageTrigger2 = $client->account->usage_triggers->get($usageSid);
        $this->assertSame('new', $usageTrigger2->friendly_name);
    }

    function testFilterTriggerList() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $params = 'Page=0&PageSize=50&UsageCategory=sms';
        $http->shouldReceive('get')->once()
            ->with('/2010-04-01/Accounts/AC123/Usage/Triggers.json?' . $params)
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('usage_triggers' => array(
                    array(
                        'usage_category' => 'sms',
                        'current_value' => '4',
                        'trigger_value' => '100.30',
                    ),
                    array(
                        'usage_category' => 'sms',
                        'current_value' => '4',
                        'trigger_value' => '400.30',
                    )),
                    'next_page_uri' => '/2010-04-01/Accounts/AC123/Usage/Triggers.json?UsageCategory=sms&Page=1&PageSize=50',
                ))
            ));
        $params = 'UsageCategory=sms&Page=1&PageSize=50';
        $http->shouldReceive('get')->once()
            ->with('/2010-04-01/Accounts/AC123/Usage/Triggers.json?' . $params)
            ->andReturn(array(400, array('Content-Type' => 'application/json'),
                '{"status":400,"message":"foo", "code": "20006"}'
            ));
        $client = new Services_Twilio('AC123', '456bef', '2010-04-01', $http);
        foreach ($client->account->usage_triggers->getIterator(
            0, 50, array(
                'UsageCategory' => 'sms',
            )) as $trigger
        ) {
            $this->assertSame($trigger->current_value, "4");
        }
    }

    function testCreateTrigger() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $params = 'UsageCategory=sms&TriggerValue=100&CallbackUrl=foo';
        $http->shouldReceive('post')->once()
            ->with('/2010-04-01/Accounts/AC123/Usage/Triggers.json', 
                $this->formHeaders, $params)
            ->andReturn(array(201, array('Content-Type' => 'application/json'),
                json_encode(array(
                    'usage_category' => 'sms',
                    'sid' => 'UT123',
                    'uri' => '/2010-04-01/Accounts/AC123/Usage/Triggers/UT123.json'
                ))
            ));
        $client = new Services_Twilio('AC123', '456bef', '2010-04-01', $http);
        $trigger = $client->account->usage_triggers->create(
            'sms',
            '100',
            'foo'
        );
        $this->assertSame('sms', $trigger->usage_category);
    }
}
