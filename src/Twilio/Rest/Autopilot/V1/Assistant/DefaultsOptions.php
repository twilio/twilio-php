<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Autopilot\V1\Assistant;

use Twilio\Options;
use Twilio\Values;

/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 */
abstract class DefaultsOptions {
    /**
     * @param array $defaults A JSON string that describes the default task links.
     * @return UpdateDefaultsOptions Options builder
     */
    public static function update($defaults = Values::NONE): UpdateDefaultsOptions {
        return new UpdateDefaultsOptions($defaults);
    }
}

class UpdateDefaultsOptions extends Options {
    /**
     * @param array $defaults A JSON string that describes the default task links.
     */
    public function __construct($defaults = Values::NONE) {
        $this->options['defaults'] = $defaults;
    }

    /**
     * A JSON string that describes the default task links for the `assistant_initiation`, `collect`, and `fallback` situations.
     *
     * @param array $defaults A JSON string that describes the default task links.
     * @return $this Fluent Builder
     */
    public function setDefaults($defaults): self {
        $this->options['defaults'] = $defaults;
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
        return '[Twilio.Autopilot.V1.UpdateDefaultsOptions ' . \implode(' ', $options) . ']';
    }
}