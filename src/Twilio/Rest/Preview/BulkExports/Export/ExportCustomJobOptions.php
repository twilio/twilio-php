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
abstract class ExportCustomJobOptions {
    /**
     * @param string $nextToken The token for the next page of job results
     * @param string $previousToken The token for the previous page of result
     * @return ReadExportCustomJobOptions Options builder
     */
    public static function read(string $nextToken = Values::NONE, string $previousToken = Values::NONE): ReadExportCustomJobOptions {
        return new ReadExportCustomJobOptions($nextToken, $previousToken);
    }

    /**
     * @param string $friendlyName The friendly_name
     * @param string $startDay The start_day
     * @param string $endDay The end_day
     * @param string $webhookUrl The webhook_url
     * @param string $webhookMethod The webhook_method
     * @param string $email The email
     * @return CreateExportCustomJobOptions Options builder
     */
    public static function create(string $friendlyName = Values::NONE, string $startDay = Values::NONE, string $endDay = Values::NONE, string $webhookUrl = Values::NONE, string $webhookMethod = Values::NONE, string $email = Values::NONE): CreateExportCustomJobOptions {
        return new CreateExportCustomJobOptions($friendlyName, $startDay, $endDay, $webhookUrl, $webhookMethod, $email);
    }
}

class ReadExportCustomJobOptions extends Options {
    /**
     * @param string $nextToken The token for the next page of job results
     * @param string $previousToken The token for the previous page of result
     */
    public function __construct(string $nextToken = Values::NONE, string $previousToken = Values::NONE) {
        $this->options['nextToken'] = $nextToken;
        $this->options['previousToken'] = $previousToken;
    }

    /**
     * The token for the next page of job results, and may be null if there are no more pages
     *
     * @param string $nextToken The token for the next page of job results
     * @return $this Fluent Builder
     */
    public function setNextToken(string $nextToken): self {
        $this->options['nextToken'] = $nextToken;
        return $this;
    }

    /**
     * The token for the previous page of results, and may be null if this is the first page
     *
     * @param string $previousToken The token for the previous page of result
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
        return '[Twilio.Preview.BulkExports.ReadExportCustomJobOptions ' . \implode(' ', $options) . ']';
    }
}

class CreateExportCustomJobOptions extends Options {
    /**
     * @param string $friendlyName The friendly_name
     * @param string $startDay The start_day
     * @param string $endDay The end_day
     * @param string $webhookUrl The webhook_url
     * @param string $webhookMethod The webhook_method
     * @param string $email The email
     */
    public function __construct(string $friendlyName = Values::NONE, string $startDay = Values::NONE, string $endDay = Values::NONE, string $webhookUrl = Values::NONE, string $webhookMethod = Values::NONE, string $email = Values::NONE) {
        $this->options['friendlyName'] = $friendlyName;
        $this->options['startDay'] = $startDay;
        $this->options['endDay'] = $endDay;
        $this->options['webhookUrl'] = $webhookUrl;
        $this->options['webhookMethod'] = $webhookMethod;
        $this->options['email'] = $email;
    }

    /**
     * The friendly_name
     *
     * @param string $friendlyName The friendly_name
     * @return $this Fluent Builder
     */
    public function setFriendlyName(string $friendlyName): self {
        $this->options['friendlyName'] = $friendlyName;
        return $this;
    }

    /**
     * The start_day
     *
     * @param string $startDay The start_day
     * @return $this Fluent Builder
     */
    public function setStartDay(string $startDay): self {
        $this->options['startDay'] = $startDay;
        return $this;
    }

    /**
     * The end_day
     *
     * @param string $endDay The end_day
     * @return $this Fluent Builder
     */
    public function setEndDay(string $endDay): self {
        $this->options['endDay'] = $endDay;
        return $this;
    }

    /**
     * The webhook_url
     *
     * @param string $webhookUrl The webhook_url
     * @return $this Fluent Builder
     */
    public function setWebhookUrl(string $webhookUrl): self {
        $this->options['webhookUrl'] = $webhookUrl;
        return $this;
    }

    /**
     * The webhook_method
     *
     * @param string $webhookMethod The webhook_method
     * @return $this Fluent Builder
     */
    public function setWebhookMethod(string $webhookMethod): self {
        $this->options['webhookMethod'] = $webhookMethod;
        return $this;
    }

    /**
     * The email
     *
     * @param string $email The email
     * @return $this Fluent Builder
     */
    public function setEmail(string $email): self {
        $this->options['email'] = $email;
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
        return '[Twilio.Preview.BulkExports.CreateExportCustomJobOptions ' . \implode(' ', $options) . ']';
    }
}