<?php

/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Serverless
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */


namespace Twilio\Rest\Serverless\V1\Service\Asset;

use Twilio\Exceptions\TwilioException;
use Twilio\InstanceResource;
use Twilio\Values;
use Twilio\Version;
use Twilio\Deserialize;


/**
 * @property string|null $sid
 * @property string|null $accountSid
 * @property string|null $serviceSid
 * @property string|null $assetSid
 * @property string|null $path
 * @property string $visibility
 * @property \DateTime|null $dateCreated
 * @property string|null $url
 */
class AssetVersionInstance extends InstanceResource
{
    /**
     * Initialize the AssetVersionInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $serviceSid The SID of the Service to fetch the Asset Version resource from.
     * @param string $assetSid The SID of the Asset resource that is the parent of the Asset Version resource to fetch.
     * @param string $sid The SID of the Asset Version resource to fetch.
     */
    public function __construct(Version $version, array $payload, string $serviceSid, string $assetSid, ?string $sid = null)
    {
        parent::__construct($version);

        // Marshaled Properties
        $this->properties = [
            'sid' => Values::array_get($payload, 'sid'),
            'accountSid' => Values::array_get($payload, 'account_sid'),
            'serviceSid' => Values::array_get($payload, 'service_sid'),
            'assetSid' => Values::array_get($payload, 'asset_sid'),
            'path' => Values::array_get($payload, 'path'),
            'visibility' => Values::array_get($payload, 'visibility'),
            'dateCreated' => Deserialize::dateTime(Values::array_get($payload, 'date_created')),
            'url' => Values::array_get($payload, 'url'),
        ];

        $this->solution = ['serviceSid' => $serviceSid, 'assetSid' => $assetSid, 'sid' => $sid ?: $this->properties['sid'], ];
    }

    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return AssetVersionContext Context for this AssetVersionInstance
     */
    protected function proxy(): AssetVersionContext
    {
        if (!$this->context) {
            $this->context = new AssetVersionContext(
                $this->version,
                $this->solution['serviceSid'],
                $this->solution['assetSid'],
                $this->solution['sid']
            );
        }

        return $this->context;
    }

    /**
     * Fetch the AssetVersionInstance
     *
     * @return AssetVersionInstance Fetched AssetVersionInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(): AssetVersionInstance
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
        return '[Twilio.Serverless.V1.AssetVersionInstance ' . \implode(' ', $context) . ']';
    }
}

