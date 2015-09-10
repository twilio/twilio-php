<?php

class Services_Twilio_Rest_Messaging_Users extends Services_Twilio_MessagingListResource {

    /**
     * Create a new User instance
     *
     * Example usage:
     *
     * .. code-block:: php
     *
     *      $messagingClient->credentials->create(array(
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
