<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Accounts\V1\Credential;

use Twilio\Options;
use Twilio\Values;

abstract class PublicKeyOptions {
    /**
     * @param string $friendlyName A string to describe the resource
     * @param string $accountSid The Subaccount this Credential should be
     *                           associated with.
     * @return CreatePublicKeyOptions Options builder
     */
    public static function create(string $friendlyName = Values::NONE, string $accountSid = Values::NONE): CreatePublicKeyOptions {
        return new CreatePublicKeyOptions($friendlyName, $accountSid);
    }

    /**
     * @param string $friendlyName A string to describe the resource
     * @return UpdatePublicKeyOptions Options builder
     */
    public static function update(string $friendlyName = Values::NONE): UpdatePublicKeyOptions {
        return new UpdatePublicKeyOptions($friendlyName);
    }
}

class CreatePublicKeyOptions extends Options {
    /**
     * @param string $friendlyName A string to describe the resource
     * @param string $accountSid The Subaccount this Credential should be
     *                           associated with.
     */
    public function __construct(string $friendlyName = Values::NONE, string $accountSid = Values::NONE) {
        $this->options['friendlyName'] = $friendlyName;
        $this->options['accountSid'] = $accountSid;
    }

    /**
     * A descriptive string that you create to describe the resource. It can be up to 64 characters long.
     *
     * @param string $friendlyName A string to describe the resource
     * @return $this Fluent Builder
     */
    public function setFriendlyName(string $friendlyName): self {
        $this->options['friendlyName'] = $friendlyName;
        return $this;
    }

    /**
     * The SID of the Subaccount that this Credential should be associated with. Must be a valid Subaccount of the account issuing the request
     *
     * @param string $accountSid The Subaccount this Credential should be
     *                           associated with.
     * @return $this Fluent Builder
     */
    public function setAccountSid(string $accountSid): self {
        $this->options['accountSid'] = $accountSid;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        $options = [];
        foreach (Values::of($this->options) as $key => $value) {
                $options[] = "$key=$value";
        }
        return '[Twilio.Accounts.V1.CreatePublicKeyOptions ' . \implode(' ', $options) . ']';
    }
}

class UpdatePublicKeyOptions extends Options {
    /**
     * @param string $friendlyName A string to describe the resource
     */
    public function __construct(string $friendlyName = Values::NONE) {
        $this->options['friendlyName'] = $friendlyName;
    }

    /**
     * A descriptive string that you create to describe the resource. It can be up to 64 characters long.
     *
     * @param string $friendlyName A string to describe the resource
     * @return $this Fluent Builder
     */
    public function setFriendlyName(string $friendlyName): self {
        $this->options['friendlyName'] = $friendlyName;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        $options = [];
        foreach (Values::of($this->options) as $key => $value) {
                $options[] = "$key=$value";
        }
        return '[Twilio.Accounts.V1.UpdatePublicKeyOptions ' . \implode(' ', $options) . ']';
    }
}