<?php
namespace Twilio\AuthStrategy;

/**
 * Class NoAuthStrategy
 * Implementation of the AuthStrategy for No Authentication
 */

class NoAuthStrategy extends AuthStrategy {

    public function __construct() {
        parent::__construct("noauth");
    }

    /**
     * Returns an empty string since no authentication is required
     *
     * @return string an empty string
     */
    public function getAuthString(): string {
        return "";
    }
}
