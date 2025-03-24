<?php

namespace Twilio\CredentialProvider;

use Twilio\Http\BearerToken\TokenManager;

/**
 * Class ClientCredentialProviderBuilder
 * Builder class for ClientCredentialProvider
 */

class OrgsCredentialProviderBuilder {
    private $instance;

    public function __construct() {
        $this->instance = new OrgsCredentialProvider();
    }

    public function setGrantType(string $grantType): OrgsCredentialProviderBuilder {
        $this->instance->grantType = $grantType;
        return $this;
    }

    public function setClientId(string $clientId): OrgsCredentialProviderBuilder {
        $this->instance->clientId = $clientId;
        return $this;
    }

    public function setClientSecret(string $clientSecret): OrgsCredentialProviderBuilder {
        $this->instance->clientSecret = $clientSecret;
        return $this;
    }

    public function setTokenManager(TokenManager $tokenManager): OrgsCredentialProviderBuilder {
        $this->instance->tokenManager = $tokenManager;
        return $this;
    }

    public function build(): OrgsCredentialProvider
    {
        return $this->instance;
    }

}
