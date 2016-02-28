<?php

class Services_Twilio_Rest_ShortCodes
    extends Services_Twilio_ListResource
{
    public function __construct($client, $uri) {
        $uri = preg_replace("#ShortCodes#", "SMS/ShortCodes", $uri);
        parent::__construct($client, $uri);
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
