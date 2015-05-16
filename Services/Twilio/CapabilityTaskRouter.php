<?php
include_once 'CapabilityAPI.php';

/**
 * Twilio TaskRouter Capability assigner
 *
 * @category Services
 * @package  Services_Twilio
 * @author Justin Witz <justin.witz@twilio.com>
 * @license  http://creativecommons.org/licenses/MIT/ MIT
 */
class Services_Twilio_TaskRouter_Capability extends Services_Twilio_API_Capability
{
	protected $accountSid;
	protected $authToken;
	protected $workspaceSid;

	protected $baseUrl = 'https://taskrouter.twilio.com/v1';
	protected $baseWsUrl = 'https://event-bridge.twilio.com/v1/wschannels';
	protected $channelId;
	protected $resourceUrl;

	protected $required = array("required" => true);
	protected $optional = array("required" => false);

	public function __construct($accountSid, $authToken, $workspaceSid, $channelId, $resourceUrl = null, $overrideBaseUrl = null, $overrideBaseWSUrl = null) {
		$this->accountSid = $accountSid;
		$this->authToken = $authToken;
		$this->workspaceSid = $workspaceSid;
		$this->channelId = $channelId;
		if(isset($overrideBaseUrl)) {
			$this->baseUrl = $overrideBaseUrl;
		}
		if(isset($overrideBaseWSUrl)) {
			$this->baseWsUrl = $overrideBaseWSUrl;
		}
		$this->baseUrl = $this->baseUrl.'/Workspaces/'.$workspaceSid;

		if(!isset($resourceUrl)) {
			if(substr($channelId,0,2) == 'WS') {
				$resourceUrl = $this->baseUrl;
			}else if(substr($channelId,0,2) == 'WK') {
				$resourceUrl = $this->baseUrl.'/Workers/'.$channelId;
			}else if(substr($channelId,0,2) == 'WQ') {
				$resourceUrl = $this->baseUrl.'/TaskQueues/'.$channelId;
			}
		}
		$this->resourceUrl = $resourceUrl;

		parent::__construct($accountSid, $authToken, 'v1', $channelId);

		//add permissions to GET and POST to the event-bridge channel
		$this->addPolicy($this->baseWsUrl."/".$this->accountSid."/".$this->channelId, "GET", null, null);
		$this->addPolicy($this->baseWsUrl."/".$this->accountSid."/".$this->channelId, "POST", null, null);

		//add permissions to fetch the instance resource
		$this->addPolicy($this->resourceUrl, "GET", null, null);

		$this->validateJWT();
	}

	private function validateJWT() {
		if(!isset($this->accountSid) || substr($this->accountSid,0,2) != 'AC') {
			throw new Exception("Invalid AccountSid provided: ".$this->accountSid);
		}
		if(!isset($this->workspaceSid) || substr($this->workspaceSid,0,2) != 'WS') {
			throw new Exception("Invalid WorkspaceSid provided: ".$this->workspaceSid);
		}
		if(!isset($this->channelId)) {
			throw new Exception("ChannelId not provided");
		}
		$prefix = substr($this->channelId,0,2);
		if($prefix != 'WS' && $prefix != 'WK' && $prefix != 'WQ') {
			throw new Exception("Invalid ChannelId provided: ".$this->channelId);
		}
	}

	public function allowFetchSubresources() {
		$method = 'GET';
		$queryFilter = array();
		$postFilter = array();
		$this->addPolicy($this->resourceUrl.'/**', $method, $queryFilter, $postFilter);
	}

	public function allowUpdates() {
		$method = 'POST';
		$queryFilter = array();
		$postFilter = array();
		$this->addPolicy($this->resourceUrl, $method, $queryFilter, $postFilter);
	}

	public function allowUpdatesSubresources() {
		$method = 'POST';
		$queryFilter = array();
		$postFilter = array();
		$this->addPolicy($this->resourceUrl.'/**', $method, $queryFilter, $postFilter);
	}

