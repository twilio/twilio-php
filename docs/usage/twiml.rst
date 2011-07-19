.. _usage-twiml:

==============
TwiML Creation
==============

The :mod:`twiml` module is responsible for the creation and validation of TwiML. Configuration options also allow users to specift defaults for various verbs.

Creation
^^^^^^^^

TwiML creation begins with the :class:`Response` verb. Each succesive verb is created by calling various methods on the response, such as :meth:`say` or :meth:`play`. These methods return the verbs they create to ease the creation of nested TwiML. To finish, call the :meth:`toxml` method on the :class:`Response`, which returns raw TwiML.

.. code-block:: php

    $response = new Services_Twilio_Twiml();
    $response->say('Hello');
    print $response;
    # returns <Response><Say>Hello</Say><Response>

The verb methods (outlined in the complete reference) take the body (only text) of the verb as the first argument. All attributes are keyword arguements.

.. code-block:: php

    $response = new Services_Twilio_Twiml();
    $response->play("monkey.mp3", array('loop' => 5));
    print $response;
    # returns <Response><Play loop="3">monkey.mp3</Play><Response>

Python 2.6+ added the :const:`with` statement for context management. Using :const:`with`, the module can *almost* emulate Ruby blocks.

.. code-block:: php

    $response = new Services_Twilio_Twiml();
    $response->say('hello');
    $response
      ->gather(array('end_on_key' => '4'))
      ->say('World');
    print $response;

which returns

.. code-block:: xml

    <Response>
      <Say>Hello</Say>
      <Gather endOnKey="4"><Say>World</Say></Gather>
    </Response>

