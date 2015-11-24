<?php


namespace Twilio;


class InstanceResource {
    protected $version;
    protected $context = null;

    public function __construct(Version $version) {
        $this->version = $version;
    }

    public function __toString() {
        return '[InstanceResource]';
    }
}