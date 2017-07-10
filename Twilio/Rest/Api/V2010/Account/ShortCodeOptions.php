<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Api\V2010\Account;

use Twilio\Options;
use Twilio\Values;

abstract class ShortCodeOptions
{
    /**
     * @param string $friendlyName A human readable description of this resource
     * @param string $apiVersion The API version to use
     * @param string $smsUrl URL Twilio will request when receiving an SMS
     * @param string $smsMethod HTTP method to use when requesting the sms url
     * @param string $smsFallbackUrl URL Twilio will request if an error occurs in
     *                               executing TwiML
     * @param string $smsFallbackMethod HTTP method Twilio will use with sms
     *                                  fallback url
     * @return UpdateShortCodeOptions Options builder
     */
    public static function update($friendlyName = Values::NONE, $apiVersion = Values::NONE, $smsUrl = Values::NONE, $smsMethod = Values::NONE, $smsFallbackUrl = Values::NONE, $smsFallbackMethod = Values::NONE)
    {
        return new UpdateShortCodeOptions($friendlyName, $apiVersion, $smsUrl, $smsMethod, $smsFallbackUrl, $smsFallbackMethod);
    }

    /**
     * @param string $friendlyName Filter by friendly name
     * @param string $shortCode Filter by ShortCode
     * @return ReadShortCodeOptions Options builder
     */
    public static function read($friendlyName = Values::NONE, $shortCode = Values::NONE)
    {
        return new ReadShortCodeOptions($friendlyName, $shortCode);
    }
}

class UpdateShortCodeOptions extends Options
{
    /**
     * @param string $friendlyName A human readable description of this resource
     * @param string $apiVersion The API version to use
     * @param string $smsUrl URL Twilio will request when receiving an SMS
     * @param string $smsMethod HTTP method to use when requesting the sms url
     * @param string $smsFallbackUrl URL Twilio will request if an error occurs in
     *                               executing TwiML
     * @param string $smsFallbackMethod HTTP method Twilio will use with sms
     *                                  fallback url
     */
    public function __construct($friendlyName = Values::NONE, $apiVersion = Values::NONE, $smsUrl = Values::NONE, $smsMethod = Values::NONE, $smsFallbackUrl = Values::NONE, $smsFallbackMethod = Values::NONE)
    {
        $this->options['friendlyName'] = $friendlyName;
        $this->options['apiVersion'] = $apiVersion;
        $this->options['smsUrl'] = $smsUrl;
        $this->options['smsMethod'] = $smsMethod;
        $this->options['smsFallbackUrl'] = $smsFallbackUrl;
        $this->options['smsFallbackMethod'] = $smsFallbackMethod;
    }

    /**
     * A human readable descriptive text for this resource, up to 64 characters long. By default, the `FriendlyName` is just the short code.
     *
     * @param string $friendlyName A human readable description of this resource
     * @return $this Fluent Builder
     */
    public function setFriendlyName($friendlyName)
    {
        $this->options['friendlyName'] = $friendlyName;
        return $this;
    }

    /**
     * SMSs to this short code will start a new TwiML session with this API version.
     *
     * @param string $apiVersion The API version to use
     * @return $this Fluent Builder
     */
    public function setApiVersion($apiVersion)
    {
        $this->options['apiVersion'] = $apiVersion;
        return $this;
    }

    /**
     * The URL Twilio will request when receiving an incoming SMS message to this short code.
     *
     * @param string $smsUrl URL Twilio will request when receiving an SMS
     * @return $this Fluent Builder
     */
    public function setSmsUrl($smsUrl)
    {
        $this->options['smsUrl'] = $smsUrl;
        return $this;
    }

    /**
     * The HTTP method Twilio will use when making requests to the `SmsUrl`. Either `GET` or `POST`.
     *
     * @param string $smsMethod HTTP method to use when requesting the sms url
     * @return $this Fluent Builder
     */
    public function setSmsMethod($smsMethod)
    {
        $this->options['smsMethod'] = $smsMethod;
        return $this;
    }

    /**
     * The URL that Twilio will request if an error occurs retrieving or executing the TwiML from `SmsUrl`.
     *
     * @param string $smsFallbackUrl URL Twilio will request if an error occurs in
     *                               executing TwiML
     * @return $this Fluent Builder
     */
    public function setSmsFallbackUrl($smsFallbackUrl)
    {
        $this->options['smsFallbackUrl'] = $smsFallbackUrl;
        return $this;
    }

    /**
     * The HTTP method Twilio will use when requesting the above URL. Either `GET` or `POST`.
     *
     * @param string $smsFallbackMethod HTTP method Twilio will use with sms
     *                                  fallback url
     * @return $this Fluent Builder
     */
    public function setSmsFallbackMethod($smsFallbackMethod)
    {
        $this->options['smsFallbackMethod'] = $smsFallbackMethod;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString()
    {
        $options = array();
        foreach ($this->options as $key => $value) {
            if ($value != Values::NONE) {
                $options[] = "$key=$value";
            }
        }
        return '[Twilio.Api.V2010.UpdateShortCodeOptions ' . implode(' ', $options) . ']';
    }
}

class ReadShortCodeOptions extends Options
{
    /**
     * @param string $friendlyName Filter by friendly name
     * @param string $shortCode Filter by ShortCode
     */
    public function __construct($friendlyName = Values::NONE, $shortCode = Values::NONE)
    {
        $this->options['friendlyName'] = $friendlyName;
        $this->options['shortCode'] = $shortCode;
    }

    /**
     * Only show the ShortCode resources with friendly names that exactly match this name
     *
     * @param string $friendlyName Filter by friendly name
     * @return $this Fluent Builder
     */
    public function setFriendlyName($friendlyName)
    {
        $this->options['friendlyName'] = $friendlyName;
        return $this;
    }

    /**
     * Only show the ShortCode resources that match this pattern. You can specify partial numbers and use '*' as a wildcard for any digit
     *
     * @param string $shortCode Filter by ShortCode
     * @return $this Fluent Builder
     */
    public function setShortCode($shortCode)
    {
        $this->options['shortCode'] = $shortCode;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString()
    {
        $options = array();
        foreach ($this->options as $key => $value) {
            if ($value != Values::NONE) {
                $options[] = "$key=$value";
            }
        }
        return '[Twilio.Api.V2010.ReadShortCodeOptions ' . implode(' ', $options) . ']';
    }
}
