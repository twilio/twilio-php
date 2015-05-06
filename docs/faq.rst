==========================
Frequently Asked Questions
==========================

Hopefully you can find an answer here to one of your questions. If not, please
contact `help@twilio.com <mailto:help@twilio.com>`_.

Debugging Requests
------------------

Sometimes the library generates unexpected output. The simplest way to debug is
to examine the HTTP request that twilio-php actually sent over the wire. You
can turn on debugging with a simple flag:

.. code-block:: php

    require('Services/Twilio.php');

    $client = new Services_Twilio('AC123', '456bef');
    $client->http->debug = true;

Then make requests as you normally would. The URI, method, headers, and body
of HTTP requests will be logged via the ``error_log`` function.


require: Failed to open stream messages
-----------------------------------------

If you are trying to use the helper library and you get an error message that
looks like this:

.. code-block:: php

    PHP Warning:  require(Services/Twilio.php): failed to open stream: No such 
    file or directory in /path/to/file

    Fatal error: require(): Failed opening required 'Services/Twilio.php' 
    (include_path='.:/usr/lib/php:/usr/local/php-5.3.8/lib/php') in 
    /Library/Python/2.6/site-packages/phpsh/phpsh.php(578): on line 1

Your PHP file can't find the Twilio library. The easiest way to do this is to
move the Services folder from the twilio-php library into the folder containing
your file. So if you have a file called ``send-sms.php``, your folder structure
should look like this:

.. code-block:: bash

    .
    ├── send-sms.php
    ├── Services
    │   ├── Twilio.php
    │   ├── Twilio
    │   │   ├── ArrayDataProxy.php
    │   │   ├── (..about 50 other files...)

If you need to copy all of these files to your web hosting server, the easiest
way is to compress them into a ZIP file, copy that to your server with FTP, and
then unzip it back into a folder in your CPanel or similar.

You can also try changing the ``require`` line like this:

.. code-block:: php

    require('/path/to/twilio-php/Services/Twilio.php');

SSL Validation Exceptions
-------------------------

If you are using an outdated version of `libcurl`, you may encounter
SSL validation exceptions. If you see the following error message, you have
a SSL validation exception: ::

    Fatal error: Uncaught exception 'Services_Twilio_TinyHttpException'
    with message 'SSL certificate problem, verify that the CA cert is OK.

    Details: error:14090086:SSL routines:SSL3_GET_SERVER_CERTIFICATE:certificate
    verify failed' in [MY PATH]\Services\Twilio\TinyHttp.php:89

This means that Twilio is trying to offer a certificate to verify that you are
actually connecting to `https://api.twilio.com <https://api.twilio.com>`_, but
your curl client cannot verify our certificate.

Upgrade your version of the twilio-php library
==============================================

From November 2011 to November 2014, the SSL certificate was built into
the helper library, and it is used to sign requests made to our API. Older
releases of the helper library include expired certificates and will not
work against the current API certificates. If you are
still encountering this problem, you can upgrade your helper library to the
latest version, and you should not encounter this error anymore.

If you are using an older version of the helper library and cannot upgrade, you
can try the the following:

Disable the local copy of Twilio's certificate
==============================================

Replace this line in your client code that uses the Twilio helper library:

.. code-block:: php

    $client = new Services_Twilio($sid, $token);

With this one:

.. code-block:: php

    $http = new Services_Twilio_TinyHttp(
        'https://api.twilio.com',
        array('curlopts' => array(
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_SSL_VERIFYHOST => 2,
        ));

    $client = new Services_Twilio($sid, $token, "2010-04-01", $http);


Upgrade your version of libcurl
===============================

The certificate authority Twilio uses is included in the latest version of the
``libcurl`` library. Upgrading your system version of ``libcurl`` will
resolve the SSL error. `Click here to download the latest version of
libcurl <http://curl.haxx.se/download.html>`_.

If this does not work, double check your Account SID, token, and that you do
not have errors anywhere else in your code. If you need further assistance,
please email our customer support at `help@twilio.com`_.
