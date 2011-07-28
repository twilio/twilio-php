===============
 Notifications
===============

Filter Notifications by Log Level
=================================

.. code-block:: php

    $client = new Services_Twilio('AC123', '123');
    foreach ($client->account->notifications->getList(array(
      'log_level' => '0'
    ) as $n) {
      print $n->error_code;
    }
