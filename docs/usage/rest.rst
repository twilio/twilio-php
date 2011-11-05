.. _ref-rest

==========================
Using the Twilio REST API
==========================

Since version 3.0, we've introduced an updated API for interacting with the Twilio REST API. Gone are the days of manual URL creation and XML parsing.

Creating a REST Client
=======================

Before querying the API, you'll need to create a :php:class:`Services_Twilio`
instance. The construcutor takes your Twilio Account Sid and Auth
Token (both available through your `Twilio Account Dashboard
<http:www.twilio.com/user/account>`_).

.. code-block:: php

    $ACCOUNT_SID = "AC123";
    $AUTH_TOKEN = "secret";
    $client = new Services_Twilio($ACCOUNT_SID, $AUTH_TOKEN);

The :attr:`account` attribute
-----------------------------

You access the Twilio API resources through this :attr:`$client`,
specifically the :attr:`$account` attribute, which is an instance of
:php:class:`Services_Twilio_Rest_Account`. We'll use the `Calls resource
<http://www.twilio.com/docs/api/rest/call>`_ as an example.

Listing Resources
====================

Iterating over the :attr:`calls` attribute will iterate over all of your call
records, handling paging for you. Only use this when you need to get all your
records.

The :attr:`$call` object is a :php:class:`Services_Twilio_Rest_Call`, which
means you can easily access fields through it's properties. The attribute names
are lowercase and use underscores for sepearators. All the available attributes
are documented in the :doc:`/api/rest` documentation.

.. code-block:: php

    // If you have many calls, this could take a while
    foreach($client->account->calls as $call) {
        print $call->price . '\n';
        print $call->duration . '\n';
    }

Filtering Resources
-------------------

Many Twilio list resources allow for filtering via :php:meth:`getIterator`
which takes an optional array of filter parameters. These parameters correspond
directlty to the listed query string parameters in the REST API documentation.

You can create a filtered iterator like this:

.. code-block:: php

    $filteredCalls = $client->account->calls->getIterator(
        0, 50, array("Status" => "in-progress"));
    foreach($filteredCalls as $call) {
        print $call->price . '\n';
        print $call->duration . '\n';
    }

Getting a Specific Resource
=============================

If you know the unique identifier for a resource, you can get that resource
using the :php:meth:`get` method on the list resource.

.. code-block:: php

    $call = $client->account->calls->get("CA123");

:php:meth:`get` fetches objects lazily, so it will only load a resource when it
is needed. This allows you to get nested objects without making multiple HTTP
requests.

.. code-block:: php

    $participant = $client->account->conferences
        ->get("CO123")->participants->get("PF123");

SSL Validation Exceptions
=========================

If you are using an outdated version of `libcurl`, you may encounter
SSL validation exceptions. If you see the following error message, you have
a SSL validation exception: ::

    Fatal error: Uncaught exception 'Services_Twilio_TinyHttpException' 
    with message 'SSL certificate problem, verify that the CA cert is OK. 

    Details: error:14090086:SSL routines:SSL3_GET_SERVER_CERTIFICATE:certificate 
    verify failed' in [MY PATH]\Services\Twilio\TinyHttp.php:89

This means that Twilio is trying to offer a certificate to verify that you are
actually connecting to `https://api.twilio.com <https://api.twilio.com>`_, but
your curl client cannot verify our certificate. There are three solutions to
this problem; any one should work.

Upgrade your version of libcurl
-------------------------------

The Twilio certificate is included in the latest version of the
``libcurl`` library. Upgrading your system version of ``libcurl`` will
resolve the SSL error. `Click here to download the latest version of
libcurl <http://curl.haxx.se/download.html>`_.

Manually add Twilio's SSL certificate
-------------------------------------

The PHP curl library can also manually verify an SSL certificate. In your
browser, navigate to
`https://github.com/twilio/twilio-php/master/Services/twilio_ssl_certificate.crt
<https://github.com/twilio/twilio-php/master/Services/twilio_ssl_certificate.crt>`_ 
and download the file. (**Note**: If your browser presents ANY warnings
at this time, your Internet connection may be compromised. Do not download the
file, and do not proceed with this step). Place this file in the same folder as
your PHP script. Then, replace this line in your script:

.. code-block:: php

    $client = new Services_Twilio($sid, $token);

with this one:

.. code-block:: php

    $http = new Services_Twilio_TinyHttp(
        'https://api.twilio.com',
        array('curlopts' => array(
            CURLOPT_SSL_VERIFYPEER => true, 
            CURLOPT_SSL_VERIFYHOST => 2, 
            CURLOPT_CAINFO => getcwd() . "/twilio_ssl_certificate.crt")));

    $client = new Services_Twilio($sid, $token, "2010-04-01", $http);

If you are still experiencing errors, please email us at `help@twilio.com
<mailto:help@twilio.com>`_ and we would be glad to help you troubleshoot your
problems.

Disable certificate checking
----------------------------

A final option is to disable checking the certificate. Disabling the
certificate check means that a malicious third party can pretend to be
Twilio, intercept your data, and gain access to your Account SID and
Auth Token in the process. Because this is a security vulnerability,
we **strongly discourage** you from disabling certificate checking in
a production environment. This is known as a `man-in-the-middle attack
<http://en.wikipedia.org/wiki/Man-in-the-middle_attack>`_.

If you still want to proceed, here is code that will disable certificate
checking:

.. code-block:: php

    $http = new Services_Twilio_TinyHttp(
        'https://api.twilio.com',
        array('curlopts' => array(CURLOPT_SSL_VERIFYPEER => false))
    );

    $client = new Services_Twilio('AC123', 'token', '2010-04-01', $http);

If this does not work, double check your Account SID, token, and that you do
not have errors anywhere else in your code. If you need further assistance,
please email our customer support at `help@twilio.com`_.

