<?php
namespace Twilio\Http\BearerToken;

use Twilio\Rest\Client;

/**
 * Class TokenManager
 * Abstract parent class for all token managers
 * @property string $token The bearer token
 * @property string $tokenManager The manager for the bearer token
 */

abstract class TokenManager {
    /**
     * Fetches the bearer token
     *
     * @return string the bearer token
     */
    abstract public function fetchToken(?Client $client = null): string;
}
