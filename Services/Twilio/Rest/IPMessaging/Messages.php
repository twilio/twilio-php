<?php

class Services_Twilio_Rest_IPMessaging_Messages extends Services_Twilio_IPMessagingListResource {

    /**
     * Create a new Message instance
     *
     * Example usage:
     *
     * .. code-block:: php
     *
     *      $ipMessagingClient->channels->get('CH123')->messages->create(array(
     *          "Body" => "TestMessage",
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
