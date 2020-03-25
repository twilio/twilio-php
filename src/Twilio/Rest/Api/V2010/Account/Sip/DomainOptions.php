<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Api\V2010\Account\Sip;

use Twilio\Options;
use Twilio\Values;

abstract class DomainOptions {
    /**
     * @param string $friendlyName A string to describe the resource
     * @param string $voiceUrl The URL we should call when receiving a call
     * @param string $voiceMethod The HTTP method to use with voice_url
     * @param string $voiceFallbackUrl The URL we should call when an error occurs
     *                                 in executing TwiML
     * @param string $voiceFallbackMethod The HTTP method to use with
     *                                    voice_fallback_url
     * @param string $voiceStatusCallbackUrl The URL that we should call to pass
     *                                       status updates
     * @param string $voiceStatusCallbackMethod The HTTP method we should use to
     *                                          call `voice_status_callback_url`
     * @param bool $sipRegistration Whether SIP registration is allowed
     * @param bool $emergencyCallingEnabled Whether emergency calling is enabled
     *                                      for the domain.
     * @return CreateDomainOptions Options builder
     */
    public static function create(string $friendlyName = Values::NONE, string $voiceUrl = Values::NONE, string $voiceMethod = Values::NONE, string $voiceFallbackUrl = Values::NONE, string $voiceFallbackMethod = Values::NONE, string $voiceStatusCallbackUrl = Values::NONE, string $voiceStatusCallbackMethod = Values::NONE, bool $sipRegistration = Values::NONE, bool $emergencyCallingEnabled = Values::NONE): CreateDomainOptions {
        return new CreateDomainOptions($friendlyName, $voiceUrl, $voiceMethod, $voiceFallbackUrl, $voiceFallbackMethod, $voiceStatusCallbackUrl, $voiceStatusCallbackMethod, $sipRegistration, $emergencyCallingEnabled);
    }

    /**
     * @param string $friendlyName A string to describe the resource
     * @param string $voiceFallbackMethod The HTTP method used with
     *                                    voice_fallback_url
     * @param string $voiceFallbackUrl The URL we should call when an error occurs
     *                                 in executing TwiML
     * @param string $voiceMethod The HTTP method we should use with voice_url
     * @param string $voiceStatusCallbackMethod The HTTP method we should use to
     *                                          call voice_status_callback_url
     * @param string $voiceStatusCallbackUrl The URL that we should call to pass
     *                                       status updates
     * @param string $voiceUrl The URL we should call when receiving a call
     * @param bool $sipRegistration Whether SIP registration is allowed
     * @param string $domainName The unique address on Twilio to route SIP traffic
     * @param bool $emergencyCallingEnabled Whether emergency calling is enabled
     *                                      for the domain.
     * @return UpdateDomainOptions Options builder
     */
    public static function update(string $friendlyName = Values::NONE, string $voiceFallbackMethod = Values::NONE, string $voiceFallbackUrl = Values::NONE, string $voiceMethod = Values::NONE, string $voiceStatusCallbackMethod = Values::NONE, string $voiceStatusCallbackUrl = Values::NONE, string $voiceUrl = Values::NONE, bool $sipRegistration = Values::NONE, string $domainName = Values::NONE, bool $emergencyCallingEnabled = Values::NONE): UpdateDomainOptions {
        return new UpdateDomainOptions($friendlyName, $voiceFallbackMethod, $voiceFallbackUrl, $voiceMethod, $voiceStatusCallbackMethod, $voiceStatusCallbackUrl, $voiceUrl, $sipRegistration, $domainName, $emergencyCallingEnabled);
    }
}

