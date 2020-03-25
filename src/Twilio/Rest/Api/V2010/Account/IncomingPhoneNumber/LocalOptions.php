<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Api\V2010\Account\IncomingPhoneNumber;

use Twilio\Options;
use Twilio\Values;

abstract class LocalOptions {
    /**
     * @param bool $beta Whether to include new phone numbers
     * @param string $friendlyName A string that identifies the resources to read
     * @param string $phoneNumber The phone numbers of the resources to read
     * @param string $origin Include phone numbers based on their origin. By
     *                       default, phone numbers of all origin are included.
     * @return ReadLocalOptions Options builder
     */
    public static function read(bool $beta = Values::NONE, string $friendlyName = Values::NONE, string $phoneNumber = Values::NONE, string $origin = Values::NONE): ReadLocalOptions {
        return new ReadLocalOptions($beta, $friendlyName, $phoneNumber, $origin);
    }

    /**
     * @param string $apiVersion The API version to use for incoming calls made to
     *                           the new phone number
     * @param string $friendlyName A string to describe the new phone number
     * @param string $smsApplicationSid The SID of the application to handle SMS
     *                                  messages
     * @param string $smsFallbackMethod The HTTP method we use to call
     *                                  status_callback
     * @param string $smsFallbackUrl The URL we call when an error occurs while
     *                               executing TwiML
     * @param string $smsMethod The HTTP method to use with sms url
     * @param string $smsUrl The URL we should call when the new phone number
     *                       receives an incoming SMS message
     * @param string $statusCallback The URL we should call to send status
     *                               information to your application
     * @param string $statusCallbackMethod HTTP method we should use to call
     *                                     status_callback
     * @param string $voiceApplicationSid The SID of the application to handle the
     *                                    new phone number
     * @param bool $voiceCallerIdLookup Whether to lookup the caller's name
     * @param string $voiceFallbackMethod The HTTP method used with
     *                                    voice_fallback_url
     * @param string $voiceFallbackUrl The URL we will call when an error occurs in
     *                                 TwiML
     * @param string $voiceMethod The HTTP method used with the voice_url
     * @param string $voiceUrl The URL we should call when the phone number
     *                         receives a call
     * @param string $identitySid The SID of the Identity resource to associate
     *                            with the new phone number
     * @param string $addressSid The SID of the Address resource associated with
     *                           the phone number
     * @param string $emergencyStatus Status determining whether the new phone
     *                                number is enabled for emergency calling
     * @param string $emergencyAddressSid The emergency address configuration to
     *                                    use for emergency calling
     * @param string $trunkSid SID of the trunk to handle calls to the new phone
     *                         number
     * @param string $voiceReceiveMode Incoming call type: fax or voice
     * @param string $bundleSid The SID of the Bundle resource associated with
     *                          number
     * @return CreateLocalOptions Options builder
     */
    public static function create(string $apiVersion = Values::NONE, string $friendlyName = Values::NONE, string $smsApplicationSid = Values::NONE, string $smsFallbackMethod = Values::NONE, string $smsFallbackUrl = Values::NONE, string $smsMethod = Values::NONE, string $smsUrl = Values::NONE, string $statusCallback = Values::NONE, string $statusCallbackMethod = Values::NONE, string $voiceApplicationSid = Values::NONE, bool $voiceCallerIdLookup = Values::NONE, string $voiceFallbackMethod = Values::NONE, string $voiceFallbackUrl = Values::NONE, string $voiceMethod = Values::NONE, string $voiceUrl = Values::NONE, string $identitySid = Values::NONE, string $addressSid = Values::NONE, string $emergencyStatus = Values::NONE, string $emergencyAddressSid = Values::NONE, string $trunkSid = Values::NONE, string $voiceReceiveMode = Values::NONE, string $bundleSid = Values::NONE): CreateLocalOptions {
        return new CreateLocalOptions($apiVersion, $friendlyName, $smsApplicationSid, $smsFallbackMethod, $smsFallbackUrl, $smsMethod, $smsUrl, $statusCallback, $statusCallbackMethod, $voiceApplicationSid, $voiceCallerIdLookup, $voiceFallbackMethod, $voiceFallbackUrl, $voiceMethod, $voiceUrl, $identitySid, $addressSid, $emergencyStatus, $emergencyAddressSid, $trunkSid, $voiceReceiveMode, $bundleSid);
    }
}

