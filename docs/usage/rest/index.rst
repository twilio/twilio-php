REST API Usage
>>>>>>>>>>>>>>>

Filter Conferences by Status
---------------------------------

.. code-block:: php

    $client = new Services_Twilio('AC123', '123');
    foreach ($client->account->conferences->getList(array(
      'status' => 'in-progress'
    )) as $conf) {
      print $conf->sid;
    }

Mute all participants
----------------------

.. code-block:: php

    $sid = "CO119231312"
    $client = new Services_Twilio('AC123', '123');
    foreach ($client->account->conferences->get($sid)->participants as $p) {
      $p->mute();
    }

Notifications
=================

Filter Notifications by Log Level
---------------------------------

.. code-block:: php

    $client = new Services_Twilio('AC123', '123');
    foreach ($client->account->notifications->getList(array(
      'log_level' => '0'
    ) as $n) {
      print $n->error_code;
    }

SMS Mesages
==============

Sending a SMS Message
----------------------

The :class:`SmsMessages` resource allows you to send outgoing text messages

.. code-block:: php

    $client = new Services_Twilio('AC123', '123');
    $message = $client->account->sms_messages->create(
      '9991231234', // From this number
      '8881231234', // Text this number
      "Hello monkey!"
    );

    print $message->sid;

Transcriptions
=================

Show all Transcribed Messagse
---------------------------------

.. code-block:: php

    $client = new Services_Twilio('AC123', '123');
    foreach ($client->account->transcriptions as $t) {
      print $t->transcription_text;
    }
