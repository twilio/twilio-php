<?php
namespace Twilio\AuthStrategy;

/**
 * Class AuthStrategy
 * Abstract parent class for all authentication strategies - Basic, Bearer Token, NoAuth etc.
 * @property string $authType The type of authentication strategy
 */

abstract class AuthStrategy {
    private $authType;

    public function __construct(string $authType) {
        $this->authType = $authType;
    }

    public function getAuthType(): string {
        return $this->authType;
    }

    /**
     * Returns the value to be set in the authentication header
     *
     * @return string the authentication string
     */
    abstract public function getAuthString(): string;
}
