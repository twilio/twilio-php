<?php
class Services_Twilio_Rest_Summary extends Services_Twilio_InstanceResource {

    public function __construct($client, $uri) {
        $this->instance_name = "Services_Twilio_Rest_SummaryInstance";
        return parent::__construct($client, $uri);
    }

    public function get() {
        return new $this->instance_name(
            $this->client, $this->uri
        );
    }

}
