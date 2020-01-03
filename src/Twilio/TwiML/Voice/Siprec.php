<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\TwiML\Voice;

use Twilio\TwiML\TwiML;

class Siprec extends TwiML {
    /**
     * Siprec constructor.
     *
     * @param array $attributes Optional attributes
     */
    public function __construct($attributes = []) {
        parent::__construct('Siprec', null, $attributes);
    }

    /**
     * Add Parameter child.
     *
     * @param array $attributes Optional attributes
     * @return Parameter Child element.
     */
    public function parameter($attributes = []): Parameter {
        return $this->nest(new Parameter($attributes));
    }

    /**
     * Add Name attribute.
     *
     * @param string $name Friendly name given to SIPREC
     */
    public function setName($name): self {
        return $this->setAttribute('name', $name);
    }

    /**
     * Add ConnectorName attribute.
     *
     * @param string $connectorName Unique name for Connector
     */
    public function setConnectorName($connectorName): self {
        return $this->setAttribute('connectorName', $connectorName);
    }
}