<?php

class Services_Twilio_NumberType extends Services_Twilio_ListResource
{
    public function getResourceName($camelized = false) {
        $this->instance_name = 'Services_Twilio_Rest_IncomingPhoneNumber';
        return $camelized ? 'IncomingPhoneNumbers' : 'incoming_phone_numbers';
    }

    public function purchase($phone_number, array $params = array()) {
        $postParams = array(
            'PhoneNumber' => $phone_number
        );
        return $this->create($postParams + $params);
    }

    public function create(array $params = array()) {
        return parent::_create($params);
    }

}
