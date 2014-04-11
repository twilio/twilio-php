<?php

use \Mockery as m;

class FeedbackTest extends PHPUnit_Framework_TestCase
{
    private static $accountSid = 'AC123';
    private static $authToken = '123';
    private static $callSid = 'CA123';
    private static $formHeaders = array('Content-Type' => 'application/x-www-form-urlencoded');

    function testCreateFeedback()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('post')->once()
            ->with('/2010-04-01/Accounts/' . self::$accountSid . '/Calls/' . self::$callSid . '/Feedback.json', self::$formHeaders,
                'QualityScore=5&Issue=post-dial-delay&Issue=another-issue')
            ->andReturn(array(201, array('Content-Type' => 'application/json'),
                json_encode(array('quality_score' => 5, 'issues' => array('post-dial-delay', 'another-issue')))
            ));
        $client = new Services_Twilio(self::$accountSid, self::$authToken, '2010-04-01', $http);
        $feedback = $client->account->calls->get(self::$callSid)->feedback->create(array('QualityScore' => 5, 'Issue' => array('post-dial-delay', 'another-issue')));
        $this->assertEquals(5, $feedback->quality_score);
        $this->assertEquals(2, count($feedback->issues));
    }

    function testCreateFeedbackShortcut()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('post')->once()
            ->with('/2010-04-01/Accounts/' . self::$accountSid . '/Calls/' . self::$callSid . '/Feedback.json', self::$formHeaders,
                'QualityScore=5&Issue=post-dial-delay&Issue=another-issue')
            ->andReturn(array(201, array('Content-Type' => 'application/json'),
                json_encode(array('quality_score' => 5, 'issues' => array('post-dial-delay', 'another-issue')))
            ));
        $client = new Services_Twilio(self::$accountSid, self::$authToken, '2010-04-01', $http);
        $feedback = $client->account->calls->createFeedback(self::$callSid, 5, array('post-dial-delay', 'another-issue'));
        $this->assertEquals(5, $feedback->quality_score);
        $this->assertEquals(2, count($feedback->issues));
    }

    function testDeleteFeedback()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('delete')->once()
            ->with('/2010-04-01/Accounts/' . self::$accountSid . '/Calls/' . self::$callSid . '/Feedback.json')
            ->andReturn(array(204, array('Content-Type' => 'application/json'), ''));
        $client = new Services_Twilio(self::$accountSid, self::$authToken, '2010-04-01', $http);
        $feedback = $client->account->calls->get(self::$callSid)->feedback->delete();
        $this->assertNull($feedback);
    }

    function testDeleteFeedbackShortcut()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('delete')->once()
            ->with('/2010-04-01/Accounts/' . self::$accountSid . '/Calls/' . self::$callSid . '/Feedback.json')
            ->andReturn(array(204, array('Content-Type' => 'application/json'), ''));
        $client = new Services_Twilio(self::$accountSid, self::$authToken, '2010-04-01', $http);
        $feedback = $client->account->calls->deleteFeedback(self::$callSid);
        $this->assertNull($feedback);
    }

    function testGetFeedback()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/2010-04-01/Accounts/' . self::$accountSid . '/Calls/' . self::$callSid . '/Feedback.json')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('quality_score' => 5, 'issues' => array('post-dial-delay', 'another-issue')))
            ));
        $client = new Services_Twilio(self::$accountSid, self::$authToken, '2010-04-01', $http);
        $feedback = $client->account->calls->get(self::$callSid)->feedback->get();
        $this->assertEquals(5, $feedback->quality_score);
        $this->assertNotEmpty($feedback->issues);
    }

    function testGetFeedbackShortcut()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/2010-04-01/Accounts/' . self::$accountSid . '/Calls/' . self::$callSid . '/Feedback.json')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array('quality_score' => 5, 'issues' => array('post-dial-delay', 'another-issue')))
            ));
        $client = new Services_Twilio(self::$accountSid, self::$authToken, '2010-04-01', $http);
        $feedback = $client->account->calls->getFeedback(self::$callSid);
        $this->assertEquals(5, $feedback->quality_score);
        $this->assertNotEmpty($feedback->issues);
    }

    function tearDown()
    {
        m::close();
    }

}
