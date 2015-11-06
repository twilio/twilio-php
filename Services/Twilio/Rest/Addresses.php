<?php

class Services_Twilio_Rest_Addresses
    extends Services_Twilio_ListResource
{

    public function __construct($client, $uri) {
        $this->instance_name = "Services_Twilio_Rest_Address";
        parent::__construct($client, $uri);
    }

}
