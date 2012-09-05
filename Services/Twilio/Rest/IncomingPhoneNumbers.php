<?php

class Services_Twilio_Rest_IncomingPhoneNumbers
    extends Services_Twilio_ListResource
{
    function create(array $params = array())
    {
        return parent::_create($params);
    }

    /**
     * Get a list of available phone numbers. 
     *
     * @return object A list of AvailableNumbers
     */
    public function getList()
    {
        return $this->client->retrieveData($this->uri); 
    }
}
