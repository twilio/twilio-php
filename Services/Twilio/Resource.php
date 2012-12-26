<?php

/**
 * Abstraction of a Twilio resource.
 *
 * @category Services
 * @package  Services_Twilio
 * @author   Neuman Vong <neuman@twilio.com>
 * @license  http://creativecommons.org/licenses/MIT/ MIT
 * @link     http://pear.php.net/package/Services_Twilio
 */ 
abstract class Services_Twilio_Resource {
    protected $subresources;

    public function __construct($client, $uri, $params = array())
    {
        $this->subresources = array();
        $this->client = $client;

        foreach ($params as $name => $param) {
            $this->$name = $param;
        }

        $this->uri = $uri;
        $this->init($client, $uri);
    }

    protected function init($client, $uri)
    {
        // Left empty for derived classes to implement
    }

    public function getSubresources($name = null) {
        if (isset($name)) {
            return isset($this->subresources[$name])
                ? $this->subresources[$name]
                : null;
        }
        return $this->subresources;
    }

    protected function setupSubresources()
    {
        foreach (func_get_args() as $name) {
            $constantized = ucfirst(self::camelize($name));
            $type = "Services_Twilio_Rest_" . $constantized;
            $this->subresources[$name] = new $type(
                $this->client, $this->uri . "/$constantized"
            );
        }
    }

    /* 
     * Get the resource name from the classname
     * 
     * Ex: Services_Twilio_Rest_Accounts -> Accounts
     *
     * @param boolean $camelized Whether to return camel case or not
     */
    public function getResourceName($camelized = false) 
    {
        $name = get_class($this);
        $parts = explode('_', $name);
        $basename = end($parts);
        if ($camelized) {
            return $basename;
        } else {
            return self::decamelize($basename);
        }
    }

    public static function decamelize($word)
    {
        return preg_replace(
            '/(^|[a-z])([A-Z])/e',
            'strtolower(strlen("\\1") ? "\\1_\\2" : "\\2")',
            $word
        );
    }

    /**
     * Return camelized version of a word
     * Examples: sms_messages => SMSMessages, calls => Calls, 
     * incoming_phone_numbers => IncomingPhoneNumbers
     *
     * @param string $word The word to camelize
     * @return string
     */
    public static function camelize($word) {
        return preg_replace('/(^|_)([a-z])/e', 'strtoupper("\\2")', $word);
    }

    /**
     * Get the value of a property on this resource.
     * 
     * @param string $key The property name
     * @return mixed Could be anything.
     */
    public function __get($key) {
        if ($subresource = $this->getSubresources($key)) {
            return $subresource;
        }
        return $this->$key;
    }

    /**
     * Print a JSON representation of this object. Strips the HTTP client 
     * before returning.
     *
     * Note, this should mainly be used for debugging, and is not guaranteed 
     * to correspond 1:1 with the JSON API output.
     *
     * Note that echoing an object before an HTTP request has been made to 
     * "fill in" its properties may return an empty object
     */
    public function __toString() {
        $out = array();
        foreach ($this as $key => $value) {
            if ($key !== "client" && $key !== "subresources") {
                $out[$key] = (string)$value;
            }
        }
        return json_encode($out);
    }

}

