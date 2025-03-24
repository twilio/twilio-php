<?php
namespace Twilio\AuthStrategy;

use Twilio\Http\BearerToken\TokenManager;
use Twilio\Jwt\JWT;

/**
 * Class TokenAuthStrategy
 * Implementation of the AuthStrategy for Bearer Token Authentication
 * @property string $token The bearer token
 * @property TokenManager $tokenManager The manager for the bearer token
 */

class TokenAuthStrategy extends AuthStrategy {
    private $token;
    private $tokenManager;

    public function __construct(TokenManager $tokenManager) {
        parent::__construct("token");
        $this->tokenManager = $tokenManager;
    }

    /**
     * Checks if the token is expired or not
     *
     * @param string $token the token to be checked
     *
     * @return bool whether the token is expired or not
     */
    public function isTokenExpired(string $token): bool {
        // Decode the JWT token
        $decodedToken = JWT::decode($token, null, false);

        // If the token doesn't have an expiration, consider it expired
        if ($decodedToken === null || $decodedToken->exp === null) {
            return false;
        }

        // Calculate the expiration time with a buffer of 30 seconds
        $expiresAt = $decodedToken->exp * 1000;
        $bufferMilliseconds = 30 * 1000;
        $bufferExpiresAt = $expiresAt - $bufferMilliseconds;

        // Return true if the current time is after the expiration time with buffer
        return time() > $bufferExpiresAt;
    }

    /**
     * Fetches the bearer token
     *
     * @return string the bearer token
     */
    public function fetchToken(): string {
        if (empty($this->token) || $this->isTokenExpired($this->token)) {
            $this->token = $this->tokenManager->fetchToken();
        }
        return $this->token;
    }

    /**
     * Returns the bearer token authentication string
     *
     * @return string the bearer token authentication string
     */
    public function getAuthString(): string {
        return "Bearer " . $this->fetchToken();
    }
}
