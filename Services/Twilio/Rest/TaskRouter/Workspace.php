<?php

class Services_Twilio_Rest_TaskRouter_Workspace extends Services_Twilio_TaskRouterInstanceResource {

    protected function init($client, $uri)
    {
        $this->setupSubresources(
            'activities',
            'events',
            'tasks',
            'task_queues',
            'workers',
            'workflows'
        );
		$this->setupSubresource('statistics', 'workspace_statistics');
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
