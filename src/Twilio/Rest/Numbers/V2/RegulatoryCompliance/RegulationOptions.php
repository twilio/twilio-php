<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Numbers\V2\RegulatoryCompliance;

use Twilio\Options;
use Twilio\Values;

abstract class RegulationOptions {
    /**
     * @param string $endUserType The type of End User of the Regulation resource
     * @param string $isoCountry The ISO country code of the phone number's country
     * @param string $numberType The type of phone number being regulated
     * @return ReadRegulationOptions Options builder
     */
    public static function read(string $endUserType = Values::NONE, string $isoCountry = Values::NONE, string $numberType = Values::NONE): ReadRegulationOptions {
        return new ReadRegulationOptions($endUserType, $isoCountry, $numberType);
    }
}

class ReadRegulationOptions extends Options {
    /**
     * @param string $endUserType The type of End User of the Regulation resource
     * @param string $isoCountry The ISO country code of the phone number's country
     * @param string $numberType The type of phone number being regulated
     */
    public function __construct(string $endUserType = Values::NONE, string $isoCountry = Values::NONE, string $numberType = Values::NONE) {
        $this->options['endUserType'] = $endUserType;
        $this->options['isoCountry'] = $isoCountry;
        $this->options['numberType'] = $numberType;
    }

    /**
     * The type of End User the regulation requires - can be `individual` or `business`.
     *
     * @param string $endUserType The type of End User of the Regulation resource
     * @return $this Fluent Builder
     */
    public function setEndUserType(string $endUserType): self {
        $this->options['endUserType'] = $endUserType;
        return $this;
    }

    /**
     * The ISO country code of the phone number's country.
     *
     * @param string $isoCountry The ISO country code of the phone number's country
     * @return $this Fluent Builder
     */
    public function setIsoCountry(string $isoCountry): self {
        $this->options['isoCountry'] = $isoCountry;
        return $this;
    }

    /**
     * The type of phone number that the regulatory requiremnt is restricting.
     *
     * @param string $numberType The type of phone number being regulated
     * @return $this Fluent Builder
     */
    public function setNumberType(string $numberType): self {
        $this->options['numberType'] = $numberType;
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
            if ($value !== Values::NONE || $value !== Values::ARRAY_NONE) {
                $options[] = "$key=$value";
            }
        }
        return '[Twilio.Numbers.V2.ReadRegulationOptions ' . \implode(' ', $options) . ']';
    }
}