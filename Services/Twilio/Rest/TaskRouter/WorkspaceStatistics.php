<?php

class Services_Twilio_Rest_TaskRouter_WorkspaceStatistics extends Services_Twilio_TaskRouterInstanceResource
{
	public function get($filters = array()) {
		return $this->client->retrieveData($this->uri, $filters);
	}
}
