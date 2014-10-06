<?php

class Services_Twilio_Rest_Wds_Task extends Services_Twilio_WdsInstanceResource {

    protected function init($client, $uri) {
        $this->setupSubresources('reservations');
    }

}
