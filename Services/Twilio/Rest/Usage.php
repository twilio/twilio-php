<?php

class Services_Twilio_Rest_Usage extends Services_Twilio_InstanceResource {

    protected function init($client, $uri) {
        $this->setupSubresources(
            'triggers',
            'records'
        );
    }
}

