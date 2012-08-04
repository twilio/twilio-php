<?php

class Services_Twilio_Rest_Members
    extends Services_Twilio_ListResource
{
    /**
     * Return the member at the front of the queue.
     *
     * @return Services_Twilio_Rest_Member The member at the front of the queue
     */
    public function front() {
        return new $this->instance_name($this->client, $this->uri . "/Front");
    }

    /* Participants are identified by CallSid, not like ME123 */
    public function getObjectFromJson($params, $idParam = "sid") {
        return parent::getObjectFromJson($params, "call_sid");
    }
}

