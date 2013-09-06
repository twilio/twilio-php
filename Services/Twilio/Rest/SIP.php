<?php

class Services_Twilio_Rest_SIP extends Services_Twilio_InstanceResource {
    protected function init($client, $uri) {
        $this->setupSubresources(
            'domains',
            'ip_access_control_lists',
            'credential_lists'
        );
    }

    public function getResourceName($camelized = false) {
        return "SIP";
    }

    public static function camelize($name) {
        return 'SIP';
    }
}
