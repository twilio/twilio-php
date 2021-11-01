<?php


namespace Twilio\Jwt\Grants;


class PlaybackGrant implements Grant {

    private $grant;

    /**
     * Returns the grant
     *
     * @return array playback grant from the Twilio API
     */
    public function getGrant(): array {
        return $this->grant;
    }

    /**
     * Set the playback grant that will allow access to a stream
     *
     * @param array $grant playback grant from Twilio API
     * @return $this updated grant
     */
    public function setGrant(array $grant): self {
        $this->grant = $grant;
        return $this;
    }

    /**
     * Returns the grant type
     *
     * @return string type of the grant
     */
    public function getGrantKey(): string {
        return 'player';
    }

    /**
     * Returns the grant data
     *
     * @return array data of the grant
     */
    public function getPayload(): array {
        $payload = [];
        if ($this->grant) {
            $payload = $this->grant;
        }
        return $payload;
    }
}
