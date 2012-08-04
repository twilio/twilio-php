<?php

use \Mockery as m;

class TwilioTest extends PHPUnit_Framework_TestCase {

    protected $formHeaders = array('Content-Type' => 'application/x-www-form-urlencoded');
    protected $callParams = array('To' => '123', 'From' => '123', 'Url' => 'http://example.com');
    protected $nginxError = array(500, array('Content-Type' => 'text/html'),
                '<html>Nginx 500 error</html>'
            );
    function tearDown() {
        m::close();
    }

    /**
     * @dataProvider uriTestProvider
     */
    function testRequestUriConstructedProperly($path, $params, $full_uri, $end_string) {
        $this->assertSame($end_string, Services_Twilio::getRequestUri(
            $path, $params, $full_uri
        ));
    }

    function uriTestProvider() {
        return array(
            array('/2010-04-01/Accounts', array('FriendlyName' => 'hi'), false, 
                '/2010-04-01/Accounts.json?FriendlyName=hi'),
            array('/2010-04-01/Accounts', array(), false, 
                '/2010-04-01/Accounts.json'),
            array('/2010-04-01/Accounts.json', array(), true, 
                '/2010-04-01/Accounts.json'),
            array('/2010-04-01/Accounts.json', array('FriendlyName' => 'hi'), true, 
                '/2010-04-01/Accounts.json'),
            array('/2010-04-01/Accounts', array(
                'FriendlyName' => 'hi', 'foo' => 'bar'
            ), false, '/2010-04-01/Accounts.json?FriendlyName=hi&foo=bar'),
        );
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

    function testOnlyOneClientCreated() {
        $client = new Services_Twilio('AC123', '456');
        $client->account->client->sid = 'CL456';
        $this->assertSame('CL456', $client->account->sandbox->client->sid);
    }

    function testNullVersionReturnsNewest() {
        $client = new Services_Twilio('AC123', '123', null);
        $this->assertEquals('2010-04-01', $client->getVersion());
        $client = new Services_Twilio('AC123', '123', 'v1');
        $this->assertEquals('2010-04-01', $client->getVersion());
        $client = new Services_Twilio('AC123', '123', '2010-04-01');
        $this->assertEquals('2010-04-01', $client->getVersion());
        $client = new Services_Twilio('AC123', '123', '2008-08-01');
        $this->assertEquals('2008-08-01', $client->getVersion());
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

    function testListResource() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/2010-04-01/Accounts/AC123/Calls.json?Page=0&PageSize=10')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array(
                    'total' => 1,
                    'calls' => array(array('status' => 'completed', 'sid' => 'CA123'))
                ))
            ));
        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http);
        $page = $client->account->calls->getPage(0, 10);
        $call = current($page->getItems());
        $this->assertEquals('completed', $call->status);
        $this->assertEquals(1, $page->total);
    }

    function testInstanceResourceUriConstructedProperly() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/2010-04-01/Accounts/AC123/Calls.json?Page=0&PageSize=10')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array(
                    'total' => 1,
                    'calls' => array(array(
                        'status' => 'in-progress',
                        'sid' => 'CA123',
                        'uri' => 'junk_uri'
                    ))
                ))
            ));
        $http->shouldReceive('get')->once()
            ->with('/2010-04-01/Accounts/AC123/Calls/CA123.json')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array(
                    'status' => 'completed'
                ))
            ));
        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http);
        $page = $client->account->calls->getPage(0, 10);
        $call = current($page->getItems());

        /* trigger api fetch by trying to retrieve nonexistent var */
        try {
            $call->nonexistent;
        } catch (Exception $e) {
            // pass
        }
        $this->assertSame($call->status, 'completed');
    }

    function testIterateOverPage() {
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
        foreach ($page->getIterator() as $pageitems) {
            $this->assertSame('CA123', $pageitems->sid);
        }
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
        $http->shouldReceive('post')->once()->with(
                '/2010-04-01/Accounts/AC123/Calls.json', $this->formHeaders, 
                http_build_query($this->callParams)
            )->andReturn(
                array(200, array('Content-Type' => 'application/json'),
                '{"sid":"CA123"}')
        );
        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http);
        $client->account->calls->create('123', '123', 'http://example.com');
    }

    function testModifyLiveCall() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('post')->once()->with(
            '/2010-04-01/Accounts/AC123/Calls.json', $this->formHeaders, 
            http_build_query($this->callParams)
        )->andReturn(
            array(200, array('Content-Type' => 'application/json'), 
            '{"sid":"CA123"}')
        );
        $http->shouldReceive('post')->once()->with(
            '/2010-04-01/Accounts/AC123/Calls/CA123.json', 
            $this->formHeaders,
            'Status=completed'
        )->andReturn(
            array(200, array('Content-Type' => 'application/json'),
                '{"sid":"CA123"}'
            )
        );
        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http);
        $calls = $client->account->calls;
        $call = $calls->create('123', '123', 'http://example.com');
        $call->hangup();
    }

    function testUnmute() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with(
                '/2010-04-01/Accounts/AC123/Conferences/CF123/Participants.json?Page=0&PageSize=10')
                ->andReturn(array(200, array('Content-Type' => 'application/json'),
                    json_encode(array(
                        'participants' => array(array('call_sid' => 'CA123'))
                    ))
                ));
        $http->shouldReceive('post')->once()
            ->with(
                '/2010-04-01/Accounts/AC123/Conferences/CF123/Participants/CA123.json',
                $this->formHeaders,
                'Muted=true'
            )->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array())
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
            ->with('/2010-04-01/Accounts/AC123.json', $this->formHeaders, 'FriendlyName=bar')
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
                '{"status":400,"message":"foo", "code": "20006"}'
            ));
        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http);
        foreach ($client->account->calls as $call) {
            $this->assertEquals('CA123', $call->sid);
        }
        $this->assertInstanceOf('Traversable', $client->account->calls);
    }

    function testDeepPagingUsesAfterSid() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $callsBase = '/2010-04-01/Accounts/AC123/Calls.json';
        $firstPageUri = $callsBase . '?Page=0&PageSize=1';
        $afterSidUri = $callsBase . '?Page=1&PageSize=1&AfterSid=CA123';
        $secondAfterSidUri = $callsBase . '?Page=2&PageSize=1&AfterSid=CA456';
        $http->shouldReceive('get')->once()
            ->with($firstPageUri)
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array(
                    'next_page_uri' => $afterSidUri,
                    'calls' => array(array(
                        'sid' => 'CA123',
                        'price' => '-0.02000',
                    ))
                ))
            ));
        $http->shouldReceive('get')->once()
            ->with($afterSidUri)
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array(
                    'next_page_uri' => $secondAfterSidUri,
                    'calls' => array(array(
                        'sid' => 'CA456',
                        'price' => '-0.02000',
                    ))
                ))
            ));
        $http->shouldReceive('get')->once()
            ->with($secondAfterSidUri)
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array(
                    'next_page_uri' => null,
                    'calls' => array(array(
                        'sid' => 'CA789',
                        'price' => '-0.02000',
                    ))
                ))
            ));
        $http->shouldReceive('get')->once()
            ->with('/2010-04-01/Accounts/AC123/Calls.json?Page=3&PageSize=1')
            ->andReturn(array(400, array('Content-Type' => 'application/json'),
                '{"status":400,"message":"foo", "code": "20006"}'
            ));
        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http);
        foreach ($client->account->calls->getIterator(0, 1) as $call) {
            $this->assertSame($call->price, '-0.02000');
        }
    }

    function testIteratorWithFiltersPagesCorrectly() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $recordingsBase = '/2010-04-01/Accounts/AC123/Recordings.json';
        $firstPageUri = $recordingsBase . '?Page=0&PageSize=1&DateCreated%3E=2011-01-01';
        $secondPageUri = $recordingsBase . '?DateCreated%3E=2011-01-01&Page=1&PageSize=1';
        $thirdPageUri = $recordingsBase . '?DateCreated%3E=2011-01-01&Page=2&PageSize=1';
        $http->shouldReceive('get')->once()
            ->with($firstPageUri)
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array(
                    'next_page_uri' => $secondPageUri,
                    'recordings' => array(array(
                        'sid' => 'RE123',
                        'duration' => 7,
                    ))
                ))
            ));
        $http->shouldReceive('get')->once()
            ->with($secondPageUri)
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array(
                    'next_page_uri' => $thirdPageUri,
                    'recordings' => array(array(
                        'sid' => 'RE123',
                        'duration' => 7,
                    ))
                ))
            ));
        $http->shouldReceive('get')->once()
            ->with($thirdPageUri)
            ->andReturn(array(400, array('Content-Type' => 'application/json'),
                '{"status":400,"message":"foo", "code": "20006"}'
            ));

        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http);
        foreach ($client->account->recordings->getIterator(0, 1, array('DateCreated>' => '2011-01-01')) as $recording) {
            $this->assertSame($recording->duration, 7);
        }
    }

    function testRetryOn500() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/2010-04-01/Accounts/AC123/SMS/Messages/SM123.json')
            ->andReturn($this->nginxError);
        $http->shouldReceive('get')->once()
            ->with('/2010-04-01/Accounts/AC123/SMS/Messages/SM123.json')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('price' => 0.5))
            )
        );
        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http);
        $message = $client->account->sms_messages->get('SM123');
        $this->assertSame($message->price, 0.5);
    }

    function testDeleteOn500() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('delete')->once()
            ->with('/2010-04-01/Accounts/AC123/SMS/Messages/SM123.json')
            ->andReturn($this->nginxError);
        $http->shouldReceive('delete')->once()
            ->with('/2010-04-01/Accounts/AC123/SMS/Messages/SM123.json')
            ->andReturn(
                array(204, array('Content-Type' => 'application/json'), '')
        );
        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http);
        $client->account->sms_messages->delete('SM123');
    }

    function testSetExplicitRetryLimit() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/2010-04-01/Accounts/AC123/SMS/Messages/SM123.json')
            ->andReturn($this->nginxError);
        $http->shouldReceive('get')->once()
            ->with('/2010-04-01/Accounts/AC123/SMS/Messages/SM123.json')
            ->andReturn($this->nginxError);
        $http->shouldReceive('get')->once()
            ->with('/2010-04-01/Accounts/AC123/SMS/Messages/SM123.json')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('price' => 0.5))
            )
        );
        // retry twice
        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http, 2);
        $message = $client->account->sms_messages->get('SM123');
        $this->assertSame($message->price, 0.5);
    }

    function testRetryLimitIsHonored() {
        $this->setExpectedException('Services_Twilio_RestException');
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/2010-04-01/Accounts/AC123/SMS/Messages/SM123.json')
            ->andReturn($this->nginxError);
        $http->shouldReceive('get')->once()
            ->with('/2010-04-01/Accounts/AC123/SMS/Messages/SM123.json')
            ->andReturn($this->nginxError);
        $http->shouldReceive('get')->never()
            ->with('/2010-04-01/Accounts/AC123/SMS/Messages/SM123.json')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('price' => 0.5))
            )
        );
        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http);
        $message = $client->account->sms_messages->get('SM123');
        $this->assertSame($message->price, 0.5);
    }

    function testRetryIdempotentFunctionsOnly() {
        $this->setExpectedException('Services_Twilio_RestException');
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('post')->once()
            ->with('/2010-04-01/Accounts/AC123/SMS/Messages.json', $this->formHeaders, 
                'From=%2B14105551234&To=%2B14102221234&Body=bar')
            ->andReturn($this->nginxError);
        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http);
        $message = $client->account->sms_messages->create('+14105551234', 
            '+14102221234', 'bar');
    }

}
