<?php

class Services_Twilio_Rest_Wds_Activities extends Services_Twilio_WdsListResource {

    public function __construct($client, $uri) {
        $this->instance_name = "Services_Twilio_Rest_Wds_Activity";
        parent::__construct($client, $uri);
    }

    public function create($friendlyName, $available) {
        $params['FriendlyName'] = $friendlyName;
        $params['Available'] = $available;
        return parent::_create($params);
    }
}
