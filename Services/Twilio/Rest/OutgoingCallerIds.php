<?php

class Services_Twilio_Rest_OutgoingCallerIds
    extends Services_Twilio_ListResource
{
    public function create($phoneNumber, array $params = array())
    {
        return parent::_create(array(
            'PhoneNumber' => $phoneNumber,
        ) + $params);
    }

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
