<?php

class Services_Twilio_Rest_Wds_Tasks extends Services_Twilio_WdsListResource {

    public function create($attributes, $workflowSid) {
        $params['Attributes'] = $attributes;
        $params['WorkflowSid'] = $workflowSid;
        return parent::_create($params);
    }

}
