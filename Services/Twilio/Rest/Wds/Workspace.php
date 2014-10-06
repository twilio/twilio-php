<?php

class Services_Twilio_Rest_Wds_Workspace extends Services_Twilio_WdsInstanceResource {

    protected function init($client, $uri)
    {
        $this->setupSubresources(
            'activities',
            'tasks',
            'task_queues',
            'workers',
            'workflows'
        );
    }
}
