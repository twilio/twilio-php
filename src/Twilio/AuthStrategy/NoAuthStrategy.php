<?php
namespace Twilio\AuthStrategy;

/**
 * @property string $username
 * @property string $password
 */

class NoAuthStrategy extends AuthStrategy {

    public function __construct() {
        parent::__construct("noauth");
    }

    public function getAuthString(): string {
        return "";
    }

    public function requiresAuthentication(): bool {
       return false;
    }
}
