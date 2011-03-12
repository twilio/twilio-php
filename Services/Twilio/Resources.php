<?php

class Accounts extends Services_Twilio_ListResource { }
class Account extends Services_Twilio_InstanceResource { }

class Calls extends Services_Twilio_ListResource {
  public function create($from, $to, $url, array $params = array()) {
    return parent::_create(array(
      'From' => $from,
      'To' => $to,
      'Url' => $url,
    ) + $params);
  }
}

class Call extends Services_Twilio_InstanceResource {
  public function hangup() {
    $this->update('Status', 'completed');
  }
}

class SmsMessages extends Services_Twilio_ListResource {
  public function getSchema() {
    return array(
      'class' => 'SmsMessages',
      'basename' => 'SMS/Messages',
      'instance' => 'SmsMessage',
      'list' => 'sms_messages',
    );
  }
}

class SmsMessage extends Services_Twilio_InstanceResource {
}

class AvailablePhoneNumbers extends Services_Twilio_ListResource {
  public function getLocal($country) {
    $curried = new Services_Twilio_PartialApplicationHelper();
    $curried->set(
      'getList',
      array($this, 'getList'),
      array($country, 'Local')
    );
    return $curried;
  }
  public function getTollFree($country) {
    $curried = new Services_Twilio_PartialApplicationHelper();
    $curried->set(
      'getList',
      array($this, 'getList'),
      array($country, 'TollFree')
    );
    return $curried;
  }
  public function getList($country, $type, array $params = array()) {
    return $this->retrieveData("$country/$type", $params);
  }
}

class AvailablePhoneNumber extends Services_Twilio_InstanceResource {
}

class OutgoingCallerIds extends Services_Twilio_ListResource {
}
class IncomingPhoneNumbers extends Services_Twilio_ListResource {
}
class Conferences extends Services_Twilio_ListResource {
}
class Conference extends Services_Twilio_InstanceResource {
}
class Participants extends Services_Twilio_ListResource {
}
class Participant extends Services_Twilio_InstanceResource {
  public function mute() {
    $this->update('Muted', 'true');
  }
}
class Recordings extends Services_Twilio_ListResource {
}
class Transcriptions extends Services_Twilio_ListResource {
}
class Notifications extends Services_Twilio_ListResource {
}
class Notification extends Services_Twilio_InstanceResource {
}
class Sandbox extends Services_Twilio_InstanceResource {
}

// vim: ai ts=2 sw=2 noet sta
