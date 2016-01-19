<?php

class Services_Twilio_Rest_Addresses
    extends Services_Twilio_ListResource
{
    public function create($friendlyName, array $params = array())
    {
        $params["FriendlyName"] = $friendlyName;

        return parent::_create($params);
    }
}
