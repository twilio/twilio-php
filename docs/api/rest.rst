.. _api-rest:

===============================
Services_Twilio_Rest
===============================

Accounts
===========

.. php:class:: Services_Twilio_Rest_Accounts

  For more information, see the `Account List Resource <http://www.twilio.com/docs/api/rest/account#list>`_ documentation.

  .. php:method:: get($sid)

     Get an account resource

     :param array $params: A 34 character string that uniquely identifies this account.
     :returns: A :php:class:`Services_Twilio_Rest_Account` instance

  .. php:method:: create($params = array())

     Create a new Subaccount.

     :param array $params: An array of parameterss describing the new subaccount
     :returns: A new :php:class:`Services_Twilio_Rest_Account` instance

     The **$params** array can contain the following keys:

     *name*
       A description of this account, up to 64 characters long


.. php:class:: Services_Twilio_Rest_Account

   For more information, see the `Account Instance Resource <http://www.twilio.com/docs/api/rest/account#instance>`_ documentation.

   .. php:method:: update($params)

     Update the account

     The **$params** array is the same as in :php:meth:`Services_Twilio_Rest_Accounts::create`

   .. php:attr:: sid

      A 34 character string that uniquely identifies this account.

   .. php:attr:: date_created

      The date that this account was created, in GMT in RFC 2822 format

   .. php:attr:: date_updated

      The date that this account was last updated, in GMT in RFC 2822 format.

   .. php:attr:: friendly_name

      A human readable description of this account, up to 64 characters long. By default the FriendlyName is your email address.

   .. php:attr:: status

      The status of this account. Usually active, but can be suspended if you've been bad, or closed if you've been horrible.

   .. php:attr:: auth_token

      The authorization token for this account. This token should be kept a secret, so no sharing.

Application
=================

.. php:class:: Services_Twilio_Rest_Application

   For more information, see the `Application Instance Resource <http://www.twilio.com/docs/api/rest/applications#instance>`_ documentation.

   .. php:attr:: sid

      A 34 character string that uniquely idetifies this resource.

   .. php:attr:: date_created

      The date that this resource was created, given as GMT RFC 2822 format.

   .. php:attr:: date_updated

      The date that this resource was last updated, given as GMT RFC 2822 format.

   .. php:attr:: friendly_name

      A human readable descriptive text for this resource, up to 64 characters long. By default, the FriendlyName is a nicely formatted version of the phone number.

   .. php:attr:: account_sid

      The unique id of the Account responsible for this phone number.

   .. php:attr:: api_version

      Calls to this phone number will start a new TwiML session with this API version.

   .. php:attr:: voice_caller_id_lookup

      Look up the caller's caller-ID name from the CNAM database (additional charges apply). Either true or false.

   .. php:attr:: voice_url

      The URL Twilio will request when this phone number receives a call.

   .. php:attr:: voice_method

      The HTTP method Twilio will use when requesting the above Url. Either GET or POST.

   .. php:attr:: voice_fallback_url

      The URL that Twilio will request if an error occurs retrieving or executing the TwiML requested by Url.

   .. php:attr:: voice_fallback_method

      The HTTP method Twilio will use when requesting the VoiceFallbackUrl. Either GET or POST.

   .. php:attr:: status_callback

      The URL that Twilio will request to pass status parameters (such as call ended) to your application.

   .. php:attr:: status_callback_method

      The HTTP method Twilio will use to make requests to the StatusCallback URL. Either GET or POST.

   .. php:attr:: sms_url

      The URL Twilio will request when receiving an incoming SMS message to this number.

   .. php:attr:: sms_method

      The HTTP method Twilio will use when making requests to the SmsUrl. Either GET or POST.

   .. php:attr:: sms_fallback_url

      The URL that Twilio will request if an error occurs retrieving or executing the TwiML from SmsUrl.

   .. php:attr:: sms_fallback_method

      The HTTP method Twilio will use when requesting the above URL. Either GET or POST.

   .. php:attr:: uri

      The URI for this resource, relative to https://api.twilio.com.


Calls
=======

