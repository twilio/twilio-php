<?php

class Services_Twilio_Rest_Participant
    extends Services_Twilio_InstanceResource
{
    public function mute()
    {
        $this->update('Muted', 'true');
    }

    public function getCallSid()
    {
        return $this->_params->call_sid;
    }
}
