<?php

class Services_Twilio_Rest_Call
    extends Services_Twilio_InstanceResource
{
    public function hangup()
    {
        $this->update('Status', 'completed');
    }

    public function route($url) {
        $this->update('Url', $url);
    }

    protected function init($client, $uri)
    {
        $this->setupSubresources(
            'notifications',
            'recordings'
        );
    }
}