.. php:class:: Services_Twilio_Rest_Calls

   For more information, see the `Call Instance Resource <http://www.twilio.com/docs/api/rest/call#list>`_ documentation.

   .. php:method:: create($from, $to, $url, array $parms = array())

      Make an outgoing call

      :param string $from: The phone number to use as the caller id.
      :param string $to: The number to call formatted with a '+' and country code
      :param string $url: The fully qualified URL that should be consulted when
                          the call connects. This value can also be an ApplicationSid.
      :param array $params: An array of optional parameters for this call

      The **$params** array can contain the following keys:

      *method*
        The HTTP method Twilio should use when making its request to the above Url parameter's value. Defaults to POST. If an ApplicationSid parameter is present, this parameter is ignored.

      *fallback_url*
        A URL that Twilio will request if an error occurs requesting or executing the TwiML at Url. If an ApplicationSid parameter is present, this parameter is ignored.

      *fallback_method*
        The HTTP method that Twilio should use to request the FallbackUrl. Must be either GET or POST. Defaults to POST. If an ApplicationSid parameter is present, this parameter is ignored.

      *status_callback*
        A URL that Twilio will request when the call ends to notify your app. If an ApplicationSid parameter is present, this parameter is ignored.

      *status_callback_method*
        The HTTP method Twilio should use when requesting the above URL. Defaults to POST. If an ApplicationSid parameter is present, this parameter is ignored.

      *send_digits*
        A string of keys to dial after connecting to the number. Valid digits in the string include: any digit (0-9), '#' and '*'. For example, if you connected to a company phone number, and wanted to dial extension 1234 and then the pound key, use SendDigits=1234#. Remember to URL-encode this string, since the '#' character has special meaning in a URL.

      *if_machine*
        Tell Twilio to try and determine if a machine (like voicemail) or a human has answered the call. Possible values are Continue and Hangup. See the answering machines section below for more info.

      *timeout*
        The integer number of seconds that Twilio should allow the phone to ring before assuming there is no answer. Default is 60 seconds, the maximum is 999 seconds. Note, you could set this to a low value, such as 15, to hangup before reaching an answering machine or voicemail.

.. php:class:: Services_Twilio_Rest_Call

   For more information, see the `Call Instance Resource <http://www.twilio.com/docs/api/rest/call#instance>`_ documentation.

   .. php:attr:: sid

      A 34 character string that uniquely identifies this resource.

   .. php:attr:: parent_call_sid

      A 34 character string that uniquely identifies the call that created this leg.

   .. php:attr:: date_created

      The date that this resource was created, given as GMT in RFC 2822 format.

   .. php:attr:: date_updated

      The date that this resource was last updated, given as GMT in RFC 2822 format.

   .. php:attr:: account_sid

      The unique id of the Account responsible for creating this call.

   .. php:attr:: to

      The phone number that received this call. e.g., +16175551212 (E.164 format)

   .. php:attr:: from

      The phone number that made this call. e.g., +16175551212 (E.164 format)

   .. php:attr:: phone_number_sid

      If the call was inbound, this is the Sid of the IncomingPhoneNumber that received the call. If the call was outbound, it is the Sid of the OutgoingCallerId from which the call was placed.

   .. php:attr:: status

      A string representing the status of the call. May be :data:`QUEUED`, :data:`RINGING`, :data:`IN-PROGRESS`, :data:`COMPLETED`, :data:`FAILED`, :data:`BUSY` or :data:`NO_ANSWER`.

   .. php:attr:: stat_time

      The start time of the call, given as GMT in RFC 2822 format. Empty if the call has not yet been dialed.

   .. php:attr:: end_time

      The end time of the call, given as GMT in RFC 2822 format. Empty if the call did not complete successfully.

   .. php:attr:: duration

      The length of the call in seconds. This value is empty for busy, failed, unanswered or ongoing calls.

   .. php:attr:: price

      The charge for this call in USD. Populated after the call is completed. May not be immediately available.

   .. php:attr:: direction

      A string describing the direction of the call. inbound for inbound calls, outbound-api for calls initiated via the REST API or outbound-dial for calls initiated by a <Dial> verb.

   .. php:attr:: answered_by

      If this call was initiated with answering machine detection, either human or machine. Empty otherwise.

   .. php:attr:: forwarded_from

      If this call was an incoming call forwarded from another number, the forwarding phone number (depends on carrier supporting forwarding). Empty otherwise.

   .. php:attr:: caller_name

      If this call was an incoming call from a phone number with Caller ID Lookup enabled, the caller's name. Empty otherwise.

