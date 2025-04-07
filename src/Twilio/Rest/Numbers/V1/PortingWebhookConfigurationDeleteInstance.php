<?php

/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Numbers
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */


namespace Twilio\Rest\Numbers\V1;

use Twilio\Exceptions\TwilioException;
use Twilio\InstanceResource;
use Twilio\Version;


class PortingWebhookConfigurationDeleteInstance extends InstanceResource
{
    /**
     * Initialize the PortingWebhookConfigurationDeleteInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $webhookType The webhook type for the configuration to be delete. `PORT_IN`, `PORT_OUT`
     */
    public function __construct(Version $version, array $payload, ?string $webhookType = null)
    {
        parent::__construct($version);

        $this->solution = ['webhookType' => $webhookType ?: $this->properties['webhookType'], ];
    }

    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return PortingWebhookConfigurationDeleteContext Context for this PortingWebhookConfigurationDeleteInstance
     */
    protected function proxy(): PortingWebhookConfigurationDeleteContext
    {
        if (!$this->context) {
            $this->context = new PortingWebhookConfigurationDeleteContext(
                $this->version,
                $this->solution['webhookType']
            );
        }

        return $this->context;
    }

    /**
     * Delete the PortingWebhookConfigurationDeleteInstance
     *
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete(): bool
    {

        return $this->proxy()->delete();
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
        return '[Twilio.Numbers.V1.PortingWebhookConfigurationDeleteInstance ' . \implode(' ', $context) . ']';
    }
}

