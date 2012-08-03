<?php

class Services_Twilio_Rest_Members
    extends Services_Twilio_ListResource
{
    public function front() {
        return new $this->instance_name($this->client, $this->uri . "/Front");
    }

    /* Participants are identified by CallSid, not like ME123 */
    public function getObjectFromJson($params, $idParam = "sid") {
        return parent::getObjectFromJson($params, "call_sid");
    }
}

