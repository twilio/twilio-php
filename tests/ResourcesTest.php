<?php

use \Mockery as m;

class AvailablePhoneNumbersTest extends PHPUnit_Framework_TestCase {
  function testPartialApplication() {
    $http = m::mock();
    $http->shouldReceive('get')->once()
      ->with('/2010-04-01/Accounts/AC123.json')
      ->andReturn(array(200, array('content-type' => 'application/json'),
        json_encode(array(
          'subresource_uris' =>
          array('available_phone_numbers'
          => '/2010-04-01/Accounts/AC123/AvailablePhoneNumbers.json')
        ))
      ));
    $http->shouldReceive('get')->once()
      ->with('/2010-04-01/Accounts/AC123/AvailablePhoneNumbers/US/Local.json?AreaCode=510')
      ->andReturn(array(200, array('content-type' => 'application/json'),
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
