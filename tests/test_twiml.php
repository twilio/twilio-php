<?php

    // Testing Requires PHPUnit
    require_once 'PHPUnit/Framework.php';
    require_once '../twilio.php';
    
    class TwiMLTest extends PHPUnit_Framework_TestCase
    {
        public function addBadAttribute($verb){
            $r = new $verb(NULL, array("foo" => "bar"));
        }
        
        // Test Response Verb
        public function testResponseEmpty(){
            $r = new Response();
            $expected = '<Response></Response>';
            $this->assertXmlStringEqualsXmlString($expected, $r->asUrl(False),
                "Should be an empty response");
        }
        
        // public function testResponseAddAttribute(){
        //     $r = new Response();
        //     $r->set("foo", "bar");
        //     $expected = '<Response foo="bar"></Response>';
        //     $this->assertXmlStringEqualsXmlString($expected, $r->asUrl(False), 
        //         "Should have the foo attribute set to bar");
        // }
        
        // Test Say Verb
        public function testSayBasic() {   
            $r = new Response();
            $r->append(new Say("Hello Monkey"));
            $expected = '<Response><Say>Hello Monkey</Say></Response>';
            $this->assertXmlStringEqualsXmlString($expected, $r->asUrl(False));
        }
        
        public function testSayLoopThree() {
            $r = new Response();
            $r->append(new Say("Hello Monkey", array("loop" => 3)));
            $expected = '<Response><Say loop="3">Hello Monkey</Say></Response>';
            $this->assertXmlStringEqualsXmlString($expected, $r->asUrl(False));
        }
        
        public function testSayLoopThreeWoman() {
            $r = new Response();
            $r->append(new Say("Hello Monkey", array("loop" => 3, "voice"=>"woman")));
            $expected = '<Response><Say loop="3" voice="woman">Hello Monkey</Say></Response>';
            $this->assertXmlStringEqualsXmlString($expected, $r->asUrl(False));
        }
        
        public function testSayConvienceMethod() {
            $r = new Response();
            $r->addSay("Hello Monkey", array("language" => "fr"));
            $expected = '<Response><Say language="fr">Hello Monkey</Say></Response>';
            $this->assertXmlStringEqualsXmlString($expected, $r->asUrl(False));
        }
        
        public function testSayBadAppend() {
            $this->setExpectedException('TwilioException');
            $s = new Say();
            $s->append(new Dial());
        }
        
        public function testSayAddBadAttribute(){
            $this->setExpectedException('TwilioException');
            $this->addBadAttribute("Say");
        }
        
        //Test Play Verb
        public function testPlayBasic() {   
            $r = new Response();
            $r->append(new Play("hello-monkey.mp3"));
            $expected = '<Response><Play>hello-monkey.mp3</Play></Response>';
            $this->assertXmlStringEqualsXmlString($expected, $r->asUrl(False));
        }
        
        public function testPlayLoopThree() {
            $r = new Response();
            $r->append(new Play("hello-monkey.mp3", array("loop" => 3)));
            $expected = '<Response><Play loop="3">hello-monkey.mp3</Play></Response>';
            $this->assertXmlStringEqualsXmlString($expected, $r->asUrl(False));
        }
        
        public function testPlayConvienceMethod() {
            $r = new Response();
            $r->addPlay("hello-monkey.mp3", array("loop" => 3));
            $expected = '<Response><Play loop="3">hello-monkey.mp3</Play></Response>';
            $this->assertXmlStringEqualsXmlString($expected, $r->asUrl(False));
        }
        
        public function testPlayBadAppend() {
            $this->setExpectedException('TwilioException');
            $p = new Play();
            $p->append(new Dial());
        }
        
        public function testPlayAddBadAttribute(){
            $this->setExpectedException('TwilioException');
            $this->addBadAttribute("Play");
        }
        
        //Test Record Verb
        public function testRecord() {   
            $r = new Response();
            $r->append(new Record());
            $expected = '<Response><Record></Record></Response>';
            $this->assertXmlStringEqualsXmlString($expected, $r->asUrl(False));
        }
        
        public function testRecordActionMethod() {   
            $r = new Response();
            $r->append(new Record(array("action" => "example.com", "method" => "GET")));
            $expected = '<Response><Record action="example.com" method="GET"></Record></Response>';
            $this->assertXmlStringEqualsXmlString($expected, $r->asUrl(False));
        }
        
        public function testRecordMaxLengthKeyTimeout(){
            $r = new Response();
            $r->append(new Record(array("timeout" => 4, "finishOnKey" => "#", "maxLength" => 30)));
            $expected = '<Response><Record timeout="4" finishOnKey="#" maxLength="30"></Record></Response>';
            $this->assertXmlStringEqualsXmlString($expected, $r->asUrl(False));
        }
        
        public function testRecordConvienceMethod(){
            $r = new Response();
            $r->addRecord(array("transcribeCallback" => "example.com"));
            $expected = '<Response><Record transcribeCallback="example.com"></Record></Response>';
            $this->assertXmlStringEqualsXmlString($expected, $r->asUrl(False));
        }
        
        public function testRecordAddAttribute(){
            $r = new Response();
            $re = new Record();
            $re->set("foo", "bar");
            $r->append($re);
            $expected = '<Response><Record foo="bar"></Record></Response>';
            $this->assertXmlStringEqualsXmlString($expected, $r->asUrl(False));
        }
        
        public function testRecordBadAppend() {
            $this->setExpectedException('TwilioException');
            $r = new Record();
            $r->append(new Dial());
        }
        
        public function testRecordAddBadAttribute(){
            $this->setExpectedException('TwilioException');
            $this->addBadAttribute("Record");
        }
        
        //Test Redirect Verb
        public function testRedirect() {
            $r = new Response();
            $r->append(new Redirect());
            $expected = '<Response><Redirect></Redirect></Response>';
            $this->assertXmlStringEqualsXmlString($expected, $r->asUrl(False));
        }
        
        public function testRedirectConvience() {
            $r = new Response();
            $r->addRedirect();
            $expected = '<Response><Redirect></Redirect></Response>';
            $this->assertXmlStringEqualsXmlString($expected, $r->asUrl(False));
        }
        public function testRedirectAddAttribute(){
            $r = new Response();
            $re = new Redirect();
            $re->set("foo", "bar");
            $r->append($re);
            $expected = '<Response><Redirect foo="bar"></Redirect></Response>';
            $this->assertXmlStringEqualsXmlString($expected, $r->asUrl(False));
        }
        
        public function testRedirectBadAppend() {
            $this->setExpectedException('TwilioException');
            $r = new Redirect();
            $r->append(new Dial());
        }
        
        public function testRedirectAddBadAttribute(){
            $this->setExpectedException('TwilioException');
            $this->addBadAttribute("Redirect");
        }
        
        //Test Hangup Verb
        public function testHangup() {
            $r = new Response();
            $r->append(new Hangup());
            $expected = '<Response><Hangup></Hangup></Response>';
            $this->assertXmlStringEqualsXmlString($expected, $r->asUrl(False));
        }
        
        public function testHangupConvience() {
            $r = new Response();
            $r->addHangup();
            $expected = '<Response><Hangup></Hangup></Response>';
            $this->assertXmlStringEqualsXmlString($expected, $r->asUrl(False));
        }
        
        public function testHangupAddAttribute(){
            $r = new Response();
            $re = new Hangup();
            $re->set("foo", "bar");
            $r->append($re);
            $expected = '<Response><Hangup foo="bar"></Hangup></Response>';
            $this->assertXmlStringEqualsXmlString($expected, $r->asUrl(False));
        }
        
        public function testHangupBadAppend() {
            $this->setExpectedException('TwilioException');
            $r = new Hangup();
            $r->append(new Dial());
        }
        
        //Test Pause Verb
        public function testPause() {
            $r = new Response();
            $r->append(new Pause());
            $expected = '<Response><Pause></Pause></Response>';
            $this->assertXmlStringEqualsXmlString($expected, $r->asUrl(False));
        }
        
        public function testPauseConvience() {
            $r = new Response();
            $r->addPause();
            $expected = '<Response><Pause></Pause></Response>';
            $this->assertXmlStringEqualsXmlString($expected, $r->asUrl(False));
        }
        
        public function testPauseAddAttribute(){
            $r = new Response();
            $re = new Pause();
            $re->set("foo", "bar");
            $r->append($re);
            $expected = '<Response><Pause foo="bar"></Pause></Response>';
            $this->assertXmlStringEqualsXmlString($expected, $r->asUrl(False));
        }
        
        public function testPauseBadAppend() {
            $this->setExpectedException('TwilioException');
            $r = new Pause();
            $r->append(new Dial());
        }
        
        public function testPauseAddBadAttribute(){
            $this->setExpectedException('TwilioException');
            new Pause(array("foo" => "bar"));
        }
        
        //Test Dial Verb
        public function testDial() {
            $r = new Response();
            $r->append(new Dial("1231231234"));
            $expected = '<Response><Dial>1231231234</Dial></Response>';
            $this->assertXmlStringEqualsXmlString($expected, $r->asUrl(False));
        }
        
        public function testDialConvience() {
            $r = new Response();
            $r->addDial();
            $expected = '<Response><Dial></Dial></Response>';
            $this->assertXmlStringEqualsXmlString($expected, $r->asUrl(False));
        }
        
        public function testDialAddNumber() {
            $r = new Response();
            $d = $r->append(new Dial());
            $d->append(new Number("1231231234"));
            $expected = '<Response><Dial><Number>1231231234</Number></Dial></Response>';
            $this->assertXmlStringEqualsXmlString($expected, $r->asUrl(False));
        }
        
        public function testDialAddConference() {
            $r = new Response();
            $d = $r->append(new Dial());
            $d->append(new Conference("MyRoom"));
            $expected = '<Response><Dial><Conference>MyRoom</Conference></Dial></Response>';
            $this->assertXmlStringEqualsXmlString($expected, $r->asUrl(False));
        }
        
        public function testDialAddConferenceConvience() {
            $r = new Response();
            $d = $r->append(new Dial());
            $d->addConference("MyRoom", array("startConferenceOnEnter" => "false"));
            $expected = '<Response><Dial><Conference startConferenceOnEnter="false">MyRoom</Conference></Dial></Response>';
            $this->assertXmlStringEqualsXmlString($expected, $r->asUrl(False));
        }
        
        public function testDialAddAttribute(){
            $r = new Response();
            $re = new Dial();
            $re->set("foo", "bar");
            $r->append($re);
            $expected = '<Response><Dial foo="bar"></Dial></Response>';
            $this->assertXmlStringEqualsXmlString($expected, $r->asUrl(False));
        }
        
        public function testDialBadAppend() {
            $this->setExpectedException('TwilioException');
            $r = new Dial();
            $r->append(new Pause());
        }
        
        public function testDialAddBadAttribute(){
            $this->setExpectedException('TwilioException');
            new Dial(array("foo" => "bar"));
        }
        
        //Test Gather Verb
        public function testGather(){
            $r = new Response();
            $r->append(new Gather());
            $expected = '<Response><Gather></Gather></Response>';
            $this->assertXmlStringEqualsXmlString($expected, $r->asUrl(False));
        }
        
        public function testGatherMethodAction(){
            $r = new Response();
            $r->append(new Gather(array("action"=>"example.com", "method"=>"GET")));
            $expected = '<Response><Gather action="example.com" method="GET"></Gather></Response>';
            $this->assertXmlStringEqualsXmlString($expected, $r->asUrl(False));
        }
        
        public function testGatherActionWithParams(){
            $r = new Response(); 
            $r->append(new Gather(array("action" => "record.php?action=recordPageNow&id=4&page=3"))); 
            $expected = '<Response><Gather action="record.php?action=recordPageNow&amp;id=4&amp;page=3"></Gather></Response>';
            $this->assertXmlStringEqualsXmlString($expected, $r->asUrl(False));
        }
        
        public function testGatherNestedVerbs(){
            $r = new Response();
            $g = $r->append(new Gather(array("action"=>"example.com", "method"=>"GET")));
            $g->append(new Say("Hello World"));
            $g->append(new Play("helloworld.mp3"));
            $g->append(new Pause());
            $expected = '
                <Response>
                    <Gather action="example.com" method="GET">
                        <Say>Hello World</Say>
                        <Play>helloworld.mp3</Play>
                        <Pause></Pause>
                    </Gather>
                </Response>';
            $this->assertXmlStringEqualsXmlString($expected, $r->asUrl(False));
        }
        
        public function testGatherNestedVerbsConvienceMethods(){
            $r = new Response();
            $g = $r->addGather(array("action"=>"example.com", "method"=>"GET"));
            $g->addSay("Hello World");
            $g->addPlay("helloworld.mp3");
            $g->addPause();
            $expected = '
                <Response>
                    <Gather action="example.com" method="GET">
                        <Say>Hello World</Say>
                        <Play>helloworld.mp3</Play>
                        <Pause></Pause>
                    </Gather>
                </Response>';
            $this->assertXmlStringEqualsXmlString($expected, $r->asUrl(False));
        }
        
        public function testGatherAddAttribute(){
            $r = new Response();
            $re = new Gather();
            $re->set("foo", "bar");
            $r->append($re);
            $expected = '<Response><Gather foo="bar"></Gather></Response>';
            $this->assertXmlStringEqualsXmlString($expected, $r->asUrl(False));
        }
        
        public function testGatherBadAppend() {
            $this->setExpectedException('TwilioException');
            $r = new Gather();
            $r->append(new Conference());
        }
        
        public function testGatherAddBadAttribute(){
            $this->setExpectedException('TwilioException');
            new Gather(array("foo" => "bar"));
        }
        
        //Test Sms Verb
        public function testSms() {
            $r = new Response();
            $r->append(new Sms("Hello World"));
            $expected = '<Response><Sms>Hello World</Sms></Response>';
            $this->assertXmlStringEqualsXmlString($expected, $r->asUrl(False));
        }
        
        public function testSmsConvience() {
            $r = new Response();
            $r->addSms("Hello World");
            $expected = '<Response><Sms>Hello World</Sms></Response>';
            $this->assertXmlStringEqualsXmlString($expected, $r->asUrl(False));
        }
        
        public function testSmsAddAttribute(){
            $r = new Response();
            $re = new Sms();
            $re->set("foo", "bar");
            $r->append($re);
            $expected = '<Response><Sms foo="bar"></Sms></Response>';
            $this->assertXmlStringEqualsXmlString($expected, $r->asUrl(False));
        }
        
        public function testSmsBadAppend() {
            $this->setExpectedException('TwilioException');
            $r = new Sms();
            $r->append(new Dial());
        }
        
        public function testSmsAddBadAttribute(){
            $this->setExpectedException('TwilioException');
            new Sms(array("foo" => "bar"));
        }
        
                
    }

?>

 