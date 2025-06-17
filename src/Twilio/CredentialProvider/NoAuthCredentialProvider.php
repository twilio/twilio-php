<?php
namespace Twilio\CredentialProvider;

use Twilio\AuthStrategy\AuthStrategy;
use Twilio\AuthStrategy\NoAuthStrategy;

/**
 * Class NoAuthCredentialProvider
 * Credential provider for no authentication
 */

class NoAuthCredentialProvider extends CredentialProvider {
    public function __construct() {
        parent::__construct("noauth");
    }

    /**
     * Returns the authentication strategy for the credential provider
     *
     * @return AuthStrategy the authentication strategy for the credential provider
     */
    public function toAuthStrategy(): AuthStrategy {
        return new NoAuthStrategy();
    }
}
