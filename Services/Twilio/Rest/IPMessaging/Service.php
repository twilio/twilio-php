<?php

class Services_Twilio_Rest_IPMessaging_Service extends Services_Twilio_IPMessagingInstanceResource {
    protected function init($client, $uri) {
        $this->setupSubresources(
            'channels',
            'roles',
            'users'
        );
    }
}
