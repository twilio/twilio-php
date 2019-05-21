<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Messaging\V1;

use Twilio\Exceptions\TwilioException;
use Twilio\InstanceContext;
use Twilio\Options;
use Twilio\Rest\Messaging\V1\Session\MessageList;
use Twilio\Rest\Messaging\V1\Session\ParticipantList;
use Twilio\Rest\Messaging\V1\Session\WebhookList;
use Twilio\Serialize;
use Twilio\Values;
use Twilio\Version;

/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 *
 * @property \Twilio\Rest\Messaging\V1\Session\ParticipantList participants
 * @property \Twilio\Rest\Messaging\V1\Session\MessageList messages
 * @property \Twilio\Rest\Messaging\V1\Session\WebhookList webhooks
 * @method \Twilio\Rest\Messaging\V1\Session\ParticipantContext participants(string $sid)
 * @method \Twilio\Rest\Messaging\V1\Session\MessageContext messages(string $sid)
 * @method \Twilio\Rest\Messaging\V1\Session\WebhookContext webhooks(string $sid)
 */
class SessionContext extends InstanceContext {
    protected $_participants = null;
    protected $_messages = null;
    protected $_webhooks = null;

    /**
     * Initialize the SessionContext
     *
     * @param \Twilio\Version $version Version that contains the resource
     * @param string $sid A 34 character string that uniquely identifies this
     *                    resource.
     * @return \Twilio\Rest\Messaging\V1\SessionContext
     */
    public function __construct(Version $version, $sid) {
        parent::__construct($version);

        // Path Solution
        $this->solution = array('sid' => $sid, );

        $this->uri = '/Sessions/' . rawurlencode($sid) . '';
    }

    /**
     * Fetch a SessionInstance
     *
     * @return SessionInstance Fetched SessionInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() {
        $params = Values::of(array());

        $payload = $this->version->fetch(
            'GET',
            $this->uri,
            $params
        );

        return new SessionInstance($this->version, $payload, $this->solution['sid']);
    }

    /**
     * Deletes the SessionInstance
     *
     * @return boolean True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete() {
        return $this->version->delete('delete', $this->uri);
    }

    /**
     * Update the SessionInstance
     *
     * @param array|Options $options Optional Arguments
     * @return SessionInstance Updated SessionInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update($options = array()) {
        $options = new Values($options);

        $data = Values::of(array(
            'FriendlyName' => $options['friendlyName'],
            'Attributes' => $options['attributes'],
            'DateCreated' => Serialize::iso8601DateTime($options['dateCreated']),
            'DateUpdated' => Serialize::iso8601DateTime($options['dateUpdated']),
            'CreatedBy' => $options['createdBy'],
        ));

        $payload = $this->version->update(
            'POST',
            $this->uri,
            array(),
            $data
        );

        return new SessionInstance($this->version, $payload, $this->solution['sid']);
    }

    /**
     * Access the participants
     *
     * @return \Twilio\Rest\Messaging\V1\Session\ParticipantList
     */
    protected function getParticipants() {
        if (!$this->_participants) {
            $this->_participants = new ParticipantList($this->version, $this->solution['sid']);
        }

        return $this->_participants;
    }

    /**
     * Access the messages
     *
     * @return \Twilio\Rest\Messaging\V1\Session\MessageList
     */
    protected function getMessages() {
        if (!$this->_messages) {
            $this->_messages = new MessageList($this->version, $this->solution['sid']);
        }

        return $this->_messages;
    }

    /**
     * Access the webhooks
     *
     * @return \Twilio\Rest\Messaging\V1\Session\WebhookList
     */
    protected function getWebhooks() {
        if (!$this->_webhooks) {
            $this->_webhooks = new WebhookList($this->version, $this->solution['sid']);
        }

        return $this->_webhooks;
    }

    /**
     * Magic getter to lazy load subresources
     *
     * @param string $name Subresource to return
     * @return \Twilio\ListResource The requested subresource
     * @throws \Twilio\Exceptions\TwilioException For unknown subresources
     */
    public function __get($name) {
        if (property_exists($this, '_' . $name)) {
            $method = 'get' . ucfirst($name);
            return $this->$method();
        }

        throw new TwilioException('Unknown subresource ' . $name);
    }

    /**
     * Magic caller to get resource contexts
     *
     * @param string $name Resource to return
     * @param array $arguments Context parameters
     * @return \Twilio\InstanceContext The requested resource context
     * @throws \Twilio\Exceptions\TwilioException For unknown resource
     */
    public function __call($name, $arguments) {
        $property = $this->$name;
        if (method_exists($property, 'getContext')) {
            return call_user_func_array(array($property, 'getContext'), $arguments);
        }

        throw new TwilioException('Resource does not have a context');
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
        return '[Twilio.Messaging.V1.SessionContext ' . implode(' ', $context) . ']';
    }
}