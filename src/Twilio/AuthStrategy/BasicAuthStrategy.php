<?php
namespace Twilio\AuthStrategy;

/**
 * @property string $username
 * @property string $password
 */

class BasicAuthStrategy extends AuthStrategy {
    private $username;
    private $password;

    public function __construct(string $username, string $password) {
        parent::__construct("basic");
        $this->username = $username;
        $this->password = $password;
    }

    public function getAuthString(): string {
        return base64_encode($this->username . ':' . $this->password);
    }

    public function requiresAuthentication(): bool {
       return true;
    }
}
