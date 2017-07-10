<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Api\V2010\Account;

use Twilio\InstanceContext;
use Twilio\Options;
use Twilio\Serialize;
use Twilio\Values;
use Twilio\Version;

class ApplicationContext extends InstanceContext
{
    /**
     * Initialize the ApplicationContext
     *
     * @param \Twilio\Version $version Version that contains the resource
     * @param string $accountSid The account_sid
     * @param string $sid Fetch by unique Application Sid
     * @return \Twilio\Rest\Api\V2010\Account\ApplicationContext
     */
    public function __construct(Version $version, $accountSid, $sid)
    {
        parent::__construct($version);

        // Path Solution
        $this->solution = array(
            'accountSid' => $accountSid,
            'sid' => $sid,
        );

        $this->uri = '/Accounts/' . rawurlencode($accountSid) . '/Applications/' . rawurlencode($sid) . '.json';
    }

    /**
     * Deletes the ApplicationInstance
     *
     * @return boolean True if delete succeeds, false otherwise
     */
    public function delete()
    {
        return $this->version->delete('delete', $this->uri);
    }

    /**
     * Fetch a ApplicationInstance
     *
     * @return ApplicationInstance Fetched ApplicationInstance
     */
    public function fetch()
    {
        $params = Values::of(array());

        $payload = $this->version->fetch(
            'GET',
            $this->uri,
            $params
        );

        return new ApplicationInstance(
            $this->version,
            $payload,
            $this->solution['accountSid'],
            $this->solution['sid']
        );
    }

    /**
     * Update the ApplicationInstance
     *
     * @param array|Options $options Optional Arguments
     * @return ApplicationInstance Updated ApplicationInstance
     */
    public function update($options = array())
    {
        $options = new Values($options);

        $data = Values::of(array(
            'FriendlyName' => $options['friendlyName'],
            'ApiVersion' => $options['apiVersion'],
            'VoiceUrl' => $options['voiceUrl'],
            'VoiceMethod' => $options['voiceMethod'],
            'VoiceFallbackUrl' => $options['voiceFallbackUrl'],
            'VoiceFallbackMethod' => $options['voiceFallbackMethod'],
            'StatusCallback' => $options['statusCallback'],
            'StatusCallbackMethod' => $options['statusCallbackMethod'],
            'VoiceCallerIdLookup' => Serialize::booleanToString($options['voiceCallerIdLookup']),
            'SmsUrl' => $options['smsUrl'],
            'SmsMethod' => $options['smsMethod'],
            'SmsFallbackUrl' => $options['smsFallbackUrl'],
            'SmsFallbackMethod' => $options['smsFallbackMethod'],
            'SmsStatusCallback' => $options['smsStatusCallback'],
            'MessageStatusCallback' => $options['messageStatusCallback'],
        ));

        $payload = $this->version->update(
            'POST',
            $this->uri,
            array(),
            $data
        );

        return new ApplicationInstance(
            $this->version,
            $payload,
            $this->solution['accountSid'],
            $this->solution['sid']
        );
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString()
    {
        $context = array();
        foreach ($this->solution as $key => $value) {
            $context[] = "$key=$value";
        }
        return '[Twilio.Api.V2010.ApplicationContext ' . implode(' ', $context) . ']';
    }
}
