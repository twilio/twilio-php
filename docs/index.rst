.. Services_Twilio documentation master file, created by
   sphinx-quickstart on Tue Mar  8 04:02:01 2011.
   You can adapt this file completely to your liking, but it should at least
   contain the root `toctree` directive.

=================
**twilio-php**
=================

Status
=======

This documentation is for version 3.0 of `twilio-php <https://www.github.com/twilio/twilio-php>`_.

Installation
================

.. code-block:: bash

    pear channel-discover twilio.github.com/pear
    pear install twilio/Services_Twilio

If you aren't using PEAR, you can just download the `source <https://github.com/twilio/pear/blob/gh-pages/get/Services_Twilio-0.0.3.tar?raw=true>`_

Quickstart
============

Getting started with the Twilio API couldn't be easier. Create a Twilio REST client to get started. For example, the following code makes a call using the Twilio REST API.

Making a Call
>>>>>>>>>>>>>>>

.. code-block:: php

    $sid = "ACXXXXXX"; // Your Twilio account sid
    $token = "YYYYYY"; // Your Twilio auth token

    $client = new Services_Twilio($sid, $token);
    $call = $client->account->calls->create(
      '9991231234', // From this number
      '8881231234', // Call this number
      'http://foo.com/call.xml'
    );

Generating TwiML
>>>>>>>>>>>>>>>>>>>>

To control phone calls, your application need to output TwiML. Use :class:`Services_Twilio_Twiml` to easily create such responses.

.. code-block:: php

    $response = new Services_Twilio_Twiml();
    $response->say('Hello');
    print $response;

.. code-block:: xml

    <?xml version="1.0" encoding="utf-8"?>
    <Response><Play loop="5">monkey.mp3</Play><Response>

User Guide
==================

.. toctree::
    :maxdepth: 1
    :glob:

    usage/rest
    usage/twiml
    usage/validation
    usage/token-generation

API Documentation
==================

.. toctree::
    :maxdepth: 1
    :glob:

    api/*


Support and Development
===========================

All development occurs over on `Github <https://github.com/twilio/twilio-php>`_. To checkout the source,

.. code-block:: bash

    git clone git@github.com:twilio/twilio-php.git


Report bugs using the Github `issue tracker <https://github.com/twilio/twilio-php/issues>`_.

If you’ve got questions that aren’t answered by this documentation, ask the `#twilio IRC channel <irc://irc.freenode.net/#twilio>`_

Running the Tests
>>>>>>>>>>>>>>>>>>>>>>>>>

The unit tests depend on `Mockery <https://github.com/padraic/mockery>`_ and `PHPUnit <https://github.com/sebastianbergmann/phpunit>`_. First, 'discover' all the necessary pear channels (which is ridiculous)

.. code-block:: bash

    pear channel-discover pear.phpunit.de
    pear channel-discover components.ez.no
    pear channel-discover pear.symfony-project.com
    pear channel-discover pear.survivethedeepend.com
    pear channel-discover hamcrest.googlecode.com/svn/pear

.. code-block:: bash

    pear install --alldeps deepend/Mockery
    pear install phpunit/PHPUnit

After installation, run the tests with :data:`make`

.. code-block:: bash

    make test


Making the Documentation
>>>>>>>>>>>>>>>>>>>>>>>>>>

Our documentation is written using `Sphinx <http://sphinx.pocoo.org/>`_. You'll need to install Sphinx and the Sphinx PHP domain before you can build the docs.

.. code-block:: bash

    pip install Sphinx sphinxcontrib-phpdomain

Once you have those installed, making the docs is easy.

.. code-block:: bash

    cd docs
    make html

