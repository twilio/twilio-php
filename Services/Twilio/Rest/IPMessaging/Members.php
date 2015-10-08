<?php

class Services_Twilio_Rest_IPMessaging_Members extends Services_Twilio_IPMessagingListResource {

    /**
     * Create a new Member instance
     *
     * Example usage:
     *
     * .. code-block:: php
     *
     *      $ipMessagingClient->channels->get('CH123')->members->create(array(
     *          "FriendlyName" => "TestMember",
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
