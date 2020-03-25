<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Preview\Sync\Service\SyncMap;

use Twilio\Options;
use Twilio\Values;

/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 */
abstract class SyncMapItemOptions {
    /**
     * @param string $order The order
     * @param string $from The from
     * @param string $bounds The bounds
     * @return ReadSyncMapItemOptions Options builder
     */
    public static function read(string $order = Values::NONE, string $from = Values::NONE, string $bounds = Values::NONE): ReadSyncMapItemOptions {
        return new ReadSyncMapItemOptions($order, $from, $bounds);
    }
}

class ReadSyncMapItemOptions extends Options {
    /**
     * @param string $order The order
     * @param string $from The from
     * @param string $bounds The bounds
     */
    public function __construct(string $order = Values::NONE, string $from = Values::NONE, string $bounds = Values::NONE) {
        $this->options['order'] = $order;
        $this->options['from'] = $from;
        $this->options['bounds'] = $bounds;
    }

    /**
     * The order
     *
     * @param string $order The order
     * @return $this Fluent Builder
     */
    public function setOrder(string $order): self {
        $this->options['order'] = $order;
        return $this;
    }

    /**
     * The from
     *
     * @param string $from The from
     * @return $this Fluent Builder
     */
    public function setFrom(string $from): self {
        $this->options['from'] = $from;
        return $this;
    }

    /**
     * The bounds
     *
     * @param string $bounds The bounds
     * @return $this Fluent Builder
     */
    public function setBounds(string $bounds): self {
        $this->options['bounds'] = $bounds;
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
        return '[Twilio.Preview.Sync.ReadSyncMapItemOptions ' . \implode(' ', $options) . ']';
    }
}