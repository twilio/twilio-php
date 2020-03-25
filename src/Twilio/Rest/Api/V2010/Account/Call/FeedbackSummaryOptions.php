<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Api\V2010\Account\Call;

use Twilio\Options;
use Twilio\Values;

abstract class FeedbackSummaryOptions {
    /**
     * @param bool $includeSubaccounts `true` includes feedback from the specified
     *                                 account and its subaccounts
     * @param string $statusCallback The URL that we will request when the feedback
     *                               summary is complete
     * @param string $statusCallbackMethod The HTTP method we use to make requests
     *                                     to the StatusCallback URL
     * @return CreateFeedbackSummaryOptions Options builder
     */
    public static function create(bool $includeSubaccounts = Values::NONE, string $statusCallback = Values::NONE, string $statusCallbackMethod = Values::NONE): CreateFeedbackSummaryOptions {
        return new CreateFeedbackSummaryOptions($includeSubaccounts, $statusCallback, $statusCallbackMethod);
    }
}

class CreateFeedbackSummaryOptions extends Options {
    /**
     * @param bool $includeSubaccounts `true` includes feedback from the specified
     *                                 account and its subaccounts
     * @param string $statusCallback The URL that we will request when the feedback
     *                               summary is complete
     * @param string $statusCallbackMethod The HTTP method we use to make requests
     *                                     to the StatusCallback URL
     */
    public function __construct(bool $includeSubaccounts = Values::NONE, string $statusCallback = Values::NONE, string $statusCallbackMethod = Values::NONE) {
        $this->options['includeSubaccounts'] = $includeSubaccounts;
        $this->options['statusCallback'] = $statusCallback;
        $this->options['statusCallbackMethod'] = $statusCallbackMethod;
    }

    /**
     * Whether to also include Feedback resources from all subaccounts. `true` includes feedback from all subaccounts and `false`, the default, includes feedback from only the specified account.
     *
     * @param bool $includeSubaccounts `true` includes feedback from the specified
     *                                 account and its subaccounts
     * @return $this Fluent Builder
     */
    public function setIncludeSubaccounts(bool $includeSubaccounts): self {
        $this->options['includeSubaccounts'] = $includeSubaccounts;
        return $this;
    }

    /**
     * The URL that we will request when the feedback summary is complete.
     *
     * @param string $statusCallback The URL that we will request when the feedback
     *                               summary is complete
     * @return $this Fluent Builder
     */
    public function setStatusCallback(string $statusCallback): self {
        $this->options['statusCallback'] = $statusCallback;
        return $this;
    }

    /**
     * The HTTP method (`GET` or `POST`) we use to make the request to the `StatusCallback` URL.
     *
     * @param string $statusCallbackMethod The HTTP method we use to make requests
     *                                     to the StatusCallback URL
     * @return $this Fluent Builder
     */
    public function setStatusCallbackMethod(string $statusCallbackMethod): self {
        $this->options['statusCallbackMethod'] = $statusCallbackMethod;
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
        return '[Twilio.Api.V2010.CreateFeedbackSummaryOptions ' . \implode(' ', $options) . ']';
    }
}