<?php

class Services_Twilio_Rest_Messaging_Service extends Services_Twilio_MessagingInstanceResource {
    protected function init($client, $uri) {
        $this->setupSubresources(
            'channels',
            'roles',
            'users'
        );
    }
}
