<?php

use \Mockery as m;
require('../../../Services/Twilio.php');

class VoiceTest extends PHPUnit_Framework_TestCase {

    function testGetCountries() {
        $data = array(
            'countries' => array(
                array('iso_country' => 'US')
            )
        );
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()->with(
            '/v1/Voice/Countries'
        )->andReturn(array(200, array('Content-Type' => 'application/json'),
                                 json_encode($data)));

        $pricingClient = new Pricing_Services_Twilio('AC123', '123', 'v1',
                                                     $http, 1);
        $countries = $pricingClient->voiceCountries->getIterator();
        $this->assertNotNull($countries);
    }
}