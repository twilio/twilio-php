<?php

use \Mockery as m;

class FeedbackTest extends PHPUnit_Framework_TestCase {

    protected $formHeaders = array('Content-Type' => 'application/x-www-form-urlencoded');

    function testCreateFeedback() {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('post')->once()
            ->with('/2010-04-01/Accounts/AC123/Calls/CA123/Feedback.json', $this->formHeaders,
            'QualityScore=5&Issue=post-dial-delay&Issue=another-issue')
            ->andReturn(array(201, array('Content-Type' => 'application/json'),
                json_encode(array('quality_score' => 5, 'issues' => array('post-dial-delay', 'another-issue')))
            ));
        $client = new Services_Twilio('AC123', '123', '2010-04-01', $http);
        $client->account->calls->createFeedback('CA123', 5, array('post-dial-delay', 'another-issue'));
    }

}