<?php

class Services_Twilio_Rest_Pricing_PhoneNumberCountries
    extends Services_Twilio_PricingListResource {

    public function get($isoCountry) {
        $instance = new $this->instance_name($this->client, $this->uri . "/$isoCountry");
        $instance->isoCountry = $isoCountry;
        return $instance;
    }
}