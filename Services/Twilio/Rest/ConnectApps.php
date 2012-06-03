<?php

class Services_Twilio_Rest_ConnectApps
    extends Services_Twilio_ListResource
{
    public function __construct($resource, $uri) {
        $this->instance_name = 'ConnectApp';
        parent::__construct($resource, $uri);
    }

    public function create($name, array $params = array())
    {
        throw new BadMethodCallException('Not allowed');
    }
}
