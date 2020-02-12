<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\IpMessaging\V2\Service\User;

use Twilio\Exceptions\TwilioException;
use Twilio\InstanceResource;
use Twilio\Options;
use Twilio\Values;
use Twilio\Version;

/**
 * @property string $accountSid
 * @property string $serviceSid
 * @property string $channelSid
 * @property string $userSid
 * @property string $memberSid
 * @property string $status
 * @property int $lastConsumedMessageIndex
 * @property int $unreadMessagesCount
 * @property array $links
 * @property string $url
 * @property string $notificationLevel
 */
class UserChannelInstance extends InstanceResource {
    /**
     * Initialize the UserChannelInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $serviceSid The SID of the Service that the resource is
     *                           associated with
     * @param string $userSid The SID of the User the User Channel belongs to
     * @param string $channelSid The SID of the Channel that has the User Channel
     *                           to fetch
     */
    public function __construct(Version $version, array $payload, $serviceSid, $userSid, $channelSid = null) {
        parent::__construct($version);

        // Marshaled Properties
        $this->properties = [
            'accountSid' => Values::array_get($payload, 'account_sid'),
            'serviceSid' => Values::array_get($payload, 'service_sid'),
            'channelSid' => Values::array_get($payload, 'channel_sid'),
            'userSid' => Values::array_get($payload, 'user_sid'),
            'memberSid' => Values::array_get($payload, 'member_sid'),
            'status' => Values::array_get($payload, 'status'),
            'lastConsumedMessageIndex' => Values::array_get($payload, 'last_consumed_message_index'),
            'unreadMessagesCount' => Values::array_get($payload, 'unread_messages_count'),
            'links' => Values::array_get($payload, 'links'),
            'url' => Values::array_get($payload, 'url'),
            'notificationLevel' => Values::array_get($payload, 'notification_level'),
        ];

        $this->solution = [
            'serviceSid' => $serviceSid,
            'userSid' => $userSid,
            'channelSid' => $channelSid ?: $this->properties['channelSid'],
        ];
    }

    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return UserChannelContext Context for this UserChannelInstance
     */
    protected function proxy(): UserChannelContext {
        if (!$this->context) {
            $this->context = new UserChannelContext(
                $this->version,
                $this->solution['serviceSid'],
                $this->solution['userSid'],
                $this->solution['channelSid']
            );
        }

        return $this->context;
    }

    /**
     * Fetch a UserChannelInstance
     *
     * @return UserChannelInstance Fetched UserChannelInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(): UserChannelInstance {
        return $this->proxy()->fetch();
    }

    /**
     * Deletes the UserChannelInstance
     *
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete(): bool {
        return $this->proxy()->delete();
    }

    /**
     * Update the UserChannelInstance
     *
     * @param array|Options $options Optional Arguments
     * @return UserChannelInstance Updated UserChannelInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update($options = []): UserChannelInstance {
        return $this->proxy()->update($options);
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
        return '[Twilio.IpMessaging.V2.UserChannelInstance ' . \implode(' ', $context) . ']';
    }
}