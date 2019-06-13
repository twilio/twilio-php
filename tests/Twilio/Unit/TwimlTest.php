<?php


namespace Twilio\Tests\Unit;


use Twilio\Twiml;

class TwimlTest extends UnitTest {

    public function twiml($body) {
        return '<?xml version="1.0" encoding="UTF-8"?>' . "\n$body\n";
    }

    public function testEmpty() {
        $twiml = new Twiml();
        $actual = (string)$twiml;
        $this->assertTrue(
            ($this->twiml('<Response></Response>') == $actual) ||
            ($this->twiml('<Response/>') == $actual)
        );
    }

    public function testSingle() {
        $twiml = new Twiml();
        $twiml->Example();
        $actual = (string)$twiml;
        $this->assertTrue(
            ($this->twiml('<Response><Example></Example></Response>') == $actual) ||
            ($this->twiml('<Response><Example/></Response>') == $actual)
        );
    }

    public function testSingleWithBody() {
        $twiml = new Twiml();
        $twiml->Example('body');
        $actual = (string)$twiml;
        $this->assertEquals($this->twiml('<Response><Example>body</Example></Response>'), $actual);
    }

    public function testSingleWithAttributes() {
        $twiml = new Twiml();
        $twiml->Example(array('attr1' => 'val1', 'attr2' => 'val2'));
        $actual = (string)$twiml;
        $this->assertTrue(
            ($this->twiml('<Response><Example attr1="val1" attr2="val2"></Example></Response>') == $actual) ||
            ($this->twiml('<Response><Example attr1="val1" attr2="val2"/></Response>') == $actual)
        );
    }

    public function testSingleWithBodyAndAttributes() {
        $twiml = new Twiml();
        $twiml->Example('body', array('attr1' => 'val1', 'attr2' => 'val2'));
        $actual = (string)$twiml;
        $this->assertEquals($this->twiml('<Response><Example attr1="val1" attr2="val2">body</Example></Response>'), $actual);
    }

    public function testNested() {
        $twiml = new Twiml();
        $twiml->Parent()->Child();
        $actual = (string)$twiml;
        $this->assertTrue(
            ($this->twiml('<Response><Parent><Child></Child></Parent></Response>') == $actual) ||
            ($this->twiml('<Response><Parent><Child/></Parent></Response>') == $actual)
        );
    }

    /**
     * This behavior is almost certainly incorrect.  Writing a test case just to
     * capture it and warn if we break backwards compatibility
     */
    public function testNestedWithParentBody() {
        $twiml = new Twiml();
        $twiml->Parent('body')->Child();
        $actual = (string)$twiml;
        $this->assertTrue(
            ($this->twiml('<Response><Parent>body<Child></Child></Parent></Response>') == $actual) ||
            ($this->twiml('<Response><Parent>body<Child/></Parent></Response>') == $actual)
        );
    }

    public function testNestedWithChildBody() {
        $twiml = new Twiml();
        $twiml->Parent()->Child('body');
        $actual = (string)$twiml;
        $this->assertEquals($this->twiml('<Response><Parent><Child>body</Child></Parent></Response>'), $actual);
    }

    /**
     * This behavior is almost certainly incorrect.  Writing a test case just to
     * capture it and warn if we break backwards compatibility
     */
    public function testNestedWithParentAndChildBody() {
        $twiml = new Twiml();
        $twiml->Parent('parent-body')->Child('child-body');
        $actual = (string)$twiml;
        $this->assertEquals($this->twiml('<Response><Parent>parent-body<Child>child-body</Child></Parent></Response>'), $actual);
    }

    public function testNestedWithAttributes() {
        $twiml = new Twiml();
        $twiml->Parent(array('attr1' => 'val1'))->Child(array('attr2' => 'val2'));
        $actual = (string)$twiml;
        $this->assertTrue(
            ($this->twiml('<Response><Parent attr1="val1"><Child attr2="val2"></Child></Parent></Response>') == $actual) ||
            ($this->twiml('<Response><Parent attr1="val1"><Child attr2="val2"/></Parent></Response>') == $actual)
        );
    }

    /**
     * This behavior is almost certainly incorrect.  Writing a test case just to
     * capture it and warn if we break backwards compatibility
     */
    public function testNestedWithAttributesAndParentBody() {
        $twiml = new Twiml();
        $twiml->Parent('body', array('attr1' => 'val1'))->Child(array('attr2' => 'val2'));
        $actual = (string)$twiml;
        $this->assertTrue(
            ($this->twiml('<Response><Parent attr1="val1">body<Child attr2="val2"></Child></Parent></Response>') == $actual) ||
            ($this->twiml('<Response><Parent attr1="val1">body<Child attr2="val2"/></Parent></Response>') == $actual)
        );
    }

    public function testNestedWithAttributesAndChildBody() {
        $twiml = new Twiml();
        $twiml->Parent(array('attr1' => 'val1'))->Child('body', array('attr2' => 'val2'));
        $actual = (string)$twiml;
        $this->assertEquals($this->twiml('<Response><Parent attr1="val1"><Child attr2="val2">body</Child></Parent></Response>'), $actual);
    }

    /**
     * This behavior is almost certainly incorrect.  Writing a test case just to
     * capture it and warn if we break backwards compatibility
     */
    public function testNestedWithAttributesAndParentAndChildBody() {
        $twiml = new Twiml();
        $twiml->Parent('parent-body', array('attr1' => 'val1'))->Child('child-body', array('attr2' => 'val2'));
        $actual = (string)$twiml;
        $this->assertEquals($this->twiml('<Response><Parent attr1="val1">parent-body<Child attr2="val2">child-body</Child></Parent></Response>'), $actual);
    }

    /**
     * @param mixed $value A "Falsey" value that should become the body of the
     *                     Example tag
     * @dataProvider printingFalseyProvider
     */
    public function testPrintingFalseyBody($value) {
        $twiml = new Twiml();
        $twiml->Example($value);
        $actual = (string)$twiml;
        $this->assertEquals($this->twiml('<Response><Example>' . $value . '</Example></Response>'), $actual);
    }

    public function printingFalseyProvider() {
        return array(
            array(0),
            array('0'),
            array('false'),
        );
    }

    /**
     * @param mixed $value A "Falsey" value that should be ignored by the TwiML
     *                     generator
     * @dataProvider silentFalseyProvider
     */
    public function testSilentFalseyBody($value) {
        $twiml = new Twiml();
        $twiml->Example($value);
        $actual = (string)$twiml;
        $this->assertTrue(
            ($this->twiml('<Response><Example></Example></Response>') == $actual) ||
            ($this->twiml('<Response><Example/></Response>') == $actual)
        );
    }

    public function silentFalseyProvider() {
        return array(
            array(''),
            array(false),
            array(null),
            array(array()),
        );
    }
}