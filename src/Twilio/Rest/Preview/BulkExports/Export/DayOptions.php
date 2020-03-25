<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Preview\BulkExports\Export;

use Twilio\Options;
use Twilio\Values;

/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 */
abstract class DayOptions {
    /**
     * @param string $nextToken The next_token
     * @param string $previousToken The previous_token
     * @return ReadDayOptions Options builder
     */
    public static function read(string $nextToken = Values::NONE, string $previousToken = Values::NONE): ReadDayOptions {
        return new ReadDayOptions($nextToken, $previousToken);
    }
}

class ReadDayOptions extends Options {
    /**
     * @param string $nextToken The next_token
     * @param string $previousToken The previous_token
     */
    public function __construct(string $nextToken = Values::NONE, string $previousToken = Values::NONE) {
        $this->options['nextToken'] = $nextToken;
        $this->options['previousToken'] = $previousToken;
    }

    /**
     * The next_token
     *
     * @param string $nextToken The next_token
     * @return $this Fluent Builder
     */
    public function setNextToken(string $nextToken): self {
        $this->options['nextToken'] = $nextToken;
        return $this;
    }

    /**
     * The previous_token
     *
     * @param string $previousToken The previous_token
     * @return $this Fluent Builder
     */
    public function setPreviousToken(string $previousToken): self {
        $this->options['previousToken'] = $previousToken;
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
        return '[Twilio.Preview.BulkExports.ReadDayOptions ' . \implode(' ', $options) . ']';
    }
}