<?php	
 namespace Twilio\Tests\Unit;	
 use Twilio\Deserialize;	
 class DeserializeTest extends UnitTest {	
     public function testDate() {	
        $actual = Deserialize::dateTime('2019-01-01');	
        $this->assertEquals('2019-01-01', $actual->format('Y-m-d'));	
    }	
     public function testDateTime() {	
        $actual = Deserialize::dateTime('2020-01-02 12:13:14');	
        $this->assertEquals('01/02/2020 12:13:14', $actual->format('m/d/Y H:i:s'));	
    }	
     public function testNonDateTime() {	
        $actual = Deserialize::dateTime('abc123');	
        $this->assertEquals('abc123', $actual);	
    }	
     public function testEmpty() {	
        $actual = Deserialize::dateTime('');	
        $this->assertEquals('', $actual);	
    }	
     public function testNull() {	
        $actual = Deserialize::dateTime(null);	
        $this->assertNull($actual);	
    }	
}
