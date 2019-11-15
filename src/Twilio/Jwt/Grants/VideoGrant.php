<?php


namespace Twilio\Jwt\Grants;


class VideoGrant implements Grant {

    private $configurationProfileSid;
    private $room;

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
     * @deprecated in favor of setRoom/getRoom
     *
     * @param string $configurationProfileSid configuration profile sid of grant
     *
     * @return $this updated grant
     */
    public function setConfigurationProfileSid($configurationProfileSid) {
        \trigger_error('Configuration profile sid is deprecated, use room instead.', E_USER_NOTICE);
        $this->configurationProfileSid = $configurationProfileSid;
        return $this;
    }

    /**
     * Returns the room
     *
     * @return string room name or sid set in this grant
     */
    public function getRoom() {
        return $this->room;
    }

    /**
     * Set the room to allow access to in the grant
     *
     * @param string $roomSidOrName room sid or name
     * @return $this updated grant
     */
    public function setRoom($roomSidOrName) {
        $this->room = $roomSidOrName;
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
        if ($this->room) {
            $payload['room'] = $this->room;
        }
        return $payload;
    }

}