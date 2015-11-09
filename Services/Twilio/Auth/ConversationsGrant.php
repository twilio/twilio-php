<?php

class Services_Twilio_Auth_ConversationsGrant implements Services_Twilio_Auth_Grant
{
    private $configurationProfileSid;

    /**
     * Returns the configuration profile sid
     *
     * @return string the configuration profile sid
     */
    public function getConfigurationProfileSid()
    {
        return $this->configurationProfileSid;
    }

    /**
     * @param string $configurationProfileSid the configuration profile sid
     * we want to enable for this grant
     *
     * @return Services_Twilio_Auth_ConversationsGrant updated grant
     */
    public function setConfigurationProfileSid($configurationProfileSid)
    {
        $this->configurationProfileSid = $configurationProfileSid;
        return $this;
    }

    /**
     * Returns the grant type
     *
     * @return string type of the grant
     */
    public function getGrantKey()
    {
        return "rtc";
    }

    /**
     * Returns the grant data
     *
     * @return array data of the grant
     */
    public function getPayload()
    {
        $payload = array();
        if ($this->configurationProfileSid) {
            $payload['configuration_profile_sid'] = $this->configurationProfileSid;
        }

        return $payload;
    }

}