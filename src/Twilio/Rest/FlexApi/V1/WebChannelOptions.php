<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\FlexApi\V1;

use Twilio\Options;
use Twilio\Values;

abstract class WebChannelOptions {
    /**
     * @param string $chatUniqueName The chat channel's unique name
     * @param string $preEngagementData The pre-engagement data
     * @return CreateWebChannelOptions Options builder
     */
    public static function create(string $chatUniqueName = Values::NONE, string $preEngagementData = Values::NONE): CreateWebChannelOptions {
        return new CreateWebChannelOptions($chatUniqueName, $preEngagementData);
    }

    /**
     * @param string $chatStatus The chat status
     * @param string $postEngagementData The post-engagement data
     * @return UpdateWebChannelOptions Options builder
     */
    public static function update(string $chatStatus = Values::NONE, string $postEngagementData = Values::NONE): UpdateWebChannelOptions {
        return new UpdateWebChannelOptions($chatStatus, $postEngagementData);
    }
}

class CreateWebChannelOptions extends Options {
    /**
     * @param string $chatUniqueName The chat channel's unique name
     * @param string $preEngagementData The pre-engagement data
     */
    public function __construct(string $chatUniqueName = Values::NONE, string $preEngagementData = Values::NONE) {
        $this->options['chatUniqueName'] = $chatUniqueName;
        $this->options['preEngagementData'] = $preEngagementData;
    }

    /**
     * The chat channel's unique name.
     *
     * @param string $chatUniqueName The chat channel's unique name
     * @return $this Fluent Builder
     */
    public function setChatUniqueName(string $chatUniqueName): self {
        $this->options['chatUniqueName'] = $chatUniqueName;
        return $this;
    }

    /**
     * The pre-engagement data.
     *
     * @param string $preEngagementData The pre-engagement data
     * @return $this Fluent Builder
     */
    public function setPreEngagementData(string $preEngagementData): self {
        $this->options['preEngagementData'] = $preEngagementData;
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
        return '[Twilio.FlexApi.V1.CreateWebChannelOptions ' . \implode(' ', $options) . ']';
    }
}

class UpdateWebChannelOptions extends Options {
    /**
     * @param string $chatStatus The chat status
     * @param string $postEngagementData The post-engagement data
     */
    public function __construct(string $chatStatus = Values::NONE, string $postEngagementData = Values::NONE) {
        $this->options['chatStatus'] = $chatStatus;
        $this->options['postEngagementData'] = $postEngagementData;
    }

    /**
     * The chat status. Can only be `inactive`.
     *
     * @param string $chatStatus The chat status
     * @return $this Fluent Builder
     */
    public function setChatStatus(string $chatStatus): self {
        $this->options['chatStatus'] = $chatStatus;
        return $this;
    }

    /**
     * The post-engagement data.
     *
     * @param string $postEngagementData The post-engagement data
     * @return $this Fluent Builder
     */
    public function setPostEngagementData(string $postEngagementData): self {
        $this->options['postEngagementData'] = $postEngagementData;
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
        return '[Twilio.FlexApi.V1.UpdateWebChannelOptions ' . \implode(' ', $options) . ']';
    }
}