=============
 Phone Calls
=============

Making a Phone Call
===================

The :class:`Calls` resource allows you to make outgoing calls:

.. code-block:: php

    $client = new Services_Twilio('AC123', '123');
    $call = $client->account->calls->create(
      '9991231234', // From this number
      '8881231234', // Call this number
      'http://foo.com/call.xml'
    );
    print $call->length;
    print $call->sid;

Accessing Resources from a specific Call
========================================

The :class:`Call` resource has some sub resources you can access, such as
notifications and recordings. If you have already have a :class:`Call`
resource, they are easy to get.:

.. code-block:: php

    $client = new Services_Twilio('AC123', '123');
    foreach ($client->account->calls as $call) {
      $notifications = $call->notifications;
      if (is_array($notifications)) {
        foreach ($notifications as $notification) {
          print $notification->sid;
        }
      }

      $transcriptions = $call->transcriptions;
      if (is_array($transcriptions)) {
        foreach ($transcriptions as $transcription) {
          print $transcription->sid;
        }
      }

      $recordings = $call->recordings;
      if (is_array($recordings)) {
        foreach ($recordings as $recording) {
          print $recording->sid;
        }
      }
    }

Be careful, as the above code makes quite a few HTTP requests and display 
numerous PHP warnings for unintialized variables.

Retrieve a Call Record
======================

If you already have a :class:`Call` sid, you can use the client to retrieve
that record.:

.. code-block:: php

    $client = new Services_Twilio('AC123', '123');
    $sid = "CA12341234"
    $call = $client->account->calls->get($sid)

Modifying live calls
====================

The :class:`Call` resource makes it easy to find current live calls and
redirect them as necessary:

.. code-block:: php

    $client = new Services_Twilio('AC123', '123');
    $calls = $client->account->calls->getIterator(0, 50, array('Status' => 'in-progress'));
    foreach ($calls as $call) {
      $call->update(array('Url' => 'http://foo.com/new.xml', 'Method' => 'POST'));
    }

Ending all live calls is also possible:

.. code-block:: php

    $client = new Services_Twilio('AC123', '123');
    $calls = $client->account->calls->getIterator(0, 50, array('Status' => 'in-progress'));
    foreach ($calls as $call) {
      $call->hangup();
    }

Note that :meth:`hangup` will also cancel calls currently queued.
