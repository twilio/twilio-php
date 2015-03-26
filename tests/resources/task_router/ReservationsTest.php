<?php

use \Mockery as m;

class ReservationsTest extends PHPUnit_Framework_TestCase
{
    function testGet() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/v1/Workspaces/WS123/Tasks/WT123/Reservations/WR123')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('sid' => 'WR123', 'reservation_status' => 'reserved'))
            ));
        $taskrouterClient = new TaskRouter_Services_Twilio('AC123', '123', 'WS123', 'v1', $http);
        $reservation = $taskrouterClient->workspace->tasks->get('WT123')->reservations->get('WR123');
        $this->assertNotNull($reservation);
        $this->assertEquals('reserved', $reservation->reservation_status);
    }

	function testGetPage() {
		$http = m::mock(new Services_Twilio_TinyHttp);
		$http->shouldReceive('get')->once()
			->with('/v1/Workspaces/WS123/Tasks/WT123/Reservations?Page=0&PageSize=50')
			->andReturn(array(200, array('Content-Type' => 'application/json'),
							json_encode(array(
											'meta' => array('key' => 'reservations', 'next_page_url' => null),
											'reservations' => array(array('sid' => 'WR123', 'reservation_status' => 'reserved'))
										))));
		$taskrouterClient = new TaskRouter_Services_Twilio('AC123', '123', 'WS123', 'v1', $http);
		$reservations = $taskrouterClient->workspace->tasks->get('WT123')->reservations->getPage();
		$reservationItems = $reservations->getItems();
		$this->assertNotNull($reservations);
		$this->assertEquals('reserved', $reservationItems[0]->reservation_status);
	}

    function tearDown()
    {
        m::close();
    }
}
