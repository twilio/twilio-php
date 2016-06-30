<?php

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
	private $tasksUrl;
	private $workerReservationsUrl;
	private $activityUrl;
	protected $channelUrl;

	public function __construct($accountSid, $authToken, $workspaceSid, $workerSid, $overrideBaseUrl = null, $overrideBaseWSUrl = null)
	{
		parent::__construct($accountSid, $authToken, $workspaceSid, $workerSid, null, $overrideBaseUrl, $overrideBaseWSUrl);

		$this->tasksUrl = $this->baseUrl.'/Tasks/**';
		$this->activityUrl = $this->baseUrl.'/Activities';
		$this->workerReservationsUrl = $this->resourceUrl.'/Reservations/**';
		$this->channelUrl = $this->resourceUrl.'/Channels/**';

		//add permissions to fetch the list of activities, tasks, and worker reservations
		$this->allow($this->activityUrl, "GET", null, null);
		$this->allow($this->tasksUrl, "GET", null, null);
		$this->allow($this->workerReservationsUrl, "GET", null, null);
		$this->allow($this->channelUrl, "GET", null, null);
	}

	protected function setupResource() {
		$this->resourceUrl = $this->baseUrl.'/Workers/'.$this->channelId;
	}

	public function allowActivityUpdates() {
		$method = 'POST';
		$queryFilter = array();
		$postFilter = array("ActivitySid" => $this->required);
		$this->allow($this->resourceUrl, $method, $queryFilter, $postFilter);
	}

	public function allowReservationUpdates() {
		$method = 'POST';
		$queryFilter = array();
		$postFilter = array();
		$this->allow($this->tasksUrl, $method, $queryFilter, $postFilter);
		$this->allow($this->workerReservationsUrl, $method, $queryFilter, $postFilter);
	}
}
