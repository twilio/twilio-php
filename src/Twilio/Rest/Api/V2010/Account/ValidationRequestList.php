<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Api\V2010\Account;

use Twilio\Exceptions\TwilioException;
use Twilio\ListResource;
use Twilio\Options;
use Twilio\Values;
use Twilio\Version;

class ValidationRequestList extends ListResource {
    /**
     * Construct the ValidationRequestList
     *
     * @param Version $version Version that contains the resource
     * @param string $accountSid The SID of the Account that created the resource
     */
    public function __construct(Version $version, $accountSid) {
        parent::__construct($version);

        // Path Solution
        $this->solution = ['accountSid' => $accountSid, ];

        $this->uri = '/Accounts/' . \rawurlencode($accountSid) . '/OutgoingCallerIds.json';
    }

    /**
     * Create a new ValidationRequestInstance
     *
     * @param string $phoneNumber The phone number to verify in E.164 format
     * @param array|Options $options Optional Arguments
     * @return ValidationRequestInstance Newly created ValidationRequestInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function create($phoneNumber, $options = []): ValidationRequestInstance {
        $options = new Values($options);

        $data = Values::of([
            'PhoneNumber' => $phoneNumber,
            'FriendlyName' => $options['friendlyName'],
            'CallDelay' => $options['callDelay'],
            'Extension' => $options['extension'],
            'StatusCallback' => $options['statusCallback'],
            'StatusCallbackMethod' => $options['statusCallbackMethod'],
        ]);

        $payload = $this->version->create(
            'POST',
            $this->uri,
            [],
            $data
        );

        return new ValidationRequestInstance($this->version, $payload, $this->solution['accountSid']);
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        return '[Twilio.Api.V2010.ValidationRequestList]';
    }
}