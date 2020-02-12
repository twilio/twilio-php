<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Studio\V1\Flow\Engagement\Step;

use Twilio\ListResource;
use Twilio\Version;

class StepContextList extends ListResource {
    /**
     * Construct the StepContextList
     *
     * @param Version $version Version that contains the resource
     * @param string $flowSid The SID of the Flow
     * @param string $engagementSid The SID of the Engagement
     * @param string $stepSid Step SID
     */
    public function __construct(Version $version, $flowSid, $engagementSid, $stepSid) {
        parent::__construct($version);

        // Path Solution
        $this->solution = ['flowSid' => $flowSid, 'engagementSid' => $engagementSid, 'stepSid' => $stepSid, ];
    }

    /**
     * Constructs a StepContextContext
     */
    public function getContext(): StepContextContext {
        return new StepContextContext(
            $this->version,
            $this->solution['flowSid'],
            $this->solution['engagementSid'],
            $this->solution['stepSid']
        );
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        return '[Twilio.Studio.V1.StepContextList]';
    }
}