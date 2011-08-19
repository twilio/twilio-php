<?php

use \Mockery as m;

class TwilioTest extends PHPUnit_Framework_TestCase {
    function tearDown() {
        m::close();
    }
    function testNeedsRefining() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/2010-04-01/Accounts/AC123.json')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array(
                    'sid' => 'AC123',
                    'friendly_name' => 'Robert Paulson',
                ))
            ));
        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http);
        $this->assertEquals('AC123', $client->account->sid);
        $this->assertEquals('Robert Paulson', $client->account->friendly_name);
    }

    function testAccessSidAvoidsNetworkCall() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->never();
        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http);
        $client->account->sid;
    }

    function testObjectLoadsOnlyOnce() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/2010-04-01/Accounts/AC123.json')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array(
                    'sid' => 'AC123',
                    'friendly_name' => 'Robert Paulson',
                    'status' => 'active',
                ))
            ));
        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http);
        $client->account->friendly_name;
        $client->account->friendly_name;
        $client->account->status;
    }

    function testSubresourceLoad() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/2010-04-01/Accounts/AC123/Calls/CA123.json')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('status' => 'Completed'))
            ));

        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http);
        $this->assertEquals(
            'Completed',
            $client->account->calls->get('CA123')->status
        );
    }

    function testSubresourceSubresource() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/2010-04-01/Accounts/AC123/Calls/CA123/Notifications/NO123.json')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('message_text' => 'Foo'))
            ));

        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http);
        $notifs = $client->account->calls->get('CA123')->notifications;
        $this->assertEquals('Foo', $notifs->get('NO123')->message_text);
    }

    function testGetIteratorUsesFilters() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $qs = '?Page=0&PageSize=10&StartTime%3E=2009-07-06';
        $http->shouldReceive('get')->once()
            ->with('/2010-04-01/Accounts/AC123/Calls.json' . $qs)
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array(
                    'total' => 1,
                    'calls' => array(array('status' => 'Completed', 'sid' => 'CA123'))
                ))
            ));
        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http);
        $iterator = $client->account->calls->getIterator(
            0, 10, array('StartTime>' => '2009-07-06'));
        foreach ($iterator as $call) {
            $this->assertEquals('Completed', $call->status);
            break;
        }
    }

    function testGetIteratorUsesFiltersMoreThanOnce() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $qs = '?Page=0&PageSize=1&StartTime%3E=2009-07-06';
        $http->shouldReceive('get')->twice()
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array(
                    'total' => 2,
                    'calls' => array(array('status' => 'Completed', 'sid' => 'CA123'))
                ))
            ));
        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http);
        $iterator = $client->account->calls->getIterator(
            0, 1, array('StartTime>' => '2009-07-06'));
        foreach ($iterator as $call) {
            $this->assertEquals('Completed', $call->status);
        }
    }

    function testListResource() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/2010-04-01/Accounts/AC123/Calls.json?Page=0&PageSize=10')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array(
                    'total' => 1,
                    'calls' => array(array('status' => 'Completed', 'sid' => 'CA123'))
                ))
            ));
        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http);
        $page = $client->account->calls->getPage(0, 10);
        $call = current($page->getItems());
        $this->assertEquals('Completed', $call->status);
        $this->assertEquals(1, $page->total);
    }

    function testAsymmetricallyNamedResources() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/2010-04-01/Accounts/AC123/SMS/Messages.json?Page=0&PageSize=10')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sms_messages' => array(
                    array('status' => 'sent', 'sid' => 'SM123')
                )))
            ));
        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http);
        $sms = current($client->account->sms_messages->getPage(0, 10)->getItems());
        $this->assertEquals('sent', $sms->status);
    }

    function testParams() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $qs = 'Page=0&PageSize=10&FriendlyName=foo&Status=active';
        $http->shouldReceive('get')
            ->with('/2010-04-01/Accounts.json?' . $qs)
            ->andReturn(array(
                200,
                array('Content-Type' => 'application/json'),
                '{"accounts":[]}'
            ));
        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http);
        $client->accounts->getPage(0, 10, array(
            'FriendlyName' => 'foo',
            'Status' => 'active',
        ));
    }

    function testUpdate() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('post')->once()
            ->with('/2010-04-01/Accounts/AC123/Calls.json', m::any(), m::any())
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                '{"sid":"CA123"}'
            ));
        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http);
        $client->account->calls->create('123', '123', 'http://example.com');
    }

    function testModifyLiveCall() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('post')->once()
            ->with('/2010-04-01/Accounts/AC123/Calls.json', m::any(), m::any())
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                '{"sid":"CA123"}'
            ));
        $http->shouldReceive('post')->once()
            ->with('/2010-04-01/Accounts/AC123/Calls/CA123.json', m::any(),
                'Status=completed')
                ->andReturn(array(200, array('Content-Type' => 'application/json'),
                    '{"sid":"CA123"}'
                ));
        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http);
        $calls = $client->account->calls;
        $calls->create('123', '123', 'http://example.com')->hangup();
    }

    function testUnmute() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with(
                '/2010-04-01/Accounts/AC123/Conferences/CF123/Participants.json?Page=0&PageSize=10')
                ->andReturn(array(200, array('Content-Type' => 'application/json'),
                    json_encode(array(
                        'participants' => array(array('sid' => 'CA123'))
                    ))
                ));
        $http->shouldReceive('post')->once()
            ->with(
                '/2010-04-01/Accounts/AC123/Conferences/CF123/Participants/CA123.json',
                m::any(),
                'Muted=true'
            )->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode('{}')
            ));
        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http);
        $conf = $client->account->conferences->get('CF123');
        $page = $conf->participants->getPage(0, 10);
        foreach ($page->getItems() as $participant) {
            $participant->mute();
        }
    }

    function testResourcePropertiesReflectUpdates() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/2010-04-01/Accounts/AC123.json')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('friendly_name' => 'foo'))
            ));
        $http->shouldReceive('post')->once()
            ->with('/2010-04-01/Accounts/AC123.json', m::any(), m::any())
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('friendly_name' => 'bar'))
            ));
        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http);
        $this->assertEquals('foo', $client->account->friendly_name);
        $client->account->update('FriendlyName', 'bar');
        $this->assertEquals('bar', $client->account->friendly_name);
    }

    //function testAccessingNonExistentPropertiesErrorsOut

    function testArrayAccessForListResources() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/2010-04-01/Accounts/AC123/Calls.json?Page=0&PageSize=50')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array(
                    'calls' => array(array('sid' => 'CA123'))
                ))
            ));
        $http->shouldReceive('get')->once()
            ->with('/2010-04-01/Accounts/AC123/Calls.json?Page=1&PageSize=50')
            ->andReturn(array(400, array('Content-Type' => 'application/json'),
                '{"status":400,"message":"foo"}'
            ));
        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http);
        foreach ($client->account->calls as $call) {
            $this->assertEquals('CA123', $call->sid);
        }
        $this->assertInstanceOf('Traversable', $client->account->calls);
    }
}
