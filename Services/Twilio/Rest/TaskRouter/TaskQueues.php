<?php

class Services_Twilio_Rest_TaskRouter_TaskQueues extends Services_Twilio_TaskRouterListResource {

    public function create($friendlyName, $assignmentActivitySid, $reservationActivitySid, array $params = array()) {
        $params['FriendlyName'] = $friendlyName;
        $params['AssignmentActivitySid'] = $assignmentActivitySid;
        $params['ReservationActivitySid'] = $reservationActivitySid;
        return parent::_create($params);
    }

	protected function init($client, $uri) {
		$this->setupSubresource('statistics', 'task_queues_statistics');
	}

	protected function setupSubresource($name, $type) {
		$constantizedType = ucfirst(self::camelize($type));
		$constantizedName = ucfirst(self::camelize($name));
		$type = "Services_Twilio_Rest_TaskRouter_" . $constantizedType;
		$this->subresources[$name] = new $type(
			$this->client, $this->uri . "/". $constantizedName
		);
	}
}
