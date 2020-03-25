<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Serverless\V1\Service\Environment;

use Twilio\Options;
use Twilio\Values;

/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 */
abstract class VariableOptions {
    /**
     * @param string $key A string by which the Variable resource can be referenced
     * @param string $value A string that contains the actual value of the variable
     * @return UpdateVariableOptions Options builder
     */
    public static function update(string $key = Values::NONE, string $value = Values::NONE): UpdateVariableOptions {
        return new UpdateVariableOptions($key, $value);
    }
}

class UpdateVariableOptions extends Options {
    /**
     * @param string $key A string by which the Variable resource can be referenced
     * @param string $value A string that contains the actual value of the variable
     */
    public function __construct(string $key = Values::NONE, string $value = Values::NONE) {
        $this->options['key'] = $key;
        $this->options['value'] = $value;
    }

    /**
     * A string by which the Variable resource can be referenced. Must be less than 128 characters long.
     *
     * @param string $key A string by which the Variable resource can be referenced
     * @return $this Fluent Builder
     */
    public function setKey(string $key): self {
        $this->options['key'] = $key;
        return $this;
    }

    /**
     * A string that contains the actual value of the variable. Must have less than 450 bytes.
     *
     * @param string $value A string that contains the actual value of the variable
     * @return $this Fluent Builder
     */
    public function setValue(string $value): self {
        $this->options['value'] = $value;
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
        return '[Twilio.Serverless.V1.UpdateVariableOptions ' . \implode(' ', $options) . ']';
    }
}