<?php


namespace Twilio;


class InstanceContext {
    protected $version;

    public function __construct(Version $version) {
        $this->version = $version;
    }

    public function __toString() {
        return '[InstanceContext]';
    }
}