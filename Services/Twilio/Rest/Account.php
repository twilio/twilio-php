<?php

class Services_Twilio_Rest_Account
    extends Services_Twilio_InstanceResource
{
    protected function init()
    {
        $this->setupSubresources(
            'available_phone_numbers',
            'calls',
            'conferences',
            'incoming_phone_numbers',
            'notifications',
            'outgoing_callerids',
            'recordings',
            'sandbox',
            'sms_messages',
            'transcriptions'
        );
    }
}
