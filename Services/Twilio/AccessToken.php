<?php

include_once 'JWT.php';

class Services_Twilio_AccessToken
{
    private $signingKeySid;
    private $accountSid;
    private $secret;
    private $ttl;
    private $grants;

    public function __construct($signingKeySid, $accountSid, $secret, $ttl = 3600)
    {
        $this->signingKeySid = $signingKeySid;
        $this->accountSid = $accountSid;
        $this->secret = $secret;
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

    public function asJWT()
    {
        $header = array('cty' => 'twilio-sat;v=1');
        $now = time();
        $payload = array(
            'jti' => $this->signingKeySid . '-' . $now,
            'iss' => $this->signingKeySid,
            'sub' => $this->accountSid,
            'nbf' => $now,
            'exp' => $now + $this->ttl,
            'grants' => $this->grants
        );

        return JWT::encode($payload, $this->secret, 'HS256', $header);
    }

    public function __toString()
    {
        return $this->asJWT();
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
