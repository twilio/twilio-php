<?php

/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Flex
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */


namespace Twilio\Rest\FlexApi\V1;

use Twilio\Exceptions\TwilioException;
use Twilio\InstanceResource;
use Twilio\Values;
use Twilio\Version;
use Twilio\Rest\FlexApi\V1\Interaction\InteractionChannelList;


/**
 * @property string|null $sid
 * @property array|null $channel
 * @property array|null $routing
 * @property string|null $url
 * @property array|null $links
 * @property string|null $interactionContextSid
 */
class InteractionInstance extends InstanceResource
{
    protected $_channels;

    /**
     * Initialize the InteractionInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $sid The SID of the Interaction resource to fetch.
     */
    public function __construct(Version $version, array $payload, ?string $sid = null)
    {
        parent::__construct($version);

        // Marshaled Properties
        $this->properties = [
            'sid' => Values::array_get($payload, 'sid'),
            'channel' => Values::array_get($payload, 'channel'),
            'routing' => Values::array_get($payload, 'routing'),
            'url' => Values::array_get($payload, 'url'),
            'links' => Values::array_get($payload, 'links'),
            'interactionContextSid' => Values::array_get($payload, 'interaction_context_sid'),
        ];

        $this->solution = ['sid' => $sid ?: $this->properties['sid'], ];
    }

    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return InteractionContext Context for this InteractionInstance
     */
    protected function proxy(): InteractionContext
    {
        if (!$this->context) {
            $this->context = new InteractionContext(
                $this->version,
                $this->solution['sid']
            );
        }

        return $this->context;
    }

    /**
     * Fetch the InteractionInstance
     *
     * @return InteractionInstance Fetched InteractionInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(): InteractionInstance
    {

        return $this->proxy()->fetch();
    }

    /**
     * Access the channels
     */
    protected function getChannels(): InteractionChannelList
    {
        return $this->proxy()->channels;
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
        return '[Twilio.FlexApi.V1.InteractionInstance ' . \implode(' ', $context) . ']';
    }
}

