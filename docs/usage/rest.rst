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

SSL Validation Exceptions
-------------------------

If you are using an out-dated verison of `libcurl`, you may encounter SSL validation exceptions. If you can't upgrade `libcurl`, you can disable SSL peer validation. Only use this as a last resort, as it leaves you vunerable to `Man-in-the-middle attacks <http://en.wikipedia.org/wiki/Man-in-the-middle_attack>`_.

.. code-block:: php

    $http = new Services_Twilio_TinyHttp(
        'https://api.twilio.com',
        array('curlopts' => array(CURLOPT_SSL_VERIFYPEER => false))
    );

    $client = new Services_Twilio('AC123', 'token', '2010-04-01', $http);

Listing Resources
====================

Iterating over the :attr:`calls` attribute will iterate over all of your call records, handling paging for you. Only use this when you need to get all your records.

The :attr:`$call` object is a :php:class:`Services_Twilio_Rest_Call`, which means you can easily access fields through it's properties. The attribute names are lowercase and use underscores for sepearators. All the available attributes are documented in the :doc:`/api/rest` documentation.

.. code-block:: php

    // This could take a while
    foreach($client->account->calls as $call) {
        print $call->price . '\n';
	print $call->duration . '\n';
    }

Filtering Resources
-------------------

Many Twilio list resources allow for filtering via :php:meth:`getIterator` which takes an optional array of filter parameters. These parameters correspond directlty to the listed query string parameters in the REST API documentation.

You can create a filtered iterator.

.. code-block:: php

    $filteredCalls = $client->account->calls->getIterator(
        0, 50, array("Status" => "in-progress"));
    foreach($filteredCalls as $call) {
        print $call->price . '\n';
	print $call->duration . '\n';
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
