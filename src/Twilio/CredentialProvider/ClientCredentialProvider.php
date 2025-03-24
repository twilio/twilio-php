<?php
namespace Twilio\CredentialProvider;

use Twilio\AuthStrategy\AuthStrategy;
use Twilio\AuthStrategy\TokenAuthStrategy;
use Twilio\Exceptions\TwilioException;
use Twilio\Http\BearerToken\ApiTokenManager;
use Twilio\Http\BearerToken\TokenManager;


class ClientCredentialProvider extends CredentialProvider {
    private $options;
    private $tokenManager;

    public function __construct() {
        parent::__construct("client-credentials");
        $this->options = [
            "grantType" => "client_credentials",
            "clientId" => null,
            "clientSecret" => null,
            "code" => null,
            "redirectUri" =>null,
            "audience" => null,
            "refreshToken" => null,
            "scope" => null
        ];
    }

    /**
     * @return TokenManager
     */
    public function getTokenManager(): TokenManager {
        return $this->tokenManager;
    }

    /**
     * @param TokenManager $tokenManager
     */
    public function setTokenManager(TokenManager $tokenManager): void {
        $this->tokenManager = $tokenManager;
    }


    public function __get(string $name)
    {
        if (array_key_exists($name, $this->options)) {
            return $this->options[$name];
        }
        throw new TwilioException('Unknown property ' . $name);
    }

    public function __set(string $name, $value)
    {
        if (array_key_exists($name, $this->options)) {
            $this->options[$name] = $value;
        } else {
            throw new TwilioException('Unknown property ' . $name);
        }
    }

    public function toAuthStrategy(): AuthStrategy {
        if ($this->tokenManager === null) {
            $this->tokenManager = new ApiTokenManager($this->options);
        }
        return new TokenAuthStrategy($this->tokenManager);
    }
}
