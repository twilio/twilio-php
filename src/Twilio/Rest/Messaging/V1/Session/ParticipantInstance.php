<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Messaging\V1\Session;

use Twilio\Deserialize;
use Twilio\Exceptions\TwilioException;
use Twilio\InstanceResource;
use Twilio\Options;
use Twilio\Values;
use Twilio\Version;

/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 *
 * @property string $accountSid
 * @property string $serviceSid
 * @property string $messagingServiceSid
 * @property string $sessionSid
 * @property string $sid
 * @property string $identity
 * @property string $twilioAddress
 * @property string $userAddress
 * @property string $attributes
 * @property string $type
 * @property \DateTime $dateCreated
 * @property \DateTime $dateUpdated
 * @property string $url
 */
class ParticipantInstance extends InstanceResource {
    /**
     * Initialize the ParticipantInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $sessionSid The SID of the Session for the participant
     * @param string $sid The SID that identifies the resource to fetch
     */
    public function __construct(Version $version, array $payload, $sessionSid, $sid = null) {
        parent::__construct($version);

        // Marshaled Properties
        $this->properties = [
            'accountSid' => Values::array_get($payload, 'account_sid'),
            'serviceSid' => Values::array_get($payload, 'service_sid'),
            'messagingServiceSid' => Values::array_get($payload, 'messaging_service_sid'),
            'sessionSid' => Values::array_get($payload, 'session_sid'),
            'sid' => Values::array_get($payload, 'sid'),
            'identity' => Values::array_get($payload, 'identity'),
            'twilioAddress' => Values::array_get($payload, 'twilio_address'),
            'userAddress' => Values::array_get($payload, 'user_address'),
            'attributes' => Values::array_get($payload, 'attributes'),
            'type' => Values::array_get($payload, 'type'),
            'dateCreated' => Deserialize::dateTime(Values::array_get($payload, 'date_created')),
            'dateUpdated' => Deserialize::dateTime(Values::array_get($payload, 'date_updated')),
            'url' => Values::array_get($payload, 'url'),
        ];

        $this->solution = ['sessionSid' => $sessionSid, 'sid' => $sid ?: $this->properties['sid'], ];
    }

    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return ParticipantContext Context for this ParticipantInstance
     */
    protected function proxy(): ParticipantContext {
        if (!$this->context) {
            $this->context = new ParticipantContext(
                $this->version,
                $this->solution['sessionSid'],
                $this->solution['sid']
            );
        }

        return $this->context;
    }

    /**
     * Update the ParticipantInstance
     *
     * @param array|Options $options Optional Arguments
     * @return ParticipantInstance Updated ParticipantInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update($options = []): ParticipantInstance {
        return $this->proxy()->update($options);
    }

    /**
     * Fetch a ParticipantInstance
     *
     * @return ParticipantInstance Fetched ParticipantInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(): ParticipantInstance {
        return $this->proxy()->fetch();
    }

    /**
     * Deletes the ParticipantInstance
     *
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete(): bool {
        return $this->proxy()->delete();
    }

    /**
     * Magic getter to access properties
     *
     * @param string $name Property to access
     * @return mixed The requested property
     * @throws TwilioException For unknown properties
     */
    public function __get($name) {
        if (\array_key_exists($name, $this->properties)) {
            return $this->properties[$name];
        }

        if (\property_exists($this, '_' . $name)) {
            $method = 'get' . \ucfirst($name);
            return $this->$method();
        }

        throw new TwilioException('Unknown property: ' . $name);
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
        return '[Twilio.Messaging.V1.ParticipantInstance ' . \implode(' ', $context) . ']';
    }
}