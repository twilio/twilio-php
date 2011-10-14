.. _usage-twiml:

==============
TwiML Creation
==============

TwiML creation begins with the :class:`Services_Twilio_Twiml` verb. Each succesive verb is created by calling various methods on the response, such as :meth:`say` or :meth:`play`. These methods return the verbs they create to ease the creation of nested TwiML.

.. code-block:: php

    $response = new Services_Twilio_Twiml;
    $response->say('Hello');
    print $response;

.. code-block:: xml

    <?xml version="1.0" encoding="UTF-8"?>
    <Response>
      <Say>Hello</Say>
    <Response>

Primary Verbs
=============

Response
--------

All TwiML starts with the `<Response>` verb. The following code creates an empty response.

.. code-block:: php

    $response = new Services_Twilio_Twiml;
    print $response;

.. code-block:: xml

    <?xml version="1.0" encoding="UTF-8"?>
    <Response></Response>

Say
---

.. code-block:: php

    $response = new Services_Twilio_Twiml;
    $response->say("Hello World");
    print $response;

.. code-block:: xml

    <?xml version="1.0" encoding="UTF-8"?>
    <Response>
      <Say>Hello World</Say>
    </Response>

Play
----

.. code-block:: php

    $response = new Services_Twilio_Twiml;
    $response->play("monkey.mp3", array('loop' => 5));
    print $response;

.. code-block:: xml

    <?xml version="1.0" encoding="UTF-8"?>
    <Response>
      <Play loop="5">monkey.mp3</Play>
    <Response>

Gather
------

.. code-block:: php

    $response = new Services_Twilio_Twiml;
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

.. code-block:: php

    $response = new Services_Twilio_Twiml;
    $response->record(array(
      'action' => 'http://foo.com/path/to/redirect',
      'maxLength' => 20
    ));
    print $response;
    
.. code-block:: xml

    <?xml version="1.0" encoding="UTF-8"?>
    <Response>
      <Record action="http://foo.com/path/to/redirect" maxLength="20"/>
    </Response>

Sms
---

.. code-block:: php

    $response = new Services_Twilio_Twiml;
    $response->sms('Hello World', array(
      'to' => '+14150001111',
      'from' => '+14152223333'
    ));
    print $response;

.. code-block:: xml

    <?xml version="1.0" encoding="UTF-8"?>
    <Response>
      <Dial to="+14150001111" from="+14152223333">Hello World</Dial>
    </Response>

Dial
----

.. code-block:: php

    $response = new Services_Twilio_Twiml;
    $response->dial('+14150001111', array(
      'callerId' => '+14152223333'
    ));
    print $response;

.. code-block:: xml

    <?xml version="1.0" encoding="UTF-8"?>
    <Response>
      <Dial callerId="+14152223333">+14150001111</Dial>
    </Response>

Number
~~~~~~

.. code-block:: php

    $response = new Services_Twilio_Twiml;
    $dial = $response->dial(NULL, array(
      'callerId' => '+14152223333'
    ));
    $dial->number('+14151112222', array(
      'sendDigits' => '2'
    ));
    print $response;

.. code-block:: xml

    <?xml version="1.0" encoding="UTF-8"?>
    <Response>
      <Dial callerId="+14152223333">
        <Number sendDigits="2">+14151112222</Number>
      </Dial>
    </Response>

Client
~~~~~~

.. code-block:: php

    $response = new Services_Twilio_Twiml;
    $dial = $response->dial(NULL, array(
      'callerId' => '+14152223333'
    ));
    $dial->client('client-id');
    print $response;

.. code-block:: xml

    <?xml version="1.0" encoding="UTF-8"?>
    <Response>
      <Dial callerId="+14152223333">
        <Client>client-id</Client>
      </Dial>
    </Response>

Conference
~~~~~~~~~~



Secondary Verbs
===============

Hangup
------

.. code-block:: php

    $response = new Services_Twilio_Twiml;
    $response->hangup();
    print $response;
    
.. code-block:: xml

    <?xml version="1.0" encoding="UTF-8"?>
    <Response>
      <Hangup />
    </Response>

Redirect
--------

.. code-block:: php

    $response = new Services_Twilio_Twiml;
    $response->redirect('http://foo.com/path/to/resource');
    print $response;
    
.. code-block:: xml

    <?xml version="1.0" encoding="UTF-8"?>
    <Response>
      <Redirect>http://foo.com/path/to/resource</Redirect>
    </Response>


Reject
------

.. code-block:: php

    $response = new Services_Twilio_Twiml;
    $response->reject(array(
      'reason' => 'busy'
    ));
    print $response;
    
.. code-block:: xml

    <?xml version="1.0" encoding="UTF-8"?>
    <Response>
      <Reject reason="busy" />
    </Response>


Pause
-----

.. code-block:: php

    $response = new Services_Twilio_Twiml;
    $response->say('Hello');
    $response->pause("");
    $response->say('World');
    print $response;

.. code-block:: xml

    <?xml version="1.0" encoding="UTF-8"?>
    <Response>
      <Say>Hello</Say>
      <Pause />
      <Say>Word</Say>
    </Response>


The verb methods (outlined in the complete reference) take the body (only text) of the verb as the first argument. All attributes are keyword arguments.
