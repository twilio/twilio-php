<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Taskrouter\V1\Workspace;

use Twilio\Deserialize;
use Twilio\Exceptions\TwilioException;
use Twilio\InstanceResource;
use Twilio\Options;
use Twilio\Values;
use Twilio\Version;

/**
 * @property string $accountSid
 * @property \DateTime $dateCreated
 * @property \DateTime $dateUpdated
 * @property string $friendlyName
 * @property string $sid
 * @property string $uniqueName
 * @property string $workspaceSid
 * @property bool $channelOptimizedRouting
 * @property string $url
 * @property array $links
 */
class TaskChannelInstance extends InstanceResource {
    /**
     * Initialize the TaskChannelInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $workspaceSid The SID of the Workspace that contains the
     *                             TaskChannel
     * @param string $sid The SID of the TaskChannel resource to fetch
     */
    public function __construct(Version $version, array $payload, $workspaceSid, $sid = null) {
        parent::__construct($version);

        // Marshaled Properties
        $this->properties = [
            'accountSid' => Values::array_get($payload, 'account_sid'),
            'dateCreated' => Deserialize::dateTime(Values::array_get($payload, 'date_created')),
            'dateUpdated' => Deserialize::dateTime(Values::array_get($payload, 'date_updated')),
            'friendlyName' => Values::array_get($payload, 'friendly_name'),
            'sid' => Values::array_get($payload, 'sid'),
            'uniqueName' => Values::array_get($payload, 'unique_name'),
            'workspaceSid' => Values::array_get($payload, 'workspace_sid'),
            'channelOptimizedRouting' => Values::array_get($payload, 'channel_optimized_routing'),
            'url' => Values::array_get($payload, 'url'),
            'links' => Values::array_get($payload, 'links'),
        ];

        $this->solution = ['workspaceSid' => $workspaceSid, 'sid' => $sid ?: $this->properties['sid'], ];
    }

    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return TaskChannelContext Context for this TaskChannelInstance
     */
    protected function proxy(): TaskChannelContext {
        if (!$this->context) {
            $this->context = new TaskChannelContext(
                $this->version,
                $this->solution['workspaceSid'],
                $this->solution['sid']
            );
        }

        return $this->context;
    }

    /**
     * Fetch a TaskChannelInstance
     *
     * @return TaskChannelInstance Fetched TaskChannelInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(): TaskChannelInstance {
        return $this->proxy()->fetch();
    }

    /**
     * Update the TaskChannelInstance
     *
     * @param array|Options $options Optional Arguments
     * @return TaskChannelInstance Updated TaskChannelInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update($options = []): TaskChannelInstance {
        return $this->proxy()->update($options);
    }

    /**
     * Deletes the TaskChannelInstance
     *
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete(): bool {
        return $this->proxy()->delete();
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
        return '[Twilio.Taskrouter.V1.TaskChannelInstance ' . \implode(' ', $context) . ']';
    }
}