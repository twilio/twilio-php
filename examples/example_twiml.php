<?php
    
    /*
    The TwiML PHP Response Library makes it easy to write TwiML without having
    to touch XML. Error checking is built in to help preventing invalid markup.
    
    USAGE:
    To create TwiML, you will make new TwiML verbs and nest them inside another
    TwiML verb. Convenience methods are provided to simplify TwiML creation.
    */
    
    include ('twilio.php');
   
    // ========================================================================
    // Using Say, Dial, and Play
    $r = new Response();
    $r->append(new Say("Hello World", array("voice" => "man", 
        "language" => "fr", "loop" => "10")));
    $r->append(new Dial("4155551212", array("timeLimit" => "45")));
    $r->append(new Play("http://www.mp3.com"));
    $r->Respond();
    
    /* outputs:
    <Response>
        <Say voice="man" language="fr" loop="10">Hello World</Say>
        <Play>http://www.mp3.com</Play>
        <Dial timeLimit="45">4155551212</Dial>
    </Response>
    */
    
    // The same XML can be created above using the convencience methods
    $r = new Response();
    $r->addSay("Hello World", array("voice" => "man", "language" => "fr", 
        "loop" => "10"));
    $r->addDial("4155551212", array("timeLimit" => "45"));
    $r->addPlay("http://www.mp3.com");
    //$r->Respond();
    
    // ========================================================================
    // Gather, Redirect
    $r = new Response();
    $g = $r->append(new Gather(array("numDigits" => "1")));
    $g->append(new Say("Press 1"));
    $r->append(new Redirect());
    //$r->Respond();
    
    
    /* outputs:
    <Response>
    	<Gather numDigits="1">
    		<Say>Press 1</Say>
    	</Gather>
    	<Redirect/>
    </Response>
    */
    
    // ========================================================================
    // Add a Say verb multiple times
    $r = new Response();
    $say = new Say("Press 1");
    $r->append($say);
    $r->append($say);
    //$r->Respond();
    
    
    /*
    <Response>
    	<Say>Press 1</Say>
    	<Say>Press 1</Say>
    </Response>
    */
    
    // ========================================================================
    // Creating a Conference Call
    // See the conferencing docs for more information
    // http://www.twilio.com/docs/api/twiml/conference
    $r = new Response();
    $dial = new Dial();
    $conf = new Conference('MyRoom',array('startConferenceOnEnter'=>"true"));
    $dial->append($conf);
    $r->append($dial);
    $r->Respond();
    
    /*
    <Response>
        <Dial>
            <Conference startConferenceOnEnter="True">
                MyRoom
            </Conference>
        </Dial>
    </Response>
    */
    
    // ========================================================================
    // Set any attribute / value pair
    // You may want to add an attribute to a verb that the library does not 
    // support. This can be accomplished by putting __ in front o the 
    // attribute name
    $r = new Response();
    $redirect = new Redirect();
    $redirect->set("crazy","delicious");
    $r->append($redirect);
    //$r-> Respond();
    
    /*
    <Response>
    	<Redirect crazy="delicious"/>
    </Response>
    */

?>
