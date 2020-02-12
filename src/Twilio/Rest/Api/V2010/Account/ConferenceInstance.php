<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Api\V2010\Account;

use Twilio\Deserialize;
use Twilio\Exceptions\TwilioException;
use Twilio\InstanceResource;
use Twilio\Options;
use Twilio\Rest\Api\V2010\Account\Conference\ParticipantList;
use Twilio\Rest\Api\V2010\Account\Conference\RecordingList;
use Twilio\Values;
use Twilio\Version;

/**
 * @property string $accountSid
 * @property \DateTime $dateCreated
 * @property \DateTime $dateUpdated
 * @property string $apiVersion
 * @property string $friendlyName
 * @property string $region
 * @property string $sid
 * @property string $status
 * @property string $uri
 * @property array $subresourceUris
 */
class ConferenceInstance extends InstanceResource {
    protected $_participants;
    protected $_recordings;

    /**
     * Initialize the ConferenceInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $accountSid The SID of the Account that created this resource
     * @param string $sid The unique string that identifies this resource
     */
    public function __construct(Version $version, array $payload, $accountSid, $sid = null) {
        parent::__construct($version);

        // Marshaled Properties
        $this->properties = [
            'accountSid' => Values::array_get($payload, 'account_sid'),
            'dateCreated' => Deserialize::dateTime(Values::array_get($payload, 'date_created')),
            'dateUpdated' => Deserialize::dateTime(Values::array_get($payload, 'date_updated')),
            'apiVersion' => Values::array_get($payload, 'api_version'),
            'friendlyName' => Values::array_get($payload, 'friendly_name'),
            'region' => Values::array_get($payload, 'region'),
            'sid' => Values::array_get($payload, 'sid'),
            'status' => Values::array_get($payload, 'status'),
            'uri' => Values::array_get($payload, 'uri'),
            'subresourceUris' => Values::array_get($payload, 'subresource_uris'),
        ];

        $this->solution = ['accountSid' => $accountSid, 'sid' => $sid ?: $this->properties['sid'], ];
    }

    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return ConferenceContext Context for this ConferenceInstance
     */
    protected function proxy(): ConferenceContext {
        if (!$this->context) {
            $this->context = new ConferenceContext(
                $this->version,
                $this->solution['accountSid'],
                $this->solution['sid']
            );
        }

        return $this->context;
    }

    /**
     * Fetch a ConferenceInstance
     *
     * @return ConferenceInstance Fetched ConferenceInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(): ConferenceInstance {
        return $this->proxy()->fetch();
    }

    /**
     * Update the ConferenceInstance
     *
     * @param array|Options $options Optional Arguments
     * @return ConferenceInstance Updated ConferenceInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update($options = []): ConferenceInstance {
        return $this->proxy()->update($options);
    }

    /**
     * Access the participants
     */
    protected function getParticipants(): ParticipantList {
        return $this->proxy()->participants;
    }

    /**
     * Access the recordings
     */
    protected function getRecordings(): RecordingList {
        return $this->proxy()->recordings;
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
        return '[Twilio.Api.V2010.ConferenceInstance ' . \implode(' ', $context) . ']';
    }
}