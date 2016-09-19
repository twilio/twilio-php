<?php


namespace Twilio\Jwt\Grants;


class VideoGrant implements Grant {

    private $configurationProfileSid;

    /**
     * Returns the configuration profile sid
     *
     * @return string the configuration profile sid
     */
    public function getConfigurationProfileSid() {
        return $this->configurationProfileSid;
    }

    /**
     * Set the configuration profile sid of the grant
     *
     * @param string $configurationProfileSid configuration profile sid of grant
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
        return "video";
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