<?php    
    // Include the PHP TwilioRest library 
    require "twilio.php";
    
    // Twilio REST API version 
    $ApiVersion = "2010-04-01";
    
    // Set our AccountSid and AuthToken 
    $AccountSid = "ACXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX";
    $AuthToken = "YYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYY";

    // Create a new TwilioUtils object
    $utils = new TwilioUtils($AccountSid, $AuthToken);
    
    // Note, that if your URL uses an implied "index" document 
    // (index.php), then apache often adds a slash to the SCRIPT_URI 
    // while Twilio's original request will not have a slash
    // Example: if Twilio requested http://mycompany.com/twilio
    //   and that url is handled by an index.php script
    //   Apache/PHP will report the URI as being: 
    //   http://mycompany.com/twilio/
    //   But the hash should be calculated without the trailing slash
           
    // Also note, if you're using URL rewriting, then you should check 
    // to see that PHP is reporting your SCRIPT_URI and 
    // QUERY_STRING correctly.
    
    if($_SERVER['HTTPS'])
        $http = "https://";
    else
        $http = "http://";
    
    $url = $http.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
    
    if(isset($_POST)) {
        // copy the post data
        $data = $_POST;
    }
    
    $expected_signature = $_SERVER["HTTP_X_TWILIO_SIGNATURE"];
        
    echo "The request from Twilio";
    if($utils->validateRequest($expected_signature, $url, $data))
        echo "was confirmed to have come from Twilio.";
    else
        echo "was NOT VALID.  It might have been spoofed!";
?>