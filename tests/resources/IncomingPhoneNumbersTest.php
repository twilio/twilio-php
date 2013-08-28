<?php

use \Mockery as m;

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

