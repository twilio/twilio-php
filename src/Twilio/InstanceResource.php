<?php


namespace Twilio;


class InstanceResource {
    protected $version;
    protected $context;
    protected $properties = [];
    protected $solution = [];

    public function __construct(Version $version) {
        $this->version = $version;
    }

    public function toArray(): array {
        return $this->properties;
    }

    public function __toString() {
        return '[InstanceResource]';
    }
}