class ReadLocalOptions extends Options {
    /**
     * @param bool $beta Whether to include new phone numbers
     * @param string $friendlyName A string that identifies the resources to read
     * @param string $phoneNumber The phone numbers of the resources to read
     * @param string $origin Include phone numbers based on their origin. By
     *                       default, phone numbers of all origin are included.
     */
    public function __construct(bool $beta = Values::NONE, string $friendlyName = Values::NONE, string $phoneNumber = Values::NONE, string $origin = Values::NONE) {
        $this->options['beta'] = $beta;
        $this->options['friendlyName'] = $friendlyName;
        $this->options['phoneNumber'] = $phoneNumber;
        $this->options['origin'] = $origin;
    }

    /**
     * Whether to include phone numbers new to the Twilio platform. Can be: `true` or `false` and the default is `true`.
     *
     * @param bool $beta Whether to include new phone numbers
     * @return $this Fluent Builder
     */
    public function setBeta(bool $beta): self {
        $this->options['beta'] = $beta;
        return $this;
    }

    /**
     * A string that identifies the resources to read.
     *
     * @param string $friendlyName A string that identifies the resources to read
     * @return $this Fluent Builder
     */
    public function setFriendlyName(string $friendlyName): self {
        $this->options['friendlyName'] = $friendlyName;
        return $this;
    }

    /**
     * The phone numbers of the IncomingPhoneNumber resources to read. You can specify partial numbers and use '*' as a wildcard for any digit.
     *
     * @param string $phoneNumber The phone numbers of the resources to read
     * @return $this Fluent Builder
     */
    public function setPhoneNumber(string $phoneNumber): self {
        $this->options['phoneNumber'] = $phoneNumber;
        return $this;
    }

    /**
     * Whether to include phone numbers based on their origin. Can be: `twilio` or `hosted`. By default, phone numbers of all origin are included.
     *
     * @param string $origin Include phone numbers based on their origin. By
     *                       default, phone numbers of all origin are included.
     * @return $this Fluent Builder
     */
    public function setOrigin(string $origin): self {
        $this->options['origin'] = $origin;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        $options = [];
        foreach (Values::of($this->options) as $key => $value) {
                $options[] = "$key=$value";
        }
        return '[Twilio.Api.V2010.ReadLocalOptions ' . \implode(' ', $options) . ']';
    }
}

