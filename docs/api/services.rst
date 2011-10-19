===============================
Services_Twilio
===============================

.. php:class:: Services_Twilio

  .. php:method:: __construct($sid, $token)

     Create a new Services_Twilio REST client

     :param string $sid: Twilio Account SID
     :param string $token: Twilio Account auth token
     :param string $version: Twilio API version string (should be 2008-08-01 or 2010-04-01)
     :param $_http: A :php:class:`Services_Twilio_TinyHttp` client.
     :type $_http: :php:class:`Services_Twilio_TinyHttp`

  .. php:attr:: account

     A :php:class:`Services_Twilio_Rest_Account` instance for the given account SID

  .. php:attr:: accounts

     A :php:class:`Services_Twilio_Rest_Accounts` instance

