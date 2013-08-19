=============
Messages
=============

Sending a Message
=====================

The :class:`Messages` resource allows you to send outgoing messages.

.. code-block:: php

    require('/path/to/twilio-php/Services/Twilio.php');

    $client = new Services_Twilio('AC123', '123');
    $message = $client->account->messages->create(
      '+14085551234', // From a Twilio number in your account
      '+12125551234', // Text any number
      array('Body' => 'Hello monkey!', // At least one of these parameters
                                       // is required
            'ContentUrls' => array('http://example.com/image.jpg')
    ));

    print $message->sid;

Listing Messages
====================

It's easy to iterate over your messages.

.. code-block:: php

    $client = new Services_Twilio('AC123', '123');
    foreach ($client->account->messages as $message) {
        echo "From: {$message->from}\nTo: {$message->to}\nBody: " . $message->body;
    }

Filtering Messages
======================

Let's say you want to find all of the messages that have been sent from
a particular number. You can do so by constructing an iterator explicitly:

.. code-block:: php

    $client = new Services_Twilio('AC123', '123');
    foreach ($client->account->messages->getIterator(0, 50, array(
        'From' => '+14105551234',
    )) as $message) {
        echo "From: {$message->from}\nTo: {$message->to}\nBody: " . $message->body;
    }
