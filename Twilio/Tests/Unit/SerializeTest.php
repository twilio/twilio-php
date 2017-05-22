<?php

namespace Twilio\Tests\Unit;

use Twilio\Serialize;

class SerializeTest extends UnitTest {

    public function testNull() {
        $actual = Serialize::prefixedCollapsibleMap(null, "Prefix");
        $this->assertEquals(array(), $actual);
    }

    public function testEmptyArray() {
        $actual = Serialize::prefixedCollapsibleMap(array(), "Prefix");
        $this->assertEquals(array(), $actual);
    }

    public function testSingleKey() {
        $actual = Serialize::prefixedCollapsibleMap(array(
            "foo" => "bar"
        ), "Prefix");
        $this->assertEquals(array(
            "Prefix.foo" => "bar"
        ), $actual);
    }

    public function testNestedKey() {
        $actual = Serialize::prefixedCollapsibleMap(array(
            "foo" => array(
                "bar" => "baz"
            )
        ), "Prefix");
        $this->assertEquals(array(
            "Prefix.foo.bar" => "baz"
        ), $actual);
    }

    public function testMultipleKeys() {
        $actual = Serialize::prefixedCollapsibleMap(array(
            "watson" => array(
                "language" => "en",
                "alice" => "bob"
            ),
            "foo" => "bar"
        ), "Prefix");
        $this->assertEquals(array(
            "Prefix.watson.language" => "en",
            "Prefix.watson.alice" => "bob",
            "Prefix.foo" => "bar"
        ), $actual);
    }

    public function testIso8601DateNull() {
        $actual = Serialize::iso8601Date(null);
        $this->assertEquals(\Twilio\Values::NONE, $actual);
    }
    
    public function testIso8601DateNone() {
        $actual = Serialize::iso8601Date(\Twilio\Values::NONE);
        $this->assertEquals(\Twilio\Values::NONE, $actual);
    }

    public function testIso8601DatePassString() {
        // Backwards compatibility, prior to 5.5.0 date parameters were passed as strings.
        // After 5.5.0 parameters can be DateTime objects or strings.
        $actual = Serialize::iso8601DateTime("2017-02-01");
        $this->assertEquals("2017-02-01", $actual);
    }

    public function testIso8601DateSameTimezone() {
        $date = new \DateTime("now", new \DateTimeZone("UTC"));
        $actual = Serialize::iso8601Date($date);
        $this->assertEquals($date->format("Y-m-d"), $actual);
    }

    public function testIso8601DateDifferentTimezone() {
        $date = new \DateTime("2017-02-01T17:15:41-0800");
        $actual = Serialize::iso8601Date($date);
        // assert original date time object is unchanged
        $this->assertEquals("2017-02-01T17:15:41-0800", $date->format(\DateTime::ISO8601));
        $this->assertEquals("2017-02-02", $actual);
    }

    public function testIso8601DateTimeNull() {
        $actual = Serialize::iso8601DateTime(null);
        $this->assertEquals(\Twilio\Values::NONE, $actual);
    }

    public function testIso8601DateTimeNone() {
        $actual = Serialize::iso8601DateTime(\Twilio\Values::NONE);
        $this->assertEquals(\Twilio\Values::NONE, $actual);
    }

    public function testIso8601DateTimePassString() {
        // Backwards compatibility, prior to 5.5.0 date parameters were passed as strings.
        // After 5.5.0 parameters can be DateTime objects or strings.
        $actual = Serialize::iso8601DateTime("2017-02-01T17:15:41Z");
        $this->assertEquals("2017-02-01T17:15:41Z", $actual);
    }

    public function testIso8601DateTimeSameTimezone() {
        $date = new \DateTime("2017-02-01T17:15:41", new \DateTimeZone("UTC"));
        $actual = Serialize::iso8601DateTime($date);
        $this->assertEquals("2017-02-01T17:15:41Z", $actual);
    }

    public function testIso8601DateTimeDifferentTimezone() {
        $date = new \DateTime("2017-02-01T17:15:41-0800");
        $actual = Serialize::iso8601DateTime($date);
        // assert original date time object is unchanged
        $this->assertEquals("2017-02-01T17:15:41-0800", $date->format(\DateTime::ISO8601));
        $this->assertEquals("2017-02-02T01:15:41Z", $actual);
    }

    public function testBooleanToString() {
        $actual = Serialize::booleanToString(True);
        $this->assertEquals("True", $actual);

        $actual = Serialize::booleanToString(False);
        $this->assertEquals("False", $actual);
    }

    public function testBooleanToStringPassThroughSpecialVals() {
        $actual = Serialize::booleanToString(null);
        $this->assertEquals(null, $actual);

        // For backwards compatibility
        $actual = Serialize::booleanToString("True");
        $this->assertEquals("True", $actual);
    }

    public function testJsonObjectSerializesArrays() {
        $actual = Serialize::json_object(array("this", "is", "a", "list"));
        $this->assertEquals('["this","is","a","list"]', $actual);

        $actual = Serialize::json_object(array("twilio" => "rocks"));
        $this->assertEquals('{"twilio":"rocks"}', $actual);
    }

    public function testJsonObjectPassThroughOtherVals() {
        $actual = Serialize::json_object('{"already":"serialized"}');
        $this->assertEquals('{"already":"serialized"}', $actual);
    }
}
