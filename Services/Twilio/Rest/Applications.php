<?php

class Services_Twilio_Rest_Applications
    extends Services_Twilio_ListResource
{
    public function __construct($resource, $uri) {
        $this->instance_name = 'Application';
        parent::__construct($resource, $uri);
    }

    public function create($name, array $params = array())
    {
        return parent::_create(array(
            'FriendlyName' => $name
        ) + $params);
    }
}
