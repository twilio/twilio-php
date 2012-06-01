<?php

class Services_Twilio_Rest_Accounts
    extends Services_Twilio_ListResource
{
    public function __construct($resource) {
        $this->instance_name = 'Account';
        parent::__construct($resource);
    }

    public function create(array $params = array())
    {
        return parent::_create($params);
    }
}
