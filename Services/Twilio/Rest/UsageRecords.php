<?php

class Services_Twilio_Rest_UsageRecords 
    extends Services_Twilio_TimeRangeResource {

    public function __construct($client, $uri) {
        $uri = preg_replace("#UsageRecords#", "Usage/Records", $uri);
        parent::__construct($client, $uri);
    }

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
}

class Services_Twilio_Rest_Today extends Services_Twilio_TimeRangeResource { } 

class Services_Twilio_Rest_Yesterday extends Services_Twilio_TimeRangeResource { }

class Services_Twilio_Rest_LastMonth extends Services_Twilio_TimeRangeResource { }

class Services_Twilio_Rest_ThisMonth extends Services_Twilio_TimeRangeResource { }

class Services_Twilio_Rest_AllTime extends Services_Twilio_TimeRangeResource { }

class Services_Twilio_Rest_Daily extends Services_Twilio_ListResource { }

class Services_Twilio_Rest_Monthly extends Services_Twilio_ListResource { }

class Services_Twilio_Rest_Yearly extends Services_Twilio_ListResource { }
