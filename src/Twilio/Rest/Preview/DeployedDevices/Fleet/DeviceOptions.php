<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Preview\DeployedDevices\Fleet;

use Twilio\Options;
use Twilio\Values;

/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 */
abstract class DeviceOptions {
    /**
     * @param string $uniqueName A unique, addressable name of this Device.
     * @param string $friendlyName A human readable description for this Device.
     * @param string $identity An identifier of the Device user.
     * @param string $deploymentSid The unique SID of the Deployment group.
     * @param bool $enabled The enabled
     * @return CreateDeviceOptions Options builder
     */
    public static function create($uniqueName = Values::NONE, $friendlyName = Values::NONE, $identity = Values::NONE, $deploymentSid = Values::NONE, $enabled = Values::NONE): CreateDeviceOptions {
        return new CreateDeviceOptions($uniqueName, $friendlyName, $identity, $deploymentSid, $enabled);
    }

    /**
     * @param string $deploymentSid Find all Devices grouped under the specified
     *                              Deployment.
     * @return ReadDeviceOptions Options builder
     */
    public static function read($deploymentSid = Values::NONE): ReadDeviceOptions {
        return new ReadDeviceOptions($deploymentSid);
    }

    /**
     * @param string $friendlyName A human readable description for this Device.
     * @param string $identity An identifier of the Device user.
     * @param string $deploymentSid The unique SID of the Deployment group.
     * @param bool $enabled The enabled
     * @return UpdateDeviceOptions Options builder
     */
    public static function update($friendlyName = Values::NONE, $identity = Values::NONE, $deploymentSid = Values::NONE, $enabled = Values::NONE): UpdateDeviceOptions {
        return new UpdateDeviceOptions($friendlyName, $identity, $deploymentSid, $enabled);
    }
}

class CreateDeviceOptions extends Options {
    /**
     * @param string $uniqueName A unique, addressable name of this Device.
     * @param string $friendlyName A human readable description for this Device.
     * @param string $identity An identifier of the Device user.
     * @param string $deploymentSid The unique SID of the Deployment group.
     * @param bool $enabled The enabled
     */
    public function __construct($uniqueName = Values::NONE, $friendlyName = Values::NONE, $identity = Values::NONE, $deploymentSid = Values::NONE, $enabled = Values::NONE) {
        $this->options['uniqueName'] = $uniqueName;
        $this->options['friendlyName'] = $friendlyName;
        $this->options['identity'] = $identity;
        $this->options['deploymentSid'] = $deploymentSid;
        $this->options['enabled'] = $enabled;
    }

    /**
     * Provides a unique and addressable name to be assigned to this Device, to be used in addition to SID, up to 128 characters long.
     *
     * @param string $uniqueName A unique, addressable name of this Device.
     * @return $this Fluent Builder
     */
    public function setUniqueName($uniqueName): self {
        $this->options['uniqueName'] = $uniqueName;
        return $this;
    }

    /**
     * Provides a human readable descriptive text to be assigned to this Device, up to 256 characters long.
     *
     * @param string $friendlyName A human readable description for this Device.
     * @return $this Fluent Builder
     */
    public function setFriendlyName($friendlyName): self {
        $this->options['friendlyName'] = $friendlyName;
        return $this;
    }

    /**
     * Provides an arbitrary string identifier representing a human user to be associated with this Device, up to 256 characters long.
     *
     * @param string $identity An identifier of the Device user.
     * @return $this Fluent Builder
     */
    public function setIdentity($identity): self {
        $this->options['identity'] = $identity;
        return $this;
    }

    /**
     * Specifies the unique string identifier of the Deployment group that this Device is going to be associated with.
     *
     * @param string $deploymentSid The unique SID of the Deployment group.
     * @return $this Fluent Builder
     */
    public function setDeploymentSid($deploymentSid): self {
        $this->options['deploymentSid'] = $deploymentSid;
        return $this;
    }

    /**
     * The enabled
     *
     * @param bool $enabled The enabled
     * @return $this Fluent Builder
     */
    public function setEnabled($enabled): self {
        $this->options['enabled'] = $enabled;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        $options = []];
        foreach ($this->options as $key => $value) {
            if ($value !== Values::NONE) {
                $options[] = "$key=$value";
            }
        }
        return '[Twilio.Preview.DeployedDevices.CreateDeviceOptions ' . \implode(' ', $options) . ']';
    }
}

class ReadDeviceOptions extends Options {
    /**
     * @param string $deploymentSid Find all Devices grouped under the specified
     *                              Deployment.
     */
    public function __construct($deploymentSid = Values::NONE) {
        $this->options['deploymentSid'] = $deploymentSid;
    }

    /**
     * Filters the resulting list of Devices by a unique string identifier of the Deployment they are associated with.
     *
     * @param string $deploymentSid Find all Devices grouped under the specified
     *                              Deployment.
     * @return $this Fluent Builder
     */
    public function setDeploymentSid($deploymentSid): self {
        $this->options['deploymentSid'] = $deploymentSid;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        $options = []];
        foreach ($this->options as $key => $value) {
            if ($value !== Values::NONE) {
                $options[] = "$key=$value";
            }
        }
        return '[Twilio.Preview.DeployedDevices.ReadDeviceOptions ' . \implode(' ', $options) . ']';
    }
}

class UpdateDeviceOptions extends Options {
    /**
     * @param string $friendlyName A human readable description for this Device.
     * @param string $identity An identifier of the Device user.
     * @param string $deploymentSid The unique SID of the Deployment group.
     * @param bool $enabled The enabled
     */
    public function __construct($friendlyName = Values::NONE, $identity = Values::NONE, $deploymentSid = Values::NONE, $enabled = Values::NONE) {
        $this->options['friendlyName'] = $friendlyName;
        $this->options['identity'] = $identity;
        $this->options['deploymentSid'] = $deploymentSid;
        $this->options['enabled'] = $enabled;
    }

    /**
     * Provides a human readable descriptive text to be assigned to this Device, up to 256 characters long.
     *
     * @param string $friendlyName A human readable description for this Device.
     * @return $this Fluent Builder
     */
    public function setFriendlyName($friendlyName): self {
        $this->options['friendlyName'] = $friendlyName;
        return $this;
    }

    /**
     * Provides an arbitrary string identifier representing a human user to be associated with this Device, up to 256 characters long.
     *
     * @param string $identity An identifier of the Device user.
     * @return $this Fluent Builder
     */
    public function setIdentity($identity): self {
        $this->options['identity'] = $identity;
        return $this;
    }

    /**
     * Specifies the unique string identifier of the Deployment group that this Device is going to be associated with.
     *
     * @param string $deploymentSid The unique SID of the Deployment group.
     * @return $this Fluent Builder
     */
    public function setDeploymentSid($deploymentSid): self {
        $this->options['deploymentSid'] = $deploymentSid;
        return $this;
    }

    /**
     * The enabled
     *
     * @param bool $enabled The enabled
     * @return $this Fluent Builder
     */
    public function setEnabled($enabled): self {
        $this->options['enabled'] = $enabled;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        $options = []];
        foreach ($this->options as $key => $value) {
            if ($value !== Values::NONE) {
                $options[] = "$key=$value";
            }
        }
        return '[Twilio.Preview.DeployedDevices.UpdateDeviceOptions ' . \implode(' ', $options) . ']';
    }
}