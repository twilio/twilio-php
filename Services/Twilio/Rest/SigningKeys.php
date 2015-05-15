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

    /**
     * Overriding to throw a runtime exception as this is not allowed to be used yet.
     */
    public function getPage(
        $page = 0, $size = 50, $filters = array(), $deep_paging_uri = null
    ) {
        throw new RuntimeException("SigningKeys List is not supported");
    }

    /**
     * Overriding to throw a runtime exception as this is not allowed to be used yet.
     */
    public function getIterator(
        $page = 0, $size = 50, $filters = array()
    ) {
        throw new RuntimeException("Cannot retrieve an iterator on SigningKeys List");
    }

    /**
     * Overriding to throw a runtime exception as this is not allowed to be used yet.
     */
    public function getPageGenerator(
        $page, $size, $filters = array(), $deep_paging_uri = null
    ) {
        throw new RuntimeException("Cannot retrieve a Page Generator on SigningKeys List");
    }
}
