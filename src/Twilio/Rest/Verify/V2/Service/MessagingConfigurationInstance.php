<?php

/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Verify
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */


namespace Twilio\Rest\Verify\V2\Service;

use Twilio\Exceptions\TwilioException;
use Twilio\InstanceResource;
use Twilio\Values;
use Twilio\Version;
use Twilio\Deserialize;


/**
 * @property string|null $accountSid
 * @property string|null $serviceSid
 * @property string|null $country
 * @property string|null $messagingServiceSid
 * @property \DateTime|null $dateCreated
 * @property \DateTime|null $dateUpdated
 * @property string|null $url
 */
class MessagingConfigurationInstance extends InstanceResource
{
    /**
     * Initialize the MessagingConfigurationInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $serviceSid The SID of the [Service](https://www.twilio.com/docs/verify/api/service) that the resource is associated with.
     * @param string $country The [ISO-3166-1](https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2) country code of the country this configuration will be applied to. If this is a global configuration, Country will take the value `all`.
     */
    public function __construct(Version $version, array $payload, string $serviceSid, ?string $country = null)
    {
        parent::__construct($version);

        // Marshaled Properties
        $this->properties = [
            'accountSid' => Values::array_get($payload, 'account_sid'),
            'serviceSid' => Values::array_get($payload, 'service_sid'),
            'country' => Values::array_get($payload, 'country'),
            'messagingServiceSid' => Values::array_get($payload, 'messaging_service_sid'),
            'dateCreated' => Deserialize::dateTime(Values::array_get($payload, 'date_created')),
            'dateUpdated' => Deserialize::dateTime(Values::array_get($payload, 'date_updated')),
            'url' => Values::array_get($payload, 'url'),
        ];

        $this->solution = ['serviceSid' => $serviceSid, 'country' => $country ?: $this->properties['country'], ];
    }

    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return MessagingConfigurationContext Context for this MessagingConfigurationInstance
     */
    protected function proxy(): MessagingConfigurationContext
    {
        if (!$this->context) {
            $this->context = new MessagingConfigurationContext(
                $this->version,
                $this->solution['serviceSid'],
                $this->solution['country']
            );
        }

        return $this->context;
    }

    /**
     * Delete the MessagingConfigurationInstance
     *
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete(): bool
    {

        return $this->proxy()->delete();
    }

    /**
     * Fetch the MessagingConfigurationInstance
     *
     * @return MessagingConfigurationInstance Fetched MessagingConfigurationInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(): MessagingConfigurationInstance
    {

        return $this->proxy()->fetch();
    }

    /**
     * Update the MessagingConfigurationInstance
     *
     * @param string $messagingServiceSid The SID of the [Messaging Service](https://www.twilio.com/docs/messaging/api/service-resource) to be used to send SMS to the country of this configuration.
     * @return MessagingConfigurationInstance Updated MessagingConfigurationInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(string $messagingServiceSid): MessagingConfigurationInstance
    {

        return $this->proxy()->update($messagingServiceSid);
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
        return '[Twilio.Verify.V2.MessagingConfigurationInstance ' . \implode(' ', $context) . ']';
    }
}

