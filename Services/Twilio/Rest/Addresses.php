<?php

class Services_Twilio_Rest_Addresses
    extends Services_Twilio_ListResource
{

    public function __construct($client, $uri) {
        $this->instance_name = "Services_Twilio_Rest_Address";
        parent::__construct($client, $uri);
    }

    /**
     * Create a new address.
     *
     * :param string $customerName: Your name or business name, or that of your customer.
     * :param string $street: The number and street address where you or your customer is located.
     * :param string $city: The city in which you or your customer is located.
     * :param string $region: The state or region in which you or your customer is located.
     * :param string $postalCode: The postal code in which you or your customer is located.
     * :param string $isoCountry: The ISO country code of your or your customer's address.
     * :param array $params: An array of optional parameters describing the new
     *      address. The ``$params`` array can contain the following keys:
     *
     *      *FriendlyName*
     *          A human-readable description of the new address. Maximum 64 characters.
     *
     * :returns: The new address
     * :rtype: :php:class:`Services_Twilio_Rest_Address`
     *
     */
    public function create($customerName, $street, $city, $region, $postalCode, $isoCountry, $params = array()) {
        return parent::_create(array(
            'CustomerName' => $customerName,
            'Street' => $street,
            'City' => $city,
            'Region' => $region,
            'PostalCode' => $postalCode,
            'IsoCountry' => $isoCountry,
        ) + $params);
    }
}
