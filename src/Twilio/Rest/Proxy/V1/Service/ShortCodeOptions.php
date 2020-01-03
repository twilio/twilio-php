<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Proxy\V1\Service;

use Twilio\Options;
use Twilio\Values;

/**
 * PLEASE NOTE that this class contains beta products that are subject to change. Use them with caution.
 */
abstract class ShortCodeOptions {
    /**
     * @param bool $isReserved Whether the short code should be reserved for manual
     *                         assignment to participants only
     * @return UpdateShortCodeOptions Options builder
     */
    public static function update($isReserved = Values::NONE): UpdateShortCodeOptions {
        return new UpdateShortCodeOptions($isReserved);
    }
}

class UpdateShortCodeOptions extends Options {
    /**
     * @param bool $isReserved Whether the short code should be reserved for manual
     *                         assignment to participants only
     */
    public function __construct($isReserved = Values::NONE) {
        $this->options['isReserved'] = $isReserved;
    }

    /**
     * Whether the short code should be reserved and not be assigned to a participant using proxy pool logic. See [Reserved Phone Numbers](https://www.twilio.com/docs/proxy/reserved-phone-numbers) for more information.
     *
     * @param bool $isReserved Whether the short code should be reserved for manual
     *                         assignment to participants only
     * @return $this Fluent Builder
     */
    public function setIsReserved($isReserved): self {
        $this->options['isReserved'] = $isReserved;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        $options = []];
        foreach ($this->options as $key => $value) {
            if ($value !== Values::NONE) {
                $options[] = "$key=$value";
            }
        }
        return '[Twilio.Proxy.V1.UpdateShortCodeOptions ' . \implode(' ', $options) . ']';
    }
}