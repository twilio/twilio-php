<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Preview\TrustedComms;

use Twilio\Deserialize;
use Twilio\Exceptions\TwilioException;
use Twilio\InstanceResource;
use Twilio\Options;
use Twilio\Values;
use Twilio\Version;

/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 *
 * @property string sid
 * @property string from
 * @property string to
 * @property string reason
 * @property \DateTime createdAt
 * @property string url
 */
class CurrentCallInstance extends InstanceResource {
    /**
     * Initialize the CurrentCallInstance
     *
     * @param \Twilio\Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @return \Twilio\Rest\Preview\TrustedComms\CurrentCallInstance
     */
    public function __construct(Version $version, array $payload) {
        parent::__construct($version);

        // Marshaled Properties
        $this->properties = array(
            'sid' => Values::array_get($payload, 'sid'),
            'from' => Values::array_get($payload, 'from'),
            'to' => Values::array_get($payload, 'to'),
            'reason' => Values::array_get($payload, 'reason'),
            'createdAt' => Deserialize::dateTime(Values::array_get($payload, 'created_at')),
            'url' => Values::array_get($payload, 'url'),
        );

        $this->solution = array();
    }

    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return \Twilio\Rest\Preview\TrustedComms\CurrentCallContext Context for
     *                                                              this
     *                                                              CurrentCallInstance
     */
    protected function proxy() {
        if (!$this->context) {
            $this->context = new CurrentCallContext($this->version);
        }

        return $this->context;
    }

    /**
     * Fetch a CurrentCallInstance
     *
     * @param array|Options $options Optional Arguments
     * @return CurrentCallInstance Fetched CurrentCallInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch($options = array()) {
        return $this->proxy()->fetch($options);
    }

    /**
     * Magic getter to access properties
     *
     * @param string $name Property to access
     * @return mixed The requested property
     * @throws TwilioException For unknown properties
     */
    public function __get($name) {
        if (array_key_exists($name, $this->properties)) {
            return $this->properties[$name];
        }

        if (property_exists($this, '_' . $name)) {
            $method = 'get' . ucfirst($name);
            return $this->$method();
        }

        throw new TwilioException('Unknown property: ' . $name);
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString() {
        $context = array();
        foreach ($this->solution as $key => $value) {
            $context[] = "$key=$value";
        }
        return '[Twilio.Preview.TrustedComms.CurrentCallInstance ' . implode(' ', $context) . ']';
    }
}