.. _api-rest:

===================
REST Documentation
===================

Account
>>>>>>>>>

   .. attribute:: sid

      A 34 character string that uniquely identifies this account.

   .. attribute:: date_created

      The date that this account was created, in GMT in RFC 2822 format

   .. attribute:: date_updated

      The date that this account was last updated, in GMT in RFC 2822 format.

   .. attribute:: friendly_name

      A human readable description of this account, up to 64 characters long. By default the FriendlyName is your email address.

   .. attribute:: status

      The status of this account. Usually active, but can be suspended if you've been bad, or closed if you've been horrible.

   .. attribute:: auth_token

      The authorization token for this account. This token should be kept a secret, so no sharing.

Call
>>>>>>

   .. attribute:: sid

      A 34 character string that uniquely identifies this resource.

   .. attribute:: parent_call_sid 

      A 34 character string that uniquely identifies the call that created this leg.

   .. attribute:: date_created

      The date that this resource was created, given as GMT in RFC 2822 format.

   .. attribute:: date_updated

      The date that this resource was last updated, given as GMT in RFC 2822 format.

   .. attribute:: account_sid

      The unique id of the Account responsible for creating this call.

   .. attribute:: to

      The phone number that received this call. e.g., +16175551212 (E.164 format)

   .. attribute:: from_ 

      The phone number that made this call. e.g., +16175551212 (E.164 format)

   .. attribute:: phone_number_sid

      If the call was inbound, this is the Sid of the IncomingPhoneNumber that received the call. If the call was outbound, it is the Sid of the OutgoingCallerId from which the call was placed.

   .. attribute:: status

      A string representing the status of the call. May be :data:`QUEUED`, :data:`RINGING`, :data:`IN-PROGRESS`, :data:`COMPLETED`, :data:`FAILED`, :data:`BUSY` or :data:`NO_ANSWER`.

   .. attribute:: start_time

      The start time of the call, given as GMT in RFC 2822 format. Empty if the call has not yet been dialed.

   .. attribute:: end_time
   
      The end time of the call, given as GMT in RFC 2822 format. Empty if the call did not complete successfully.

   .. attribute:: duration

      The length of the call in seconds. This value is empty for busy, failed, unanswered or ongoing calls.

   .. attribute:: price 
   
      The charge for this call in USD. Populated after the call is completed. May not be immediately available.

   .. attribute:: direction
   
      A string describing the direction of the call. inbound for inbound calls, outbound-api for calls initiated via the REST API or outbound-dial for calls initiated by a <Dial> verb.

   .. attribute:: answered_by

      If this call was initiated with answering machine detection, either human or machine. Empty otherwise.

   .. attribute:: forwarded_from

      If this call was an incoming call forwarded from another number, the forwarding phone number (depends on carrier supporting forwarding). Empty otherwise.

   .. attribute:: caller_name

      If this call was an incoming call from a phone number with Caller ID Lookup enabled, the caller's name. Empty otherwise.

CallerId
>>>>>>>>>>>

   .. attribute:: sid

      A 34 character string that uniquely identifies this resource.

   .. attribute:: date_created

      The date that this resource was created, given in RFC 2822 format.

   .. attribute:: date_updated

      The date that this resource was last updated, given in RFC 2822 format.

   .. attribute:: friendly_name

      A human readable descriptive text for this resource, up to 64 characters long. By default, the FriendlyName is a nicely formatted version of the phone number.

   .. attribute:: account_sid

      The unique id of the Account responsible for this Caller Id.

   .. attribute:: phone_number

      The incoming phone number. Formatted with a '+' and country code e.g., +16175551212 (E.164 format).

   .. attribute:: uri

      The URI for this resource, relative to https://api.twilio.com.

Conference
>>>>>>>>>>>>

   .. attribute:: sid

      A 34 character string that uniquely identifies this conference.

   .. attribute:: friendly_name

      A user provided string that identifies this conference room.

   .. attribute:: status

      A string representing the status of the conference. May be init, in-progress, or completed.

   .. attribute:: date_created

      The date that this conference was created, given as GMT in RFC 2822 format.

   .. attribute:: date_updated

      The date that this conference was last updated, given as GMT in RFC 2822 format.

   .. attribute:: account_sid

      The unique id of the Account responsible for creating this conference.

   .. attribute:: uri

      The URI for this resource, relative to https://api.twilio.com.

   .. attribute:: participants

      The :class:`Participants` resource, listing people currenlty in this conference


