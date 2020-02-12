<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Authy\V1\Service\Entity;

use Twilio\Options;
use Twilio\Values;

/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 */
abstract class FactorOptions {
    /**
     * @param string $authPayload Optional payload to verify the Factor for the
     *                            first time
     * @return UpdateFactorOptions Options builder
     */
    public static function update($authPayload = Values::NONE): UpdateFactorOptions {
        return new UpdateFactorOptions($authPayload);
    }
}

class UpdateFactorOptions extends Options {
    /**
     * @param string $authPayload Optional payload to verify the Factor for the
     *                            first time
     */
    public function __construct($authPayload = Values::NONE) {
        $this->options['authPayload'] = $authPayload;
    }

    /**
     * The optional payload needed to verify the Factor for the first time. E.g. for a TOTP, the numeric code.
     *
     * @param string $authPayload Optional payload to verify the Factor for the
     *                            first time
     * @return $this Fluent Builder
     */
    public function setAuthPayload($authPayload): self {
        $this->options['authPayload'] = $authPayload;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        $options = [];
        foreach ($this->options as $key => $value) {
            if ($value !== Values::NONE) {
                $options[] = "$key=$value";
            }
        }
        return '[Twilio.Authy.V1.UpdateFactorOptions ' . \implode(' ', $options) . ']';
    }
}