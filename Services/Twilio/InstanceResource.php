<?php

/**
 * Abstraction of an instance resource from the Twilio API.
 *
 * @category Services
 * @package  Services_Twilio
 * @author   Neuman Vong <neuman@twilio.com>
 * @license  http://creativecommons.org/licenses/MIT/ MIT
 * @link     http://pear.php.net/package/Services_Twilio
 */ 
abstract class Services_Twilio_InstanceResource
    extends Services_Twilio_Resource
{
    /**
     * @param mixed $params An array of updates, or a property name
     * @param mixed $value  A value with which to update the resource
     *
     * @return null
     */
    public function update($params, $value = null)
    {
        if (!is_array($params)) {
            $params = array($params => $value);
        }
        $decamelizedParams = $this->client->createData($this->uri, $params);
        $this->updateAttributes($decamelizedParams);
    }

    /* 
     * Add all properties from an associative array (the JSON response body) as 
     * properties on this instance resource, except the URI
     *
     * @param stdClass $params An object containing all of the parameters of 
     *      this instance
     * @return null Purely side effecting
     */
    public function updateAttributes($params) {
        unset($params->uri);
        foreach ($params as $name => $value) {
            $this->$name = $value;
        }
    }

    /**
     * Get the value of a property on this resource.
     * 
     * To help with lazy HTTP requests, we don't actually retrieve an object 
     * from the API unless you really need it. Hence, this function may make 
     * API requests if the property you're requesting isn't available on the 
     * resource.
     *
     * @param string $key The property name
     *
     * @return mixed Could be anything.
     */
    public function __get($key)
    {
        if ($subresource = $this->getSubresources($key)) {
            return $subresource;
        }
        if (!isset($this->$key)) {
            $params = $this->client->retrieveData($this->uri);
            $this->updateAttributes($params);
        }
        return $this->$key;
    }
}
