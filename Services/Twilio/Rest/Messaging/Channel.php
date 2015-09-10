<?php

class Services_Twilio_Rest_Messaging_Channel extends Services_Twilio_MessagingInstanceResource {
    protected function init($client, $uri) {
        $this->setupSubresources(
            'members',
            'messages'
        );
    }
}
