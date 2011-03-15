<?php

class Services_Twilio_Rest_Calls
    extends Services_Twilio_ListResource
{
    public function create($from, $to, $url, array $params = array())
    {
        return parent::_create(array(
            'From' => $from,
            'To' => $to,
            'Url' => $url,
        ) + $params);
    }
}
