<?php
    // Include the PHP TwilioRest library 
    require "twilio.php";
    
    // Twilio REST API version 
    $ApiVersion = "2010-04-01";
    
    // Set our AccountSid and AuthToken 
    $AccountSid = "ACXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX";
    $AuthToken = "YYYYYYYYYYYYYYYYYYYYYYYYYYYYYYYY";
    
    // Outgoing Caller ID you have previously validated with Twilio 
    $CallerID = 'NNNNNNNNNN';
    
    // Instantiate a new Twilio Rest Client 
    $client = new TwilioRestClient($AccountSid, $AuthToken);
    
    // ========================================================================
    // 1. Initiate a new outbound call to 415-555-1212
    //    uses a HTTP POST
    $data = array(
    	"From" => $CallerID, 	      // Outgoing Caller ID
    	"To" => "415-555-1212",	  // The phone number you wish to dial
    	"Url" => "http://demo.twilio.com/welcome"
    );
    
    $response = $client->request("/$ApiVersion/Accounts/$AccountSid/Calls", 
       "POST", $data); 
    
    // check response for success or error
    if($response->IsError)
    	echo "Error starting phone call: {$response->ErrorMessage}\n";
    else
    	echo "Started call: {$response->ResponseXml->Call->Sid}\n";
    
    // ========================================================================
    // 2. Get a list of recent calls 
    // uses a HTTP GET
    $response = $client->request("/$ApiVersion/Accounts/$AccountSid/Calls", 
        "GET");
    
    if($response->IsError)
    	echo "Error fetching recent calls: {$response->ErrorMessage}";
    else {
    	foreach($response->ResponseXml->Calls->Call AS $call)
    		echo "Call from {$call->From} to {$call->To}";
    		echo " at {$call->StartTime} of length: {$call->Duration}\n";
    }
    
    // ========================================================================
    // 3. Get Recent Developer Notifications
    // uses a HTTP GET
    $response = $client->request("/$ApiVersion/Accounts/$AccountSid/Notifications");
    
    if($response->IsError)
    	echo "Error fetching recent notifications: {$response->ErrorMessage}";
    else {
    	foreach($response->ResponseXml->Notifications->Notification AS $notification)
    		echo "Log entry (level {$notification->Log}) on ";
    		echo "{$notification->MessageDate}: {$notification->MessageText}\n";
    }
    
    // ========================================================================
    // 4. Get Recordings for a certain Call
    // uses a HTTP GET
    
    $callSid = "CA123456789123456789";
    $response = $client->request("/$ApiVersion/Accounts/$AccountSid/Recordings",
        "GET", array("CallSid" => $callSid));
    
    if($response->IsError){
    	echo "Error fetching recordings for call $callSid:";
    	echo " {$response->ErrorMessage}";
    } else {
    	
    	// iterate over recordings found
    	foreach($response->ResponseXml->Recordings->Recording AS $recording)
    		echo "Recording of duration {$recording->Duration} seconds made ";
    		echo "on:{$recording->DateCreated} at URL: ";
    		echo "/Accounts/$AccountSid/Recordings/{$recording->Sid}\n";
    }
    
    // ========================================================================
    // 5. Delete a Recording 
    // uses a HTTP DELETE
    $recordingSid = "RE12345678901234567890";
    $response = $client->request("/$ApiVersion/Accounts/$AccountSid/Recordings/$recordingSid", "DELETE");
    if($response->IsError)
    	echo "Error deleting recording $recordingSid: {$response->ErrorMessage}\n";
    else
    	echo "Successfully deleted recording $recordingSid\n";
    
    ?>