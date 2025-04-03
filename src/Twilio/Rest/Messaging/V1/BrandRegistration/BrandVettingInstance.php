<?php

/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Messaging
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */


namespace Twilio\Rest\Messaging\V1\BrandRegistration;

use Twilio\Exceptions\TwilioException;
use Twilio\InstanceResource;
use Twilio\Values;
use Twilio\Version;
use Twilio\Deserialize;


/**
 * @property string|null $accountSid
 * @property string|null $brandSid
 * @property string|null $brandVettingSid
 * @property \DateTime|null $dateUpdated
 * @property \DateTime|null $dateCreated
 * @property string|null $vettingId
 * @property string|null $vettingClass
 * @property string|null $vettingStatus
 * @property string $vettingProvider
 * @property string|null $url
 */
class BrandVettingInstance extends InstanceResource
{
    /**
     * Initialize the BrandVettingInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $brandSid The SID of the Brand Registration resource of the vettings to create .
     * @param string $brandVettingSid The Twilio SID of the third-party vetting record.
     */
    public function __construct(Version $version, array $payload, string $brandSid, ?string $brandVettingSid = null)
    {
        parent::__construct($version);

        // Marshaled Properties
        $this->properties = [
            'accountSid' => Values::array_get($payload, 'account_sid'),
            'brandSid' => Values::array_get($payload, 'brand_sid'),
            'brandVettingSid' => Values::array_get($payload, 'brand_vetting_sid'),
            'dateUpdated' => Deserialize::dateTime(Values::array_get($payload, 'date_updated')),
            'dateCreated' => Deserialize::dateTime(Values::array_get($payload, 'date_created')),
            'vettingId' => Values::array_get($payload, 'vetting_id'),
            'vettingClass' => Values::array_get($payload, 'vetting_class'),
            'vettingStatus' => Values::array_get($payload, 'vetting_status'),
            'vettingProvider' => Values::array_get($payload, 'vetting_provider'),
            'url' => Values::array_get($payload, 'url'),
        ];

        $this->solution = ['brandSid' => $brandSid, 'brandVettingSid' => $brandVettingSid ?: $this->properties['brandVettingSid'], ];
    }

    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return BrandVettingContext Context for this BrandVettingInstance
     */
    protected function proxy(): BrandVettingContext
    {
        if (!$this->context) {
            $this->context = new BrandVettingContext(
                $this->version,
                $this->solution['brandSid'],
                $this->solution['brandVettingSid']
            );
        }

        return $this->context;
    }

    /**
     * Fetch the BrandVettingInstance
     *
     * @return BrandVettingInstance Fetched BrandVettingInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(): BrandVettingInstance
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
        return '[Twilio.Messaging.V1.BrandVettingInstance ' . \implode(' ', $context) . ']';
    }
}

