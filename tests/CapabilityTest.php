<?php

require_once 'Twilio/Capability.php';

class CapabilityTest extends PHPUnit_Framework_TestCase {
    
    public function testNoPermissions() {
        $token = new Services_Twilio_Capability('AC123', 'foo');
        $payload = JWT::decode($token->generateToken(), 'foo');
        $this->assertEquals($payload->iss, "AC123");
        $this->assertEquals($payload->scope, '');
    }

    public function testInboundPermissions() {
        $token = new Services_Twilio_Capability('AC123', 'foo');
        $token->allowClientIncoming("andy");
        $payload = JWT::decode($token->generateToken(), 'foo');

        $eurl = "scope:client:incoming?clientName=andy";
        $this->assertEquals($payload->scope, $eurl);
    }

    public function testOutboundPermissions() {
        $token = new Services_Twilio_Capability('AC123', 'foo');
        $token->allowClientOutgoing("AP123");
        $payload = JWT::decode($token->generateToken(), 'foo');;
        $eurl = "scope:client:outgoing?appSid=AP123";
        $this->assertContains($eurl, $payload->scope);
    }

    public function testOutboundPermissionsParams() {
        $token = new Services_Twilio_Capability('AC123', 'foo');
        $token->allowClientOutgoing("AP123", array("foobar" => 3));
        $payload = JWT::decode($token->generateToken(), 'foo');

        $eurl = "scope:client:outgoing?appSid=AP123&appParams=foobar%3D3";
        $this->assertEquals($payload->scope, $eurl);
    }

    public function testEvents() {
        $token = new Services_Twilio_Capability('AC123', 'foo');
        $token->allowEventStream();
        $payload = JWT::decode($token->generateToken(), 'foo');

        $event_uri = "scope:stream:subscribe?path=%2F2010"
            . "-04-01%2FEvents&params=";
        $this->assertEquals($payload->scope, $event_uri);
    }

    public function testEventsWithFilters() {
        $token = new Services_Twilio_Capability('AC123', 'foo');
        $token->allowEventStream(array("foobar" => "hey"));
        $payload = JWT::decode($token->generateToken(), 'foo');

        $event_uri = "scope:stream:subscribe?path=%2F2010-"
            . "04-01%2FEvents&params=foobar%3Dhey";
        $this->assertEquals($payload->scope, $event_uri);
    }


    public function testDecode() {
        $token = new Services_Twilio_Capability('AC123', 'foo');
        $token->allowClientOutgoing("AP123", array("foobar"=> 3));
        $token->allowClientIncoming("andy");
        $token->allowEventStream();

        $outgoing_uri = "scope:client:outgoing?appSid="
            . "AP123&appParams=foobar%3D3";
        $incoming_uri = "scope:client:incoming?clientName=andy";
        $event_uri = "scope:stream:subscribe?path=%2F2010-04-01%2FEvents";

        $payload = JWT::decode($token->generateToken(), 'foo');
        $scope = $payload->scope;

        $this->assertContains($outgoing_uri, $scope);
        $this->assertContains($incoming_uri, $scope);
        $this->assertContains($event_uri, $scope);
    }
    
    /*
    function testDecodeWithAuthToken() {
        try {
            $token = new Services_Twilio_Capability('AC123', 'foo');
            $payload = JWT::decode($token->generateToken(), 'foo');
        } catch (UnexpectedValueException $e) {
            $this->assertTrue(false, "Could not decode with 'foo'");
        }
    }
    
    function testPayloadContainsAccountSid() {
        $token = new Services_Twilio_Capability('AC123', 'foo');
        $payload = JWT::decode($token->generateToken(), 'foo');
        $this->assertEquals('AC123', $payload->iss);
    }
    
    function testAllowEventsNoFilters() {
        $token = new Services_Twilio_Capability('AC123', 'foo');
        $token->allowEventStream();
        $payload = JWT::decode($token->generateToken(), 'foo');
        $url = 'https://' . $token->streamHost . '/2010-04-01/Events';
        $this->assertContains('GET:' . $url, $payload->scope);
        $this->assertEquals($url, $payload->stream);
    }
    
    function testAllowEventsWithFilters() {
        $token = new Services_Twilio_Capability('AC123', 'foo');
        $token->allowEventStream(array('abc' => '123'));
        $payload = JWT::decode($token->generateToken(), 'foo');
        $this->assertContains(
            ':https://' . $token->streamHost . '/2010-04-01/Events?abc=123',
            $payload->scope
        );
    }
    
    function testAllowInbound() {
        $token = new Services_Twilio_Capability('AC123', 'foo');
        $token->allowClientIncoming('twilio');
        $payload = JWT::decode($token->generateToken(), 'foo');
        $url = 'http://' . $token->matrixHost . '/2010-04-01/AC123/twilio';
        $this->assertContains('*:' . $url, $payload->scope);
        $this->assertEquals($url, $payload->register);
    }
    
    function testAllowOutboundNoParams() {
        $token = new Services_Twilio_Capability('AC123', 'foo');
        $token->allowClientOutgoing('twilio');
        $payload = JWT::decode($token->generateToken(), 'foo');
        $this->assertContains(
            'appSid=twilio',
            $payload->scope
        );
    }
    
    function testAllowOutboundWithParams() {
        $token = new Services_Twilio_Capability('AC123', 'foo');
        $token->allowClientOutgoing('twilio', array('abc' => '123'));
        $payload = JWT::decode($token->generateToken(), 'foo');
        $this->assertContains(
            'appSid=twilio&appParams=abc%3D123',
            $payload->scope
        );
    }
    
    function testCustomizableHosts() {
        $token = new Services_Twilio_Capability('AC123', 'foo', array(
            'matrix' => 'foo',
            'stream' => 'bar',
            'chunder' => 'baz',
        ));
        $this->assertEquals('foo', $token->matrixHost);
        $this->assertEquals('bar', $token->streamHost);
        $this->assertEquals('baz', $token->chunderHost);
    }
    
    function testClientNameValidation() {
        $this->setExpectedException('InvalidArgumentException');
        $token = new Services_Twilio_Capability('AC123', 'foo');
        $token->allowClientIncoming('@');
    }
    */
}
