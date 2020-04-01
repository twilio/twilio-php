<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Tests\Integration\Preview\Wireless\Sim;

use Twilio\Exceptions\DeserializeException;
use Twilio\Exceptions\TwilioException;
use Twilio\Http\Response;
use Twilio\Tests\HolodeckTestCase;
use Twilio\Tests\Request;

class UsageTest extends HolodeckTestCase {
    public function testFetchRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->preview->wireless->sims("DEXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                            ->usage()->fetch();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'get',
            'https://preview.twilio.com/wireless/Sims/DEXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Usage',
            [],
            [],
            []
        ));
    }

    public function testFetchResponse(): void {
        $this->holodeck->mock(new Response(
            200,
            '
            {
                "account_sid": "ACaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "commands_costs": {},
                "commands_usage": {},
                "data_costs": {},
                "data_usage": {},
                "sim_unique_name": "sim_unique_name",
                "sim_sid": "DEaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "period": {},
                "url": "https://preview.twilio.com/wireless/Sims/DEaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Usage"
            }
            '
        ));

        $actual = $this->twilio->preview->wireless->sims("DEXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                                  ->usage()->fetch();

        $this->assertNotNull($actual);
    }
}