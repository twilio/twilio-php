<?php


namespace Twilio\Tests\Unit;


use Twilio\Values;

class ValuesTest extends UnitTest {

    public function testDirectKeyAccess(): void {
        $values = new Values([
            'a' => 1,
            'b' => 2,
            'c' => 3,
        ]);

        $this->assertEquals(1, $values['a']);
        $this->assertEquals(2, $values['b']);
        $this->assertEquals(3, $values['c']);
    }

    public function testCaseInsensitiveAccess(): void {
        $values = new Values([
            'lowercase' => 1,
            'UPPERCASE' => 2,
            'MixedCase' => 3,
        ]);

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

    public function testUnknownKeySentinel(): void {
        $values = new Values([
            'known' => 1,
        ]);

        $this->assertEquals(1, $values['known']);
        $this->assertEquals(Values::NONE, $values['unknown']);
    }

    public function testUnknownValuesRemoved(): void {
        $values = new Values([
            'known' => 1,
        ]);

        $data = Values::of([
            'Known' => $values['known'],
            'Unknown' => $values['unknown'],
        ]);

        $this->assertEquals(['Known' => 1], $data);
    }

    public function testArrayValues(): void {
        $values = new Values([
            'a' => [1],
        ]);

        $data = Values::of([
            'a' => $values['a'],
            'b' => Values::ARRAY_NONE,
        ]);

        $this->assertEquals(['a' => [1]], $data);
    }
}
