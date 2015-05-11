<?php

include_once 'JWT.php';

class ScopedAuthenticationToken
{
    private $signingKeySid;
    private $accountSid;
    private $tokenId;
    private $ttl;
    private $grants;

    public function __construct($signingKeySid, $accountSid, $ttl = 3600)
    {
        $this->signingKeySid = $signingKeySid;
        $this->accountSid = $accountSid;
        $this->tokenId = $signingKeySid . '-' . time();
        $this->ttl = $ttl;
        $this->grants = array();
    }

    public function addGrant($resource, $actions = array(Action::ALL))
    {
        if (!is_array($actions)) {
            $actions = array($actions);
        }

        $this->grants[] = array(
            'res' => $resource,
            'act' => $actions,
        );
        return $this;
    }

    public function addEndpointGrant($name, $actions = array(Action::LISTEN, Action::INVITE))
    {
        return $this->addGrant('sip:' . $name . '@' . $this->accountSid . '.endpoint.twilio.com', $actions);
    }

    public function encode($secret)
    {
        $header = array('cty' => 'twilio-sat;v=1');
        $now = time();
        $payload = array(
            'jti' => $this->tokenId,
            'iss' => $this->signingKeySid,
            'sub' => $this->accountSid,
            'nbf' => $now,
            'exp' => $now + $this->ttl,
            'grants' => $this->grants
        );

        return JWT::encode($payload, $secret, 'HS256', $header);
    }
}

abstract class Action
{
    const ALL = '*';
    const DELETE = 'DELETE';
    const GET = 'GET';
    const POST = 'POST';
    const PUT = 'PUT';

    const LISTEN = 'listen';
    const INVITE = 'invite';
}
