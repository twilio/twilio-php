<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Preview\Understand\Assistant;

use Twilio\Options;
use Twilio\Values;

/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 */
abstract class FieldTypeOptions {
    /**
     * @param string $friendlyName A user-provided string that identifies this
     *                             resource. It is non-unique and can up to 255
     *                             characters long.
     * @return CreateFieldTypeOptions Options builder
     */
    public static function create($friendlyName = Values::NONE): CreateFieldTypeOptions {
        return new CreateFieldTypeOptions($friendlyName);
    }

    /**
     * @param string $friendlyName A user-provided string that identifies this
     *                             resource. It is non-unique and can up to 255
     *                             characters long.
     * @param string $uniqueName A user-provided string that uniquely identifies
     *                           this resource as an alternative to the sid. Unique
     *                           up to 64 characters long.
     * @return UpdateFieldTypeOptions Options builder
     */
    public static function update($friendlyName = Values::NONE, $uniqueName = Values::NONE): UpdateFieldTypeOptions {
        return new UpdateFieldTypeOptions($friendlyName, $uniqueName);
    }
}

class CreateFieldTypeOptions extends Options {
    /**
     * @param string $friendlyName A user-provided string that identifies this
     *                             resource. It is non-unique and can up to 255
     *                             characters long.
     */
    public function __construct($friendlyName = Values::NONE) {
        $this->options['friendlyName'] = $friendlyName;
    }

    /**
     * A user-provided string that identifies this resource. It is non-unique and can up to 255 characters long.
     *
     * @param string $friendlyName A user-provided string that identifies this
     *                             resource. It is non-unique and can up to 255
     *                             characters long.
     * @return $this Fluent Builder
     */
    public function setFriendlyName($friendlyName): self {
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
        foreach ($this->options as $key => $value) {
            if ($value !== Values::NONE) {
                $options[] = "$key=$value";
            }
        }
        return '[Twilio.Preview.Understand.CreateFieldTypeOptions ' . \implode(' ', $options) . ']';
    }
}

class UpdateFieldTypeOptions extends Options {
    /**
     * @param string $friendlyName A user-provided string that identifies this
     *                             resource. It is non-unique and can up to 255
     *                             characters long.
     * @param string $uniqueName A user-provided string that uniquely identifies
     *                           this resource as an alternative to the sid. Unique
     *                           up to 64 characters long.
     */
    public function __construct($friendlyName = Values::NONE, $uniqueName = Values::NONE) {
        $this->options['friendlyName'] = $friendlyName;
        $this->options['uniqueName'] = $uniqueName;
    }

    /**
     * A user-provided string that identifies this resource. It is non-unique and can up to 255 characters long.
     *
     * @param string $friendlyName A user-provided string that identifies this
     *                             resource. It is non-unique and can up to 255
     *                             characters long.
     * @return $this Fluent Builder
     */
    public function setFriendlyName($friendlyName): self {
        $this->options['friendlyName'] = $friendlyName;
        return $this;
    }

    /**
     * A user-provided string that uniquely identifies this resource as an alternative to the sid. Unique up to 64 characters long.
     *
     * @param string $uniqueName A user-provided string that uniquely identifies
     *                           this resource as an alternative to the sid. Unique
     *                           up to 64 characters long.
     * @return $this Fluent Builder
     */
    public function setUniqueName($uniqueName): self {
        $this->options['uniqueName'] = $uniqueName;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        $options = [];
        foreach ($this->options as $key => $value) {
            if ($value !== Values::NONE) {
                $options[] = "$key=$value";
            }
        }
        return '[Twilio.Preview.Understand.UpdateFieldTypeOptions ' . \implode(' ', $options) . ']';
    }
}