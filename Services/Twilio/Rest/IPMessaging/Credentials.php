<?php

class Services_Twilio_Rest_IPMessaging_Credentials extends Services_Twilio_IPMessagingListResource {

    /**
     * Create a new IPMessagingCredential instance
     *
     * Example usage:
     *
     * .. code-block:: php
     *
     *      $ipMessagingClient->credentials->create(array(
     *          "FriendlyName" => "TestCredential",
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
