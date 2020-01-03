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
abstract class LogOptions {
    /**
     * @param string $functionSid The SID of the function whose invocation produced
     *                            the Log resources to read
     * @param \DateTime $startDate The date and time after which the Log resources
     *                             must have been created.
     * @param \DateTime $endDate The date and time before which the Log resource
     *                           must have been created.
     * @return ReadLogOptions Options builder
     */
    public static function read($functionSid = Values::NONE, $startDate = Values::NONE, $endDate = Values::NONE): ReadLogOptions {
        return new ReadLogOptions($functionSid, $startDate, $endDate);
    }
}

class ReadLogOptions extends Options {
    /**
     * @param string $functionSid The SID of the function whose invocation produced
     *                            the Log resources to read
     * @param \DateTime $startDate The date and time after which the Log resources
     *                             must have been created.
     * @param \DateTime $endDate The date and time before which the Log resource
     *                           must have been created.
     */
    public function __construct($functionSid = Values::NONE, $startDate = Values::NONE, $endDate = Values::NONE) {
        $this->options['functionSid'] = $functionSid;
        $this->options['startDate'] = $startDate;
        $this->options['endDate'] = $endDate;
    }

    /**
     * The SID of the function whose invocation produced the Log resources to read.
     *
     * @param string $functionSid The SID of the function whose invocation produced
     *                            the Log resources to read
     * @return $this Fluent Builder
     */
    public function setFunctionSid($functionSid): self {
        $this->options['functionSid'] = $functionSid;
        return $this;
    }

    /**
     * The date/time (in GMT, ISO 8601) after which the Log resources must have been created. Defaults to 1 day prior to current date/time.
     *
     * @param \DateTime $startDate The date and time after which the Log resources
     *                             must have been created.
     * @return $this Fluent Builder
     */
    public function setStartDate($startDate): self {
        $this->options['startDate'] = $startDate;
        return $this;
    }

    /**
     * The date/time (in GMT, ISO 8601) before which the Log resources must have been created. Defaults to current date/time.
     *
     * @param \DateTime $endDate The date and time before which the Log resource
     *                           must have been created.
     * @return $this Fluent Builder
     */
    public function setEndDate($endDate): self {
        $this->options['endDate'] = $endDate;
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
        return '[Twilio.Serverless.V1.ReadLogOptions ' . \implode(' ', $options) . ']';
    }
}