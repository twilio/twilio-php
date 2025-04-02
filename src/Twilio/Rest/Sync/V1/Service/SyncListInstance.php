<?php

/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Sync
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */


namespace Twilio\Rest\Sync\V1\Service;

use Twilio\Exceptions\TwilioException;
use Twilio\InstanceResource;
use Twilio\Options;
use Twilio\Values;
use Twilio\Version;
use Twilio\Deserialize;
use Twilio\Rest\Sync\V1\Service\SyncList\SyncListPermissionList;
use Twilio\Rest\Sync\V1\Service\SyncList\SyncListItemList;


/**
 * @property string|null $sid
 * @property string|null $uniqueName
 * @property string|null $accountSid
 * @property string|null $serviceSid
 * @property string|null $url
 * @property array|null $links
 * @property string|null $revision
 * @property \DateTime|null $dateExpires
 * @property \DateTime|null $dateCreated
 * @property \DateTime|null $dateUpdated
 * @property string|null $createdBy
 */
class SyncListInstance extends InstanceResource
{
    protected $_syncListPermissions;
    protected $_syncListItems;

    /**
     * Initialize the SyncListInstance
     *
     * @param Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $serviceSid The SID of the [Sync Service](https://www.twilio.com/docs/sync/api/service) to create the new Sync List in.
     * @param string $sid The SID of the Sync List resource to delete. Can be the Sync List resource's `sid` or its `unique_name`.
     */
    public function __construct(Version $version, array $payload, string $serviceSid, ?string $sid = null)
    {
        parent::__construct($version);

        // Marshaled Properties
        $this->properties = [
            'sid' => Values::array_get($payload, 'sid'),
            'uniqueName' => Values::array_get($payload, 'unique_name'),
            'accountSid' => Values::array_get($payload, 'account_sid'),
            'serviceSid' => Values::array_get($payload, 'service_sid'),
            'url' => Values::array_get($payload, 'url'),
            'links' => Values::array_get($payload, 'links'),
            'revision' => Values::array_get($payload, 'revision'),
            'dateExpires' => Deserialize::dateTime(Values::array_get($payload, 'date_expires')),
            'dateCreated' => Deserialize::dateTime(Values::array_get($payload, 'date_created')),
            'dateUpdated' => Deserialize::dateTime(Values::array_get($payload, 'date_updated')),
            'createdBy' => Values::array_get($payload, 'created_by'),
        ];

        $this->solution = ['serviceSid' => $serviceSid, 'sid' => $sid ?: $this->properties['sid'], ];
    }

    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     *
     * @return SyncListContext Context for this SyncListInstance
     */
    protected function proxy(): SyncListContext
    {
        if (!$this->context) {
            $this->context = new SyncListContext(
                $this->version,
                $this->solution['serviceSid'],
                $this->solution['sid']
            );
        }

        return $this->context;
    }

    /**
     * Delete the SyncListInstance
     *
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete(): bool
    {

        return $this->proxy()->delete();
    }

    /**
     * Fetch the SyncListInstance
     *
     * @return SyncListInstance Fetched SyncListInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(): SyncListInstance
    {

        return $this->proxy()->fetch();
    }

    /**
     * Update the SyncListInstance
     *
     * @param array|Options $options Optional Arguments
     * @return SyncListInstance Updated SyncListInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update(array $options = []): SyncListInstance
    {

        return $this->proxy()->update($options);
    }

    /**
     * Access the syncListPermissions
     */
    protected function getSyncListPermissions(): SyncListPermissionList
    {
        return $this->proxy()->syncListPermissions;
    }

    /**
     * Access the syncListItems
     */
    protected function getSyncListItems(): SyncListItemList
    {
        return $this->proxy()->syncListItems;
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
        return '[Twilio.Sync.V1.SyncListInstance ' . \implode(' ', $context) . ']';
    }
}

