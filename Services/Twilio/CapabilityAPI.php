<?php

/**
 * Twilio API Capability Token generator
 *
 * @category Services
 * @package  Services_Twilio
 * @author Justin Witz <justin.witz@twilio.com>
 * @license  http://creativecommons.org/licenses/MIT/ MIT
 */
class Services_Twilio_API_Capability
{
    public $accountSid;
    public $authToken;
    public $version;
    public $friendlyName;
    public $policies;
    
    public function __construct($accountSid, $authToken, $version, $friendlyName)
    {
        $this->accountSid = $accountSid;
        $this->authToken = $authToken;
        $this->version = $version;
        $this->friendlyName = $friendlyName;
        $this->policies = array();
    }
    
    public function addPolicy($policy) {
    	array_push($this->policies, $policy);
    }
    
    public function generatePolicy($url, $method, $queryFilter = array(), $postFilter = array(), $allow = true) 
    {
    	$policy = new Policy($url, $method, $queryFilter, $postFilter, $allow);
    	return $policy;
    }
    
    public function generateAndAddPolicy($url, $method, $queryFilter = array(), $postFilter = array(), $allow = true) {
    	$policy = $this->generatePolicy($url, $method, $queryFilter, $postFilter, $allow);
    	$this->addPolicy($policy);
    }
       
    /**
     * Generates a new token based on the credentials and permissions that
     * previously has been granted to this token.
     *
     * @param $ttl the expiration time of the token (in seconds). Default
     *        value is 3600 (1hr)
     * @return the newly generated token that is valid for $ttl seconds
     */
    public function generateToken($ttl = 3600)
    {
        $payload = array(
            'version' => $this->version,
            'friendly_name' => $this->friendlyName,
            'policies' => array(),
            'account_sid' => $this->accountSid,
            'iss' => $this->accountSid,
            'exp' => time() + $ttl,
        );
        $policyStrings = array();

        foreach ($this->policies as $policy) {
            $policyStrings[] = json_encode($policy->toArray(), JSON_FORCE_OBJECT);
        }

		$policyStringsArray = '['.implode(', ', $policyStrings).']';
        $payload['policies'] = $policyStringsArray;
        return JWT::encode($payload, $this->authToken, 'HS256');
    }
}

/**
 * Twilio API Policy constructor
 *
 * @category Services
 * @package  Services_Twilio
 * @author Justin Witz <justin.witz@twilio.com>
 * @license  http://creativecommons.org/licenses/MIT/ MIT
 */
class Policy
{
	public $url;
	public $method;
	public $queryFilter;
	public $postFilter;
	public $allow;
	
	public function __construct($url, $method, $queryFilter = array(), $postFilter = array(), $allow = true)
    {
        $this->url = $url;
        $this->method = $method;
        $this->queryFilter = $queryFilter;
        $this->postFilter = $postFilter;
        $this->allow = $allow;
    }
    
    public function addQueryFilter($queryFilter)
    {
    	array_push($this->queryFilter, $queryFilter);
    }
    
    public function addPostFilter($postFilter)
    {
    	array_push($this->postFilter, $postFilter);
    }
    
    public function toArray() {
    	return array('url' => $this->url, 'method' => $this->method, 'query_filter' => $this->queryFilter, 'post_filter' => $this->postFilter, 'allow' => $this->allow);
    }
}
