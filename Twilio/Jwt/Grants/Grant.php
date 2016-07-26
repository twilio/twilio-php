<?php


namespace Twilio\Jwt\Grants;


interface Grant {
    /**
     * Returns the grant type
     *
     * @return string type of the grant
     */
    public function getGrantKey();

    /**
     * Returns the grant data
     *
     * @return array data of the grant
     */
    public function getPayload();
}