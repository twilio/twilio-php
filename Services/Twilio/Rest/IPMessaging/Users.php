<?php

class Services_Twilio_Rest_IPMessaging_Users extends Services_Twilio_IPMessagingListResource {

    /**
     * Create a new User instance
     *
     * Example usage:
     *
     * .. code-block:: php
     *
     *      $ipMessagingClient->credentials->create(array(
     *          "FriendlyName" => "TestUser",
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
