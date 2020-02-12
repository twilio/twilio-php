<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Pricing\V1\Voice;

use Twilio\ListResource;
use Twilio\Version;

class NumberList extends ListResource {
    /**
     * Construct the NumberList
     *
     * @param Version $version Version that contains the resource
     */
    public function __construct(Version $version) {
        parent::__construct($version);

        // Path Solution
        $this->solution = [];
    }

    /**
     * Constructs a NumberContext
     *
     * @param string $number The phone number to fetch
     */
    public function getContext($number): NumberContext {
        return new NumberContext($this->version, $number);
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        return '[Twilio.Pricing.V1.NumberList]';
    }
}