class CreateLocalOptions extends Options {
    /**
     * @param string $apiVersion The API version to use for incoming calls made to
     *                           the new phone number
     * @param string $friendlyName A string to describe the new phone number
     * @param string $smsApplicationSid The SID of the application to handle SMS
     *                                  messages
     * @param string $smsFallbackMethod The HTTP method we use to call
     *                                  status_callback
     * @param string $smsFallbackUrl The URL we call when an error occurs while
     *                               executing TwiML
     * @param string $smsMethod The HTTP method to use with sms url
     * @param string $smsUrl The URL we should call when the new phone number
     *                       receives an incoming SMS message
     * @param string $statusCallback The URL we should call to send status
     *                               information to your application
     * @param string $statusCallbackMethod HTTP method we should use to call
     *                                     status_callback
     * @param string $voiceApplicationSid The SID of the application to handle the
     *                                    new phone number
     * @param bool $voiceCallerIdLookup Whether to lookup the caller's name
     * @param string $voiceFallbackMethod The HTTP method used with
     *                                    voice_fallback_url
     * @param string $voiceFallbackUrl The URL we will call when an error occurs in
     *                                 TwiML
     * @param string $voiceMethod The HTTP method used with the voice_url
     * @param string $voiceUrl The URL we should call when the phone number
     *                         receives a call
     * @param string $identitySid The SID of the Identity resource to associate
     *                            with the new phone number
     * @param string $addressSid The SID of the Address resource associated with
     *                           the phone number
     * @param string $emergencyStatus Status determining whether the new phone
     *                                number is enabled for emergency calling
     * @param string $emergencyAddressSid The emergency address configuration to
     *                                    use for emergency calling
     * @param string $trunkSid SID of the trunk to handle calls to the new phone
     *                         number
     * @param string $voiceReceiveMode Incoming call type: fax or voice
     * @param string $bundleSid The SID of the Bundle resource associated with
     *                          number
     */
    public function __construct(string $apiVersion = Values::NONE, string $friendlyName = Values::NONE, string $smsApplicationSid = Values::NONE, string $smsFallbackMethod = Values::NONE, string $smsFallbackUrl = Values::NONE, string $smsMethod = Values::NONE, string $smsUrl = Values::NONE, string $statusCallback = Values::NONE, string $statusCallbackMethod = Values::NONE, string $voiceApplicationSid = Values::NONE, bool $voiceCallerIdLookup = Values::NONE, string $voiceFallbackMethod = Values::NONE, string $voiceFallbackUrl = Values::NONE, string $voiceMethod = Values::NONE, string $voiceUrl = Values::NONE, string $identitySid = Values::NONE, string $addressSid = Values::NONE, string $emergencyStatus = Values::NONE, string $emergencyAddressSid = Values::NONE, string $trunkSid = Values::NONE, string $voiceReceiveMode = Values::NONE, string $bundleSid = Values::NONE) {
        $this->options['apiVersion'] = $apiVersion;
        $this->options['friendlyName'] = $friendlyName;
        $this->options['smsApplicationSid'] = $smsApplicationSid;
        $this->options['smsFallbackMethod'] = $smsFallbackMethod;
        $this->options['smsFallbackUrl'] = $smsFallbackUrl;
        $this->options['smsMethod'] = $smsMethod;
        $this->options['smsUrl'] = $smsUrl;
        $this->options['statusCallback'] = $statusCallback;
        $this->options['statusCallbackMethod'] = $statusCallbackMethod;
        $this->options['voiceApplicationSid'] = $voiceApplicationSid;
        $this->options['voiceCallerIdLookup'] = $voiceCallerIdLookup;
        $this->options['voiceFallbackMethod'] = $voiceFallbackMethod;
        $this->options['voiceFallbackUrl'] = $voiceFallbackUrl;
        $this->options['voiceMethod'] = $voiceMethod;
        $this->options['voiceUrl'] = $voiceUrl;
        $this->options['identitySid'] = $identitySid;
        $this->options['addressSid'] = $addressSid;
        $this->options['emergencyStatus'] = $emergencyStatus;
        $this->options['emergencyAddressSid'] = $emergencyAddressSid;
        $this->options['trunkSid'] = $trunkSid;
        $this->options['voiceReceiveMode'] = $voiceReceiveMode;
        $this->options['bundleSid'] = $bundleSid;
    }

    /**
     * The API version to use for incoming calls made to the new phone number. The default is `2010-04-01`.
     *
     * @param string $apiVersion The API version to use for incoming calls made to
     *                           the new phone number
     * @return $this Fluent Builder
     */
    public function setApiVersion(string $apiVersion): self {
        $this->options['apiVersion'] = $apiVersion;
        return $this;
    }

    /**
     * A descriptive string that you created to describe the new phone number. It can be up to 64 characters long. By default, this is a formatted version of the phone number.
     *
     * @param string $friendlyName A string to describe the new phone number
     * @return $this Fluent Builder
     */
    public function setFriendlyName(string $friendlyName): self {
        $this->options['friendlyName'] = $friendlyName;
        return $this;
    }

    /**
     * The SID of the application that should handle SMS messages sent to the new phone number. If an `sms_application_sid` is present, we ignore all of the `sms_*_url` urls and use those set on the application.
     *
     * @param string $smsApplicationSid The SID of the application to handle SMS
     *                                  messages
     * @return $this Fluent Builder
     */
    public function setSmsApplicationSid(string $smsApplicationSid): self {
        $this->options['smsApplicationSid'] = $smsApplicationSid;
        return $this;
    }

