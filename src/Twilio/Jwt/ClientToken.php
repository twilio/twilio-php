<?php


namespace Twilio\Jwt;

use Twilio\Jwt\Client\ScopeURI;

/**
 * Twilio Capability Token generator
 */
class ClientToken {
    public $accountSid;
    public $authToken;
    /** @var ScopeURI[] $scopes */
    public $scopes;
    public $clientName;
    /** @var string[] $customClaims */
    private $customClaims;

    /**
     * Create a new TwilioCapability with zero permissions. Next steps are to
     * grant access to resources by configuring this token through the
     * functions allowXXXX.
     *
     * @param string $accountSid the account sid to which this token is granted
     *        access
     * @param string $authToken the secret key used to sign the token. Note,
     *        this auth token is not visible to the user of the token.
     */
    public function __construct(string $accountSid, string $authToken) {
        $this->accountSid = $accountSid;
        $this->authToken = $authToken;
        $this->scopes = [];
        $this->clientName = false;
        $this->customClaims = [];
    }

    /**
     * If the user of this token should be allowed to accept incoming
     * connections then configure the TwilioCapability through this method and
     * specify the client name.
     *
     * @param string $clientName
     * @throws \InvalidArgumentException
     */
    public function allowClientIncoming(string $clientName): void {
        // clientName must be a non-zero length alphanumeric string
        if (\preg_match('/\W/', $clientName)) {
            throw new \InvalidArgumentException(
                'Only alphanumeric characters allowed in client name.');
        }

        if ($clientName === '') {
            throw new \InvalidArgumentException(
                'Client name must not be a zero length string.');
        }

        $this->clientName = $clientName;
        $this->allow('client', 'incoming', ['clientName' => $clientName]);
    }

    /**
     * Allow the user of this token to make outgoing connections.
     *
     * @param string $appSid the application to which this token grants access
     * @param mixed[] $appParams signed parameters that the user of this token
     *        cannot overwrite.
     */
    public function allowClientOutgoing(string $appSid, array $appParams = []): void {
        $this->allow('client', 'outgoing', [
            'appSid' => $appSid,
            'appParams' => \http_build_query($appParams, '', '&')
        ]);
    }

    /**
     * Allow the user of this token to access their event stream.
     *
     * @param mixed[] $filters key/value filters to apply to the event stream
     */
    public function allowEventStream(array $filters = []): void {
        $this->allow('stream', 'subscribe', [
            'path' => '/2010-04-01/Events',
            'params' => \http_build_query($filters, '', '&'),
        ]);
    }

    /**
     * Allows to set custom claims, which then will be encoded into JWT payload.
     *
     * @param string $name
     * @param string $value
     */
    public function addClaim(string $name, string $value): void {
        $this->customClaims[$name] = $value;
    }

    /**
     * Generates a new token based on the credentials and permissions that
     * previously has been granted to this token.
     *
     * @param int $ttl the expiration time of the token (in seconds). Default
     *        value is 3600 (1hr)
     * @return string the newly generated token that is valid for $ttl seconds
     */
    public function generateToken(int $ttl = 3600): string {
        $payload = \array_merge($this->customClaims, [
            'scope' => [],
            'iss' => $this->accountSid,
            'exp' => \time() + $ttl,
        ]);
        $scopeStrings = [];

        foreach ($this->scopes as $scope) {
            if ($scope->privilege === 'outgoing' && $this->clientName) {
                $scope->params['clientName'] = $this->clientName;
            }
            $scopeStrings[] = $scope->toString();
        }

        $payload['scope'] = \implode(' ', $scopeStrings);
        return JWT::encode($payload, $this->authToken, 'HS256');
    }

    protected function allow(string $service, string $privilege, array $params): void {
        $this->scopes[] = new ScopeURI($service, $privilege, $params);
    }
}
