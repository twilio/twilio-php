<?php

/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Intelligence
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */


namespace Twilio\Rest\Intelligence\V2;

use Twilio\Exceptions\TwilioException;
use Twilio\InstanceResource;
use Twilio\Values;
use Twilio\Version;


/**
 * @property string|null $serviceSid
 * @property string[]|null $operatorSids
 * @property string|null $url
 */
class OperatorAttachmentsInstance extends InstanceResource
{
    /**
     * Initialize the OperatorAttachmentsInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $serviceSid The unique SID identifier of the Service.
     */
    public function __construct(Version $version, array $payload, ?string $serviceSid = null)
    {
        parent::__construct($version);

        // Marshaled Properties
        $this->properties = [
            'serviceSid' => Values::array_get($payload, 'service_sid'),
            'operatorSids' => Values::array_get($payload, 'operator_sids'),
            'url' => Values::array_get($payload, 'url'),
        ];

        $this->solution = ['serviceSid' => $serviceSid ?: $this->properties['serviceSid'], ];
    }

    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return OperatorAttachmentsContext Context for this OperatorAttachmentsInstance
     */
    protected function proxy(): OperatorAttachmentsContext
    {
        if (!$this->context) {
            $this->context = new OperatorAttachmentsContext(
                $this->version,
                $this->solution['serviceSid']
            );
        }

        return $this->context;
    }

    /**
     * Fetch the OperatorAttachmentsInstance
     *
     * @return OperatorAttachmentsInstance Fetched OperatorAttachmentsInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(): OperatorAttachmentsInstance
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
        return '[Twilio.Intelligence.V2.OperatorAttachmentsInstance ' . \implode(' ', $context) . ']';
    }
}

