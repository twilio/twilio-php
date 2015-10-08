<?php

class Services_Twilio_Rest_IPMessaging_Channels extends Services_Twilio_IPMessagingListResource {

    /**
     * Create a new Channel instance
     *
     * Example usage:
     *
     * .. code-block:: php
     *
     *      $ipMessagingClient->services->get('SV123')->channels->create(array(
     *          "FriendlyName" => "TestChannel",
     *      ));
     *
     * :param array $params: a single array of parameters which is serialized and
     *      sent directly to the Twilio API.
     *
     */
    public function create($params = array()) {
        return parent::_create($params);
    }
}
