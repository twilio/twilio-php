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

The verb methods (outlined in the complete reference) take the body (only text) of the verb as the first argument. All attributes are keyword arguements.

.. code-block:: php

    $response = new Services_Twilio_Twiml();
    $response->play("monkey.mp3", array('loop' => 5));
    print $response;

.. code-block:: xml

    <?xml version="1.0" encoding="UTF-8"?>
    <Response><Play loop="3">monkey.mp3</Play><Response>

.. code-block:: php

    $response = new Services_Twilio_Twiml();
    $response->say('hello');
    $response
      ->gather(array('end_on_key' => '4'))
      ->say('World');
    print $response;

.. code-block:: xml

    <?xml version="1.0" encoding="UTF-8"?>
    <Response>
      <Say>Hello</Say>
      <Gather endOnKey="4"><Say>World</Say></Gather>
    </Response>