class CreateDomainOptions extends Options {
    /**
     * @param string $friendlyName A string to describe the resource
     * @param string $voiceUrl The URL we should call when receiving a call
     * @param string $voiceMethod The HTTP method to use with voice_url
     * @param string $voiceFallbackUrl The URL we should call when an error occurs
     *                                 in executing TwiML
     * @param string $voiceFallbackMethod The HTTP method to use with
     *                                    voice_fallback_url
     * @param string $voiceStatusCallbackUrl The URL that we should call to pass
     *                                       status updates
     * @param string $voiceStatusCallbackMethod The HTTP method we should use to
     *                                          call `voice_status_callback_url`
     * @param bool $sipRegistration Whether SIP registration is allowed
     * @param bool $emergencyCallingEnabled Whether emergency calling is enabled
     *                                      for the domain.
     */
    public function __construct(string $friendlyName = Values::NONE, string $voiceUrl = Values::NONE, string $voiceMethod = Values::NONE, string $voiceFallbackUrl = Values::NONE, string $voiceFallbackMethod = Values::NONE, string $voiceStatusCallbackUrl = Values::NONE, string $voiceStatusCallbackMethod = Values::NONE, bool $sipRegistration = Values::NONE, bool $emergencyCallingEnabled = Values::NONE) {
        $this->options['friendlyName'] = $friendlyName;
        $this->options['voiceUrl'] = $voiceUrl;
        $this->options['voiceMethod'] = $voiceMethod;
        $this->options['voiceFallbackUrl'] = $voiceFallbackUrl;
        $this->options['voiceFallbackMethod'] = $voiceFallbackMethod;
        $this->options['voiceStatusCallbackUrl'] = $voiceStatusCallbackUrl;
        $this->options['voiceStatusCallbackMethod'] = $voiceStatusCallbackMethod;
        $this->options['sipRegistration'] = $sipRegistration;
        $this->options['emergencyCallingEnabled'] = $emergencyCallingEnabled;
    }

    /**
     * A descriptive string that you created to describe the resource. It can be up to 64 characters long.
     *
     * @param string $friendlyName A string to describe the resource
     * @return $this Fluent Builder
     */
    public function setFriendlyName(string $friendlyName): self {
        $this->options['friendlyName'] = $friendlyName;
        return $this;
    }

    /**
     * The URL we should when the domain receives a call.
     *
     * @param string $voiceUrl The URL we should call when receiving a call
     * @return $this Fluent Builder
     */
    public function setVoiceUrl(string $voiceUrl): self {
        $this->options['voiceUrl'] = $voiceUrl;
        return $this;
    }

    /**
     * The HTTP method we should use to call `voice_url`. Can be: `GET` or `POST`.
     *
     * @param string $voiceMethod The HTTP method to use with voice_url
     * @return $this Fluent Builder
     */
    public function setVoiceMethod(string $voiceMethod): self {
        $this->options['voiceMethod'] = $voiceMethod;
        return $this;
    }

    /**
     * The URL that we should call when an error occurs while retrieving or executing the TwiML from `voice_url`.
     *
     * @param string $voiceFallbackUrl The URL we should call when an error occurs
     *                                 in executing TwiML
     * @return $this Fluent Builder
     */
    public function setVoiceFallbackUrl(string $voiceFallbackUrl): self {
        $this->options['voiceFallbackUrl'] = $voiceFallbackUrl;
        return $this;
    }

    /**
     * The HTTP method we should use to call `voice_fallback_url`. Can be: `GET` or `POST`.
     *
     * @param string $voiceFallbackMethod The HTTP method to use with
     *                                    voice_fallback_url
     * @return $this Fluent Builder
     */
    public function setVoiceFallbackMethod(string $voiceFallbackMethod): self {
        $this->options['voiceFallbackMethod'] = $voiceFallbackMethod;
        return $this;
    }

    /**
     * The URL that we should call to pass status parameters (such as call ended) to your application.
     *
     * @param string $voiceStatusCallbackUrl The URL that we should call to pass
     *                                       status updates
     * @return $this Fluent Builder
     */
    public function setVoiceStatusCallbackUrl(string $voiceStatusCallbackUrl): self {
        $this->options['voiceStatusCallbackUrl'] = $voiceStatusCallbackUrl;
        return $this;
    }

