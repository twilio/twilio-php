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
class Services_Twilio_TaskRouter_Capability
{
	protected $accountSid;
	protected $authToken;
	protected $workspaceSid;
	protected $apiCapability;

	protected $baseUrl = 'https://taskrouter.twilio.com/v1';
	protected $baseWsUrl = 'https://event-bridge.twilio.com/v1/wschannels';
	protected $channelId;
	protected $resourceUrl;

	protected $required = array("required" => true);
	protected $optional = array("required" => false);

	public function __construct($accountSid, $authToken, $workspaceSid, $channelId, $overrideBaseUrl = null, $overrideBaseWSUrl = null) {
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
		$this->apiCapability = new Services_Twilio_API_Capability($accountSid, $authToken, 'v1', $channelId);

		//add permissions to GET and POST to the event-bridge channel
		$this->apiCapability->addPolicy($this->baseWsUrl."/".$this->accountSid."/".$this->channelId, "GET", null, null);
		$this->apiCapability->addPolicy($this->baseWsUrl."/".$this->accountSid."/".$this->channelId, "POST", null, null);
	}

	public function allowFetchSubresources() {
		$method = 'GET';
		$queryFilter = array();
		$postFilter = array();
		$this->apiCapability->addPolicy($this->resourceUrl.'/**', $method, $queryFilter, $postFilter);
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
    private $workerUrl;
    private $reservationsUrl;
    private $activityUrl;
    
    public function __construct($accountSid, $authToken, $workspaceSid, $workerSid, $overrideBaseUrl = null, $overrideBaseWSUrl = null)
    {
		parent::__construct($accountSid, $authToken, $workspaceSid, $workerSid, $overrideBaseUrl, $overrideBaseWSUrl);

        $this->workerUrl = $this->baseUrl.'/Workers/'.$workerSid;
        $this->reservationsUrl = $this->workerUrl.'/Reservations/*';
        $this->activityUrl = $this->baseUrl.'/Activities';
		$this->resourceUrl = $this->workerUrl;

		//add permissions to fetch the worker, activity and worker reservations resource
		$this->apiCapability->addPolicy($this->activityUrl, "GET", null, null);
		$this->apiCapability->addPolicy($this->workerUrl, "GET", null, null);
		$this->apiCapability->addPolicy($this->reservationsUrl, "GET", null, null);
    }
    
    public function allowActivityUpdates() {
        $method = 'POST';
        $queryFilter = array();
        $postFilter = array("ActivitySid" => $this->required);
        $this->apiCapability->addPolicy($this->workerUrl, $method, $queryFilter, $postFilter);
    }
    
    public function allowReservationUpdates() {
        $method = 'POST';
        $queryFilter = array();
        $postFilter = array("ReservationStatus" => $this->required);
        $this->apiCapability->addPolicy($this->reservationsUrl, $method, $queryFilter, $postFilter);
    }
    
    public function generateToken($ttl = 3600) {
        $taskRouterAttributes = array(
            'account_sid' => $this->accountSid,
            'channel' => $this->channelId,
            'workspace_sid' => $this->workspaceSid,
            'worker_sid' => $this->channelId,
        );
    	return $this->apiCapability->generateToken($ttl, $taskRouterAttributes);
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
		parent::__construct($accountSid, $authToken, $workspaceSid, $taskQueueSid, $overrideBaseUrl, $overrideBaseWSUrl);

		$this->$taskQueueUrl = $this->baseUrl.'/TaskQueues/'.$taskQueueSid;
		$this->resourceUrl = $this->$taskQueueUrl;

		//add permissions to fetch the taskqueue resource
		$this->apiCapability->addPolicy($this->$taskQueueUrl, "GET", null, null);
	}

	public function generateToken($ttl = 3600) {
		$taskRouterAttributes = array(
			'account_sid' => $this->accountSid,
			'channel' => $this->channelId,
			'workspace_sid' => $this->workspaceSid,
			'taskqueue_sid' => $this->channelId,
		);
		return $this->apiCapability->generateToken($ttl, $taskRouterAttributes);
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
		parent::__construct($accountSid, $authToken, $workspaceSid, $workspaceSid, $overrideBaseUrl, $overrideBaseWSUrl);
		$this->resourceUrl = $this->baseUrl;

		//add permissions to fetch the workspace resource
		$this->apiCapability->addPolicy($this->baseUrl.'/*', "GET", null, null);
	}

	public function generateToken($ttl = 3600) {
		$taskRouterAttributes = array(
			'account_sid' => $this->accountSid,
			'channel' => $this->channelId,
			'workspace_sid' => $this->channelId
		);
		return $this->apiCapability->generateToken($ttl, $taskRouterAttributes);
	}
}
