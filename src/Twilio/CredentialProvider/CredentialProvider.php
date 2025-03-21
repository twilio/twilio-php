<?php
namespace Twilio\CredentialProvider;

use Twilio\AuthStrategy\AuthStrategy;

/**
 * Class CredentialProvider
 * Abstract parent class for all credential providers
 * @property string $authType The type of authentication
 */

abstract class CredentialProvider {
    private $authType;

    public function __construct(string $authType) {
        $this->authType = $authType;
    }

    public function getAuthType(): string {
        return $this->authType;
    }

    /**
     * Returns the authentication strategy for the credential provider
     *
     * @return AuthStrategy the authentication strategy for the credential provider
     */
    abstract public function toAuthStrategy(): AuthStrategy;
}