    /**
     * The HTTP method we should use to call `voice_status_callback_url`. Can be: `GET` or `POST`.
     *
     * @param string $voiceStatusCallbackMethod The HTTP method we should use to
     *                                          call `voice_status_callback_url`
     * @return $this Fluent Builder
     */
    public function setVoiceStatusCallbackMethod(string $voiceStatusCallbackMethod): self {
        $this->options['voiceStatusCallbackMethod'] = $voiceStatusCallbackMethod;
        return $this;
    }

    /**
     * Whether to allow SIP Endpoints to register with the domain to receive calls. Can be `true` or `false`. `true` allows SIP Endpoints to register with the domain to receive calls, `false` does not.
     *
     * @param bool $sipRegistration Whether SIP registration is allowed
     * @return $this Fluent Builder
     */
    public function setSipRegistration(bool $sipRegistration): self {
        $this->options['sipRegistration'] = $sipRegistration;
        return $this;
    }

    /**
     * Whether emergency calling is enabled for the domain. If enabled, allows emergency calls on the domain from phone numbers with validated addresses.
     *
     * @param bool $emergencyCallingEnabled Whether emergency calling is enabled
     *                                      for the domain.
     * @return $this Fluent Builder
     */
    public function setEmergencyCallingEnabled(bool $emergencyCallingEnabled): self {
        $this->options['emergencyCallingEnabled'] = $emergencyCallingEnabled;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        $options = [];
        foreach ($this->options as $key => $value) {
            if ($value !== Values::NONE || $value !== Values::ARRAY_NONE) {
                $options[] = "$key=$value";
            }
        }
        return '[Twilio.Api.V2010.CreateDomainOptions ' . \implode(' ', $options) . ']';
    }
}

class UpdateDomainOptions extends Options {
    /**
     * @param string $friendlyName A string to describe the resource
     * @param string $voiceFallbackMethod The HTTP method used with
     *                                    voice_fallback_url
     * @param string $voiceFallbackUrl The URL we should call when an error occurs
     *                                 in executing TwiML
     * @param string $voiceMethod The HTTP method we should use with voice_url
     * @param string $voiceStatusCallbackMethod The HTTP method we should use to
     *                                          call voice_status_callback_url
     * @param string $voiceStatusCallbackUrl The URL that we should call to pass
     *                                       status updates
     * @param string $voiceUrl The URL we should call when receiving a call
     * @param bool $sipRegistration Whether SIP registration is allowed
     * @param string $domainName The unique address on Twilio to route SIP traffic
     * @param bool $emergencyCallingEnabled Whether emergency calling is enabled
     *                                      for the domain.
     */
    public function __construct(string $friendlyName = Values::NONE, string $voiceFallbackMethod = Values::NONE, string $voiceFallbackUrl = Values::NONE, string $voiceMethod = Values::NONE, string $voiceStatusCallbackMethod = Values::NONE, string $voiceStatusCallbackUrl = Values::NONE, string $voiceUrl = Values::NONE, bool $sipRegistration = Values::NONE, string $domainName = Values::NONE, bool $emergencyCallingEnabled = Values::NONE) {
        $this->options['friendlyName'] = $friendlyName;
        $this->options['voiceFallbackMethod'] = $voiceFallbackMethod;
        $this->options['voiceFallbackUrl'] = $voiceFallbackUrl;
        $this->options['voiceMethod'] = $voiceMethod;
        $this->options['voiceStatusCallbackMethod'] = $voiceStatusCallbackMethod;
        $this->options['voiceStatusCallbackUrl'] = $voiceStatusCallbackUrl;
        $this->options['voiceUrl'] = $voiceUrl;
        $this->options['sipRegistration'] = $sipRegistration;
        $this->options['domainName'] = $domainName;
        $this->options['emergencyCallingEnabled'] = $emergencyCallingEnabled;
    }