Notification
>>>>>>>>>>>>>>

   .. attribute:: sid

      A 34 character string that uniquely identifies this resource.

   .. attribute:: date_created

      The date that this resource was created, given in RFC 2822 format.

   .. attribute:: date_updated

      The date that this resource was last updated, given in RFC 2822 format.

   .. attribute:: account_sid

      The unique id of the Account responsible for this notification.

   .. attribute:: call_sid

      CallSid is the unique id of the call during which the notification was generated. Empty if the notification was generated by the REST API without regard to a specific phone call.

   .. attribute:: api_version

      The version of the Twilio in use when this notification was generated.

   .. attribute:: log

      An integer log level corresponding to the type of notification: 0 is ERROR, 1 is WARNING.

   .. attribute:: error_code

      A unique error code for the error condition. You can lookup errors, with possible causes and solutions, in our Error Dictionary.

   .. attribute:: more_info

      A URL for more information about the error condition. The URL is a page in our Error Dictionary.

   .. attribute:: message_text

      The text of the notification.

   .. attribute:: message_date

      The date the notification was actually generated, given in RFC 2822 format. Due to buffering, this may be slightly different than the DateCreated date.

   .. attribute:: request_url

      The URL of the resource that generated the notification. If the notification was generated during a phone call: This is the URL of the resource on YOUR SERVER that caused the notification. If the notification was generated by your use of the REST API: This is the URL of the REST resource you were attempting to request on Twilio's servers.

   .. attribute:: request_method

      The HTTP method in use for the request that generated the notification. If the notification was generated during a phone call: The HTTP Method use to request the resource on your server. If the notification was generated by your use of the REST API: This is the HTTP method used in your request to the REST resource on Twilio's servers.

   .. attribute:: request_variables

      The Twilio-generated HTTP GET or POST variables sent to your server. Alternatively, if the notification was generated by the REST API, this field will include any HTTP POST or PUT variables you sent to the REST API.

   .. attribute:: response_headers

      The HTTP headers returned by your server.

   .. attribute:: response_body

      The HTTP body returned by your server.

   .. attribute:: uri

      The URI for this resource, relative to https://api.twilio.com

Participant
>>>>>>>>>>>>>>

   .. attribute:: call_sid

      A 34 character string that uniquely identifies the call that is connected to this conference

   .. attribute:: conference_sid

      A 34 character string that identifies the conference this participant is in

   .. attribute:: date_created

      The date that this resource was created, given in RFC 2822 format.

   .. attribute:: date_updated

      The date that this resource was last updated, given in RFC 2822 format.

   .. attribute:: account_sid

      The unique id of the Account that created this conference

   .. attribute:: muted

      true if this participant is currently muted. false otherwise.

   .. attribute:: start_conference_on_enter

      Was the startConferenceOnEnter attribute set on this participant (true or false)?

   .. attribute:: end_conference_on_exit

      Was the endConferenceOnExit attribute set on this participant (true or false)?

   .. attribute:: uri

      The URI for this resource, relative to https://api.twilio.com.


PhoneNumber
>>>>>>>>>>>>>>

   .. attribute:: sid

      A 34 character string that uniquely idetifies this resource.

   .. attribute:: date_created

      The date that this resource was created, given as GMT RFC 2822 format.

   .. attribute:: date_updated

      The date that this resource was last updated, given as GMT RFC 2822 format.

   .. attribute:: friendly_name

      A human readable descriptive text for this resource, up to 64 characters long. By default, the FriendlyName is a nicely formatted version of the phone number.

   .. attribute:: account_sid

      The unique id of the Account responsible for this phone number.

   .. attribute:: phone_number

      The incoming phone number. e.g., +16175551212 (E.164 format)

   .. attribute:: api_version

      Calls to this phone number will start a new TwiML session with this API version.

   .. attribute:: voice_caller_id_lookup

      Look up the caller's caller-ID name from the CNAM database (additional charges apply). Either true or false.

   .. attribute:: voice_url

      The URL Twilio will request when this phone number receives a call.

   .. attribute:: voice_method

      The HTTP method Twilio will use when requesting the above Url. Either GET or POST.

   .. attribute:: voice_fallback_url

      The URL that Twilio will request if an error occurs retrieving or executing the TwiML requested by Url.

   .. attribute:: voice_fallback_method

      The HTTP method Twilio will use when requesting the VoiceFallbackUrl. Either GET or POST.

   .. attribute:: status_callback

      The URL that Twilio will request to pass status parameters (such as call ended) to your application.

   .. attribute:: status_callback_method

      The HTTP method Twilio will use to make requests to the StatusCallback URL. Either GET or POST.

   .. attribute:: sms_url

      The URL Twilio will request when receiving an incoming SMS message to this number.

   .. attribute:: sms_method

      The HTTP method Twilio will use when making requests to the SmsUrl. Either GET or POST.

   .. attribute:: sms_fallback_url

      The URL that Twilio will request if an error occurs retrieving or executing the TwiML from SmsUrl.

   .. attribute:: sms_fallback_method

      The HTTP method Twilio will use when requesting the above URL. Either GET or POST.

   .. attribute:: uri

      The URI for this resource, relative to https://api.twilio.com.

