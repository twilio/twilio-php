.. _ref-rest

REST API Usage
>>>>>>>>>>>>>>>

Accounts
==================

Updating Account Information
----------------------------

Updating :class:`Account` information is really easy:

.. code-block:: php

    $client = new Services_Twilio('AC123', '123');
    $account = $client->account;
    $account->update(array('name' => 'My Awesome Account'));

Creating a Sub Account
----------------------

.. code-block:: php

    $client = new Services_Twilio('AC123', '123');
    $subaccount = $client->accounts->create(array(
      'name' => 'My Awesome SubAccount'
    ));

Phone Calls
==============

Making a Phone Call
-------------------

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
----------------------------------------

The :class:`Call` resource has some sub resources you can access, such as
notifications and recordings. If you have already have a :class:`Call`
resource, they are easy to get.:

.. code-block:: php

    $client = new Services_Twilio('AC123', '123');
    foreach ($client->account->calls as $call) {
      print $call->notifications;
      print $call->transcriptions;
      print $call->recordings;
    }

Be careful, as the above code makes quite a few HTTP requests.

Retrieve a Call Record
----------------------

If you already have a :class:`Call` sid, you can use the client to retrieve
that record.:

.. code-block:: php

    $client = new Services_Twilio('AC123', '123');
    $sid = "CA12341234"
    $call = $client->account->calls->get($sid)

Modifying live calls
--------------------

The :class:`Call` resource makes it easy to find current live calls and
redirect them as necessary:

.. code-block:: php

    $client = new Services_Twilio('AC123', '123');
    $calls = $client->account->calls->getList(array('status' => 'in-progress'));
    foreach ($calls as $call) {
      $call->route('http://foo.com/new.xml', array('method' => 'POST'));
    }

Ending all live calls is also possible:

.. code-block:: php

    $client = new Services_Twilio('AC123', '123');
    $calls = $client->account->calls->getList(array('status' => 'in-progress'));
    foreach ($calls as $call) {
      $call->hangup();
    }

Note that :meth:`hangup` will also cancel calls currently queued.


Caller Ids
=============

Validate a Phone Number
-----------------------
Adding a new phone number to your validated numbers is quick and easy:

.. code-block:: php

    $client = new Services_Twilio('AC123', '123');
    $response = $client->account->caller_ids->validate('+9876543212');
    print response->validation_code;

Twilio will call the provided number and for the validation code to be entered.

Listing all Validated Phone Numbers
-----------------------------------
Show all the current caller_ids:

.. code-block:: php

    $client = new Services_Twilio('AC123', '123');
    foreach ($client->account->caller_ids as $caller_id) {
      print $caller_id->friendly_name;
    }

Conferences
================

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