    /**
     * A descriptive string that you created to describe the resource. It can be up to 64 characters long.
     *
     * @param string $friendlyName A string to describe the resource
     * @return $this Fluent Builder
     */
    public function setFriendlyName(string $friendlyName): self {
        $this->options['friendlyName'] = $friendlyName;
        return $this;
    }

    /**
     * The HTTP method we should use to call `voice_fallback_url`. Can be: `GET` or `POST`.
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
     * The URL that we should call when an error occurs while retrieving or executing the TwiML requested by `voice_url`.
     *
     * @param string $voiceFallbackUrl The URL we should call when an error occurs
     *                                 in executing TwiML
     * @return $this Fluent Builder
     */
    public function setVoiceFallbackUrl(string $voiceFallbackUrl): self {
        $this->options['voiceFallbackUrl'] = $voiceFallbackUrl;
        return $this;
    }

    /**
     * The HTTP method we should use to call `voice_url`
     *
     * @param string $voiceMethod The HTTP method we should use with voice_url
     * @return $this Fluent Builder
     */
    public function setVoiceMethod(string $voiceMethod): self {
        $this->options['voiceMethod'] = $voiceMethod;
        return $this;
    }

    /**
     * The HTTP method we should use to call `voice_status_callback_url`. Can be: `GET` or `POST`.
     *
     * @param string $voiceStatusCallbackMethod The HTTP method we should use to
     *                                          call voice_status_callback_url
     * @return $this Fluent Builder
     */
    public function setVoiceStatusCallbackMethod(string $voiceStatusCallbackMethod): self {
        $this->options['voiceStatusCallbackMethod'] = $voiceStatusCallbackMethod;
        return $this;
    }

    /**
     * The URL that we should call to pass status parameters (such as call ended) to your application.
     *
     * @param string $voiceStatusCallbackUrl The URL that we should call to pass
     *                                       status updates
     * @return $this Fluent Builder
     */
    public function setVoiceStatusCallbackUrl(string $voiceStatusCallbackUrl): self {
        $this->options['voiceStatusCallbackUrl'] = $voiceStatusCallbackUrl;
        return $this;
    }

    /**
     * The URL we should call when the domain receives a call.
     *
     * @param string $voiceUrl The URL we should call when receiving a call
     * @return $this Fluent Builder
     */
    public function setVoiceUrl(string $voiceUrl): self {
        $this->options['voiceUrl'] = $voiceUrl;
        return $this;
    }

    /**
     * Whether to allow SIP Endpoints to register with the domain to receive calls. Can be `true` or `false`. `true` allows SIP Endpoints to register with the domain to receive calls, `false` does not.
     *
     * @param bool $sipRegistration Whether SIP registration is allowed
     * @return $this Fluent Builder
     */
    public function setSipRegistration(bool $sipRegistration): self {
        $this->options['sipRegistration'] = $sipRegistration;
        return $this;
    }

    /**
     * The unique address you reserve on Twilio to which you route your SIP traffic. Domain names can contain letters, digits, and "-".
     *
     * @param string $domainName The unique address on Twilio to route SIP traffic
     * @return $this Fluent Builder
     */
    public function setDomainName(string $domainName): self {
        $this->options['domainName'] = $domainName;
        return $this;
    }

    /**
     * Whether emergency calling is enabled for the domain. If enabled, allows emergency calls on the domain from phone numbers with validated addresses.
     *
     * @param bool $emergencyCallingEnabled Whether emergency calling is enabled
     *                                      for the domain.
     * @return $this Fluent Builder
     */
    public function setEmergencyCallingEnabled(bool $emergencyCallingEnabled): self {
        $this->options['emergencyCallingEnabled'] = $emergencyCallingEnabled;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        $options = [];
        foreach ($this->options as $key => $value) {
            if ($value !== Values::NONE || $value !== Values::ARRAY_NONE) {
                $options[] = "$key=$value";
            }
        }
        return '[Twilio.Api.V2010.UpdateDomainOptions ' . \implode(' ', $options) . ']';
    }
}