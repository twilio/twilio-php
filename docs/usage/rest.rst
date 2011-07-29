.. _ref-rest

==========================
Using the Twilio REST API
==========================

Since version 3.0, we've introduced an updated API for interacting with the Twilio REST API. Gone are the days of manual URL creation and XML parsing.

Creating a REST Client
=======================

Before querying the API, you'll need to create a :php:class:`Services_Twilio` instance. The construcutor takes your Twilio Account Sid and Auth Token (both available on your `Twilio Account Dashboard <http:www.twilio.com/user/account>`_).

.. code-block:: php

    $ACCOUNT_SID = "AC123";
    $AUTH_TOKEN = "secret";
    $client = new Services_Twilio($ACCOUNT_SID, $AUTH_TOKEN);

The :attr:`account` attibute
----------------------------

You access the Twilio API resources through this :attr:`$client`, specifically the :attr:`$account` attribute, which is an instance of :php:class:`Services_Twilio_Rest_Account`. We'll use the `Calls resource <http://www.twilio.com/docs/api/rest/call>`_ as an example.

Listing Resources
====================

Each list resource supports iterating over the first page of results using :php:meth:`getList`. The followig code will print out the price and duration of your 50 latest calls

.. code-block:: php

    foreach($client->account->calls->getList() as $call) {
        print $call->sid . "\n";
    }

The :attr:`$call` object is a :php:class:`Services_Twilio_Rest_Call`, which means you can easily access fields through it's properties. The attribute names are lowercase and use underscores for sepearators. All the available attributes are documented in the :doc:`/api/rest` documentation.

Iterating over the :attr:`calls` attribute (without calling :php:meth:`getList`) will iterate over all of your call records, handling paging for you. Only use this when you need to get all your records.

.. code-block:: php

    // This could take a while
    foreach($client->account->calls as $call) {
        print $call->sid . "\n";
    }

Filtering Resources
-------------------

Many Twilio list resources allow for filtering via :php:meth:`getList` which takes an optionatl array of filter parameters. These parameters correspond directlty to the listed query string parameters in the REST API documentation.

.. code-block:: php

    $filtered_calls = $client->account->calls->getList(
        array("Started" => "2011-05-07"));
    foreach($filtered_calls as $call) {
        print $call->price . "\n";
	print $call->duration . "\n";
    }

You can also create a filtered iterator.

.. code-block:: php

    $filtered_calls = $client->account->calls->getIterator(0, 50,
        array("Started" => "2011-05-07"));
    foreach($filtered_calls as $call) {
        print $call->price . "\n";
	print $call->duration . "\n";
    }

Getting a Specific Resource
=============================

If you know the unique identifier for a resource, you can get that resource using the :php:meth:`get` method on the list resource.

.. code-block:: php

    $call = $client->account->calls->get("CA123");

:php:meth:`get` fetches objects lazyily, so it will only load a resource when it's needed. This allows you to get nested objects without making multiple HTTP requests.

.. code-block:: php

    $participant = $client->account->conferences
        ->get("CO123")->participants->get("PF123");


Updating an Individual Resource
================================

.. code-block:: php

    $call = $client->account->calls->get("CA123")->update(array(
        "Status" => "completed",
    ));

This will hangup and cancel that call.

Deleting an Individual Resource
================================

.. code-block:: php

    if ($client->account->calls->delete("CA123"))
        print "Success"
    else
        print "Failure"

The follwing will print "Failure" as call records can't be deleted.
