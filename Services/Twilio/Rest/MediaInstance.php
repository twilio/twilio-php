<?php

class Services_Twilio_Rest_MediaInstance extends Services_Twilio_InstanceResource {

	public function __construct($client, $uri) {
		$uri = str_replace('MediaInstance', 'Media', $uri);
		parent::__construct($client, $uri);
	}
}