AvailablePhoneNumber

   .. attribute:: friendly_name

      A nicely-formatted version of the phone number.

   .. attribute:: phone_number

      The phone number, in E.164 (i.e. "+1") format.

   .. attribute:: lata

      The LATA of this phone number.

   .. attribute:: rate_center

      The rate center of this phone number.

   .. attribute:: latitude

      The latitude coordinate of this phone number.

   .. attribute:: longitude

      The longitude coordinate of this phone number.

   .. attribute:: region

      The two-letter state or province abbreviation of this phone number.

   .. attribute:: postal_code

      The postal (zip) code of this phone number.

   .. attribute:: iso_country


Recording
>>>>>>>>>>>

   .. attribute:: sid

      A 34 character string that uniquely identifies this resource.

   .. attribute:: date_created

      The date that this resource was created, given in RFC 2822 format.

   .. attribute:: date_updated

      The date that this resource was last updated, given in RFC 2822 format.

   .. attribute:: account_sid

      The unique id of the Account responsible for this recording.

   .. attribute:: call_sid

      The call during which the recording was made.

   .. attribute:: duration

      The length of the recording, in seconds.

   .. attribute:: api_version

      The version of the API in use during the recording.

   .. attribute:: uri

      The URI for this resource, relative to https://api.twilio.com

   .. attribute:: subresource_uris

      The list of subresources under this account

   .. attribute:: formats

      A diciontary of the audio formats available for this recording

      .. code-block:: php

          array(
              'wav' => 'https://api.twilio.com/path/to/recording.wav',
              'mp3' => 'https://api.twilio.com/path/to/recording.mp3',
          )

SmsMessage
>>>>>>>>>>>>

   .. attribute:: sid

      A 34 character string that uniquely identifies this resource.

   .. attribute:: date_created

      The date that this resource was created, given in RFC 2822 format.

   .. attribute:: date_updated

      The date that this resource was last updated, given in RFC 2822 format.

   .. attribute:: date_sent

      The date that the SMS was sent, given in RFC 2822 format.

   .. attribute:: account_sid

      The unique id of the Account that sent this SMS message.

   .. attribute:: from

      The phone number that initiated the message in E.164 format. For incoming messages, this will be the remote phone. For outgoing messages, this will be one of your Twilio phone numbers.

   .. attribute:: to

      The phone number that received the message in E.164 format. For incoming messages, this will be one of your Twilio phone numbers. For outgoing messages, this will be the remote phone.

   .. attribute:: body

      The text body of the SMS message. Up to 160 characters long.

   .. attribute:: status

      The status of this SMS message. Either queued, sending, sent, or failed.

   .. attribute:: direction

      The direction of this SMS message. incoming for incoming messages, outbound-api for messages initiated via the REST API, outbound-call for messages initiated during a call or outbound-reply for messages initiated in response to an incoming SMS.

   .. attribute:: price

      The amount billed for the message.

   .. attribute:: api_version

      The version of the Twilio API used to process the SMS message.

   .. attribute:: uri

      The URI for this resource, relative to https://api.twilio.com


Transcription
>>>>>>>>>>>>>>>

   .. attribute:: sid

      A 34 character string that uniquely identifies this resource.

   .. attribute:: date_created

      The date that this resource was created, given in RFC 2822 format.

   .. attribute:: date_updated

      The date that this resource was last updated, given in RFC 2822 format.

   .. attribute:: account_sid
   
      The unique id of the Account responsible for this transcription.

   .. attribute:: status

      A string representing the status of the transcription: in-progress, completed or failed.

   .. attribute:: recording_sid

      The unique id of the Recording this Transcription was made of.

   .. attribute:: duration

      The duration of the transcribed audio, in seconds.

   .. attribute:: transcription_text

      The text content of the transcription.

   .. attribute:: price

      The charge for this transcript in USD. Populated after the transcript is completed. Note, this value may not be immediately available.

   .. attribute:: uri

      The URI for this resource, relative to https://api.twilio.com


