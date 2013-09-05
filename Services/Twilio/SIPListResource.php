<?php

/**
 * This subclass of ListResource is used solely to update
 * the URI for sip resources.
 */
abstract class Service_Twilio_SIPListResource extends Services_Twilio_Resource_ListResource
{
    public function __construct($client, $uri) {
        // Rename all /Sip/ uris to /SIP/
        $uri = preg_replace("#/Sip#", "/SIP", $uri);
        parent::__construct($client, $uri);
    }
}
