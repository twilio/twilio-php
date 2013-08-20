<?php

class Services_Twilio_Rest_Message
    extends Services_Twilio_InstanceResource
{
    protected function init($client, $uri) {
        $this->setupSubresources(
            'media_list'
        );
    }
}
