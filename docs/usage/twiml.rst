.. _usage-twiml:

==============
TwiML Creation
==============

TwiML creation begins with the :class:`Services_Twilio_Twiml` verb. Each succesive verb is created by calling various methods on the response, such as :meth:`say` or :meth:`play`. These methods return the verbs they create to ease the creation of nested TwiML.

.. code-block:: php

    $response = new Services_Twilio_Twiml();
    $response->say('Hello');
    print $response;

.. code-block:: xml

    <?xml version="1.0" encoding="UTF-8"?>
    <Response><Say>Hello</Say><Response>

Primary Verbs
=============

These are the

Response
--------

All TwiML starts with the `<Response>` verb. The following code creates an empty response.

.. code-block:: php

    $response = new Services_Twilio_Twiml();
    print $response;

.. code-block:: xml

    <?xml version="1.0" encoding="UTF-8"?>
    <Response></Response>

Say
---

.. code-block:: php

    $response = new Services_Twilio_Twiml();
    $response->say("Hello World");
    print $response;

.. code-block:: xml

    <?xml version="1.0" encoding="UTF-8"?>
    <Response><Say>Hello World</Say></Response>

Play
----

.. code-block:: php

    $response = new Services_Twilio_Twiml();
    $response->play("monkey.mp3", array('loop' => 5));
    print $response;

.. code-block:: xml

    <?xml version="1.0" encoding="UTF-8"?>
    <Response><Play loop="5">monkey.mp3</Play><Response>

Gather
------

.. code-block:: php

    $response = new Services_Twilio_Twiml();
    $gather = $response->gather(array('numDigits' => 5));
    $gather->say("Hello Caller");
    print $response;

.. code-block:: xml

    <?xml version="1.0" encoding="UTF-8"?>
    <Response>
      <Gather numDigits="5">
        <Say>Hellow Caller</Say>
      </Gather>
    <Response>

Record
------

Sms
---

Dial
----

Number
~~~~~~

Client
~~~~~~

Conference
~~~~~~~~~~

Secondary Verbs
===============

Hangup
------

Redirect
--------

Reject
------

Pause
-----

.. code-block:: php

    $response = new Services_Twilio_Twiml();
    $response->pause("");
    print $response;

.. code-block:: xml

    <?xml version="1.0" encoding="UTF-8"?>
    <Response></Response>


The verb methods (outlined in the complete reference) take the body (only text) of the verb as the first argument. All attributes are keyword arguements.
