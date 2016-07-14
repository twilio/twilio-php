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

}
