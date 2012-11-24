<?php

class Services_Twilio_Rest_IncomingPhoneNumbers
    extends Services_Twilio_ListResource
{
    function create(array $params = array()) {
        return parent::_create($params);
    }

    /**
     * Return a phone number instance from its E.164 representation. If more
     * than one number matches the search string, returns the first one.
     *
     * @param string $number The number in E.164 format, eg "+684105551234"
     * @return Services_Twilio_Rest_IncomingPhoneNumber|null The number object, 
     *      or null
     * 
     * @throws Services_Twilio_RestException if the number is invalid, not 
     *      provided in E.164 format or for any other API exception.
     */
    public function getNumber($number) {
        $page = $this->getPage(0, 1, array(
            'PhoneNumber' => $number
        ));
        $items = $page->getItems();
        if (is_null($items) || empty($items)) {
            return null;
        }
        return $items[0];
    }
}
