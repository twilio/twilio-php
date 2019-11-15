<?php


abstract class Obsolete_Service_Twilio {

    public function __construct($sid, $token, $version = null, $http = null, $retryAttempts = 1) {
        $name = \get_class($this);
        \trigger_error($name . ' has been removed from this version of the library. Please refer to https://www.twilio.com/docs/libraries/php for more information.', E_USER_WARNING);
    }

}


class Services_Twilio extends Obsolete_Service_Twilio {

    public function __construct($sid, $token, $version = null, $http = null, $retryAttempts = 1) {
        parent::__construct($sid, $token, $version, $http, $retryAttempts);
    }

}


class TaskRouter_Services_Twilio extends Obsolete_Service_Twilio {

    public function __construct($sid, $token, $workspaceSid, $version = null, $http = null, $retryAttempts = 1) {
        parent::__construct($sid, $token, $version, $http, $retryAttempts);
    }

}


class Lookups_Services_Twilio extends Obsolete_Service_Twilio {

    public function __construct($sid, $token, $version = null, $http = null, $retryAttempts = 1) {
        parent::__construct($sid, $token, $version, $http, $retryAttempts);
    }

}


class Pricing_Services_Twilio extends Obsolete_Service_Twilio {

    public function __construct($sid, $token, $version = null, $http = null, $retryAttempts = 1) {
        parent::__construct($sid, $token, $version, $http, $retryAttempts);
    }

}


class Monitor_Services_Twilio extends Obsolete_Service_Twilio {

    public function __construct($sid, $token, $version = null, $http = null, $retryAttempts = 1) {
        parent::__construct($sid, $token, $version, $http, $retryAttempts);
    }

}


class Trunking_Services_Twilio extends Obsolete_Service_Twilio {

    public function __construct($sid, $token, $version = null, $http = null, $retryAttempts = 1) {
        parent::__construct($sid, $token, $version, $http, $retryAttempts);
    }

}


class IPMessaging_Services_Twilio extends Obsolete_Service_Twilio {

    public function __construct($sid, $token, $version = null, $http = null, $retryAttempts = 1) {
        parent::__construct($sid, $token, $version, $http, $retryAttempts);
    }

}
