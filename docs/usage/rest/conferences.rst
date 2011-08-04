=============
 Conferences
=============

Filter Conferences by Status
============================

.. code-block:: php

    $client = new Services_Twilio('AC123', '123');
    foreach ($client->account->conferences->getIterator(0, 50, array(
      'Status' => 'in-progress'
    )) as $conf) {
      print $conf->sid;
    }

Mute all participants
=====================

.. code-block:: php

    $sid = "CO119231312"
    $client = new Services_Twilio('AC123', '123');
    foreach ($client->account->conferences->get($sid)->participants as $p) {
      $p->mute();
    }
