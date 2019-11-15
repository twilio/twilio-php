<?php


namespace Twilio\Jwt\TaskRouter;
use Twilio\Jwt\JWT;


/**
 * Twilio TaskRouter Capability assigner
 *
 * @author Justin Witz <justin.witz@twilio.com>
 * @license  http://creativecommons.org/licenses/MIT/ MIT
 */
class CapabilityToken {
    protected $accountSid;
    protected $authToken;
    private $friendlyName;
    /** @var Policy[] $policies */
    private $policies;

    protected $baseUrl = 'https://taskrouter.twilio.com/v1';
    protected $baseWsUrl = 'https://event-bridge.twilio.com/v1/wschannels';
    protected $version = 'v1';

    protected $workspaceSid;
    protected $channelId;
    protected $resourceUrl;

    protected $required = array("required" => true);
    protected $optional = array("required" => false);

    public function __construct($accountSid, $authToken, $workspaceSid, $channelId, $resourceUrl = null, $overrideBaseUrl = null, $overrideBaseWSUrl = null) {
        $this->accountSid = $accountSid;
        $this->authToken = $authToken;
        $this->friendlyName = $channelId;
        $this->policies = array();

        $this->workspaceSid = $workspaceSid;
        $this->channelId = $channelId;
        if (isset($overrideBaseUrl)) {
            $this->baseUrl = $overrideBaseUrl;
        }
        if (isset($overrideBaseWSUrl)) {
            $this->baseWsUrl = $overrideBaseWSUrl;
        }
        $this->baseUrl = $this->baseUrl . '/Workspaces/' . $workspaceSid;

        $this->validateJWT();

        if (!isset($resourceUrl)) {
            $this->setupResource();
        }

        //add permissions to GET and POST to the event-bridge channel
        $this->allow($this->baseWsUrl . "/" . $this->accountSid . "/" . $this->channelId, "GET", null, null);
        $this->allow($this->baseWsUrl . "/" . $this->accountSid . "/" . $this->channelId, "POST", null, null);

        //add permissions to fetch the instance resource
        $this->allow($this->resourceUrl, "GET", null, null);
    }

    protected function setupResource() {

    }

    public function addPolicyDeconstructed($url, $method, $queryFilter = array(), $postFilter = array(), $allow = true) {
        $policy = new Policy($url, $method, $queryFilter, $postFilter, $allow);
        \array_push($this->policies, $policy);
        return $policy;
    }

    public function allow($url, $method, $queryFilter = array(), $postFilter = array()) {
        $this->addPolicyDeconstructed($url, $method, $queryFilter, $postFilter, true);
    }

    public function deny($url, $method, $queryFilter = array(), $postFilter = array()) {
        $this->addPolicyDeconstructed($url, $method, $queryFilter, $postFilter, false);
    }

    private function validateJWT() {
        if (!isset($this->accountSid) || \substr($this->accountSid, 0, 2) != 'AC') {
            throw new \Exception("Invalid AccountSid provided: " . $this->accountSid);
        }
        if (!isset($this->workspaceSid) || \substr($this->workspaceSid, 0, 2) != 'WS') {
            throw new \Exception("Invalid WorkspaceSid provided: " . $this->workspaceSid);
        }
        if (!isset($this->channelId)) {
            throw new \Exception("ChannelId not provided");
        }
        $prefix = \substr($this->channelId, 0, 2);
        if ($prefix != 'WS' && $prefix != 'WK' && $prefix != 'WQ') {
            throw new \Exception("Invalid ChannelId provided: " . $this->channelId);
        }
    }

    public function allowFetchSubresources() {
        $method = 'GET';
        $queryFilter = array();
        $postFilter = array();
        $this->allow($this->resourceUrl . '/**', $method, $queryFilter, $postFilter);
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
        $this->allow($this->resourceUrl . '/**', $method, $queryFilter, $postFilter);
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
        $this->allow($this->resourceUrl . '/**', $method, $queryFilter, $postFilter);
    }

    public function generateToken($ttl = 3600, $extraAttributes = array()) {
        $payload = array(
            'version' => $this->version,
            'friendly_name' => $this->friendlyName,
            'iss' => $this->accountSid,
            'exp' => \time() + $ttl,
            'account_sid' => $this->accountSid,
            'channel' => $this->channelId,
            'workspace_sid' => $this->workspaceSid
        );

        if (\substr($this->channelId, 0, 2) == 'WK') {
            $payload['worker_sid'] = $this->channelId;
        } else if (\substr($this->channelId, 0, 2) == 'WQ') {
            $payload['taskqueue_sid'] = $this->channelId;
        }

        foreach ($extraAttributes as $key => $value) {
            $payload[$key] = $value;
        }

        $policyStrings = array();
        foreach ($this->policies as $policy) {
            $policyStrings[] = $policy->toArray();
        }

        $payload['policies'] = $policyStrings;
        return JWT::encode($payload, $this->authToken, 'HS256');
    }
}