CallerId
============

.. php:class:: Services_Twilio_Rest_OutgoingCallerId

   For more information, see the `OutgoingCallerId Instance Resource <http://www.twilio.com/docs/api/rest/outgoing-caller-ids#instance>`_ documentation.

   .. php:attr:: sid

      A 34 character string that uniquely identifies this resource.

   .. php:attr:: date_created

      The date that this resource was created, given in RFC 2822 format.

   .. php:attr:: date_updated

      The date that this resource was last updated, given in RFC 2822 format.

   .. php:attr:: friendly_name

      A human readable descriptive text for this resource, up to 64 characters long. By default, the FriendlyName is a nicely formatted version of the phone number.

   .. php:attr:: account_sid

      The unique id of the Account responsible for this Caller Id.

   .. php:attr:: phone_number

      The incoming phone number. Formatted with a '+' and country code e.g., +16175551212 (E.164 format).

   .. php:attr:: uri

      The URI for this resource, relative to https://api.twilio.com.

Conference
=============

.. php:class:: Services_Twilio_Rest_Conference

   For more information, see the `Conference Instance Resource <http://www.twilio.com/docs/api/rest/conference#instance>`_ documentation.

   .. php:attr:: sid

      A 34 character string that uniquely identifies this conference.

   .. php:attr:: friendly_name

      A user provided string that identifies this conference room.

   .. php:attr:: status

      A string representing the status of the conference. May be init, in-progress, or completed.

   .. php:attr:: date_created

      The date that this conference was created, given as GMT in RFC 2822 format.

   .. php:attr:: date_updated

      The date that this conference was last updated, given as GMT in RFC 2822 format.

   .. php:attr:: account_sid

      The unique id of the Account responsible for creating this conference.

   .. php:attr:: uri

      The URI for this resource, relative to https://api.twilio.com.

   .. php:attr:: participants

      The :php:class:`Services_Twilio_Rest_Participants` instance, listing people currenlty in this conference


Notification
=============

.. php:class:: Services_Twilio_Rest_Notification

   For more information, see the `Notification Instance Resource <http://www.twilio.com/docs/api/rest/notification#instance>`_ documentation.

   .. php:attr:: sid

      A 34 character string that uniquely identifies this resource.

   .. php:attr:: date_created

      The date that this resource was created, given in RFC 2822 format.

   .. php:attr:: date_updated

      The date that this resource was last updated, given in RFC 2822 format.

   .. php:attr:: account_sid

      The unique id of the Account responsible for this notification.

   .. php:attr:: call_sid

      CallSid is the unique id of the call during which the notification was generated. Empty if the notification was generated by the REST API without regard to a specific phone call.

   .. php:attr:: api_version

      The version of the Twilio in use when this notification was generated.

   .. php:attr:: log

      An integer log level corresponding to the type of notification: 0 is ERROR, 1 is WARNING.

   .. php:attr:: error_code

      A unique error code for the error condition. You can lookup errors, with possible causes and solutions, in our Error Dictionary.

   .. php:attr:: more_info

      A URL for more information about the error condition. The URL is a page in our Error Dictionary.

   .. php:attr:: message_text

      The text of the notification.

   .. php:attr:: message_date

      The date the notification was actually generated, given in RFC 2822 format. Due to buffering, this may be slightly different than the DateCreated date.

   .. php:attr:: request_url

      The URL of the resource that generated the notification. If the notification was generated during a phone call: This is the URL of the resource on YOUR SERVER that caused the notification. If the notification was generated by your use of the REST API: This is the URL of the REST resource you were attempting to request on Twilio's servers.

   .. php:attr:: request_method

      The HTTP method in use for the request that generated the notification. If the notification was generated during a phone call: The HTTP Method use to request the resource on your server. If the notification was generated by your use of the REST API: This is the HTTP method used in your request to the REST resource on Twilio's servers.

   .. php:attr:: request_variables

      The Twilio-generated HTTP GET or POST variables sent to your server. Alternatively, if the notification was generated by the REST API, this field will include any HTTP POST or PUT variables you sent to the REST API.

   .. php:attr:: response_headers

      The HTTP headers returned by your server.

   .. php:attr:: response_body

      The HTTP body returned by your server.

   .. php:attr:: uri

      The URI for this resource, relative to https://api.twilio.com

