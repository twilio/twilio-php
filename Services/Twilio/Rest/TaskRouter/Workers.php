<?php

class Services_Twilio_Rest_TaskRouter_Workers extends Services_Twilio_TaskRouterListResource {

    public function create($friendlyName, array $params = array()) {
        $params['FriendlyName'] = $friendlyName;
        return parent::_create($params);
    }

	protected function init($client, $uri) {
		$this->setupSubresource('statistics', 'workers_statistics');
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
