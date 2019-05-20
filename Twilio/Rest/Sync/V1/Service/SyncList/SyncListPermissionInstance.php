<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Sync\V1\Service\SyncList;

use Twilio\Exceptions\TwilioException;
use Twilio\InstanceResource;
use Twilio\Values;
use Twilio\Version;

/**
 * PLEASE NOTE that this class contains beta products that are subject to change. Use them with caution.
 * 
 * @property string accountSid
 * @property string serviceSid
 * @property string listSid
 * @property string identity
 * @property bool read
 * @property bool write
 * @property bool manage
 * @property string url
 */
class SyncListPermissionInstance extends InstanceResource {
    /**
     * Initialize the SyncListPermissionInstance
     * 
     * @param \Twilio\Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $serviceSid Sync Service Instance SID.
     * @param string $listSid Sync List SID.
     * @param string $identity Identity of the user to whom the Sync List
     *                         Permission applies.
     * @return \Twilio\Rest\Sync\V1\Service\SyncList\SyncListPermissionInstance 
     */
    public function __construct(Version $version, array $payload, $serviceSid, $listSid, $identity = null) {
        parent::__construct($version);

        // Marshaled Properties
        $this->properties = array(
            'accountSid' => Values::array_get($payload, 'account_sid'),
            'serviceSid' => Values::array_get($payload, 'service_sid'),
            'listSid' => Values::array_get($payload, 'list_sid'),
            'identity' => Values::array_get($payload, 'identity'),
            'read' => Values::array_get($payload, 'read'),
            'write' => Values::array_get($payload, 'write'),
            'manage' => Values::array_get($payload, 'manage'),
            'url' => Values::array_get($payload, 'url'),
        );

        $this->solution = array(
            'serviceSid' => $serviceSid,
            'listSid' => $listSid,
            'identity' => $identity ?: $this->properties['identity'],
        );
    }

    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     * 
     * @return \Twilio\Rest\Sync\V1\Service\SyncList\SyncListPermissionContext Context for this SyncListPermissionInstance
     */
    protected function proxy() {
        if (!$this->context) {
            $this->context = new SyncListPermissionContext(
                $this->version,
                $this->solution['serviceSid'],
                $this->solution['listSid'],
                $this->solution['identity']
            );
        }

        return $this->context;
    }

    /**
     * Fetch a SyncListPermissionInstance
     * 
     * @return SyncListPermissionInstance Fetched SyncListPermissionInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch() {
        return $this->proxy()->fetch();
    }

    /**
     * Deletes the SyncListPermissionInstance
     * 
     * @return boolean True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete() {
        return $this->proxy()->delete();
    }

    /**
     * Update the SyncListPermissionInstance
     * 
     * @param bool $read Read access.
     * @param bool $write Write access.
     * @param bool $manage Manage access.
     * @return SyncListPermissionInstance Updated SyncListPermissionInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update($read, $write, $manage) {
        return $this->proxy()->update($read, $write, $manage);
    }

    /**
     * Magic getter to access properties
     * 
     * @param string $name Property to access
     * @return mixed The requested property
     * @throws TwilioException For unknown properties
     */
    public function __get($name) {
        if (array_key_exists($name, $this->properties)) {
            return $this->properties[$name];
        }

        if (property_exists($this, '_' . $name)) {
            $method = 'get' . ucfirst($name);
            return $this->$method();
        }

        throw new TwilioException('Unknown property: ' . $name);
    }

    /**
     * Provide a friendly representation
     * 
     * @return string Machine friendly representation
     */
    public function __toString() {
        $context = array();
        foreach ($this->solution as $key => $value) {
            $context[] = "$key=$value";
        }
        return '[Twilio.Sync.V1.SyncListPermissionInstance ' . implode(' ', $context) . ']';
    }
}