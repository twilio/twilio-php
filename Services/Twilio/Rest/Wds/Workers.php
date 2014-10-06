<?php

class Services_Twilio_Rest_Wds_Workers extends Services_Twilio_WdsListResource {

    public function create($friendlyName, array $params = array()) {
        $params['FriendlyName'] = $friendlyName;
        return parent::_create($params);
    }
}
