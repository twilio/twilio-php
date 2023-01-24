<?php

namespace Twilio\Tests\Unit;

use Twilio\Deserialize;

class DeserializeTest extends UnitTest {
    public function testDate(): void {
        $actual = Deserialize::dateTime('2019-01-01');
        $this->assertEquals('2019-01-01', $actual->format('Y-m-d'));
    }

    public function testDateTime(): void {
        $actual = Deserialize::dateTime('2020-01-02 12:13:14');
        $this->assertEquals('01/02/2020 12:13:14', $actual->format('m/d/Y H:i:s'));
    }

    public function testNonDateTime(): void {
        $actual = Deserialize::dateTime('abc123');
        $this->assertEquals('abc123', $actual);
    }

    public function testEmpty(): void {
        $actual = Deserialize::dateTime('');
        $this->assertEquals('', $actual);
    }

    public function testNull(): void {
        $actual = Deserialize::dateTime(null);
        $this->assertNull($actual);
    }

    public function testPhoneNumberCapabilities(): void {
        $actual = Deserialize::phoneNumberCapabilities([
                    "voice" => true,
                    "sms" => false,
                    "mms" => true,
                    "fax" => false ]);
        $this->assertEquals(true, $actual->mms);
        $this->assertEquals(false, $actual->sms);
        $this->assertEquals(true, $actual->voice);
        $this->assertEquals(false, $actual->fax);
        $this->assertEquals("[Twilio.Base.PhoneNumberCapabilities " .
            "(
            mms: true,
            sms: false,
            voice: true,
            fax: false
        )]", $actual->__toString());

    }

    public function testPhoneNumberCapabilitiesException(): void {
        $actual = Deserialize::phoneNumberCapabilities([
            "voice" => true,
            "mms" => false,
            "fax" => false ]);
        try{
            $actual->video;
        }catch (\Exception $e){
            $this->assertEquals("Unknown subresource video", $e->getMessage());
        }
    }

    public function testNonPhoneNumberCapabilities(): void {
        $actual = Deserialize::phoneNumberCapabilities([1,2,3]);
        $this->assertEquals([1,2,3], $actual);
    }

    public function testEmptyPhoneNumberCapabilities(): void {
        $actual = Deserialize::phoneNumberCapabilities([]);
        $this->assertEquals([], $actual);
    }

    public function testNullPhoneNumberCapabilities(): void {
        $actual = Deserialize::phoneNumberCapabilities(null);
        $this->assertNull($actual);
    }
}
