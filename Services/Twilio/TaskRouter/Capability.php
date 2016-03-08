<?php
include_once (dirname(__FILE__).'/CapabilityAPI.php');
/**
 * Twilio TaskRouter Capability assigner
 *
 * @category Services
 * @package  Services_Twilio
 * @author Justin Witz <justin.witz@twilio.com>
 * @license  http://creativecommons.org/licenses/MIT/ MIT
 */
class Services_Twilio_TaskRouter_Capability extends Services_Twilio_TaskRouter_CapabilityAPI
{
	protected $baseUrl = 'https://taskrouter.twilio.com/v1';
	protected $baseWsUrl = 'https://event-bridge.twilio.com/v1/wschannels';
	protected $version = 'v1';

	protected $workspaceSid;
	protected $channelId;
	protected $resourceUrl;

	protected $required = array("required" => true);
	protected $optional = array("required" => false);

	public function __construct($accountSid, $authToken, $workspaceSid, $channelId, $resourceUrl = null, $overrideBaseUrl = null, $overrideBaseWSUrl = null) {
		parent::__construct($accountSid, $authToken, $this->version, $channelId);

		$this->workspaceSid = $workspaceSid;
		$this->channelId = $channelId;
		if(isset($overrideBaseUrl)) {
			$this->baseUrl = $overrideBaseUrl;
		}
		if(isset($overrideBaseWSUrl)) {
			$this->baseWsUrl = $overrideBaseWSUrl;
		}
		$this->baseUrl = $this->baseUrl.'/Workspaces/'.$workspaceSid;

		$this->validateJWT();

		if(!isset($resourceUrl)) {
			$this->setupResource();
		}

		//add permissions to GET and POST to the event-bridge channel
		$this->allow($this->baseWsUrl."/".$this->accountSid."/".$this->channelId, "GET", null, null);
		$this->allow($this->baseWsUrl."/".$this->accountSid."/".$this->channelId, "POST", null, null);

		//add permissions to fetch the instance resource
		$this->allow($this->resourceUrl, "GET", null, null);
	}

	protected function setupResource() {
		if(substr($this->channelId,0,2) == 'WS') {
			$this->resourceUrl = $this->baseUrl;
		}else if(substr($this->channelId,0,2) == 'WK') {
			$this->resourceUrl = $this->baseUrl.'/Workers/'.$this->channelId;

			//add permissions to fetch the list of activities, tasks and worker reservations
			$activityUrl = $this->baseUrl.'/Activities';
			$this->allow($activityUrl, "GET", null, null);

			$tasksUrl = $this->baseUrl.'/Tasks/**';
			$this->allow($tasksUrl, "GET", null, null);

			$workerReservationsUrl = $this->resourceUrl.'/Reservations/**';
			$this->allow($workerReservationsUrl, "GET", null, null);

		}else if(substr($this->channelId,0,2) == 'WQ') {
			$this->resourceUrl = $this->baseUrl.'/TaskQueues/'.$this->channelId;
		}
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
		$this->allow($this->resourceUrl.'/**', $method, $queryFilter, $postFilter);
	}

	public function allowUpdates() {
		$method = 'POST';
		$queryFilter = array();
		$postFilter = array();
		$this->allow($this->resourceUrl, $method, $queryFilter, $postFilter);
	}

	public function allowUpdatesSubresources() {
		$method = 'POST';
		$queryFilter = array();
		$postFilter = array();
		$this->allow($this->resourceUrl.'/**', $method, $queryFilter, $postFilter);
	}

	public function allowDelete() {
		$method = 'DELETE';
		$queryFilter = array();
		$postFilter = array();
		$this->allow($this->resourceUrl, $method, $queryFilter, $postFilter);
	}

	public function allowDeleteSubresources() {
		$method = 'DELETE';
		$queryFilter = array();
		$postFilter = array();
		$this->allow($this->resourceUrl.'/**', $method, $queryFilter, $postFilter);
	}

	/**
	 * @deprecated Please use {Services_Twilio_TaskRouter_Worker_Capability.allowActivityUpdates} instead
	 */
	public function allowWorkerActivityUpdates() {
		$method = 'POST';
		$queryFilter = array();
		$postFilter = array("ActivitySid" => $this->required);
		$this->allow($this->resourceUrl, $method, $queryFilter, $postFilter);
	}

	/**
	 * @deprecated Please use {Services_Twilio_TaskRouter_Worker_Capability} instead; added automatically in constructor
	 */
	public function allowWorkerFetchAttributes() {
		$method = 'GET';
		$queryFilter = array();
		$postFilter = array();
		$this->allow($this->resourceUrl, $method, $queryFilter, $postFilter);
	}

	/**
	 * @deprecated Please use {Services_Twilio_TaskRouter_Worker_Capability.allowReservationUpdates} instead
	 */
	public function allowTaskReservationUpdates() {
		$method = 'POST';
		$queryFilter = array();
		$postFilter = array();
		$reservationsUrl = $this->baseUrl.'/Tasks/**';
		$this->allow($reservationsUrl, $method, $queryFilter, $postFilter);
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