<?php

class Services_Twilio_Rest_Addresses
    extends Services_Twilio_ListResource
{

	public function create($customerName, $street, $city, $region, $postalCode, $isoCountry,$friendlyName = null) {
		$params = array(
				'CustomerName' => $customerName,
				'Street' => $street,
				'City' => $city,
				'Region' => $region,
				'PostalCode' => $postalCode,
				'IsoCountry' => $isoCountry,
		);
		if (!is_null($friendlyName)) {
			$params['FriendlyName'] = $friendlyName;
		}
		return parent::_create($params);
	}
}
