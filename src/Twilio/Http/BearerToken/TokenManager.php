<?php
namespace Twilio\Http\BearerToken;

/**
 * @property string $token
 * @property string $tokenManager
 */

abstract class TokenManager {
    abstract public function fetchToken(): string;
}