	public function allowDelete() {
		$method = 'DELETE';
		$queryFilter = array();
		$postFilter = array();
		$this->addPolicy($this->resourceUrl, $method, $queryFilter, $postFilter);
	}

	public function allowDeleteSubresources() {
		$method = 'DELETE';
		$queryFilter = array();
		$postFilter = array();
		$this->addPolicy($this->resourceUrl.'/**', $method, $queryFilter, $postFilter);
	}

	public function getResourceUrl() {
		return $this->resourceUrl;
	}

	public function generateToken($ttl = 3600, $extraAttributes = null) {
		$taskRouterAttributes = array(
			'account_sid' => $this->accountSid,
			'channel' => $this->channelId,
			'workspace_sid' => $this->workspaceSid
		);

		if(substr($this->channelId,0,2) == 'WK') {
			$taskRouterAttributes['worker_sid'] = $this->channelId;
		}else if(substr($this->channelId,0,2) == 'WQ') {
			$taskRouterAttributes['taskqueue_sid'] = $this->channelId;
		}

		return parent::generateToken($ttl, $taskRouterAttributes);
	}
}


/**
 * Twilio TaskRouter Worker Capability assigner
 *
 * @category Services
 * @package  Services_Twilio
 * @author Justin Witz <justin.witz@twilio.com>
 * @license  http://creativecommons.org/licenses/MIT/ MIT
 */
class Services_Twilio_TaskRouter_Worker_Capability extends Services_Twilio_TaskRouter_Capability
{
	private $reservationsUrl;
	private $activityUrl;

	public function __construct($accountSid, $authToken, $workspaceSid, $workerSid, $overrideBaseUrl = null, $overrideBaseWSUrl = null)
	{
		parent::__construct($accountSid, $authToken, $workspaceSid, $workerSid, null, $overrideBaseUrl, $overrideBaseWSUrl);

		$this->reservationsUrl = $this->baseUrl.'/Tasks/**';
		$this->activityUrl = $this->baseUrl.'/Activities';

		//add permissions to fetch the list of activities and list of worker reservations
		$this->addPolicy($this->activityUrl, "GET", null, null);
		$this->addPolicy($this->reservationsUrl, "GET", null, null);
	}

	public function allowActivityUpdates() {
		$method = 'POST';
		$queryFilter = array();
		$postFilter = array("ActivitySid" => $this->required);
		$this->addPolicy($this->resourceUrl, $method, $queryFilter, $postFilter);
	}

	public function allowReservationUpdates() {
		$method = 'POST';
		$queryFilter = array();
		$postFilter = array();
		$this->addPolicy($this->reservationsUrl, $method, $queryFilter, $postFilter);
	}
}

/**
 * Twilio TaskRouter TaskQueue Capability assigner
 *
 * @category Services
 * @package  Services_Twilio
 * @author Justin Witz <justin.witz@twilio.com>
 * @license  http://creativecommons.org/licenses/MIT/ MIT
 */
class Services_Twilio_TaskRouter_TaskQueue_Capability extends Services_Twilio_TaskRouter_Capability
{
	private $taskQueueUrl;

	public function __construct($accountSid, $authToken, $workspaceSid, $taskQueueSid, $overrideBaseUrl = null, $overrideBaseWSUrl = null)
	{
		parent::__construct($accountSid, $authToken, $workspaceSid, $taskQueueSid, null, $overrideBaseUrl, $overrideBaseWSUrl);
	}
}

/**
 * Twilio TaskRouter Workspace Capability assigner
 *
 * @category Services
 * @package  Services_Twilio
 * @author Justin Witz <justin.witz@twilio.com>
 * @license  http://creativecommons.org/licenses/MIT/ MIT
 */
class Services_Twilio_TaskRouter_Workspace_Capability extends Services_Twilio_TaskRouter_Capability
{
	public function __construct($accountSid, $authToken, $workspaceSid, $overrideBaseUrl = null, $overrideBaseWSUrl = null)
	{
		parent::__construct($accountSid, $authToken, $workspaceSid, $workspaceSid, null, $overrideBaseUrl, $overrideBaseWSUrl);
	}
}