<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Api\V2010\Account;

use Twilio\Exceptions\TwilioException;
use Twilio\ListResource;
use Twilio\Options;
use Twilio\Rest\Api\V2010\Account\Call\FeedbackSummaryList;
use Twilio\Values;
use Twilio\Version;

/**
 * @property \Twilio\Rest\Api\V2010\Account\Call\FeedbackSummaryList feedbackSummaries
 * @method \Twilio\Rest\Api\V2010\Account\Call\FeedbackSummaryContext feedbackSummaries(string $sid)
 */
class CallList extends ListResource {
    protected $_feedbackSummaries = null;

    /**
     * Construct the CallList
     * 
     * @param Version $version Version that contains the resource
     * @param string $accountSid The unique id of the Account responsible for
     *                           creating this Call
     * @return \Twilio\Rest\Api\V2010\Account\CallList 
     */
    public function __construct(Version $version, $accountSid) {
        parent::__construct($version);
        
        // Path Solution
        $this->solution = array(
            'accountSid' => $accountSid,
        );
        
        $this->uri = '/Accounts/' . rawurlencode($accountSid) . '/Calls.json';
    }

    /**
     * Create a new CallInstance
     * 
     * @param string $to Phone number, SIP address or client identifier to call
     * @param string $from Twilio number from which to originate the call
     * @param array|Options $options Optional Arguments
     * @return CallInstance Newly created CallInstance
     */
    public function create($to, $from, $options = array()) {
        $options = new Values($options);
        
        $data = Values::of(array(
            'To' => $to,
            'From' => $from,
            'Url' => $options['url'],
            'ApplicationSid' => $options['applicationSid'],
            'Method' => $options['method'],
            'FallbackUrl' => $options['fallbackUrl'],
            'FallbackMethod' => $options['fallbackMethod'],
            'StatusCallback' => $options['statusCallback'],
            'StatusCallbackEvent' => $options['statusCallbackEvent'],
            'StatusCallbackMethod' => $options['statusCallbackMethod'],
            'SendDigits' => $options['sendDigits'],
            'IfMachine' => $options['ifMachine'],
            'Timeout' => $options['timeout'],
            'Record' => $options['record'],
            'RecordingChannels' => $options['recordingChannels'],
            'RecordingStatusCallback' => $options['recordingStatusCallback'],
            'RecordingStatusCallbackMethod' => $options['recordingStatusCallbackMethod'],
            'SipAuthUsername' => $options['sipAuthUsername'],
            'SipAuthPassword' => $options['sipAuthPassword'],
            'MachineDetection' => $options['machineDetection'],
            'MachineDetectionTimeout' => $options['machineDetectionTimeout'],
        ));
        
        $payload = $this->version->create(
            'POST',
            $this->uri,
            array(),
            $data
        );
        
        return new CallInstance(
            $this->version,
            $payload,
            $this->solution['accountSid']
        );
    }

    /**
     * Streams CallInstance records from the API as a generator stream.
     * This operation lazily loads records as efficiently as possible until the
     * limit
     * is reached.
     * The results are returned as a generator, so this operation is memory
     * efficient.
     * 
     * @param array|Options $options Optional Arguments
     * @param int $limit Upper limit for the number of records to return. stream()
     *                   guarantees to never return more than limit.  Default is no
     *                   limit
     * @param mixed $pageSize Number of records to fetch per request, when not set
     *                        will use the default value of 50 records.  If no
     *                        page_size is defined but a limit is defined, stream()
     *                        will attempt to read the limit with the most
     *                        efficient page size, i.e. min(limit, 1000)
     * @return \Twilio\Stream stream of results
     */
    public function stream($options = array(), $limit = null, $pageSize = null) {
        $limits = $this->version->readLimits($limit, $pageSize);
        
        $page = $this->page($options, $limits['pageSize']);
        
        return $this->version->stream($page, $limits['limit'], $limits['pageLimit']);
    }

