<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Chat\V2\Service\User;

use Twilio\Options;
use Twilio\Values;

abstract class UserBindingOptions {
    /**
     * @param string[] $bindingType The push technology used by the User Binding
     *                              resources to read
     * @return ReadUserBindingOptions Options builder
     */
    public static function read(array $bindingType = Values::ARRAY_NONE): ReadUserBindingOptions {
        return new ReadUserBindingOptions($bindingType);
    }
}

class ReadUserBindingOptions extends Options {
    /**
     * @param string[] $bindingType The push technology used by the User Binding
     *                              resources to read
     */
    public function __construct(array $bindingType = Values::ARRAY_NONE) {
        $this->options['bindingType'] = $bindingType;
    }

    /**
     * The push technology used by the User Binding resources to read. Can be: `apn`, `gcm`, or `fcm`.  See [push notification configuration](https://www.twilio.com/docs/chat/push-notification-configuration) for more info.
     *
     * @param string[] $bindingType The push technology used by the User Binding
     *                              resources to read
     * @return $this Fluent Builder
     */
    public function setBindingType(array $bindingType): self {
        $this->options['bindingType'] = $bindingType;
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
            if ($value !== Values::NONE || $value !== Values::ARRAY_NONE) {
                $options[] = "$key=$value";
            }
        }
        return '[Twilio.Chat.V2.ReadUserBindingOptions ' . \implode(' ', $options) . ']';
    }
}