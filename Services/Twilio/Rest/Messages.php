<?php

class Services_Twilio_Rest_Messages extends Services_Twilio_ListResource {

    /**
     * Create a new Message instance
     *
     * Example usage:
     *
     *  .. code-block:: php
     *
     *      $client->account->messages->create(array("Body" => "foo", ...));
     *
     * :param array params: a single array of parameters which is serialized and
     *      sent directly to the Twilio API. You may find it easier to use the
     *      sendSms or sendMms helpers instead of this library.
     *
     */
    public function create($params = array()) {
        return parent::_create($params);
    }

    /**
     * Send an SMS message
     *
     *  .. code-block:: php
     *
     *      $client = new Services_Twilio('AC123', '123');
     *      $message = $client->account->messages->sendSms(
     *          '+14085551234', // From a Twilio number in your account
     *          '+12125551234', // Text any number
     *          'Hello monkey!',  // Message body
     *      ));
     *
     * :param string $from: the from number for the message, this must be a
     *      number you purchased from Twilio
     * :param string $to: the message recipient's phone number
     * :param string $body: the text to include along with this MMS
     * :param array $params: Any additional params (callback, etc) you'd like to
     *      send with this request, these are serialized and sent as POST
     *      parameters
     *
     * :returns: The created SMS
     * :returntype: :php:class:`Services_Twilio_Rest_Message`
     * :exception: :php:class:`Services_Twilio_RestException`
     *      An exception if the parameters are
     *      invalid (for example, the from number is not a Twilio number
     *      registered to your account)
     */
    public function sendSms($from, $to, $body, $params = array()) {
        return self::create(array(
            'From' => $from,
            'To' => $to,
            'Body' => $body,
        ) + $params);
    }

    /**
     * Send an MMS message
     *
     *  .. code-block:: php
     *
     *      $client = new Services_Twilio('AC123', '123');
     *      $message = $client->account->messages->sendMms(
     *          '+14085551234', // From a Twilio number in your account
     *          '+12125551234', // Text any number
     *          array('http://example.com/image.jpg'),    // An array of MediaUrls
     *          'Hello monkey!',                          // Message body (if any)
     *      ));
     *
     * :param string $from: the from number for the message, this must be a
     *      number you purchased from Twilio
     * :param string $to: the message recipient's phone number
     * :param string|array $mediaUrls: the URLs of images to send in this MMS
     * :param string $body: the text to include along with this MMS
     * :param array $params: Any additional params (callback, etc) you'd like to
     *      send with this request, these are serialized and sent as POST
     *      parameters
     *
     * :return: :php:class:`Services_Twilio_Rest_Message` The created MMS message
     * :exception: :php:class:`Services_Twilio_RestException`
     *      An exception if the parameters are invalid (for example, the from
     *      number is not a Twilio number registered to your account, or is
     *      unable to send MMS)
     */
    public function sendMms($from, $to, $mediaUrls, $body = null,
        $params = array()
    ) {
        $postParams = array(
            'From' => $from,
            'To' => $to,
            'MediaUrl' => $mediaUrls,
        );
        if (!is_null($body)) {
            $postParams['Body'] = $body;
        }
        return self::create($postParams + $params);
    }
}