    /**
     * Reads CallInstance records from the API as a list.
     * Unlike stream(), this operation is eager and will load `limit` records into
     * memory before returning.
     * 
     * @param array|Options $options Optional Arguments
     * @param int $limit Upper limit for the number of records to return. read()
     *                   guarantees to never return more than limit.  Default is no
     *                   limit
     * @param mixed $pageSize Number of records to fetch per request, when not set
     *                        will use the default value of 50 records.  If no
     *                        page_size is defined but a limit is defined, read()
     *                        will attempt to read the limit with the most
     *                        efficient page size, i.e. min(limit, 1000)
     * @return CallInstance[] Array of results
     */
    public function read($options = array(), $limit = null, $pageSize = null) {
        return iterator_to_array($this->stream($options, $limit, $pageSize), false);
    }

    /**
     * Retrieve a single page of CallInstance records from the API.
     * Request is executed immediately
     * 
     * @param array|Options $options Optional Arguments
     * @param mixed $pageSize Number of records to return, defaults to 50
     * @param string $pageToken PageToken provided by the API
     * @param mixed $pageNumber Page Number, this value is simply for client state
     * @return \Twilio\Page Page of CallInstance
     */
    public function page($options = array(), $pageSize = Values::NONE, $pageToken = Values::NONE, $pageNumber = Values::NONE) {
        $options = new Values($options);
        $params = Values::of(array(
            'To' => $options['to'],
            'From' => $options['from'],
            'ParentCallSid' => $options['parentCallSid'],
            'Status' => $options['status'],
            'StartTime<' => $options['startTimeBefore'],
            'StartTime' => $options['startTime'],
            'StartTime>' => $options['startTimeAfter'],
            'EndTime<' => $options['endTimeBefore'],
            'EndTime' => $options['endTime'],
            'EndTime>' => $options['endTimeAfter'],
            'PageToken' => $pageToken,
            'Page' => $pageNumber,
            'PageSize' => $pageSize,
        ));
        
        $response = $this->version->page(
            'GET',
            $this->uri,
            $params
        );
        
        return new CallPage($this->version, $response, $this->solution);
    }

    /**
     * Access the feedbackSummaries
     */
    protected function getFeedbackSummaries() {
        if (!$this->_feedbackSummaries) {
            $this->_feedbackSummaries = new FeedbackSummaryList(
                $this->version,
                $this->solution['accountSid']
            );
        }
        
        return $this->_feedbackSummaries;
    }

    /**
     * Constructs a CallContext
     * 
     * @param string $sid Call Sid that uniquely identifies the Call to fetch
     * @return \Twilio\Rest\Api\V2010\Account\CallContext 
     */
    public function getContext($sid) {
        return new CallContext(
            $this->version,
            $this->solution['accountSid'],
            $sid
        );
    }

    /**
     * Magic getter to lazy load subresources
     * 
     * @param string $name Subresource to return
     * @return \Twilio\ListResource The requested subresource
     * @throws \Twilio\Exceptions\TwilioException For unknown subresources
     */
    public function __get($name) {
        if (property_exists($this, '_' . $name)) {
            $method = 'get' . ucfirst($name);
            return $this->$method();
        }
        
        throw new TwilioException('Unknown subresource ' . $name);
    }

    /**
     * Magic caller to get resource contexts
     * 
     * @param string $name Resource to return
     * @param array $arguments Context parameters
     * @return \Twilio\InstanceContext The requested resource context
     * @throws \Twilio\Exceptions\TwilioException For unknown resource
     */
    public function __call($name, $arguments) {
        $property = $this->$name;
        if (method_exists($property, 'getContext')) {
            return call_user_func_array(array($property, 'getContext'), $arguments);
        }
        
        throw new TwilioException('Resource does not have a context');
    }

    /**
     * Provide a friendly representation
     * 
     * @return string Machine friendly representation
     */
    public function __toString() {
        return '[Twilio.Api.V2010.CallList]';
    }
}