    /**
     * The HTTP method that we should use to call `sms_fallback_url`. Can be: `GET` or `POST` and defaults to `POST`.
     *
     * @param string $smsFallbackMethod The HTTP method we use to call
     *                                  status_callback
     * @return $this Fluent Builder
     */
    public function setSmsFallbackMethod(string $smsFallbackMethod): self {
        $this->options['smsFallbackMethod'] = $smsFallbackMethod;
        return $this;
    }

    /**
     * The URL that we should call when an error occurs while requesting or executing the TwiML defined by `sms_url`.
     *
     * @param string $smsFallbackUrl The URL we call when an error occurs while
     *                               executing TwiML
     * @return $this Fluent Builder
     */
    public function setSmsFallbackUrl(string $smsFallbackUrl): self {
        $this->options['smsFallbackUrl'] = $smsFallbackUrl;
        return $this;
    }

    /**
     * The HTTP method that we should use to call `sms_url`. Can be: `GET` or `POST` and defaults to `POST`.
     *
     * @param string $smsMethod The HTTP method to use with sms url
     * @return $this Fluent Builder
     */
    public function setSmsMethod(string $smsMethod): self {
        $this->options['smsMethod'] = $smsMethod;
        return $this;
    }

    /**
     * The URL we should call when the new phone number receives an incoming SMS message.
     *
     * @param string $smsUrl The URL we should call when the new phone number
     *                       receives an incoming SMS message
     * @return $this Fluent Builder
     */
    public function setSmsUrl(string $smsUrl): self {
        $this->options['smsUrl'] = $smsUrl;
        return $this;
    }

    /**
     * The URL we should call using the `status_callback_method` to send status information to your application.
     *
     * @param string $statusCallback The URL we should call to send status
     *                               information to your application
     * @return $this Fluent Builder
     */
    public function setStatusCallback(string $statusCallback): self {
        $this->options['statusCallback'] = $statusCallback;
        return $this;
    }

    /**
     * The HTTP method we should use to call `status_callback`. Can be: `GET` or `POST` and defaults to `POST`.
     *
     * @param string $statusCallbackMethod HTTP method we should use to call
     *                                     status_callback
     * @return $this Fluent Builder
     */
    public function setStatusCallbackMethod(string $statusCallbackMethod): self {
        $this->options['statusCallbackMethod'] = $statusCallbackMethod;
        return $this;
    }

    /**
     * The SID of the application we should use to handle calls to the new phone number. If a `voice_application_sid` is present, we ignore all of the voice urls and use only those set on the application. Setting a `voice_application_sid` will automatically delete your `trunk_sid` and vice versa.
     *
     * @param string $voiceApplicationSid The SID of the application to handle the
     *                                    new phone number
     * @return $this Fluent Builder
     */
    public function setVoiceApplicationSid(string $voiceApplicationSid): self {
        $this->options['voiceApplicationSid'] = $voiceApplicationSid;
        return $this;
    }

    /**
     * Whether to lookup the caller's name from the CNAM database and post it to your app. Can be: `true` or `false` and defaults to `false`.
     *
     * @param bool $voiceCallerIdLookup Whether to lookup the caller's name
     * @return $this Fluent Builder
     */
    public function setVoiceCallerIdLookup(bool $voiceCallerIdLookup): self {
        $this->options['voiceCallerIdLookup'] = $voiceCallerIdLookup;
        return $this;
    }

    /**
     * The HTTP method that we should use to call `voice_fallback_url`. Can be: `GET` or `POST` and defaults to `POST`.
     *
     * @param string $voiceFallbackMethod The HTTP method used with
     *                                    voice_fallback_url
     * @return $this Fluent Builder
     */
    public function setVoiceFallbackMethod(string $voiceFallbackMethod): self {
        $this->options['voiceFallbackMethod'] = $voiceFallbackMethod;
        return $this;
    }

    /**
     * The URL that we should call when an error occurs retrieving or executing the TwiML requested by `url`.
     *
     * @param string $voiceFallbackUrl The URL we will call when an error occurs in
     *                                 TwiML
     * @return $this Fluent Builder
     */
    public function setVoiceFallbackUrl(string $voiceFallbackUrl): self {
        $this->options['voiceFallbackUrl'] = $voiceFallbackUrl;
        return $this;
    }

