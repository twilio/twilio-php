<?php

namespace Twilio\CredentialProvider;

use Twilio\Http\BearerToken\TokenManager;

/**
 * Class ClientCredentialProviderBuilder
 * Builder class for ClientCredentialProvider
 */

class ClientCredentialProviderBuilder {
    private $instance;

    public function __construct() {
        $this->instance = new ClientCredentialProvider();
    }

    public function setGrantType(string $grantType): ClientCredentialProviderBuilder {
        $this->instance->grantType = $grantType;
        return $this;
    }

    public function setClientId(string $clientId): ClientCredentialProviderBuilder {
        $this->instance->clientId = $clientId;
        return $this;
    }

    public function setClientSecret(string $clientSecret): ClientCredentialProviderBuilder {
        $this->instance->clientSecret = $clientSecret;
        return $this;
    }

    public function setTokenManager(TokenManager $tokenManager): ClientCredentialProviderBuilder {
        $this->instance->setTokenManager($tokenManager);
        return $this;
    }

    public function build(): ClientCredentialProvider
    {
        return $this->instance;
    }

}
