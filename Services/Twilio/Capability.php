<?php

/**
 * Twilio Capability Token generator
 *
 * @category Services
 * @package  Services_Twilio
 * @author   Kyle Conroy <kyle at twilio dot com>
 * @license  http://creativecommons.org/licenses/MIT/ MIT
 * @link     https://gist.github.com/855985
 */
class Services_Twilio_Capability
{

    protected $element;

    /**
     * Constructs a Capability Token geneator
     *
     * @param string $accountSid:
     *   - the Twilio Account Sid
     * @paraam string $authToken
     *   - the Twilio Auth Token 
     *   - used to sign the capability token
     */
    public function __construct(string $accountSid, string $authToken)
    {
        
    }
    
    /**
      * Allow outbound connections to this Twilio Application
      *
      * @param string appSid
      * - This is the application that points to a TwiML producing URL that 
      *   will be executed when the client connects.
      * @param string clientName
      * - This clientName will be used for outgoing connections callerid
      * @param array appParams
      * - This is a URL encoded string of parameters that will be passed to 
      *   the application on client connect().  Note that these are "secure" 
      *   parameters, because they are inside of the signed payload, and we 
      *   know they came from the developer.
      */
    public function allowClientOutgoing(string $appSid, 
        string $clientName=null, array $params=array())
    {
        
    }
    
    /**
      * Allow inbound connections
      *
      * @param string clientName
      * - The name for this client
      */
    public function allowClientIncoming(string $clientName)
    {
        
    }
    
    /**
      * Allow inbound connections
      *
      * @param string clientName
      * - The name for this client
      */
    public function generate(int $expires=3600)
    {
        
    }
    
    public function payload()
    {
        
    }

}
