<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Studio\V1\Flow\Engagement;

use Twilio\Exceptions\TwilioException;
use Twilio\InstanceContext;
use Twilio\ListResource;
use Twilio\Rest\Studio\V1\Flow\Engagement\Step\StepContextList;
use Twilio\Values;
use Twilio\Version;

/**
 * @property StepContextList $stepContext
 * @method \Twilio\Rest\Studio\V1\Flow\Engagement\Step\StepContextContext stepContext()
 */
class StepContext extends InstanceContext {
    protected $_stepContext;

    /**
     * Initialize the StepContext
     *
     * @param Version $version Version that contains the resource
     * @param string $flowSid The SID of the Flow
     * @param string $engagementSid The SID of the Engagement
     * @param string $sid The SID that identifies the resource to fetch
     */
    public function __construct(Version $version, $flowSid, $engagementSid, $sid) {
        parent::__construct($version);

        // Path Solution
        $this->solution = ['flowSid' => $flowSid, 'engagementSid' => $engagementSid, 'sid' => $sid, ];

        $this->uri = '/Flows/' . \rawurlencode($flowSid) . '/Engagements/' . \rawurlencode($engagementSid) . '/Steps/' . \rawurlencode($sid) . '';
    }

    /**
     * Fetch a StepInstance
     *
     * @return StepInstance Fetched StepInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(): StepInstance {
        $params = Values::of([]);

        $payload = $this->version->fetch(
            'GET',
            $this->uri,
            $params
        );

        return new StepInstance(
            $this->version,
            $payload,
            $this->solution['flowSid'],
            $this->solution['engagementSid'],
            $this->solution['sid']
        );
    }

    /**
     * Access the stepContext
     */
    protected function getStepContext(): StepContextList {
        if (!$this->_stepContext) {
            $this->_stepContext = new StepContextList(
                $this->version,
                $this->solution['flowSid'],
                $this->solution['engagementSid'],
                $this->solution['sid']
            );
        }

        return $this->_stepContext;
    }

    /**
     * Magic getter to lazy load subresources
     *
     * @param string $name Subresource to return
     * @return ListResource The requested subresource
     * @throws TwilioException For unknown subresources
     */
    public function __get($name): ListResource {
        if (\property_exists($this, '_' . $name)) {
            $method = 'get' . \ucfirst($name);
            return $this->$method();
        }

        throw new TwilioException('Unknown subresource ' . $name);
    }

    /**
     * Magic caller to get resource contexts
     *
     * @param string $name Resource to return
     * @param array $arguments Context parameters
     * @return InstanceContext The requested resource context
     * @throws TwilioException For unknown resource
     */
    public function __call($name, $arguments): InstanceContext {
        $property = $this->$name;
        if (\method_exists($property, 'getContext')) {
            return \call_user_func_array([$property, 'getContext'], $arguments);
        }

        throw new TwilioException('Resource does not have a context');
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        $context = [];
        foreach ($this->solution as $key => $value) {
            $context[] = "$key=$value";
        }
        return '[Twilio.Studio.V1.StepContext ' . \implode(' ', $context) . ']';
    }
}