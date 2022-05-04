<?php

namespace Twilio\Tests\Unit;

use Twilio\Serialize;
use Twilio\Values;

class SerializeTest extends UnitTest {

    public function testNull(): void {
        $actual = Serialize::prefixedCollapsibleMap(null, 'Prefix');
        $this->assertEquals([], $actual);
    }

    public function testEmptyArray(): void {
        $actual = Serialize::prefixedCollapsibleMap([], 'Prefix');
        $this->assertEquals([], $actual);
    }

    public function testSingleKey(): void {
        $actual = Serialize::prefixedCollapsibleMap(['foo' => 'bar'], 'Prefix');
        $this->assertEquals(['Prefix.foo' => 'bar'], $actual);
    }

    public function testNestedKey(): void {
        $actual = Serialize::prefixedCollapsibleMap(['foo' => ['bar' => 'baz']], 'Prefix');
        $this->assertEquals(['Prefix.foo.bar' => 'baz'], $actual);
    }

    public function testMultipleKeys(): void {
        $actual = Serialize::prefixedCollapsibleMap([
            'watson' => [
                'language' => 'en',
                'alice' => 'bob'
            ],
            'foo' => 'bar'
        ], 'Prefix');
        $this->assertEquals([
            'Prefix.watson.language' => 'en',
            'Prefix.watson.alice' => 'bob',
            'Prefix.foo' => 'bar'
        ], $actual);
    }

    public function testIso8601DateNull(): void {
        $actual = Serialize::iso8601Date(null);
        $this->assertEquals(\Twilio\Values::NONE, $actual);
    }

    public function testIso8601DateNone(): void {
        $actual = Serialize::iso8601Date(\Twilio\Values::NONE);
        $this->assertEquals(\Twilio\Values::NONE, $actual);
    }

    public function testIso8601DatePassString(): void {
        // Backwards compatibility, prior to 5.5.0 date parameters were passed as strings.
        // After 5.5.0 parameters can be DateTime objects or strings.
        $actual = Serialize::iso8601DateTime('2017-02-01');
        $this->assertEquals('2017-02-01', $actual);
    }

    public function testIso8601DateSameTimezone(): void {
        $date = new \DateTime('now', new \DateTimeZone('+0000'));
        $actual = Serialize::iso8601Date($date);
        $this->assertEquals($date->format('Y-m-d'), $actual);
    }

    public function testIso8601DateDifferentTimezone(): void {
        $date = new \DateTime('2017-02-01T17:15:41-0800');
        $actual = Serialize::iso8601Date($date);
        // assert original date time object is unchanged
        $this->assertEquals('2017-02-01T17:15:41-0800', $date->format(\DateTime::ISO8601));
        $this->assertEquals('2017-02-02', $actual);
    }

    public function testIso8601DateTimeNull(): void {
        $actual = Serialize::iso8601DateTime(null);
        $this->assertEquals(\Twilio\Values::NONE, $actual);
    }

    public function testIso8601DateTimeNone(): void {
        $actual = Serialize::iso8601DateTime(\Twilio\Values::NONE);
        $this->assertEquals(\Twilio\Values::NONE, $actual);
    }

    public function testIso8601DateTimePassString(): void {
        // Backwards compatibility, prior to 5.5.0 date parameters were passed as strings.
        // After 5.5.0 parameters can be DateTime objects or strings.
        $actual = Serialize::iso8601DateTime('2017-02-01T17:15:41Z');
        $this->assertEquals('2017-02-01T17:15:41Z', $actual);
    }

    public function testIso8601DateTimeSameTimezone(): void {
        $date = new \DateTime('2017-02-01T17:15:41', new \DateTimeZone('+0000'));
        $actual = Serialize::iso8601DateTime($date);
        $this->assertEquals('2017-02-01T17:15:41Z', $actual);
    }

    public function testIso8601DateTimeDifferentTimezone(): void {
        $date = new \DateTime('2017-02-01T17:15:41-0800');
        $actual = Serialize::iso8601DateTime($date);
        // assert original date time object is unchanged
        $this->assertEquals('2017-02-01T17:15:41-0800', $date->format(\DateTime::ISO8601));
        $this->assertEquals('2017-02-02T01:15:41Z', $actual);
    }

    public function testBooleanToString(): void {
        $actual = Serialize::booleanToString(True);
        $this->assertEquals('True', $actual);

        $actual = Serialize::booleanToString(False);
        $this->assertEquals('False', $actual);
    }

    public function testBooleanToStringPassThroughSpecialVals(): void {
        $actual = Serialize::booleanToString(null);
        $this->assertEquals(null, $actual);

        // For backwards compatibility
        $actual = Serialize::booleanToString('True');
        $this->assertEquals('True', $actual);
    }

    public function testJsonObjectSerializesArrays(): void {
        $actual = Serialize::jsonObject(['this', 'is', 'a', 'list']);
        $this->assertEquals('["this","is","a","list"]', $actual);

        $actual = Serialize::jsonObject(['twilio' => 'rocks']);
        $this->assertEquals('{"twilio":"rocks"}', $actual);
    }

    public function testJsonObjectPassThroughOtherVals(): void {
        $actual = Serialize::jsonObject('{"already":"serialized"}');
        $this->assertEquals('{"already":"serialized"}', $actual);
    }

    public function testMapAppliesFunctionToArray(): void {
        $actual = Serialize::map([1, 2, 3], static function ($e) {
            return $e * 2;
        });
        $this->assertEquals([2, 4, 6], $actual);
    }

    public function testMapPassThroughOtherVals(): void {
        $actual = Serialize::map('abc', static function ($e) {
            return $e * 2;
        });
        $this->assertEquals('abc', $actual);

        $actual = Serialize::map(Values::NONE, static function ($e) {
            return $e * 2;
        });
        $this->assertEquals(Values::NONE, $actual);

        $actual = Serialize::map(10, static function ($e) {
            return $e * 2;
        });
        $this->assertEquals(10, $actual);
    }
}
