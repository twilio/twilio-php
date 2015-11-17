<?php


namespace Twilio;


class ListResource {
    protected $version;

    public function __construct(Version $version) {
        $this->version = $version;
    }

    public function __toString() {
        return '[ListResource]';
    }
}