<?php

class Services_Twilio_Rest_Calls
    extends Services_Twilio_ListResource
{

    public function __construct($resource, $uri) {
        $this->instance_name = 'Call';
        parent::__construct($resource, $uri);
    }

    public static function isApplicationSid($value)
    {
        return strlen($value) == 34
            && !(strpos($value, "AP") === false);
    }

    public function create($from, $to, $url, array $params = array())
    {

        $params["To"] = $to;
        $params["From"] = $from;

        if (self::isApplicationSid($url)) {
            $params["ApplicationSid"] = $url;
        } else {
            $params["Url"] = $url;
        }

        return parent::_create($params);
    }
}
