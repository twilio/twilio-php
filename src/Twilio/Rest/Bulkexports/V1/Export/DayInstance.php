<?php

/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Bulkexports
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */


namespace Twilio\Rest\Bulkexports\V1\Export;

use Twilio\Exceptions\TwilioException;
use Twilio\InstanceResource;
use Twilio\Values;
use Twilio\Version;


/**
 * @property string|null $redirectTo
 * @property string|null $day
 * @property int $size
 * @property string|null $createDate
 * @property string|null $friendlyName
 * @property string|null $resourceType
 */
class DayInstance extends InstanceResource
{
    /**
     * Initialize the DayInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $resourceType The type of communication – Messages, Calls, Conferences, and Participants
     * @param string $day The ISO 8601 format date of the resources in the file, for a UTC day
     */
    public function __construct(Version $version, array $payload, string $resourceType, ?string $day = null)
    {
        parent::__construct($version);

        // Marshaled Properties
        $this->properties = [
            'redirectTo' => Values::array_get($payload, 'redirect_to'),
            'day' => Values::array_get($payload, 'day'),
            'size' => Values::array_get($payload, 'size'),
            'createDate' => Values::array_get($payload, 'create_date'),
            'friendlyName' => Values::array_get($payload, 'friendly_name'),
            'resourceType' => Values::array_get($payload, 'resource_type'),
        ];

        $this->solution = ['resourceType' => $resourceType, 'day' => $day ?: $this->properties['day'], ];
    }

    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return DayContext Context for this DayInstance
     */
    protected function proxy(): DayContext
    {
        if (!$this->context) {
            $this->context = new DayContext(
                $this->version,
                $this->solution['resourceType'],
                $this->solution['day']
            );
        }

        return $this->context;
    }

    /**
     * Fetch the DayInstance
     *
     * @return DayInstance Fetched DayInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(): DayInstance
    {

        return $this->proxy()->fetch();
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
        return '[Twilio.Bulkexports.V1.DayInstance ' . \implode(' ', $context) . ']';
    }
}

