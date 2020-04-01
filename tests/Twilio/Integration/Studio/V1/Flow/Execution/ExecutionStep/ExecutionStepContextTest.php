<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Tests\Integration\Studio\V1\Flow\Execution\ExecutionStep;

use Twilio\Exceptions\DeserializeException;
use Twilio\Exceptions\TwilioException;
use Twilio\Http\Response;
use Twilio\Tests\HolodeckTestCase;
use Twilio\Tests\Request;

class ExecutionStepContextTest extends HolodeckTestCase {
    public function testFetchRequest(): void {
        $this->holodeck->mock(new Response(500, ''));

        try {
            $this->twilio->studio->v1->flows("FWXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                     ->executions("FNXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                     ->steps("FTXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                     ->stepContext()->fetch();
        } catch (DeserializeException $e) {}
          catch (TwilioException $e) {}

        $this->assertRequest(new Request(
            'get',
            'https://studio.twilio.com/v1/Flows/FWXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Executions/FNXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Steps/FTXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX/Context',
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
                "context": {
                    "foo": "bar"
                },
                "flow_sid": "FWaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "execution_sid": "FNaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "step_sid": "FTaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa",
                "url": "https://studio.twilio.com/v1/Flows/FWaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Executions/FNaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Steps/FTaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa/Context"
            }
            '
        ));

        $actual = $this->twilio->studio->v1->flows("FWXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                           ->executions("FNXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                           ->steps("FTXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX")
                                           ->stepContext()->fetch();

        $this->assertNotNull($actual);
    }
}