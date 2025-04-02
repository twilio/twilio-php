<?php

/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Notify
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */


namespace Twilio\Rest\Notify\V1;

use Twilio\Exceptions\TwilioException;
use Twilio\InstanceResource;
use Twilio\Options;
use Twilio\Values;
use Twilio\Version;
use Twilio\Deserialize;
use Twilio\Rest\Notify\V1\Service\NotificationList;
use Twilio\Rest\Notify\V1\Service\BindingList;


/**
 * @property string|null $sid
 * @property string|null $accountSid
 * @property string|null $friendlyName
 * @property \DateTime|null $dateCreated
 * @property \DateTime|null $dateUpdated
 * @property string|null $apnCredentialSid
 * @property string|null $gcmCredentialSid
 * @property string|null $fcmCredentialSid
 * @property string|null $messagingServiceSid
 * @property string|null $facebookMessengerPageId
 * @property string|null $defaultApnNotificationProtocolVersion
 * @property string|null $defaultGcmNotificationProtocolVersion
 * @property string|null $defaultFcmNotificationProtocolVersion
 * @property bool|null $logEnabled
 * @property string|null $url
 * @property array|null $links
 * @property string|null $alexaSkillId
 * @property string|null $defaultAlexaNotificationProtocolVersion
 * @property string|null $deliveryCallbackUrl
 * @property bool|null $deliveryCallbackEnabled
 */
class ServiceInstance extends InstanceResource
{
    protected $_notifications;
    protected $_bindings;

    /**
     * Initialize the ServiceInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $sid The Twilio-provided string that uniquely identifies the Service resource to delete.
     */
    public function __construct(Version $version, array $payload, ?string $sid = null)
    {
        parent::__construct($version);

        // Marshaled Properties
        $this->properties = [
            'sid' => Values::array_get($payload, 'sid'),
            'accountSid' => Values::array_get($payload, 'account_sid'),
            'friendlyName' => Values::array_get($payload, 'friendly_name'),
            'dateCreated' => Deserialize::dateTime(Values::array_get($payload, 'date_created')),
            'dateUpdated' => Deserialize::dateTime(Values::array_get($payload, 'date_updated')),
            'apnCredentialSid' => Values::array_get($payload, 'apn_credential_sid'),
            'gcmCredentialSid' => Values::array_get($payload, 'gcm_credential_sid'),
            'fcmCredentialSid' => Values::array_get($payload, 'fcm_credential_sid'),
            'messagingServiceSid' => Values::array_get($payload, 'messaging_service_sid'),
            'facebookMessengerPageId' => Values::array_get($payload, 'facebook_messenger_page_id'),
            'defaultApnNotificationProtocolVersion' => Values::array_get($payload, 'default_apn_notification_protocol_version'),
            'defaultGcmNotificationProtocolVersion' => Values::array_get($payload, 'default_gcm_notification_protocol_version'),
            'defaultFcmNotificationProtocolVersion' => Values::array_get($payload, 'default_fcm_notification_protocol_version'),
            'logEnabled' => Values::array_get($payload, 'log_enabled'),
            'url' => Values::array_get($payload, 'url'),
            'links' => Values::array_get($payload, 'links'),
            'alexaSkillId' => Values::array_get($payload, 'alexa_skill_id'),
            'defaultAlexaNotificationProtocolVersion' => Values::array_get($payload, 'default_alexa_notification_protocol_version'),
            'deliveryCallbackUrl' => Values::array_get($payload, 'delivery_callback_url'),
            'deliveryCallbackEnabled' => Values::array_get($payload, 'delivery_callback_enabled'),
        ];

        $this->solution = ['sid' => $sid ?: $this->properties['sid'], ];
    }

    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return ServiceContext Context for this ServiceInstance
     */
    protected function proxy(): ServiceContext
    {
        if (!$this->context) {
            $this->context = new ServiceContext(
                $this->version,
                $this->solution['sid']
            );
        }

        return $this->context;
    }

    /**
     * Delete the ServiceInstance
     *
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete(): bool
    {

        return $this->proxy()->delete();
    }

    /**
     * Fetch the ServiceInstance
     *
     * @return ServiceInstance Fetched ServiceInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(): ServiceInstance
    {

        return $this->proxy()->fetch();
    }

    /**
     * Update the ServiceInstance
     *
     * @param array|Options $options Optional Arguments
     * @return ServiceInstance Updated ServiceInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(array $options = []): ServiceInstance
    {

        return $this->proxy()->update($options);
    }

    /**
     * Access the notifications
     */
    protected function getNotifications(): NotificationList
    {
        return $this->proxy()->notifications;
    }

    /**
     * Access the bindings
     */
    protected function getBindings(): BindingList
    {
        return $this->proxy()->bindings;
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
        return '[Twilio.Notify.V1.ServiceInstance ' . \implode(' ', $context) . ']';
    }
}

