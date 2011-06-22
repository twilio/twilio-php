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
            
            if($this->IsError = ($status >= 400)) { 
              if($status == 401) { 
                $this->ErrorMessage = "Authentication required"; 
              } else { 
                $this->ErrorMessage = 
                    (string)$this->ResponseXml->RestException->Message; 
              } 
            }
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
    /**
    * The <Say> verb converts text to speech that is read back to the caller.
    * <Say> is useful for development or saying dynamic text that is difficult to pre-record.
    */
    class Say extends Verb {
    
        protected $valid = array('voice','language','loop');
        /**
        * Say Constructor
        * 
        * Instatiates a new Say object with text and optional attributes.
        * Possible attributes are:
        * 	"voice" => 'man'|'woman',
        *   "language" => 'en'|'es'|'fr'|'de',
        * 	"loop"	=> integer >= 0
        *
        * @param string $text
        * @param array $attr Optional attributes
        * @return Say
        */
        function __construct($text='', $attr = array()) {
			parent::__construct($text, $attr);
        }
    }
	/**
	* The <Reject> verb rejects an incoming call to your Twilio number without 
	* billing you. This is very useful for blocking unwanted calls.
	* If the first verb in a TwiML document is <Reject>, Twilio will not pick 
	* up the call. The call ends with a status of 'busy' or 'no-answer',
	* depending on the verb's 'reason' attribute. Any verbs after 
	* <Reject> are unreachable and ignored.
	* 
	* Note that using <Reject> as the first verb in your response is the only 
	* way to prevent Twilio from answering a call. Any other response will 
	* result in an answered call and your account will be billed.
	*/
	class Reject extends Verb {
		
		protected $valid = array('reason');
		
        /**
        * Reject Constructor
        * 
        * Instatiates a new Reject object with optional attributes.
        * Possible attributes are:
        * 	"reason" => 'rejected'|'busy',
        *
        * @param array $attr Optional attributes, defaults to 'rejected'
        * @return Reject
        */
        function __construct($attr = array()) {
			parent::__construct($attr);
        }		
	}
    /**
    * The <Play> verb plays an audio file back to the caller. 
    * Twilio retrieves the file from a URL that you provide.
    */
    class Play extends Verb {
        
        protected $valid = array('loop');
        
    	/**
        * Play Constructor
        * 
        * Instatiates a new Play object with a URL and optional attributes.
        * Possible attributes are:
        * 	"loop" =>  integer >= 0
        *
        * @param string $url The URL of an audio file that Twilio will retrieve and play to the caller.
        * @param array $attr Optional attributes
        * @return Play
        */
        function __construct($url='', $attr = array()) {
			parent::__construct($url, $attr);
        } 
    }
    
    /**
    * The <Record> verb records the caller's voice and returns to you the URL 
    * of a file containing the audio recording. You can optionally generate 
    * text transcriptions of recorded calls by setting the 'transcribe' 
    * attribute of the <Record> verb to 'true'.
    */
    class Record extends Verb {
    
        protected $valid = array('action','method','timeout','finishOnKey',
								 'maxLength','transcribe','transcribeCallback', 'playBeep');
		
		/**
        * Record Constructor
        * 
        * Instatiates a new Record object with optional attributes.
        * Possible attributes are:
        * 	"action" =>  relative or absolute url, (default: current url)
        * 	"method" => 'GET'|'POST', (default: POST)
        *   "timeout" => positive integer, (default: 5)
        * 	"finishOnKey"	=> any digit, #, * (default: 1234567890*#)
        * 	"maxLength"	=> integer >= 1, (default: 3600, 1hr)
        * 	"transcribe" => true|false, (default: false)
        * 	"transcribeCallback" => relative or absolute url
        * 	"playBeep" => true|false, (default: true)
        *
        * @param array $attr Optional attributes
        * @return Record
        */
        function __construct($attr = array()) {
			parent::__construct($attr);
        } 
    }
    
    /**
    * The <Dial> verb connects the current caller to an another phone. 
    * If the called party picks up, the two parties are connected and can 
    * communicate until one hangs up. If the called party does not pick up,
    *  if a busy signal is received, or if the number doesn't exist, 
    * the dial verb will finish. 
    * 
    * When the dialed call ends, Twilio makes a GET or POST request to 
    * the 'action' URL if provided. Call flow will continue using 
    * the TwiML received in response to that request.
    */
    class Dial extends Verb {
    
        protected $valid = array('action','method','timeout','hangupOnStar',
            'timeLimit','callerId');
    
        protected $nesting = array('Number','Conference');
        
        /**
        * Dial Constructor
        * 
        * Instatiates a new Dial object with a number and optional attributes.
        * Possible attributes are:
        * 	"action" =>  relative or absolute url
        * 	"method" => 'GET'|'POST', (default: POST)
        *   "timeout" => positive integer, (default: 30)
        * 	"hangupOnStar"	=> true|false, (default: false)
        * 	"timeLimit"	=> integer >= 0, (default: 14400, 4hrs)
        * 	"callerId" => valid phone #, (default: Caller's callerid)
        *
        * @param string|Number|Conference $number The number or conference you wish to call
        * @param array $attr Optional attributes
        * @return Dial
        */
        function __construct($number='', $attr = array()) {
			parent::__construct($number, $attr);
        } 
    
    }
    /**
    * The <Redirect> verb transfers control of a call to the TwiML at a 
    * different URL. All verbs after <Redirect> are unreachable and ignored.
    */
    class Redirect extends Verb {
    
        protected $valid = array('method');
        
        /**
        * Redirect Constructor
        * 
        * Instatiates a new Redirect object with text and optional attributes.
        * Possible attributes are:
        * 	"method" => 'GET'|'POST', (default: POST)
        *
        * @param string $url An absolute or relative URL for a different TwiML document.
        * @param array $attr Optional attributes
        * @return Redirect
        */
        function __construct($url='', $attr = array()) {
			parent::__construct($url, $attr);
        } 
    
    }
    /**
    * The <Pause> verb waits silently for a specific number of seconds. 
    * If <Pause> is the first verb in a TwiML document, Twilio will wait 
    * the specified number of seconds before picking up the call.
    */
    class Pause extends Verb {
    
        protected $valid = array('length');
    
    	/**
        * Pause Constructor
        * 
        * Instatiates a new Pause object with text and optional attributes.
        * Possible attributes are:
        * 	"length" => integer > 0, (default: 1)
        *
        * @param array $attr Optional attributes
        * @return Pause
        */
        function __construct($attr = array()) {
            parent::__construct(NULL, $attr);
        }
    
    }
    /**
    * The <Hangup> verb ends a call. If used as the first verb in a TwiML 
    * response it does not prevent Twilio from answering the call and billing 
    * your account. The only way to not answer a call and prevent billing 
    * is to use the <Reject> verb.
    */
    class Hangup extends Verb {
    
    	/**
        * Hangup Constructor
        * 
        * Instatiates a new Hangup object.
        * 
        * @return Hangup
        */
        function __construct() {
            parent::__construct(NULL, array());
        }
    
    
    }
    
    /**
    * The <Gather> verb collects digits that a caller enters into his or her 
    * telephone keypad. When the caller is done entering data, Twilio submits 
    * that data to the provided 'action' URL in an HTTP GET or POST request, 
    * just like a web browser submits data from an HTML form.
    * If no input is received before timeout, <Gather> falls through to the 
    * next verb in the TwiML document. 
    * 
    * You may optionally nest <Say> and <Play> within a <Gather> verb while 
    * waiting for input. This allows you to read menu options to the caller 
    * while letting her enter a menu selection at any time. After the first 
    * digit is received the audio will stop playing.
    */
    class Gather extends Verb {
    
        protected $valid = array('action','method','timeout','finishOnKey',
            'numDigits');
            
        protected $nesting = array('Say', 'Play', 'Pause');
        /**
        * Gather Constructor
        * 
        * Instatiates a new Gather object with optional attributes.
        * Possible attributes are:
        * 	"action" =>  relative or absolute url (default: current url)
        * 	"method" => 'GET'|'POST', (default: POST)
        *   "timeout" => positive integer, (default: 5)
        * 	"finishOnKey"	=> any digit, #, *, (default: #)
        * 	"numDigits"	=> integer >= 1 (default: unlimited)
        *
        * @param array $attr Optional attributes
        * @return Gather
        */
        function __construct($attr = array()){
            parent::__construct(NULL, $attr);
        }
    
    }
    /**
    * The <Dial> verb's <Number> noun specifies a phone number to dial. 
    * Using the noun's attributes you can specify particular behaviors 
    * that Twilio should apply when dialing the number.
    * 
    * You can use multiple <Number> nouns within a <Dial> verb to simultaneously
    *  call all of them at once. The first call to pick up is connected 
    * to the current call and the rest are hung up.
    */
    class Number extends Verb {
    
        protected $valid = array('url','sendDigits');
        
         /**
        * Number Constructor
        * 
        * Instatiates a new Number object with optional attributes.
        * Possible attributes are:
        * 	"sendDigits"	=> any digits
        * 	"url"	=> any url
        *
        * @param string $number Number you wish to dial
        * @param array $attr Optional attributes
        * @return Number
        */
         function __construct($number = '', $attr = array()){
            parent::__construct($number, $attr);
         }
            
    }
    /**
    * The <Dial> verb's <Conference> noun allows you to connect to a conference
    * room. Much like how the <Number> noun allows you to connect to another
    * phone number, the <Conference> noun allows you to connect to a named 
    * conference room and talk with the other callers who have also connected 
    * to that room.
    * 
    * The name of the room is up to you and is namespaced to your account. 
    * This means that any caller who joins 'room1234' via your account will 
    * end up in the same conference room, but callers connecting through 
    * different accounts would not. The maximum number of participants in a 
    * single Twilio conference room is 40.
    */
    class Conference extends Verb {
    
        protected $valid = array('muted','beep','startConferenceOnEnter',
            'endConferenceOnExit','waitUrl','waitMethod');
        
        /**
        * Conference Constructor
        * 
        * Instatiates a new Conference object with room and optional attributes.
        * Possible attributes are:
        * 	"muted"	=> true|false, (default: false)
        * 	"beef"	=> true|false, (default: true)
        * 	"startConferenceOnEnter"	=> true|false (default: true)
        * 	"endConferenceOnExit"	=> true|false (default: false)
        * 	"waitUrl"	=> TwiML url, empty string,	(default: Twilio hold music)
        * 	"waitMethod"	=> 'GET'|'POST', (default: POST)
        * 	"maxParticipants"	=> integer > 0 && <= 40 (default: 40)
        *
        * @param string $room Conference room to join
        * @param array $attr Optional attributes
        * @return Conference
        */
         function __construct($room = '', $attr = array()){
            parent::__construct($room, $attr);
         }
            
    }
    /**
    * The <Sms> verb sends an SMS message to a phone number during a phone call.
    */
    class Sms extends Verb {
        protected $valid = array('to', 'from', 'action', 'method', 'statusCallback');
        
        /**
        * SMS Constructor
        * 
        * Instatiates a new SMS object with room and optional attributes.
        * Possible attributes are:
        * 	"to"	=> phone #
        * 	"from"	=> sms capable phone #
        * 	"action"	=> true|false (default: true)
        * 	"method"	=> 'GET'|'POST', (default: POST)
        * 	"statusCallback"	=> relative or absolute URL
        *
        * @param string $message SMS message to send
        * @param array $attr Optional attributes
        * @return SMS
        */
         function __construct($message = '', $attr = array()){
            parent::__construct($message, $attr);
         }
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
