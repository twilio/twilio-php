<?php

class Services_Twilio_Rest_Messages
    extends Services_Twilio_ListResource
{
    function create($from, $to, array $params = array()) {
        return parent::_create(array(
            'From' => $from,
            'To' => $to,
        ) + $params);
    }
}
