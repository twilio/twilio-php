<?php

class Services_Twilio_Rest_Messages extends Services_Twilio_ListResource {

    /**
     * Create a new Message resource
     *
     * This function takes a single argument, an array of keys and values
     */
    public function create(array $params = array()) {
        return parent::_create($params);
    }

    /**
     * Send an SMS message
     *
     * @return Services_Twilio_Rest_Message The created SMS
     * @throws Services_Twilio_RestException An exception if the parameters are
     *      invalid (for example, the from number is not a Twilio number
     *      registered to your account)
     */
    function sendSms($from, $to, $body, array $params = array()) {
        return self::create(array(
            'From' => $from,
            'To' => $to,
            'Body' => $body,
        ) + $params);
    }

    /**
     * Send an MMS message
     *
     * @param string|array $mediaUrls the URLs of images to send in this MMS
     * @param string $body the text to include along with this MMS
     *
     * @return Services_Twilio_Rest_Message The created MMS message
     * @throws Services_Twilio_RestException An exception if the parameters are
     *      invalid (for example, the from number is not a Twilio number
     *      registered to your account, or is unable to send MMS)
     */
    function sendMms($from, $to, $mediaUrls, $body = null,
        array $params = array()
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
