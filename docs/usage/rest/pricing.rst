.. _ref-rest:

============================
Using the Twilio Pricing API
============================

The Twilio Pricing API works similarly to the main Twilio REST API,
but is located on a new domain: `pricing.twilio.com`.

The Pricing API is accessible through a new :php:class:`Pricing_Services_Twilio`
class that works much like the :php:class:`Services_Twilio` object you already
use for the main Twilio REST API.

Creating a Pricing Client
=========================

.. code-block:: php

    $ACCOUNT_SID = "AC123";
    $AUTH_TOKEN = "secret";
    $client = new Pricing_Services_Twilio($ACCOUNT_SID, $AUTH_TOKEN);

Accessing Resources
===================

The Pricing API resources function similarly to those available in the main
Twilio API. For basic examples, see :doc:`/usage/rest`.

Voice Pricing
=============

Twilio Voice pricing is available by country and by phone number.

Voice calls are priced per minute and reflect the current Twilio list
price as well as any discounts available for your account at the time
you request pricing information.

Voice Countries
---------------

To retrieve a list of countries where Twilio voice services are available:

.. code-block:: php

    $ACCOUNT_SID = "AC123";
    $AUTH_TOKEN = "secret";
    $client = new Pricing_Services_Twilio($ACCOUNT_SID, $AUTH_TOKEN);

    $countryList = $client->voiceCountries->getPage();
    foreach ($countryList->countries as $c) {
        echo $c->isoCountry . "\n";
    }

Note that the country objects in the returned list will not have pricing
information populated; you will need to retrieve the specific information
for each country you are interested in individually:

.. code-block:: php

    $ACCOUNT_SID = "AC123";
    $AUTH_TOKEN = "secret";
    $client = new Pricing_Services_Twilio($ACCOUNT_SID, $AUTH_TOKEN);

    $country = $client->voiceCountries->get("GB");
    echo $country->iso_country . "\n";
    echo $country->price_unit . "\n";

    foreach ($country->outbound_prefix_prices as $price) {
        // Price per minute before discounts
        echo $price->base_price . "\n";
        // Price per minute after applying any discounts available
        // to your account
        echo $price->current_price . "\n";
        // Prefixes of phone numbers to which these rates apply
        foreach ($price->prefixes as $prefix) {
            echo $prefix . "\n";
        }
    }

Voice Numbers
-------------

To retrieve pricing information for calls to and from a specific phone number:

.. code-block:: php

    $ACCOUNT_SID = "AC123";
    $AUTH_TOKEN = "secret";
    $client = new Pricing_Services_Twilio($ACCOUNT_SID, $AUTH_TOKEN);

    $number = $client->voiceNumbers->get("+15105551234");
    echo $number->price_unit . "\n";
    echo $number->outbound_call_price->call_base_price . "\n";
    // $number->inbound_call_price is only set for Twilio-hosted numbers
    echo $number->inbound_call_price->call_base_price . "\n";

Phone Number Pricing
====================

Twilio Phone Numbers are priced per month.

To retrieve a list of countries where Twilio Numbers are available:

.. code-block:: php

    $ACCOUNT_SID = "AC123";
    $AUTH_TOKEN = "secret";
    $client = new Pricing_Services_Twilio($ACCOUNT_SID, $AUTH_TOKEN);

    $countryList = $client->phoneNumberCountries->getPage();
    foreach ($countryList->countries as $c) {
        echo $c->iso_country . "\n";
    }

Note that the country objects in the returned list will not have pricing
information populated; you will need to retrieve the specific information
for each country you are interested in individually:

.. code-block:: php

    $ACCOUNT_SID = "AC123";
    $AUTH_TOKEN = "secret";
    $client = new Pricing_Services_Twilio($ACCOUNT_SID, $AUTH_TOKEN);

    $country = $client->phoneNumberCountries->get("GB");
    echo $country->price_unit . "\n";

    foreach ($country->phone_number_prices as $p) {
        // "mobile", "toll_free", "local", or "national"
        echo $p->number_type . "\n";
        // Number price per month before discounts
        echo $p->base_price . "\n";
        // Number price per month after available discounts for your
        // account have been applied
        echo $p->current_price . "\n";
    }

