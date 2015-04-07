<?php

include_once 'JWT.php';

class ScopedAuthenticationToken
{
    private $signingKeySid;
    private $accountSid;
    private $tokenId;
    private $ttl;
    private $grants;

    public function __construct($signingKeySid, $accountSid, $tokenId = null, $ttl = 3600, $grants = array())
    {
        $this->signingKeySid = $signingKeySid;
        $this->accountSid = $accountSid;
        $this->tokenId = $tokenId;
        if ($this->tokenId == null) {
            $this->tokenId = $signingKeySid . '-' . time();
        }
        $this->ttl = $ttl;
        $this->grants = $grants;
    }

    public function addGrant(Grant $grant)
    {
        $this->grants[] = $grant;
        return $this->grants;
    }

    public function generateToken($secret)
    {
        $header = array('cty' => 'twilio-sat;v=1');
        $payload = array(
            'jti' => $this->tokenId,
            'iss' => $this->signingKeySid,
            'sub' => $this->accountSid,
            'nbf' => time(),
            'exp' => time() + $this->ttl,
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
}

class Grant
{
    public function __construct($resource, $actions = array(Action::ALL))
    {
        $this->res = $resource;
        $this->act = $actions;
    }
}
