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
    /** @var string[] $customClaims */
    private $customClaims;

    public function __construct(string $accountSid, string $signingKeySid, string $secret, int $ttl = 3600, string $identity = null) {
        $this->signingKeySid = $signingKeySid;
        $this->accountSid = $accountSid;
        $this->secret = $secret;
        $this->ttl = $ttl;

        if ($identity !== null) {
            $this->identity = $identity;
        }

        $this->grants = [];
        $this->customClaims = [];
    }

    /**
     * Set the identity of this access token
     *
     * @param string $identity identity of the grant
     *
     * @return $this updated access token
     */
    public function setIdentity(string $identity): self {
        $this->identity = $identity;
        return $this;
    }

    /**
     * Returns the identity of the grant
     *
     * @return string the identity
     */
    public function getIdentity(): string {
        return $this->identity;
    }

    /**
     * Set the nbf of this access token
     *
     * @param int $nbf nbf in epoch seconds of the grant
     *
     * @return $this updated access token
     */
    public function setNbf(int $nbf): self {
        $this->nbf = $nbf;
        return $this;
    }

    /**
     * Returns the nbf of the grant
     *
     * @return int the nbf in epoch seconds
     */
    public function getNbf(): int {
        return $this->nbf;
    }

    /**
     * Add a grant to the access token
     *
     * @param Grant $grant to be added
     *
     * @return $this the updated access token
     */
    public function addGrant(Grant $grant): self {
        $this->grants[] = $grant;
        return $this;
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

    public function toJWT(string $algorithm = 'HS256'): string {
        $header = [
            'cty' => 'twilio-fpa;v=1',
            'typ' => 'JWT'
        ];

        $now = \time();

        $grants = [];
        if ($this->identity) {
            $grants['identity'] = $this->identity;
        }

        foreach ($this->grants as $grant) {
            $payload = $grant->getPayload();
            if (empty($payload)) {
                $payload = \json_decode('{}');
            }

            $grants[$grant->getGrantKey()] = $payload;
        }

        if (empty($grants)) {
            $grants = \json_decode('{}');
        }

        $payload = \array_merge($this->customClaims, [
            'jti' => $this->signingKeySid . '-' . $now,
            'iss' => $this->signingKeySid,
            'sub' => $this->accountSid,
            'exp' => $now + $this->ttl,
            'grants' => $grants
        ]);

        if ($this->nbf !== null) {
            $payload['nbf'] = $this->nbf;
        }

        return JWT::encode($payload, $this->secret, $algorithm, $header);
    }

    public function __toString(): string {
        return $this->toJWT();
    }
}
