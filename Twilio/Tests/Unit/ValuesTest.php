<?php


namespace Twilio\Tests\Unit;


use Twilio\Values;

class ValuesTest extends UnitTest {

    public function testDirectKeyAccess() {
        $values = new Values(array(
            'a' => 1,
            'b' => 2,
            'c' => 3,
        ));

        $this->assertEquals(1, $values['a']);
        $this->assertEquals(2, $values['b']);
        $this->assertEquals(3, $values['c']);
    }

    public function testCaseInsensitiveAccess() {
        $values = new Values(array(
            'lowercase' => 1,
            'UPPERCASE' => 2,
            'MixedCase' => 3,
        ));

        $this->assertEquals(1, $values['lowercase']);
        $this->assertEquals(1, $values['LOWERCASE']);
        $this->assertEquals(1, $values['LowerCase']);

        $this->assertEquals(2, $values['uppercase']);
        $this->assertEquals(2, $values['UPPERCASE']);
        $this->assertEquals(2, $values['UpperCase']);

        $this->assertEquals(3, $values['mixedcase']);
        $this->assertEquals(3, $values['MIXEDCASE']);
        $this->assertEquals(3, $values['MixedCase']);
    }

    public function testUnknownKeySentinel() {
        $values = new Values(array(
            'known' => 1,
        ));

        $this->assertEquals(1, $values['known']);
        $this->assertEquals(Values::NONE, $values['unknown']);
    }

    public function testUnknownValuesRemoved() {
        $values = new Values(array(
            'known' => 1,
        ));

        $data = Values::of(array(
            'Known' => $values['known'],
            'Unknown' => $values['unknown'],
        ));

        $this->assertEquals(array('Known' => 1), $data);
    }
}