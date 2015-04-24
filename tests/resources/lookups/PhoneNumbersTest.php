<?php

use \Mockery as m;

class PhoneNumbersTest extends PHPUnit_Framework_TestCase
{

    function testGetPhoneNumber() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/v1/PhoneNumbers/4153902337')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array(
                    'country_code' => 'US',
                    'phone_number' => '4153902337',
                    'national_format' => '4153902337',
                    'carrier' => array(
                        'mobile_country_code' => '123',
                        'mobile_network_code' => '123',
                        'name' => '123',
                        'type' => '123',
                        'error_code' => 0
                    )
                ))
            ));
        $client = new Lookups_Services_Twilio('AC123', '123', 'v1', $http);
        $number = $client->phone_numbers->get('4153902337');
        $this->assertNotNull($number);
        $this->assertEquals('US', $number->country_code);
    }

    function testGetPhoneNumberWithCountryCode() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/v1/PhoneNumbers/4153902337?CountryCode=US')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array(
                    'country_code' => 'US',
                    'phone_number' => '4153902337',
                    'national_format' => '4153902337',
                    'carrier' => array(
                        'mobile_country_code' => '123',
                        'mobile_network_code' => '123',
                        'name' => '123',
                        'type' => '123',
                        'error_code' => 0
                    )
                ))
            ));
        $client = new Lookups_Services_Twilio('AC123', '123', 'v1', $http);
        $number = $client->phone_numbers->get('4153902337', array('CountryCode' => 'US'));
        $this->assertNotNull($number);
        $this->assertEquals('US', $number->country_code);
    }

    function testGetPhoneNumberWithCountryCodeAndType() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/v1/PhoneNumbers/4153902337?CountryCode=US&Type=carrier')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array(
                    'country_code' => 'US',
                    'phone_number' => '4153902337',
                    'national_format' => '4153902337',
                    'carrier' => array(
                        'mobile_country_code' => '123',
                        'mobile_network_code' => '123',
                        'name' => '123',
                        'type' => '123',
                        'error_code' => 0
                    )
                ))
            ));
        $client = new Lookups_Services_Twilio('AC123', '123', 'v1', $http);
        $number = $client->phone_numbers->get('4153902337', array('CountryCode' => 'US', 'Type' => 'carrier'));
        $this->assertNotNull($number);
        $this->assertEquals('US', $number->country_code);
    }

}
