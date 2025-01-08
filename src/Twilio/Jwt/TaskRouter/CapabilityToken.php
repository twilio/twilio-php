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

    protected $required = ['required' => true];
    protected $optional = ['required' => false];

    public function __construct(string $accountSid, string $authToken, string $workspaceSid, string $channelId,
                                string $resourceUrl = null, string $overrideBaseUrl = null, string $overrideBaseWSUrl = null) {
        $this->accountSid = $accountSid;
        $this->authToken = $authToken;
        $this->friendlyName = $channelId;
        $this->policies = [];

        $this->workspaceSid = $workspaceSid;
        $this->channelId = $channelId;
        if (isset($overrideBaseUrl)) {
            $this->baseUrl = $overrideBaseUrl;
        }
        if (isset($overrideBaseWSUrl)) {
            $this->baseWsUrl = $overrideBaseWSUrl;
        }
        $this->baseUrl .= '/Workspaces/' . $workspaceSid;

        $this->validateJWT();

        if (!isset($resourceUrl)) {
            $this->setupResource();
        }

        //add permissions to GET and POST to the event-bridge channel
        $this->allow($this->baseWsUrl . '/' . $this->accountSid . '/' . $this->channelId, 'GET', null, null);
        $this->allow($this->baseWsUrl . '/' . $this->accountSid . '/' . $this->channelId, 'POST', null, null);

        //add permissions to fetch the instance resource
        $this->allow($this->resourceUrl, 'GET', null, null);
    }

    protected function setupResource(): void {
    }

    public function addPolicyDeconstructed(string $url, string $method, ?array $queryFilter = [], ?array $postFilter = [], bool $allow = true): Policy {
        $policy = new Policy($url, $method, $queryFilter, $postFilter, $allow);
        $this->policies[] = $policy;
        return $policy;
    }

    public function allow(string $url, string $method, ?array $queryFilter = [], ?array $postFilter = []): void {
        $this->addPolicyDeconstructed($url, $method, $queryFilter, $postFilter, true);
    }

    public function deny(string $url, string $method, array $queryFilter = [], array $postFilter = []): void {
        $this->addPolicyDeconstructed($url, $method, $queryFilter, $postFilter, false);
    }

    private function validateJWT(): void {
        if (!isset($this->accountSid) || \strpos($this->accountSid, 'AC') !== 0) {
            throw new \Exception('Invalid AccountSid provided: ' . $this->accountSid);
        }
        if (!isset($this->workspaceSid) || \strpos($this->workspaceSid, 'WS') !== 0) {
            throw new \Exception('Invalid WorkspaceSid provided: ' . $this->workspaceSid);
        }
        if (!isset($this->channelId)) {
            throw new \Exception('ChannelId not provided');
        }
        $prefix = \substr($this->channelId, 0, 2);
        if ($prefix !== 'WS' && $prefix !== 'WK' && $prefix !== 'WQ') {
            throw new \Exception("Invalid ChannelId provided: " . $this->channelId);
        }
    }

    public function allowFetchSubresources(): void {
        $method = 'GET';
        $queryFilter = [];
        $postFilter = [];
        $this->allow($this->resourceUrl . '/**', $method, $queryFilter, $postFilter);
    }

    public function allowUpdates(): void {
        $method = 'POST';
        $queryFilter = [];
        $postFilter = [];
        $this->allow($this->resourceUrl, $method, $queryFilter, $postFilter);
    }

    public function allowUpdatesSubresources(): void {
        $method = 'POST';
        $queryFilter = [];
        $postFilter = [];
        $this->allow($this->resourceUrl . '/**', $method, $queryFilter, $postFilter);
    }

    public function allowDelete(): void {
        $method = 'DELETE';
        $queryFilter = [];
        $postFilter = [];
        $this->allow($this->resourceUrl, $method, $queryFilter, $postFilter);
    }

    public function allowDeleteSubresources(): void {
        $method = 'DELETE';
        $queryFilter = [];
        $postFilter = [];
        $this->allow($this->resourceUrl . '/**', $method, $queryFilter, $postFilter);
    }

    public function generateToken(int $ttl = 3600, array $extraAttributes = []): string {
        $payload = [
            'version' => $this->version,
            'friendly_name' => $this->friendlyName,
            'iss' => $this->accountSid,
            'exp' => \time() + $ttl,
            'account_sid' => $this->accountSid,
            'channel' => $this->channelId,
            'workspace_sid' => $this->workspaceSid
        ];

        if (\strpos($this->channelId, 'WK') === 0) {
            $payload['worker_sid'] = $this->channelId;
        } else if (\strpos($this->channelId, 'WQ') === 0) {
            $payload['taskqueue_sid'] = $this->channelId;
        }

        foreach ($extraAttributes as $key => $value) {
            $payload[$key] = $value;
        }

        $policyStrings = [];
        foreach ($this->policies as $policy) {
            $policyStrings[] = $policy->toArray();
        }

        $payload['policies'] = $policyStrings;
        return JWT::encode($payload, $this->authToken, 'HS256');
    }
}
