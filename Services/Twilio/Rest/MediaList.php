<?php

class Services_Twilio_Rest_MediaList
	extends Services_Twilio_ListResource
{
	protected $instance_name = 'Services_Twilio_Rest_Media';

	public function __construct($client, $uri) {
		$uri = str_replace('MediaList', 'Media', $uri);
		parent::__construct($client, $uri);
	}

}
