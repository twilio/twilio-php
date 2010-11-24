<?php
    /*
    Copyright (c) 2009-2010 Twilio, Inc.

    Permission is hereby granted, free of charge, to any person
    obtaining a copy of this software and associated documentation
    files (the "Software"), to deal in the Software without
    restriction, including without limitation the rights to use,
    copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the
    Software is furnished to do so, subject to the following
    conditions:

    The above copyright notice and this permission notice shall be
    included in all copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
    EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
    OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
    NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
    HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
    WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
    FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
    OTHER DEALINGS IN THE SOFTWARE.
    */    
    
    // VERSION: 2.0.8
    
    // Twilio REST Helpers
    // ========================================================================
    
    // ensure Curl is installed
    if(!extension_loaded("curl"))
        throw(new Exception(
            "Curl extension is required for TwilioRestClient to work"));
    
    /* 
     * TwilioRestResponse holds all the REST response data 
     * Before using the reponse, check IsError to see if an exception 
     * occurred with the data sent to Twilio
     * ResponseXml will contain a SimpleXml object with the response xml
     * ResponseText contains the raw string response
     * Url and QueryString are from the request
     * HttpStatus is the response code of the request
     */
    class TwilioRestResponse {
        
        public $ResponseText;
        public $ResponseXml;
        public $HttpStatus;
        public $Url;
        public $QueryString;
        public $IsError;
        public $ErrorMessage;
        
        public function __construct($url, $text, $status) {
            preg_match('/([^?]+)\??(.*)/', $url, $matches);
            $this->Url = $matches[1];
            $this->QueryString = $matches[2];
            $this->ResponseText = $text;
            $this->HttpStatus = $status;
            if($this->HttpStatus != 204)
                $this->ResponseXml = @simplexml_load_string($text);
            
            if($this->IsError = ($status >= 400))
                $this->ErrorMessage =
                    (string)$this->ResponseXml->RestException->Message;
            
        }
        
    }
    
    /* TwilioRestClient throws TwilioException on error 
     * Useful to catch this exception separately from general PHP
     * exceptions, if you want
     */
    class TwilioException extends Exception {}
    
    /*
     * TwilioRestBaseClient: the core Rest client, talks to the Twilio REST             
     * API. Returns a TwilioRestResponse object for all responses if Twilio's 
     * API was reachable Throws a TwilioException if Twilio's REST API was
     * unreachable
     */
     
    class TwilioRestClient {

        protected $Endpoint;
        protected $AccountSid;
        protected $AuthToken;
        
        /*
         * __construct 
         *   $username : Your AccountSid
         *   $password : Your account's AuthToken
         *   $endpoint : The Twilio REST Service URL, currently defaults to
         * the proper URL
         */
        public function __construct($accountSid, $authToken,
            $endpoint = "https://api.twilio.com") {
            
            $this->AccountSid = $accountSid;
            $this->AuthToken = $authToken;
            $this->Endpoint = $endpoint;
        }
        
        /*
         * sendRequst
         *   Sends a REST Request to the Twilio REST API
         *   $path : the URL (relative to the endpoint URL, after the /v1)
         *   $method : the HTTP method to use, defaults to GET
         *   $vars : for POST or PUT, a key/value associative array of data to
         * send, for GET will be appended to the URL as query params
         */
        public function request($path, $method = "GET", $vars = array()) {
            $fp = null;
            $tmpfile = "";
            $encoded = "";
            foreach($vars AS $key=>$value)
                $encoded .= "$key=".urlencode($value)."&";
            $encoded = substr($encoded, 0, -1);
            
            // construct full url
            $url = "{$this->Endpoint}/$path";
            
            // if GET and vars, append them
            if($method == "GET") 
                $url .= (FALSE === strpos($path, '?')?"?":"&").$encoded;

            // initialize a new curl object            
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
            switch(strtoupper($method)) {
                case "GET":
                    curl_setopt($curl, CURLOPT_HTTPGET, TRUE);
                    break;
                case "POST":
                    curl_setopt($curl, CURLOPT_POST, TRUE);
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $encoded);
                    break;
                case "PUT":
                    // curl_setopt($curl, CURLOPT_PUT, TRUE);
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $encoded);
                    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
                    file_put_contents($tmpfile = tempnam("/tmp", "put_"),
                        $encoded);
                    curl_setopt($curl, CURLOPT_INFILE, $fp = fopen($tmpfile,
                        'r'));
                    curl_setopt($curl, CURLOPT_INFILESIZE, 
                        filesize($tmpfile));
                    break;
                case "DELETE":
                    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
                    break;
                default:
                    throw(new TwilioException("Unknown method $method"));
                    break;
            }
            
            // send credentials
            curl_setopt($curl, CURLOPT_USERPWD,
                $pwd = "{$this->AccountSid}:{$this->AuthToken}");
            
            // do the request. If FALSE, then an exception occurred    
            if(FALSE === ($result = curl_exec($curl)))
                throw(new TwilioException(
                    "Curl failed with error " . curl_error($curl)));
            
            // get result code
            $responseCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            
            // unlink tmpfiles
            if($fp)
                fclose($fp);
            if(strlen($tmpfile))
                unlink($tmpfile);
                
            return new TwilioRestResponse($url, $result, $responseCode);
        }
    }    
        
    // Twiml Response Helpers
    // ========================================================================
    
    /*
     * Verb: Base class for all TwiML verbs used in creating Responses
     * Throws a TwilioException if an non-supported attribute or
     * attribute value is added to the verb. All methods in Verb are protected
     * or private
     */
     
    class Verb {
        private $tag;
        private $body;
        private $attr;
        private $children;
            
        /*
         * __construct 
         *   $body : Verb contents 
         *   $body : Verb attributes
         */
        function __construct($body=NULL, $attr = array()) {
            if (is_array($body)) {
                $attr = $body;
                $body = NULL;
            }
            $this->tag = get_class($this);
            $this->body = $body;
            $this->attr = array();
            $this->children = array();
            self::addAttributes($attr);
        }
        
        /*
         * addAttributes
         *     $attr  : A key/value array of attributes to be added
         *     $valid : A key/value array containging the accepted attributes
         *     for this verb
         *     Throws an exception if an invlaid attribute is found
         */
        private function addAttributes($attr) {
            foreach ($attr as $key => $value) {
                if(in_array($key, $this->valid))
                    $this->attr[$key] = $value;
                else
                    throw new TwilioException($key . ', ' . $value . 
                       " is not a supported attribute pair");
            }
        }

        /*
         * append
         *     Nests other verbs inside self.
         */
        function append($verb) {
            if(is_null($this->nesting))
                throw new TwilioException($this->tag ." doesn't support nesting");
            else if(!is_object($verb))
                throw new TwilioException($verb->tag . " is not an object");
            else if(!in_array(get_class($verb), $this->nesting))
                throw new TwilioException($verb->tag . " is not an allowed verb here");
            else {
                $this->children[] = $verb;
                return $verb;    
            }
        }
        
        /*
         * set
         *     $attr  : An attribute to be added
         *    $valid : The attrbute value for this verb
         *     No error checking here
         */
        function set($key, $value){
            $this->attr[$key] = $value;
        }
    
        /* Convenience Methods */
        function addSay($body=NULL, $attr = array()){
            return self::append(new Say($body, $attr));    
        }
        
        function addPlay($body=NULL, $attr = array()){
            return self::append(new Play($body, $attr));    
        }
        
        function addDial($body=NULL, $attr = array()){
            return self::append(new Dial($body, $attr));    
        }
        
        function addNumber($body=NULL, $attr = array()){
            return self::append(new Number($body, $attr));    
        }
        
        function addGather($attr = array()){
            return self::append(new Gather($attr));    
        }
        
        function addRecord($attr = array()){
            return self::append(new Record(NULL, $attr));    
        }
        
        function addHangup(){
            return self::append(new Hangup());    
        }
        
        function addRedirect($body=NULL, $attr = array()){
            return self::append(new Redirect($body, $attr));    
        }
        
        function addPause($attr = array()){
            return self::append(new Pause($attr));    
        }
        
        function addConference($body=NULL, $attr = array()){
            return self::append(new Conference($body, $attr));    
        }
        
        function addSms($body=NULL, $attr = array()){
            return self::append(new Sms($body, $attr));    
        }
        
        /*
         * write
         * Output the XML for this verb and all it's children
         *    $parent: This verb's parent verb
         *    $writeself : If FALSE, Verb will not output itself,
         *    only its children
         */
        protected function write($parent, $writeself=TRUE){
            if($writeself) {
                $elem = $parent->addChild($this->tag, htmlspecialchars($this->body));
                foreach($this->attr as $key => $value)
                    $elem->addAttribute($key, $value);
                foreach($this->children as $child)
                    $child->write($elem);
            } else {
                foreach($this->children as $child)
                    $child->write($parent);
            }
            
        }
        
    }
    
    
    class Response extends Verb {
        
        private $xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?><Response></Response>";
        
        protected $nesting = array('Say', 'Play', 'Gather', 'Record', 
            'Dial', 'Redirect', 'Pause', 'Hangup', 'Sms');
        
        function __construct(){
            parent::__construct(NULL);
        }
        
        function Respond($sendHeader = true) {    
            // try to force the xml data type
            // this is generally unneeded by Twilio, but nice to have
            if($sendHeader)
            {
                if(!headers_sent())
                {
                    header("Content-type: text/xml");
                }
            }
            $simplexml = new SimpleXMLElement($this->xml);
            $this->write($simplexml, FALSE);
            print $simplexml->asXML();
        }
        
        function asURL($encode = TRUE){
            $simplexml = new SimpleXMLElement($this->xml);
            $this->write($simplexml, FALSE);
            if($encode)
                return urlencode($simplexml->asXML());
            else
                return $simplexml->asXML();
        }
        
    }
    
    class Say extends Verb {
    
        protected $valid = array('voice','language','loop');
    
    }

	class Reject extends Verb {
		
		protected $valid = array('reason');
			
	}
    
    class Play extends Verb {
        
        protected $valid = array('loop');
    
    }
    
    
    class Record extends Verb {
    
        protected $valid = array('action','method','timeout','finishOnKey',
								 'maxLength','transcribe','transcribeCallback', 'playBeep');
    
    }
    
    
    class Dial extends Verb {
    
        protected $valid = array('action','method','timeout','hangupOnStar',
            'timeLimit','callerId');
    
        protected $nesting = array('Number','Conference');
    
    }
    
    class Redirect extends Verb {
    
        protected $valid = array('method');
    
    }
    
    class Pause extends Verb {
    
        protected $valid = array('length');
    
        function __construct($attr = array()) {
            parent::__construct(NULL, $attr);
        }
    
    }
    
    class Hangup extends Verb {
    
        function __construct() {
            parent::__construct(NULL, array());
        }
    
    
    }
    
    
    class Gather extends Verb {
    
        protected $valid = array('action','method','timeout','finishOnKey',
            'numDigits');
            
        protected $nesting = array('Say', 'Play', 'Pause');
        
        function __construct($attr = array()){
            parent::__construct(NULL, $attr);
        }
    
    }
    
    class Number extends Verb {
    
        protected $valid = array('url','sendDigits');
            
    }
    
    class Conference extends Verb {
    
        protected $valid = array('muted','beep','startConferenceOnEnter',
            'endConferenceOnExit','waitUrl','waitMethod');
            
    }
    
    class Sms extends Verb {
        protected $valid = array('to', 'from', 'action', 'method', 'statusCallback');
    }
    
    // Twilio Utility function and Request Validation
    // ========================================================================
    
    class TwilioUtils {
        
        protected $AccountSid;
        protected $AuthToken;
        
        function __construct($id, $token){
            $this->AuthToken = $token;
            $this->AccountSid = $id;
        }
    
        public function validateRequest($expected_signature, $url, $data = array()) {
           
           // sort the array by keys
           ksort($data);
           
           // append them to the data string in order 
           // with no delimiters
           foreach($data AS $key=>$value)
                   $url .= "$key$value";

           // This function calculates the HMAC hash of the data with the key 
           // passed in
           // Note: hash_hmac requires PHP 5 >= 5.1.2 or PECL hash:1.1-1.5
           // Or http://pear.php.net/package/Crypt_HMAC/
           $calculated_signature = base64_encode(hash_hmac("sha1",$url, $this->AuthToken, true));
           
           return $calculated_signature == $expected_signature;
           
        }
        
    }        

?>
