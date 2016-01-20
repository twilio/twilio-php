<?php

class Services_Twilio_Rest_Addresses
    extends Services_Twilio_ListResource
{
    public function create($customerName, $street, $city, $region, $postalCode, $isoCountry, array $params = array())
    {
        $params["CustomerName"] = $customerName;
        $params["Street"] = $street;
        $params["City"] = $city;
        $params["Region"] = $region;
        $params["PostalCode"] = $postalCode;
        $params["IsoCountry"] = $isoCountry;

        return parent::_create($params);
    }
}
