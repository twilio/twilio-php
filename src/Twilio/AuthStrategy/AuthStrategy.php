<?php
namespace Twilio\AuthStrategy;

/**
 * @property string $authType
 */

abstract class AuthStrategy {
    private $authType;

    public function __construct(string $authType) {
        $this->authType = $authType;
    }

    public function getAuthType(): string {
        return $this->authType;
    }

    abstract public function getAuthString(): string;
    abstract public function requiresAuthentication(): bool;
}
