<?php

class Services_Twilio_Rest_TaskRouter_Tasks extends Services_Twilio_TaskRouterListResource {

    public function create($attributes, $workflowSid) {
        $params['Attributes'] = $attributes;
        $params['WorkflowSid'] = $workflowSid;
        return parent::_create($params);
    }

}
