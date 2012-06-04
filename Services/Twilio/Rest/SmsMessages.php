<?php

class Services_Twilio_Rest_SmsMessages
    extends Services_Twilio_ListResource
{
    public function __construct($resource, $uri) {
        $uri = preg_replace("#SmsMessages#", "SMS/Messages", $uri);
        parent::__construct($resource, $uri);
    }

    function create($from, $to, $body, array $params = array())
    {
        return parent::_create(array(
            'From' => $from,
            'To' => $to,
            'Body' => $body
        ) + $params);
    }
}
