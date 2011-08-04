===============
 Notifications
===============

Filter Notifications by Log Level
=================================

.. code-block:: php

    $client = new Services_Twilio('AC123', '123');
    foreach ($client->account->notifications as $n) {
      print $n->error_code;
    }
