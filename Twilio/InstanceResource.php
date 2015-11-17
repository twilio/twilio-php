<?php


namespace Twilio;


class InstanceResource {
    protected $version;

    public function __construct(Version $version) {
        $this->version = $version;
    }

    public function __toString() {
        return '[InstanceResource]';
    }
}