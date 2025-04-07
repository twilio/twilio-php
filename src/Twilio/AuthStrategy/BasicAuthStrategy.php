<?php
namespace Twilio\AuthStrategy;

/**
 * Class BasicAuthStrategy
 * Implementation of the AuthStrategy for Basic authentication
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

    /**
     * Returns the base64 encoded string concatenating the username and password
     *
     * @return string the base64 encoded string
     */
    public function getAuthString(): string {
        return base64_encode($this->username . ':' . $this->password);
    }
}
