<?php

namespace Twilio\Jwt;


use Twilio\Jwt\Grants\Grant;

class AccessToken {
    private $signingKeySid;
    private $accountSid;
    private $secret;
    private $ttl;
    private $identity;
    private $nbf;
    /** @var Grant[] $grants */
    private $grants;

    public function __construct($accountSid, $signingKeySid, $secret, $ttl = 3600, $identity = null) {
        $this->signingKeySid = $signingKeySid;
        $this->accountSid = $accountSid;
        $this->secret = $secret;
        $this->ttl = $ttl;

        if (!is_null($identity)) {
            $this->identity = $identity;
        }

        $this->grants = array();
    }

    /**
     * Set the identity of this access token
     *
     * @param string $identity identity of the grant
     *
     * @return $this updated access token
     */
    public function setIdentity($identity) {
        $this->identity = $identity;
        return $this;
    }

    /**
     * Returns the identity of the grant
     *
     * @return string the identity
     */
    public function getIdentity() {
        return $this->identity;
    }

    /**
     * Set the nbf of this access token
     *
     * @param integer $nbf nbf in epoch seconds of the grant
     *
     * @return $this updated access token
     */
    public function setNbf($nbf) {
        $this->nbf = $nbf;
        return $this;
    }

    /**
     * Returns the nbf of the grant
     *
     * @return integer the nbf in epoch seconds
     */
    public function getNbf() {
        return $this->nbf;
    }

    /**
     * Add a grant to the access token
     *
     * @param Grant $grant to be added
     *
     * @return $this the updated access token
     */
    public function addGrant(Grant $grant) {
        $this->grants[] = $grant;
        return $this;
    }


    public function toJWT($algorithm = 'HS256') {
        $header = array(
            'cty' => 'twilio-fpa;v=1',
            'typ' => 'JWT'
        );

        $now = time();

        $grants = array();
        if ($this->identity) {
            $grants['identity'] = $this->identity;
        }

        foreach ($this->grants as $grant) {
            $payload = $grant->getPayload();
            if (empty($payload)) {
                $payload = json_decode('{}');
            }

            $grants[$grant->getGrantKey()] = $payload;
        }

        if (empty($grants)) {
            $grants = json_decode('{}');
        }

        $payload = array(
            'jti' => $this->signingKeySid . '-' . $now,
            'iss' => $this->signingKeySid,
            'sub' => $this->accountSid,
            'exp' => $now + $this->ttl,
            'grants' => $grants
        );

        if (!is_null($this->nbf)) {
            $payload['nbf'] = $this->nbf;
        }

        return JWT::encode($payload, $this->secret, $algorithm, $header);
    }

    public function __toString() {
        return $this->toJWT();
    }
}