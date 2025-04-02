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


namespace Twilio\Rest\Bulkexports\V1;

use Twilio\Exceptions\TwilioException;
use Twilio\InstanceResource;
use Twilio\Options;
use Twilio\Values;
use Twilio\Version;


/**
 * @property bool|null $enabled
 * @property string|null $webhookUrl
 * @property string|null $webhookMethod
 * @property string|null $resourceType
 * @property string|null $url
 */
class ExportConfigurationInstance extends InstanceResource
{
    /**
     * Initialize the ExportConfigurationInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $resourceType The type of communication – Messages, Calls, Conferences, and Participants
     */
    public function __construct(Version $version, array $payload, ?string $resourceType = null)
    {
        parent::__construct($version);

        // Marshaled Properties
        $this->properties = [
            'enabled' => Values::array_get($payload, 'enabled'),
            'webhookUrl' => Values::array_get($payload, 'webhook_url'),
            'webhookMethod' => Values::array_get($payload, 'webhook_method'),
            'resourceType' => Values::array_get($payload, 'resource_type'),
            'url' => Values::array_get($payload, 'url'),
        ];

        $this->solution = ['resourceType' => $resourceType ?: $this->properties['resourceType'], ];
    }

    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return ExportConfigurationContext Context for this ExportConfigurationInstance
     */
    protected function proxy(): ExportConfigurationContext
    {
        if (!$this->context) {
            $this->context = new ExportConfigurationContext(
                $this->version,
                $this->solution['resourceType']
            );
        }

        return $this->context;
    }

    /**
     * Fetch the ExportConfigurationInstance
     *
     * @return ExportConfigurationInstance Fetched ExportConfigurationInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(): ExportConfigurationInstance
    {

        return $this->proxy()->fetch();
    }

    /**
     * Update the ExportConfigurationInstance
     *
     * @param array|Options $options Optional Arguments
     * @return ExportConfigurationInstance Updated ExportConfigurationInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(array $options = []): ExportConfigurationInstance
    {

        return $this->proxy()->update($options);
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
        return '[Twilio.Bulkexports.V1.ExportConfigurationInstance ' . \implode(' ', $context) . ']';
    }
}

