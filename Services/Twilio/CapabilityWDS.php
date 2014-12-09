<?php
include_once 'CapabilityAPI.php';
/**
 * Twilio WDS Capability assigner
 *
 * @category Services
 * @package  Services_Twilio
 * @author Justin Witz <justin.witz@twilio.com>
 * @license  http://creativecommons.org/licenses/MIT/ MIT
 */
class Services_Twilio_WDS_Worker_Capability
{
    private $accountSid;
    private $authToken;
    private $workspaceSid;
    private $workerSid;
    private $apiCapability;
    
    private $baseUrl = 'https://api.twilio.com/2010-04-01';
    private $workerUrl;
    private $reservationsUrl;
    
    private $required = array("required" => true);
    
    public function __construct($accountSid, $authToken, $workspaceSid, $workerSid, $overrideBaseUrl = null)
    {
        $this->accountSid = $accountSid;
        $this->authToken = $authToken;
        $this->workspaceSid = $workspaceSid;
        $this->workerSid = $workerSid;
        $this->apiCapability = new Services_Twilio_API_Capability($accountSid, $authToken, '2010-04-10', $workerSid);
        if(isset($overrideBaseUrl)) {
            $this->baseUrl = $overrideBaseUrl;
        }
        $this->baseUrl = $this->baseUrl.'/Accounts/'.$accountSid.'/Workspaces/'.$workspaceSid;
        $this->workerUrl = $this->baseUrl.'/Workers/'.$workerSid;
        $this->reservationsUrl = $this->baseUrl.'/Tasks/**';
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
    
    public function generateToken($ttl = 3600) {
        $wdsAttributes = array(
            'account_sid' => $this->accountSid,
            'workspace_sid' => $this->workspaceSid,
            'worker_sid' => $this->workerSid
        );
    	return $this->apiCapability->generateToken($ttl, $wdsAttributes);
    }
}
