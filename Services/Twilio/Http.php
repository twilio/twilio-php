<?php

require_once 'HTTP/Request2.php';

/**
 * Exception class for Services_Twilio_Http.
 */
class Services_Twilio_HttpException extends Exception {}

/**
 * Thin wrapper around HTTP_Request2 that's compatible with the TinyHttp class
 * the tests were written for.
 *
 * @category Services
 * @package  Services_Twilio
 * @author   Neuman Vong <neuman@twilio.com>
 * @license  http://creativecommons.org/licenses/MIT/ MIT
 * @link     http://pear.php.net/package/Services_Twilio
 */ 
class Services_Twilio_Http
{

    /**
     * A part of a URL containing user, password, host and port.
     * @var string
     */
    protected $netloc;

    /**
     * An instance of HTTP_Request2.
     * @var HTTP_Request2
     */
    protected $request;

    /**
     * @param string The netloc
     * @param HTTP_Request2 An instance of HTTP_Request2
     */
    public function __construct($netloc, $_request = NULL)
    {
        $this->netloc = $netloc;
        $this->request = $_request instanceof HTTP_Request2
            ? $_request
            : new HTTP_Request2(NULL, NULL, array('adapter' => 'curl'));
    }

    /**
     * Magic method for making different kinds of HTTP requests.
     *
     * @param string Request method
     * @param array A 3-tuple comprising path, headers list, and body
     * @return array A 3-tuple comprising status, headers list, and body
     */
    public function __call($method, $args)
    {
        list($path, $headers, $body) = $args + array('/', array(), '');
        $resp = $this->request
            ->setMethod(strtoupper($method))
            ->setUrl($this->netloc . $path)
            ->setHeader($headers)
            ->setBody($body)
            ->send();
        return array($resp->getStatus(), $resp->getHeader(), $resp->getBody());
    }
}
