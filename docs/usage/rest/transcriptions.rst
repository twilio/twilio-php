================
Transcriptions
================

Show all Transcribed Messagse
=============================

.. code-block:: php

    $client = new Services_Twilio('AC123', '123');
    foreach ($client->account->transcriptions as $t) {
      print $t->transcription_text;
    }
