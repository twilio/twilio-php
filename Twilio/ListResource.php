<?php


namespace Twilio;


class ListResource {
    protected $version;
    protected $solution = array();
    protected $uri;

    public function __construct(Version $version) {
        $this->version = $version;
    }

    public function __toString() {
        return '[ListResource]';
    }
}