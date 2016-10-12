<?php


namespace Twilio;


class InstanceResource {
    protected $version;
    protected $context = null;
    protected $properties = array();
    protected $solution = array();

    public function __construct(Version $version) {
        $this->version = $version;
    }

    public function toArray() {
        return $this->properties;
    }

    public function __toString() {
        return '[InstanceResource]';
    }
}