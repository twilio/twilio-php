<?php

class Services_Twilio_Rest_Messaging_Services extends Services_Twilio_MessagingListResource {

    /**
     * Create a new MessagingService instance
     *
     * Example usage:
     *
     * .. code-block:: php
     *
     *      $messagingClient->services->create(array(
     *          "Ttl" => 100,
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
