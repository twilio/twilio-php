<?php

class Services_Twilio_Rest_Conversations_Conversation extends
    Services_Twilio_ConversationsInstanceResource {

    public function init($client, $uri) {
        $filter_types = array('/InProgress', '/Completed');
        $participants_uri = str_replace($filter_types, '', $uri) . '/Participants';
        $this->participants = new Services_Twilio_Rest_Conversations_Participants(
            $this->client, $participants_uri
        );
    }

}
