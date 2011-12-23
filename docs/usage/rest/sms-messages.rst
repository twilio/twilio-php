=============
SMS Messages
=============

Sending a SMS Message
=====================

The :class:`SmsMessages` resource allows you to send outgoing text messages.

.. code-block:: php

    require('Services/Twilio.php');

    $client = new Services_Twilio('AC123', '123');
    $message = $client->account->sms_messages->create(
      '+14085551234', // From a Twilio number in your account
      '+12125551234', // Text any number
      "Hello monkey!"
    );

    print $message->sid;
