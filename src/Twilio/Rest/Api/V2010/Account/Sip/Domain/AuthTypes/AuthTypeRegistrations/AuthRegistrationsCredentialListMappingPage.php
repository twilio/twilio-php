<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Api\V2010\Account\Sip\Domain\AuthTypes\AuthTypeRegistrations;

use Twilio\Page;

class AuthRegistrationsCredentialListMappingPage extends Page {
    public function __construct($version, $response, $solution) {
        parent::__construct($version, $response);

        // Path Solution
        $this->solution = $solution;
    }

    public function buildInstance(array $payload): AuthRegistrationsCredentialListMappingInstance {
        return new AuthRegistrationsCredentialListMappingInstance(
            $this->version,
            $payload,
            $this->solution['accountSid'],
            $this->solution['domainSid']
        );
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        return '[Twilio.Api.V2010.AuthRegistrationsCredentialListMappingPage]';
    }
}