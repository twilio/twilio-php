<?php

class Services_Twilio_Accounts extends Services_Twilio_ListResource { }
class Services_Twilio_Account extends Services_Twilio_InstanceResource { }

class Services_Twilio_Calls extends Services_Twilio_ListResource
{
    public function create($from, $to, $url, array $params = array())
    {
        return parent::_create(array(
            'From' => $from,
            'To' => $to,
            'Url' => $url,
        ) + $params);
    }
}

class Services_Twilio_Call extends Services_Twilio_InstanceResource
{
    public function hangup()
    {
        $this->update('Status', 'completed');
    }
}

class Services_Twilio_SmsMessages extends Services_Twilio_ListResource
{
    public function getSchema()
    {
        return array(
            'class' => 'Services_Twilio_SmsMessages',
            'basename' => 'SMS/Messages',
            'instance' => 'Services_Twilio_SmsMessage',
            'list' => 'sms_messages',
        );
    }
}

class Services_Twilio_SmsMessage extends Services_Twilio_InstanceResource { }

class Services_Twilio_AvailablePhoneNumbers extends Services_Twilio_ListResource
{
    public function getLocal($country)
    {
        $curried = new Services_Twilio_PartialApplicationHelper();
        $curried->set(
            'getList',
            array($this, 'getList'),
            array($country, 'Local')
        );
        return $curried;
    }
    public function getTollFree($country)
    {
        $curried = new Services_Twilio_PartialApplicationHelper();
        $curried->set(
            'getList',
            array($this, 'getList'),
            array($country, 'TollFree')
        );
        return $curried;
    }
    public function getList($country, $type, array $params = array())
    {
        return $this->retrieveData("$country/$type", $params);
    }
}

class Services_Twilio_AvailablePhoneNumber extends Services_Twilio_InstanceResource { }

class Services_Twilio_OutgoingCallerIds extends Services_Twilio_ListResource { }
class Services_Twilio_IncomingPhoneNumbers extends Services_Twilio_ListResource { }
class Services_Twilio_Conferences extends Services_Twilio_ListResource { }
class Services_Twilio_Conference extends Services_Twilio_InstanceResource { }
class Services_Twilio_Participants extends Services_Twilio_ListResource { }
class Services_Twilio_Participant extends Services_Twilio_InstanceResource {
    public function mute()
    {
        $this->update('Muted', 'true');
    }
}
class Services_Twilio_Recordings extends Services_Twilio_ListResource { }
class Services_Twilio_Transcriptions extends Services_Twilio_ListResource { }
class Services_Twilio_Notifications extends Services_Twilio_ListResource { }
class Services_Twilio_Notification extends Services_Twilio_InstanceResource { }
class Services_Twilio_Sandbox extends Services_Twilio_InstanceResource { }

