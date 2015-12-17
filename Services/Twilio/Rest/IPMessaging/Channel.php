<?php

class Services_Twilio_Rest_IPMessaging_Channel extends Services_Twilio_IPMessagingInstanceResource {
    protected function init($client, $uri) {
        $this->setupSubresources(
            'members',
            'messages'
        );
    }
}
