<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Sync\V1\Service;

use Twilio\Options;
use Twilio\Values;

/**
 * PLEASE NOTE that this class contains beta products that are subject to change. Use them with caution.
 */
abstract class SyncListOptions {
    /**
     * @param string $uniqueName An application-defined string that uniquely
     *                           identifies the resource
     * @param int $ttl Alias for collection_ttl
     * @param int $collectionTtl How long, in seconds, before the Sync List expires
     *                           and is deleted
     * @return CreateSyncListOptions Options builder
     */
    public static function create($uniqueName = Values::NONE, $ttl = Values::NONE, $collectionTtl = Values::NONE): CreateSyncListOptions {
        return new CreateSyncListOptions($uniqueName, $ttl, $collectionTtl);
    }

    /**
     * @param int $ttl An alias for collection_ttl
     * @param int $collectionTtl How long, in seconds, before the Sync List expires
     *                           and is deleted
     * @return UpdateSyncListOptions Options builder
     */
    public static function update($ttl = Values::NONE, $collectionTtl = Values::NONE): UpdateSyncListOptions {
        return new UpdateSyncListOptions($ttl, $collectionTtl);
    }
}

class CreateSyncListOptions extends Options {
    /**
     * @param string $uniqueName An application-defined string that uniquely
     *                           identifies the resource
     * @param int $ttl Alias for collection_ttl
     * @param int $collectionTtl How long, in seconds, before the Sync List expires
     *                           and is deleted
     */
    public function __construct($uniqueName = Values::NONE, $ttl = Values::NONE, $collectionTtl = Values::NONE) {
        $this->options['uniqueName'] = $uniqueName;
        $this->options['ttl'] = $ttl;
        $this->options['collectionTtl'] = $collectionTtl;
    }

    /**
     * An application-defined string that uniquely identifies the resource. This value must be unique within its Service and it can be up to 320 characters long. The `unique_name` value can be used as an alternative to the `sid` in the URL path to address the resource.
     *
     * @param string $uniqueName An application-defined string that uniquely
     *                           identifies the resource
     * @return $this Fluent Builder
     */
    public function setUniqueName($uniqueName): self {
        $this->options['uniqueName'] = $uniqueName;
        return $this;
    }

    /**
     * Alias for collection_ttl. If both are provided, this value is ignored.
     *
     * @param int $ttl Alias for collection_ttl
     * @return $this Fluent Builder
     */
    public function setTtl($ttl): self {
        $this->options['ttl'] = $ttl;
        return $this;
    }

    /**
     * How long, in seconds, before the Sync List expires (time-to-live) and is deleted.  Can be an integer from 0 to 31,536,000 (1 year). The default value is `0`, which means the Sync List does not expire. The Sync List will be deleted automatically after it expires, but there can be a delay between the expiration time and the resources's deletion.
     *
     * @param int $collectionTtl How long, in seconds, before the Sync List expires
     *                           and is deleted
     * @return $this Fluent Builder
     */
    public function setCollectionTtl($collectionTtl): self {
        $this->options['collectionTtl'] = $collectionTtl;
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
        return '[Twilio.Sync.V1.CreateSyncListOptions ' . \implode(' ', $options) . ']';
    }
}

class UpdateSyncListOptions extends Options {
    /**
     * @param int $ttl An alias for collection_ttl
     * @param int $collectionTtl How long, in seconds, before the Sync List expires
     *                           and is deleted
     */
    public function __construct($ttl = Values::NONE, $collectionTtl = Values::NONE) {
        $this->options['ttl'] = $ttl;
        $this->options['collectionTtl'] = $collectionTtl;
    }

    /**
     * An alias for `collection_ttl`. If both are provided, this value is ignored.
     *
     * @param int $ttl An alias for collection_ttl
     * @return $this Fluent Builder
     */
    public function setTtl($ttl): self {
        $this->options['ttl'] = $ttl;
        return $this;
    }

    /**
     * How long, in seconds, before the Sync List expires (time-to-live) and is deleted. Can be an integer from 0 to 31,536,000 (1 year). The default value is `0`, which means the Sync List does not expire. The Sync List will be deleted automatically after it expires, but there can be a delay between the expiration time and the resources's deletion.
     *
     * @param int $collectionTtl How long, in seconds, before the Sync List expires
     *                           and is deleted
     * @return $this Fluent Builder
     */
    public function setCollectionTtl($collectionTtl): self {
        $this->options['collectionTtl'] = $collectionTtl;
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
        return '[Twilio.Sync.V1.UpdateSyncListOptions ' . \implode(' ', $options) . ']';
    }
}