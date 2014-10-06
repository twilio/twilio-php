<?php

class Services_Twilio_Rest_Wds_TaskQueues extends Services_Twilio_WdsListResource {

    public function create($friendlyName, $assignmentActivitySid, $reservationActivitySid, array $params = array()) {
        $params['FriendlyName'] = $friendlyName;
        $params['AssignmentActivitySid'] = $assignmentActivitySid;
        $params['ReservationActivitySid'] = $reservationActivitySid;
        return parent::_create($params);
    }
}
