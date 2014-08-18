<?php

use \Mockery as m;

class FeedbackSummaryTest extends PHPUnit_Framework_TestCase
{
    private static $accountSid = 'AC123';
    private static $authToken = '123';
    private static $feedbackSummarySid = 'FSa346467ca321c71dbd5e12f627deb854';
    private static $formHeaders = array('Content-Type' => 'application/x-www-form-urlencoded');

    function testCreateFeedbackSummary()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('post')->once()
            ->with('/2010-04-01/Accounts/' . self::$accountSid . '/Calls/FeedbackSummary.json', self::$formHeaders,
                'StartDate=2014-01-01&EndDate=2014-01-31&IncludeSubaccounts=1&StatusCallback=http%3A%2F%2Fwww.example.com%2Ffeedback')
            ->andReturn(array(201, array('Content-Type' => 'application/json'),
                json_encode(array(
                    'sid' => 'FSa346467ca321c71dbd5e12f627deb854',
                    'start_date' => '2014-01-01',
                    'end_date' => '2014-01-31',
                    'account_sid' => self::$accountSid,
                    'include_subaccounts' => true,
                    'status' => 'queued',
                    'call_count' => null,
                    'call_feedback_count' => null,
                    'quality_score_average' => null,
                    'quality_score_median' => null,
                    'quality_score_standard_deviation' => null,
                    'issues' => null,
                    'date_created' => 'Thu, 19 Aug 2010 00:25:48 +0000',
                    'date_updated' => 'Thu, 19 Aug 2010 00:25:48 +0000'
                ))
            ));
        $client = new Services_Twilio(self::$accountSid, self::$authToken, '2010-04-01', $http);
        $feedbackSummary = $client->account->calls->feedback_summary->create(array('StartDate' => '2014-01-01',
            'EndDate' => '2014-01-31',
            'IncludeSubaccounts' => true,
            'StatusCallback' => 'http://www.example.com/feedback'));
        $this->assertEquals(self::$feedbackSummarySid, $feedbackSummary->sid);
        $this->assertEquals('2014-01-01', $feedbackSummary->start_date);
        $this->assertEquals('2014-01-31', $feedbackSummary->end_date);
        $this->assertEquals(0, count($feedbackSummary->issues));
    }

    function testDeleteFeedbackSummary()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('delete')->once()
            ->with('/2010-04-01/Accounts/' . self::$accountSid . '/Calls/FeedbackSummary/'. self::$feedbackSummarySid .'.json')
            ->andReturn(array(204, array('Content-Type' => 'application/json'), ''));
        $client = new Services_Twilio(self::$accountSid, self::$authToken, '2010-04-01', $http);
        $feedbackSummary = $client->account->calls->feedback_summary->delete(self::$feedbackSummarySid);
        $this->assertNull($feedbackSummary);
    }

    function testGetFeedbackSummary()
    {
        $http = m::mock(new Services_Twilio_TinyHttp);
        $http->shouldReceive('get')->once()
            ->with('/2010-04-01/Accounts/' . self::$accountSid . '/Calls/FeedbackSummary/' . self::$feedbackSummarySid . '.json')
            ->andReturn(array(200, array('Content-Type' => 'application/json'),
                json_encode(array(
                    'sid' => 'FSa346467ca321c71dbd5e12f627deb854',
                    'start_date' => '2014-01-01',
                    'end_date' => '2014-01-31',
                    'account_sid' => self::$accountSid,
                    'include_subaccounts' => true,
                    'status' => 'completed',
                    'call_count' => 10200,
                    'call_feedback_count' => 729,
                    'quality_score_average' => 4.5,
                    'quality_score_median' => 4,
                    'quality_score_standard_deviation' => 1,
                    'issues' => array(array('description' => 'imperfect-audio', 'count' => 45, 'percentage_of_total_calls' => '0.04%')),
                    'date_created' => 'Thu, 19 Aug 2010 00:25:48 +0000',
                    'date_updated' => 'Thu, 19 Aug 2010 00:25:48 +0000'
                ))
            ));
        $client = new Services_Twilio(self::$accountSid, self::$authToken, '2010-04-01', $http);
        $feedbackSummary = $client->account->calls->feedback_summary->get(self::$feedbackSummarySid);
        $this->assertEquals(self::$feedbackSummarySid, $feedbackSummary->sid);
        $this->assertEquals('2014-01-01', $feedbackSummary->start_date);
        $this->assertEquals('2014-01-31', $feedbackSummary->end_date);
        $this->assertEquals('completed', $feedbackSummary->status);
        $this->assertEquals(1, count($feedbackSummary->issues));
    }

    function tearDown()
    {
        m::close();
    }
}
