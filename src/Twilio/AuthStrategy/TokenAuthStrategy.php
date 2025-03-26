<?php
namespace Twilio\AuthStrategy;

use Twilio\Rest\Client;
use Twilio\Http\BearerToken\TokenManager;
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
        $decodedToken = json_decode(base64_decode(str_replace('_', '/', str_replace('-','+',explode('.', $token)[1]))), true);

        $expireField = $decodedToken['exp'];

        // If the token doesn't have an expiration, consider it expired
        if ($decodedToken === null || $expireField === null) {
            return false;
        }

        // Calculate the expiration time with a buffer of 30 seconds
        $expiresAt = $expireField * 1000;
        $bufferMilliseconds = 30 * 1000;
        $bufferExpiresAt = $expiresAt - $bufferMilliseconds;

        // Return true if the current time is after the expiration time with buffer
        return round(microtime(true)*1000) > $bufferExpiresAt;
    }

    /**
     * Fetches the bearer token
     *
     * @return string the bearer token
     */
    public function fetchToken(?Client $client = null): string {
        if (empty($this->token) || $this->isTokenExpired($this->token)) {
            $this->token = $this->tokenManager->fetchToken($client);
        }
        return $this->token;
    }

    /**
     * Returns the bearer token authentication string
     *
     * @return string the bearer token authentication string
     */
    public function getAuthString(?Client $client = null): string {
        return "Bearer " . $this->fetchToken($client);
    }
}
