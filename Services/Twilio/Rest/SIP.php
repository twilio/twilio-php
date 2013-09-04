<?php

class Services_Twilio_Rest_SIP extends Services_Twilio_InstanceResource {
    protected function init($client, $uri) {
        $this->setupSubresources(
            'domains',
            'ip_access_control_lists',
            'credential_lists'
        );
    }

}
