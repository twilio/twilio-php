<?php

/**
 * Abstraction of a list resource from the Twilio API.
 *
 * @category Services
 * @package  Services_Twilio
 * @author   Neuman Vong <neuman@twilio.com>
 * @license  http://creativecommons.org/licenses/MIT/ MIT
 * @link     http://pear.php.net/package/Services_Twilio
 */
abstract class Services_Twilio_ListResource
    extends Services_Twilio_Resource
    implements IteratorAggregate
{
    private $_page;

    public function __construct($resource, $uri) {
        $parts = explode('_', get_class($this));
        $name = $parts[count($parts) - 1];
        $this->instance_name = rtrim($name, 's');
        parent::__construct($resource, $uri);
    }
    /**
     * Gets a resource from this list.
     *
     * @param string $sid The resource SID
     * @return Services_Twilio_InstanceResource The resource
     */
    public function get($sid)
    {
        $instance_name = $this->instance_name;
        $instance_class_name = "Services_Twilio_Rest_" . $instance_name;
        $instance = new $instance_class_name($this->client, $this->uri . "/$sid");
        // XXX check if this is actually a sid in all cases.
        $instance->sid = $sid;
        return $instance;
    }

    public function getObjectFromJson($params)
    {
        $instance_name = $this->instance_name;
        $instance_class_name = "Services_Twilio_Rest_" . $instance_name;
        if (isset($params->sid)) {
            $uri = $this->uri . "/" . $params->sid;
        } else {
            $uri = $this->uri;
        }
        return new $instance_class_name($this->client, $this->uri, $params);
    }

    /**
     * Deletes a resource from this list.
     *
     * @param string $sid The resource SID
     * @return null
     */
    public function delete($sid, array $params = array())
    {
        $this->client->deleteData($this->uri . '/' . $sid, $params);
    }

    /**
     * Create a resource on the list and then return its representation as an
     * InstanceResource.
     *
     * @param array $params The parameters with which to create the resource
     *
     * @return Services_Twilio_InstanceResource The created resource
     */
    protected function _create(array $params)
    {
        $instance_name = $this->instance_name;
        $instance_class_name = "Services_Twilio_Rest_" . $instance_name;
        $params = $this->client->createData($this->uri, $params);
        /* Some methods like verified caller ID don't return sids. */
        if (isset($params->sid)) {
            $resource_uri = $this->uri . '/' . $params->sid;
        } else {
            $resource_uri = $this->uri;
        }
        return new $instance_class_name($this->client, $resource_uri, $params);
    }

    /**
     * Create a resource on the list and then return its representation as an
     * InstanceResource.
     *
     * @param array $params The parameters with which to create the resource
     *
     * @return Services_Twilio_InstanceResource The created resource
     */
    public function retrieveData($sid, array $params = array())
    {
        $instance_name = $this->instance_name;
        $instance_class_name = "Services_Twilio_Rest_" . $instance_name;
        $resource_uri = $this->uri . '/' . $sid;
        $params = $this->client->retrieveData($resource_uri, $params);
        return new $instance_class_name($this->client, $resource_uri, $params);
    }

    /* 
     * Same as above, but don't create an object.
     */
    public function retrieveRawData($sid, array $params = array())
    {
        $instance_name = $this->instance_name;
        $instance_class_name = "Services_Twilio_Rest_" . $instance_name;
        $resource_uri = $this->uri . '/' . $sid;
        return $this->client->retrieveData($resource_uri, $params);
    }

    /**
     * Create a resource on the list and then return its representation as an
     * InstanceResource.
     *
     * @param array $params The parameters with which to create the resource
     *
     * @return Services_Twilio_InstanceResource The created resource
     */
    public function createData($sid, array $params = array())
    {
        $schema = $this->getSchema();
        $basename = $schema['basename'];
        return $this->client->createData("$basename/$sid", $params);
    }

    /**
     * Returns a page of InstanceResources from this list.
     *
     * @param int   $page The start page
     * @param int   $size Number of items per page
     * @param array $size Optional filters
     *
     * @return Services_Twilio_Page A page
     */
    public function getPage($page = 0, $size = 50, array $filters = array())
    {
        $schema = $this->getSchema();
        $page = $this->client->retrieveData($this->uri, array(
            'Page' => $page,
            'PageSize' => $size,
        ) + $filters);

        $page->{$schema['list']} = array_map(
            array($this, 'getObjectFromJson'),
            $page->{$schema['list']}
        );

        return new Services_Twilio_Page($page, $schema['list']);
    }

    /**
     * Returns meta data about this list resource type.
     *
     * @return array Meta data
     */
    public function getSchema()
    {
        $name = get_class($this);
        $parts = explode('_', $name);
        $basename = end($parts);
        return array(
            'name' => $name,
            'basename' => $basename,
            'instance' => substr($name, 0, -1),
            'list' => self::decamelize($basename),
        );
    }

    /**
     * Returns an iterable list of InstanceResources
     *
     * @param int   $page The start page
     * @param int   $size Number of items per page
     * @param array $size Optional filters
     *
     * The filter array can accept full datetimes when StartTime or DateCreated
     * are used. Inequalities should be within the key portion of the array and
     * multiple filter parameters can be combined for more specific searches.
     *
     * eg.
     *   array('DateCreated>' => '2011-07-05 08:00:00', 'DateCreated<' => '2011-08-01')
     * or
     *   array('StartTime<' => '2011-07-05 08:00:00')
     *
     * @return Services_Twilio_AutoPagingIterator An iterator
     */
    public function getIterator($page = 0, $size = 50, array $filters = array())
    {
        return new Services_Twilio_AutoPagingIterator(
            array($this, 'getPageGenerator'),
            create_function('$page, $size, $filters',
                'return array($page + 1, $size, $filters);'),
            array($page, $size, $filters)
        );
    }

    public function getPageGenerator($page, $size, array $filters = array()) {
        return $this->getPage($page, $size, $filters)->getItems();
    }
}
