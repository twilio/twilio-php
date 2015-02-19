<?php

use \Mockery as m;
require_once 'Twilio.php';

class PhoneNumberTest extends PHPUnit_Framework_TestCase {

    function testGetCountries() {
        $data = array(
            'meta' => array(
                'key' => 'countries',
                'next_page_url' => null
            ),
            'countries' => array(
                array('iso_country' => 'US')
            )
        );
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()->with(
            '/v1/PhoneNumbers/Countries?Page=0&PageSize=50'
        )->andReturn(array(200, array('Content-Type' => 'application/json'),
                         json_encode($data)));

        $pricingClient = new Pricing_Services_Twilio('AC123', '123', 'v1',
                                                     $http, 1);
        $countries = $pricingClient->phoneNumberCountries->getPage();
        $this->assertNotNull($countries);

        $country = $countries->getItems()[0];
        $this->assertNotNull($country);
        $this->assertEquals($country->iso_country, 'US');
    }

    function testGetCountry() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()->with('/v1/PhoneNumbers/Countries/EE')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                            json_encode(array('country' => 'Estonia'))));
        $pricingClient = new Pricing_Services_Twilio('AC123', '123', 'v1', $http, 1);

        $country = $pricingClient->phoneNumberCountries->get('EE');
        $this->assertNotNull($country);
        $this->assertEquals($country->iso_country, 'EE');
        $this->assertEquals($country->country, 'Estonia');
    }
}
