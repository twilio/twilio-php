<?php

/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Proxy
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */


namespace Twilio\Rest\Proxy\V1\Service;

use Twilio\Exceptions\TwilioException;
use Twilio\InstanceResource;
use Twilio\Options;
use Twilio\Values;
use Twilio\Version;
use Twilio\Deserialize;
use Twilio\Rest\Proxy\V1\Service\Session\ParticipantList;
use Twilio\Rest\Proxy\V1\Service\Session\InteractionList;


/**
 * @property string|null $sid
 * @property string|null $serviceSid
 * @property string|null $accountSid
 * @property \DateTime|null $dateStarted
 * @property \DateTime|null $dateEnded
 * @property \DateTime|null $dateLastInteraction
 * @property \DateTime|null $dateExpiry
 * @property string|null $uniqueName
 * @property string $status
 * @property string|null $closedReason
 * @property int $ttl
 * @property string $mode
 * @property \DateTime|null $dateCreated
 * @property \DateTime|null $dateUpdated
 * @property string|null $url
 * @property array|null $links
 */
class SessionInstance extends InstanceResource
{
    protected $_participants;
    protected $_interactions;

    /**
     * Initialize the SessionInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $serviceSid The SID of the parent [Service](https://www.twilio.com/docs/proxy/api/service) resource.
     * @param string $sid The Twilio-provided string that uniquely identifies the Session resource to delete.
     */
    public function __construct(Version $version, array $payload, string $serviceSid, ?string $sid = null)
    {
        parent::__construct($version);

        // Marshaled Properties
        $this->properties = [
            'sid' => Values::array_get($payload, 'sid'),
            'serviceSid' => Values::array_get($payload, 'service_sid'),
            'accountSid' => Values::array_get($payload, 'account_sid'),
            'dateStarted' => Deserialize::dateTime(Values::array_get($payload, 'date_started')),
            'dateEnded' => Deserialize::dateTime(Values::array_get($payload, 'date_ended')),
            'dateLastInteraction' => Deserialize::dateTime(Values::array_get($payload, 'date_last_interaction')),
            'dateExpiry' => Deserialize::dateTime(Values::array_get($payload, 'date_expiry')),
            'uniqueName' => Values::array_get($payload, 'unique_name'),
            'status' => Values::array_get($payload, 'status'),
            'closedReason' => Values::array_get($payload, 'closed_reason'),
            'ttl' => Values::array_get($payload, 'ttl'),
            'mode' => Values::array_get($payload, 'mode'),
            'dateCreated' => Deserialize::dateTime(Values::array_get($payload, 'date_created')),
            'dateUpdated' => Deserialize::dateTime(Values::array_get($payload, 'date_updated')),
            'url' => Values::array_get($payload, 'url'),
            'links' => Values::array_get($payload, 'links'),
        ];

        $this->solution = ['serviceSid' => $serviceSid, 'sid' => $sid ?: $this->properties['sid'], ];
    }

    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return SessionContext Context for this SessionInstance
     */
    protected function proxy(): SessionContext
    {
        if (!$this->context) {
            $this->context = new SessionContext(
                $this->version,
                $this->solution['serviceSid'],
                $this->solution['sid']
            );
        }

        return $this->context;
    }

    /**
     * Delete the SessionInstance
     *
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete(): bool
    {

        return $this->proxy()->delete();
    }

    /**
     * Fetch the SessionInstance
     *
     * @return SessionInstance Fetched SessionInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(): SessionInstance
    {

        return $this->proxy()->fetch();
    }

    /**
     * Update the SessionInstance
     *
     * @param array|Options $options Optional Arguments
     * @return SessionInstance Updated SessionInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(array $options = []): SessionInstance
    {

        return $this->proxy()->update($options);
    }

    /**
     * Access the participants
     */
    protected function getParticipants(): ParticipantList
    {
        return $this->proxy()->participants;
    }

    /**
     * Access the interactions
     */
    protected function getInteractions(): InteractionList
    {
        return $this->proxy()->interactions;
    }

    /**
     * Magic getter to access properties
     *
     * @param string $name Property to access
     * @return mixed The requested property
     * @throws TwilioException For unknown properties
     */
    public function __get(string $name)
    {
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
    public function __toString(): string
    {
        $context = [];
        foreach ($this->solution as $key => $value) {
            $context[] = "$key=$value";
        }
        return '[Twilio.Proxy.V1.SessionInstance ' . \implode(' ', $context) . ']';
    }
}

