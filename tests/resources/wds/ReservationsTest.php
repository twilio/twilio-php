<?php

use \Mockery as m;

class ReservationsTest extends PHPUnit_Framework_TestCase
{
    function testGet() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/v1/Accounts/AC123/Workspaces/WS123/Tasks/WT123/Reservations/WR123.json')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'WR123', 'reservation_status' => 'reserved'))
            ));
        $wdsClient = new Wds_Services_Twilio('AC123', '123', 'WS123', 'v1', $http);
        $reservation = $wdsClient->workspace->tasks->get('WT123')->reservations->get('WR123');
        $this->assertNotNull($reservation);
        $this->assertEquals('reserved', $reservation->reservation_status);
    }

    function tearDown()
    {
        m::close();
    }
}