    /**
     * The HTTP method that we should use to call `voice_url`. Can be: `GET` or `POST` and defaults to `POST`.
     *
     * @param string $voiceMethod The HTTP method used with the voice_url
     * @return $this Fluent Builder
     */
    public function setVoiceMethod(string $voiceMethod): self {
        $this->options['voiceMethod'] = $voiceMethod;
        return $this;
    }

    /**
     * The URL that we should call to answer a call to the new phone number. The `voice_url` will not be called if a `voice_application_sid` or a `trunk_sid` is set.
     *
     * @param string $voiceUrl The URL we should call when the phone number
     *                         receives a call
     * @return $this Fluent Builder
     */
    public function setVoiceUrl(string $voiceUrl): self {
        $this->options['voiceUrl'] = $voiceUrl;
        return $this;
    }

    /**
     * The SID of the Identity resource that we should associate with the new phone number. Some regions require an identity to meet local regulations.
     *
     * @param string $identitySid The SID of the Identity resource to associate
     *                            with the new phone number
     * @return $this Fluent Builder
     */
    public function setIdentitySid(string $identitySid): self {
        $this->options['identitySid'] = $identitySid;
        return $this;
    }

    /**
     * The SID of the Address resource we should associate with the new phone number. Some regions require addresses to meet local regulations.
     *
     * @param string $addressSid The SID of the Address resource associated with
     *                           the phone number
     * @return $this Fluent Builder
     */
    public function setAddressSid(string $addressSid): self {
        $this->options['addressSid'] = $addressSid;
        return $this;
    }

    /**
     * The configuration status parameter that determines whether the new phone number is enabled for emergency calling.
     *
     * @param string $emergencyStatus Status determining whether the new phone
     *                                number is enabled for emergency calling
     * @return $this Fluent Builder
     */
    public function setEmergencyStatus(string $emergencyStatus): self {
        $this->options['emergencyStatus'] = $emergencyStatus;
        return $this;
    }

    /**
     * The SID of the emergency address configuration to use for emergency calling from the new phone number.
     *
     * @param string $emergencyAddressSid The emergency address configuration to
     *                                    use for emergency calling
     * @return $this Fluent Builder
     */
    public function setEmergencyAddressSid(string $emergencyAddressSid): self {
        $this->options['emergencyAddressSid'] = $emergencyAddressSid;
        return $this;
    }

    /**
     * The SID of the Trunk we should use to handle calls to the new phone number. If a `trunk_sid` is present, we ignore all of the voice urls and voice applications and use only those set on the Trunk. Setting a `trunk_sid` will automatically delete your `voice_application_sid` and vice versa.
     *
     * @param string $trunkSid SID of the trunk to handle calls to the new phone
     *                         number
     * @return $this Fluent Builder
     */
    public function setTrunkSid(string $trunkSid): self {
        $this->options['trunkSid'] = $trunkSid;
        return $this;
    }

    /**
     * The configuration parameter for the new phone number to receive incoming voice calls or faxes. Can be: `fax` or `voice` and defaults to `voice`.
     *
     * @param string $voiceReceiveMode Incoming call type: fax or voice
     * @return $this Fluent Builder
     */
    public function setVoiceReceiveMode(string $voiceReceiveMode): self {
        $this->options['voiceReceiveMode'] = $voiceReceiveMode;
        return $this;
    }

    /**
     * The SID of the Bundle resource that you associate with the phone number. Some regions require a Bundle to meet local Regulations.
     *
     * @param string $bundleSid The SID of the Bundle resource associated with
     *                          number
     * @return $this Fluent Builder
     */
    public function setBundleSid(string $bundleSid): self {
        $this->options['bundleSid'] = $bundleSid;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        $options = [];
        foreach (Values::of($this->options) as $key => $value) {
                $options[] = "$key=$value";
        }
        return '[Twilio.Api.V2010.CreateLocalOptions ' . \implode(' ', $options) . ']';
    }
}