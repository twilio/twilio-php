<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Trunking\V1\Trunk;

use Twilio\Page;

class PhoneNumberPage extends Page
{
    public function __construct($version, $response, $solution)
    {
        parent::__construct($version, $response);

        // Path Solution
        $this->solution = $solution;
    }

    public function buildInstance(array $payload)
    {
        return new PhoneNumberInstance(
            $this->version,
            $payload,
            $this->solution['trunkSid']
        );
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString()
    {
        return '[Twilio.Trunking.V1.PhoneNumberPage]';
    }
}
