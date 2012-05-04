=================
 Phone Numbers
=================

Purchasing phone numbers is a two step process. 

Searching For a Number
----------------------

First, we need to search for an available phone number. Use the
:php:meth:`Services_Twilio_Rest_AvailablePhoneNumbers::getList` method of the
:php:class:`Services_Twilio_Rest_AvailablePhoneNumbers` list resource.

.. code-block:: php

    $accountSid = 'AC1234567890abcdef1234567890a';
    $authToken = 'abcdef1234567890abcdefabcde9';

    $client = new Services_Twilio($accountSid, $authToken);
    $numbers = $client->account->available_phone_numbers->getList('US', 'TollFree');
    foreach($numbers->available_phone_numbers as $number) {
        echo 'Number: ' + $number->phone_number + "\n";
    }
    
You can also pass in parameters, to search for phone numbers in a certain area
code, or which contain a certain pattern.

.. code-block:: php

    $accountSid = 'AC1234567890abcdef1234567890a';
    $authToken = 'abcdef1234567890abcdefabcde9';

    $client = new Services_Twilio($accountSid, $authToken);

    // Full parameter documentation at http://www.twilio.com/docs/api/rest/available-phone-numbers#local
    $params = array('AreaCode' => '925', 'Contains' => 'hi');
    $numbers = $client->account->available_phone_numbers->getList('US', 'Local', $params);
    foreach($numbers->available_phone_numbers as $number) {
        echo 'Number: ' + $number->phone_number + "\n";
    }

Buying a Number
---------------

Once you have a phone number, purchase it by creating a new
:php:class:`Services_Twilio_Rest_IncomingPhoneNumber` instance.

    
.. code-block:: php

    $accountSid = 'AC1234567890abcdef1234567890a';
    $authToken = 'abcdef1234567890abcdefabcde9';

    $client = new Services_Twilio($accountSid, $authToken);

    $phoneNumber = '+44XXXYYYZZZZ';
    $purchasedNumber = $client->account->incoming_phone_numbers->create(array('PhoneNumber' => $phoneNumber));

    echo $purchasedNumber->sid;
    
Tying the two together, you can search for a number, and then purchase it.

.. code-block:: php

    $accountSid = 'AC1234567890abcdef1234567890a';
    $authToken = 'abcdef1234567890abcdefabcde9';

    $client = new Services_Twilio($accountSid, $authToken);

    // Full parameter documentation at http://www.twilio.com/docs/api/rest/available-phone-numbers#local
    $params = array('AreaCode' => '800', 'Contains' => 'hi');

    $numbers = $client->account->available_phone_numbers->getList('CA', 'TollFree', $params);
    $firstNumber = $numbers->available_phone_numbers[0]->phone_number;
    $purchasedNumber = $client->account->incoming_phone_numbers->create(array('PhoneNumber' => $firstNumber));

    echo $purchasedNumber->sid;

You can also purchase a random number with a given area code (US/Canada only):

.. code-block:: php

    $accountSid = 'AC1234567890abcdef1234567890a';
    $authToken = 'abcdef1234567890abcdefabcde9';

    $client = new Services_Twilio($accountSid, $authToken);
    $purchasedNumber = $client->account->incoming_phone_numbers->create(array('AreaCode' => '925'));

    echo $purchasedNumber->sid;

Updating a Number
-----------------

You can easily update any of the properties of your
phone number. A full list of parameters is available
in the `Incoming Phone Number REST API Documentation.
<http://www.twilio.com/docs/api/rest/incoming-phone-numbers#instance-post>`_

.. code-block:: php

    $accountSid = 'AC1234567890abcdef1234567890a';
    $authToken = 'abcdef1234567890abcdefabcde9';

    $client = new Services_Twilio($accountSid, $authToken);
    $numbers = $client->account->incoming_phone_numbers;
    foreach ($numbers as $number) {
        $number->update(array('VoiceMethod' => 'POST'));
    }

Deleting a Number
-----------------

You can delete numbers by specifying the Sid of the phone number you'd like to
delete, from the incoming phone numbers object.

.. code-block:: php

    $accountSid = 'AC1234567890abcdef1234567890a';
    $authToken = 'abcdef1234567890abcdefabcde9';

    $client = new Services_Twilio($accountSid, $authToken);
    $number = $client->account->incoming_phone_numbers;
    foreach($numbers as $number) {
        // Delete just the first number, then quit.
        $client->account->incoming_phone_numbers->delete($number->sid);
        break;
    }

