<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\IpMessaging\V1\Service;

use Twilio\Options;
use Twilio\Values;

abstract class UserOptions {
    /**
     * @param string $roleSid The SID of the Role assigned to this user
     * @param string $attributes A valid JSON string that contains
     *                           application-specific data
     * @param string $friendlyName A string to describe the new resource
     * @return CreateUserOptions Options builder
     */
    public static function create(string $roleSid = Values::NONE, string $attributes = Values::NONE, string $friendlyName = Values::NONE): CreateUserOptions {
        return new CreateUserOptions($roleSid, $attributes, $friendlyName);
    }

    /**
     * @param string $roleSid The SID id of the Role assigned to this user
     * @param string $attributes A valid JSON string that contains
     *                           application-specific data
     * @param string $friendlyName A string to describe the resource
     * @return UpdateUserOptions Options builder
     */
    public static function update(string $roleSid = Values::NONE, string $attributes = Values::NONE, string $friendlyName = Values::NONE): UpdateUserOptions {
        return new UpdateUserOptions($roleSid, $attributes, $friendlyName);
    }
}

class CreateUserOptions extends Options {
    /**
     * @param string $roleSid The SID of the Role assigned to this user
     * @param string $attributes A valid JSON string that contains
     *                           application-specific data
     * @param string $friendlyName A string to describe the new resource
     */
    public function __construct(string $roleSid = Values::NONE, string $attributes = Values::NONE, string $friendlyName = Values::NONE) {
        $this->options['roleSid'] = $roleSid;
        $this->options['attributes'] = $attributes;
        $this->options['friendlyName'] = $friendlyName;
    }

    /**
     * The SID of the [Role](https://www.twilio.com/docs/api/chat/rest/roles) assigned to the new User.
     *
     * @param string $roleSid The SID of the Role assigned to this user
     * @return $this Fluent Builder
     */
    public function setRoleSid(string $roleSid): self {
        $this->options['roleSid'] = $roleSid;
        return $this;
    }

    /**
     * A valid JSON string that contains application-specific data.
     *
     * @param string $attributes A valid JSON string that contains
     *                           application-specific data
     * @return $this Fluent Builder
     */
    public function setAttributes(string $attributes): self {
        $this->options['attributes'] = $attributes;
        return $this;
    }

    /**
     * A descriptive string that you create to describe the new resource. This value is often used for display purposes.
     *
     * @param string $friendlyName A string to describe the new resource
     * @return $this Fluent Builder
     */
    public function setFriendlyName(string $friendlyName): self {
        $this->options['friendlyName'] = $friendlyName;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        $options = [];
        foreach (Values::of($this->options) as $key => $value) {
                $options[] = "$key=$value";
        }
        return '[Twilio.IpMessaging.V1.CreateUserOptions ' . \implode(' ', $options) . ']';
    }
}

class UpdateUserOptions extends Options {
    /**
     * @param string $roleSid The SID id of the Role assigned to this user
     * @param string $attributes A valid JSON string that contains
     *                           application-specific data
     * @param string $friendlyName A string to describe the resource
     */
    public function __construct(string $roleSid = Values::NONE, string $attributes = Values::NONE, string $friendlyName = Values::NONE) {
        $this->options['roleSid'] = $roleSid;
        $this->options['attributes'] = $attributes;
        $this->options['friendlyName'] = $friendlyName;
    }

    /**
     * The SID of the [Role](https://www.twilio.com/docs/api/chat/rest/roles) assigned to this user.
     *
     * @param string $roleSid The SID id of the Role assigned to this user
     * @return $this Fluent Builder
     */
    public function setRoleSid(string $roleSid): self {
        $this->options['roleSid'] = $roleSid;
        return $this;
    }

    /**
     * A valid JSON string that contains application-specific data.
     *
     * @param string $attributes A valid JSON string that contains
     *                           application-specific data
     * @return $this Fluent Builder
     */
    public function setAttributes(string $attributes): self {
        $this->options['attributes'] = $attributes;
        return $this;
    }

    /**
     * A descriptive string that you create to describe the resource. It is often used for display purposes.
     *
     * @param string $friendlyName A string to describe the resource
     * @return $this Fluent Builder
     */
    public function setFriendlyName(string $friendlyName): self {
        $this->options['friendlyName'] = $friendlyName;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        $options = [];
        foreach (Values::of($this->options) as $key => $value) {
                $options[] = "$key=$value";
        }
        return '[Twilio.IpMessaging.V1.UpdateUserOptions ' . \implode(' ', $options) . ']';
    }
}