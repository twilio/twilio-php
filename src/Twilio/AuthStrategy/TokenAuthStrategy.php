<?php
namespace Twilio\AuthStrategy;

use Twilio\Http\BearerToken\TokenManager;
use Twilio\Jwt\JWT;

/**
 * @property string $token
 * @property TokenManager $tokenManager
 */

class TokenAuthStrategy extends AuthStrategy {
    private $token;
    private $tokenManager;

    public function __construct(TokenManager $tokenManager) {
        parent::__construct("token");
        $this->tokenManager = $tokenManager;
    }

    public function getAuthString(): string {
        return $this->fetchToken();
    }

    public function requiresAuthentication(): bool {
        return true;
    }

    public function fetchToken(): string {
       if(empty($this->token) || $this->isTokenExpired($this->token)) {
           $this->token = $this->tokenManager->fetchToken();
       }
        return $this->token;
    }

    public function isTokenExpired(string $token): bool {
        $decodedToken = JWT::decode($token);
        if($decodedToken === null || $decodedToken->exp === null) {
            // If the token doesn't have an expiration, consider it expired
            return false;
        }
        $expiresAt = $decodedToken->exp * 1000;
        $bufferMilliseconds = 30 * 1000;
        $bufferExpiresAt = $expiresAt - $bufferMilliseconds;

        // Return true if the current time is after the expiration time with buffer
        return time() > $bufferExpiresAt;
    }


}
