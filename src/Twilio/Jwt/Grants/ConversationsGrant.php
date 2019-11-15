<?php


namespace Twilio\Jwt\Grants;


class ConversationsGrant implements Grant {
    private $configurationProfileSid;

    public function __construct() {
        \trigger_error("ConversationsGrant is deprecated, please use VideoGrant", E_USER_NOTICE);
    }

    /**
     * Returns the configuration profile sid
     *
     * @return string the configuration profile sid
     */
    public function getConfigurationProfileSid() {
        return $this->configurationProfileSid;
    }

    /**
     * @param string $configurationProfileSid the configuration profile sid
     * we want to enable for this grant
     *
     * @return $this updated grant
     */
    public function setConfigurationProfileSid($configurationProfileSid) {
        $this->configurationProfileSid = $configurationProfileSid;
        return $this;
    }

    /**
     * Returns the grant type
     *
     * @return string type of the grant
     */
    public function getGrantKey() {
        return "rtc";
    }

    /**
     * Returns the grant data
     *
     * @return array data of the grant
     */
    public function getPayload() {
        $payload = array();
        if ($this->configurationProfileSid) {
            $payload['configuration_profile_sid'] = $this->configurationProfileSid;
        }
        return $payload;
    }
}
