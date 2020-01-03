<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\FlexApi\V1;

use Twilio\Options;
use Twilio\Values;

abstract class ConfigurationOptions {
    /**
     * @param string $uiVersion The Pinned UI version of the Configuration resource
     *                          to fetch
     * @return FetchConfigurationOptions Options builder
     */
    public static function fetch($uiVersion = Values::NONE): FetchConfigurationOptions {
        return new FetchConfigurationOptions($uiVersion);
    }
}

class FetchConfigurationOptions extends Options {
    /**
     * @param string $uiVersion The Pinned UI version of the Configuration resource
     *                          to fetch
     */
    public function __construct($uiVersion = Values::NONE) {
        $this->options['uiVersion'] = $uiVersion;
    }

    /**
     * The Pinned UI version of the Configuration resource to fetch.
     *
     * @param string $uiVersion The Pinned UI version of the Configuration resource
     *                          to fetch
     * @return $this Fluent Builder
     */
    public function setUiVersion($uiVersion): self {
        $this->options['uiVersion'] = $uiVersion;
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
        return '[Twilio.FlexApi.V1.FetchConfigurationOptions ' . \implode(' ', $options) . ']';
    }
}