Participant
=============

.. php:class:: Services_Twilio_Rest_Participant

   For more information, see the `Participant Instance Resource <http://www.twilio.com/docs/api/rest/participant#instance>`_ documentation.

   .. php:attr:: call_sid

      A 34 character string that uniquely identifies the call that is connected to this conference

   .. php:attr:: conference_sid

      A 34 character string that identifies the conference this participant is in

   .. php:attr:: date_created

      The date that this resource was created, given in RFC 2822 format.

   .. php:attr:: date_updated

      The date that this resource was last updated, given in RFC 2822 format.

   .. php:attr:: account_sid

      The unique id of the Account that created this conference

   .. php:attr:: muted

      true if this participant is currently muted. false otherwise.

   .. php:attr:: start_conference_on_enter

      Was the startConferenceOnEnter attribute set on this participant (true or false)?

   .. php:attr:: end_conference_on_exit

      Was the endConferenceOnExit attribute set on this participant (true or false)?

   .. php:attr:: uri

      The URI for this resource, relative to https://api.twilio.com.


PhoneNumber
=================

.. php:class:: Services_Twilio_Rest_IncomingPhoneNumber

   For more information, see the `IncomingPhoneNumber Instance Resource <http://www.twilio.com/docs/api/rest/incoming-phone-number#instance>`_ documentation.

   .. php:attr:: sid

      A 34 character string that uniquely idetifies this resource.

   .. php:attr:: date_created

      The date that this resource was created, given as GMT RFC 2822 format.

   .. php:attr:: date_updated

      The date that this resource was last updated, given as GMT RFC 2822 format.

   .. php:attr:: friendly_name

      A human readable descriptive text for this resource, up to 64 characters long. By default, the FriendlyName is a nicely formatted version of the phone number.

   .. php:attr:: account_sid

      The unique id of the Account responsible for this phone number.

   .. php:attr:: phone_number

      The incoming phone number. e.g., +16175551212 (E.164 format)

   .. php:attr:: api_version

      Calls to this phone number will start a new TwiML session with this API version.

   .. php:attr:: voice_caller_id_lookup

      Look up the caller's caller-ID name from the CNAM database (additional charges apply). Either true or false.

   .. php:attr:: voice_url

      The URL Twilio will request when this phone number receives a call.

   .. php:attr:: voice_method

      The HTTP method Twilio will use when requesting the above Url. Either GET or POST.

   .. php:attr:: voice_fallback_url

      The URL that Twilio will request if an error occurs retrieving or executing the TwiML requested by Url.

   .. php:attr:: voice_fallback_method

      The HTTP method Twilio will use when requesting the VoiceFallbackUrl. Either GET or POST.

   .. php:attr:: status_callback

      The URL that Twilio will request to pass status parameters (such as call ended) to your application.

   .. php:attr:: status_callback_method

      The HTTP method Twilio will use to make requests to the StatusCallback URL. Either GET or POST.

   .. php:attr:: sms_url

      The URL Twilio will request when receiving an incoming SMS message to this number.

   .. php:attr:: sms_method

      The HTTP method Twilio will use when making requests to the SmsUrl. Either GET or POST.

   .. php:attr:: sms_fallback_url

      The URL that Twilio will request if an error occurs retrieving or executing the TwiML from SmsUrl.

   .. php:attr:: sms_fallback_method

      The HTTP method Twilio will use when requesting the above URL. Either GET or POST.

   .. php:attr:: uri

      The URI for this resource, relative to https://api.twilio.com.

AvailablePhoneNumber
========================

.. php:class:: Services_Twilio_Rest_AvailablePhoneNumber

   For more information, see the `AvailablePhoneNumber Instance Resource <http://www.twilio.com/docs/api/rest/available-phone-numbers#instance>`_ documentation.

   .. php:attr:: friendly_name

      A nicely-formatted version of the phone number.

   .. php:attr:: phone_number

      The phone number, in E.164 (i.e. "+1") format.

   .. php:attr:: lata

      The LATA of this phone number.

   .. php:attr:: rate_center

      The rate center of this phone number.

   .. php:attr:: latitude

      The latitude coordinate of this phone number.

   .. php:attr:: longitude

      The longitude coordinate of this phone number.

   .. php:attr:: region

      The two-letter state or province abbreviation of this phone number.

   .. php:attr:: postal_code

      The postal (zip) code of this phone number.

   .. php:attr:: iso_country


