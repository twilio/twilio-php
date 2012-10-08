<?php

class Services_Twilio_Rest_UsageRecords extends Services_Twilio_ListResource {

    public function init($client, $uri) {
        $this->setupSubresources(
            'today',
            'yesterday',
            'all_time',
            'this_month',
            'last_month',
            'daily',
            'monthly',
            'yearly'
        );
    }

    public function __construct($client, $uri) {
        $uri = preg_replace('#UsageRecords#', 'Usage/Records', $uri);
        parent::__construct($client, $uri);
    }
}

