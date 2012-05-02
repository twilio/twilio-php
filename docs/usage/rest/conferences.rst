=============
 Conferences
=============

List All Conferences
====================

.. code-block:: php

    $client = new Services_Twilio('AC123', '123');
    foreach ($client->account->conferences as $conference) {
        print $conference->friendly_name;
    }

For a full list of properties available on a conference, as well as a full list
of ways to filter a conference, please see the `Conference API Documentation
<http://www.twilio.com/docs/api/rest/conference>`_ on our website.

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
