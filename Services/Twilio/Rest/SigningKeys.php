<?php

class Services_Twilio_Rest_SigningKeys extends Services_Twilio_ListResource
{
    /**
     * Create a new signing key.
     *
     * :param array $params: An array of parameters describing the new
     *      signing key. The ``$params`` array can contain the following keys:
     *
     *      *FriendlyName*
     *          A description of this signing key
     *
     * :returns: The new singing key
     * :rtype: :php:class:`Services_Twilio_Rest_SigningKey`
     *
     */
    public function create(array $params = array())
    {
        return parent::_create($params);
    }
}
