<?php

interface Services_Twilio_Auth_Grant
{
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