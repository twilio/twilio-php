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
class Services_Twilio_TaskRouter_Worker_Capability
{
    private $accountSid;
    private $authToken;
    private $workspaceSid;
    private $workerSid;
    private $apiCapability;
    
    private $baseUrl = 'https://taskrouter.twilio.com/v1';
    private $baseWsUrl = 'https://event-bridge.twilio.com/v1/wschannels';
    private $workerUrl;
    private $reservationsUrl;
    private $activityUrl;
    
    private $required = array("required" => true);
    private $optional = array("required" => false);
    
    
    public function __construct($accountSid, $authToken, $workspaceSid, $workerSid, $overrideBaseUrl = null, $overrideBaseWSUrl = null)
    {
        $this->accountSid = $accountSid;
        $this->authToken = $authToken;
        $this->workspaceSid = $workspaceSid;
        $this->workerSid = $workerSid;
        $this->apiCapability = new Services_Twilio_API_Capability($accountSid, $authToken, 'v1', $workerSid);
        if(isset($overrideBaseUrl)) {
            $this->baseUrl = $overrideBaseUrl;
        }
        if(isset($overrideBaseWSUrl)) {
            $this->baseWsUrl = $overrideBaseWSUrl;
        }
        $this->baseUrl = $this->baseUrl.'/Workspaces/'.$workspaceSid;
        $this->workerUrl = $this->baseUrl.'/Workers/'.$workerSid;
        $this->reservationsUrl = $this->baseUrl.'/Tasks/**';
        $this->activityUrl = $this->baseUrl.'/Activities';
        
        //add permissions to GET and POST to the worker URI
        $this->apiCapability->generateAndAddPolicy($this->baseWsUrl."/".$this->accountSid."/".$this->workerSid, "GET", null, null);
        $this->apiCapability->generateAndAddPolicy($this->baseWsUrl."/".$this->accountSid."/".$this->workerSid, "POST", null, null);
        $this->apiCapability->generateAndAddPolicy($this->activityUrl, "GET", null, null);
    }
    
    public function allowWorkerActivityUpdates() {
        $method = 'POST';
        $queryFilter = array();
        $postFilter = array("ActivitySid" => $this->required);
        $this->apiCapability->generateAndAddPolicy($this->workerUrl, $method, $queryFilter, $postFilter);
    }
    
    public function allowWorkerFetchAttributes() {
        $method = 'GET';
        $queryFilter = array();
        $postFilter = array();
        $this->apiCapability->generateAndAddPolicy($this->workerUrl, $method, $queryFilter, $postFilter);
    }
    
    public function allowTaskReservationUpdates() {
        $method = 'POST';
        $queryFilter = array();
        $postFilter = array("ReservationStatus" => $this->required);
        $this->apiCapability->generateAndAddPolicy($this->reservationsUrl, $method, $queryFilter, $postFilter);
    }
    
     public function allowActivityListFetch(){
        $method = 'GET';
        $queryFilter = array();
        $postFilter = array();
        $this->apiCapability->generateAndAddPolicy($this->activityUrl, $method, $queryFilter, $postFilter);

    }
    
    public function generateToken($ttl = 3600) {
        $taskRouterAttributes = array(
            'account_sid' => $this->accountSid,
            'channel' => $this->workerSid,
            'workspace_sid' => $this->workspaceSid,
            'worker_sid' => $this->workerSid,
        );
    	return $this->apiCapability->generateToken($ttl, $taskRouterAttributes);
    }
}