Recording
=============

.. php:class:: Services_Twilio_Rest_Recording

   For more information, see the `Recording Instance Resource <http://www.twilio.com/docs/api/rest/recording#instance>`_ documentation.

   .. php:attr:: sid

      A 34 character string that uniquely identifies this resource.

   .. php:attr:: date_created

      The date that this resource was created, given in RFC 2822 format.

   .. php:attr:: date_updated

      The date that this resource was last updated, given in RFC 2822 format.

   .. php:attr:: account_sid

      The unique id of the Account responsible for this recording.

   .. php:attr:: call_sid

      The call during which the recording was made.

   .. php:attr:: duration

      The length of the recording, in seconds.

   .. php:attr:: api_version

      The version of the API in use during the recording.

   .. php:attr:: uri

      The URI for this resource, relative to https://api.twilio.com

   .. php:attr:: subresource_uris

      The list of subresources under this account

   .. php:attr:: formats

      A diciontary of the audio formats available for this recording

      .. code-block:: php

          array(
              'wav' => 'https://api.twilio.com/path/to/recording.wav',
              'mp3' => 'https://api.twilio.com/path/to/recording.mp3',
          )

SmsMessage
===========

.. php:class:: Services_Twilio_Rest_SmsMessage

   For more information, see the `SMS Message Instance Resource <http://www.twilio.com/docs/api/rest/sms#instance>`_ documentation.

   .. php:attr:: sid

      A 34 character string that uniquely identifies this resource.

   .. php:attr:: date_created

      The date that this resource was created, given in RFC 2822 format.

   .. php:attr:: date_updated

      The date that this resource was last updated, given in RFC 2822 format.

   .. php:attr:: date_sent

      The date that the SMS was sent, given in RFC 2822 format.

   .. php:attr:: account_sid

      The unique id of the Account that sent this SMS message.

   .. php:attr:: from

      The phone number that initiated the message in E.164 format. For incoming messages, this will be the remote phone. For outgoing messages, this will be one of your Twilio phone numbers.

   .. php:attr:: to

      The phone number that received the message in E.164 format. For incoming messages, this will be one of your Twilio phone numbers. For outgoing messages, this will be the remote phone.

   .. php:attr:: body

      The text body of the SMS message. Up to 160 characters long.

   .. php:attr:: status

      The status of this SMS message. Either queued, sending, sent, or failed.

   .. php:attr:: direction

      The direction of this SMS message. incoming for incoming messages, outbound-api for messages initiated via the REST API, outbound-call for messages initiated during a call or outbound-reply for messages initiated in response to an incoming SMS.

   .. php:attr:: price

      The amount billed for the message.

   .. php:attr:: api_version

      The version of the Twilio API used to process the SMS message.

   .. php:attr:: uri

      The URI for this resource, relative to https://api.twilio.com


Transcription
==================

.. php:class:: Services_Twilio_Rest_Transcription

   For more information, see the `Transcription Instance Resource <http://www.twilio.com/docs/api/rest/transcription#instance>`_ documentation.

   .. php:attr:: sid

      A 34 character string that uniquely identifies this resource.

   .. php:attr:: date_created

      The date that this resource was created, given in RFC 2822 format.

   .. php:attr:: date_updated

      The date that this resource was last updated, given in RFC 2822 format.

   .. php:attr:: account_sid

      The unique id of the Account responsible for this transcription.

   .. php:attr:: status

      A string representing the status of the transcription: in-progress, completed or failed.

   .. php:attr:: recording_sid

      The unique id of the Recording this Transcription was made of.

   .. php:attr:: duration

      The duration of the transcribed audio, in seconds.

   .. php:attr:: transcription_text

      The text content of the transcription.

   .. php:attr:: price

      The charge for this transcript in USD. Populated after the transcript is completed. Note, this value may not be immediately available.

   .. php:attr:: uri

      The URI for this resource, relative to https://api.twilio.com


