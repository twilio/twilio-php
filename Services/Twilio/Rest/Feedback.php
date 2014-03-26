<?php

class Services_Twilio_Rest_Feedback extends Services_Twilio_ListResource {

    public function __construct($client, $uri) {
        $this->instance_name = "Services_Twilio_Rest_FeedbackInstance";
        return parent::__construct($client, $uri);
    }

    /**
     * Create feedback for the parent call
     */
    public function create(array $params = array()) {
        return parent::_create($params);
    }

    /**
     * Fetch the feedback for the parent call
     */
    public function get() {
        return new $this->instance_name(
            $this->client, $this->uri
        );
    }

}

class Services_Twilio_Rest_FeedbackInstance extends Services_Twilio_InstanceResource { }
