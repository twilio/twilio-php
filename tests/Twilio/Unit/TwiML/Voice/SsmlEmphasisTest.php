<?php

namespace Twilio\Tests\Unit\TwiML\Voice;

use Twilio\Tests\Unit\TwiML\TwiMLTest;
use Twilio\TwiML\Voice\SsmlEmphasis;

class SsmlEmphasisTest extends TwiMLTest {

    private $ssmlEmphasis;

    protected function setUp(): void {
        $this->ssmlEmphasis = new SsmlEmphasis("");
    }

    public function testAddBreak(): void {
        $this->ssmlEmphasis->break_(array('key'=>'value'));
        $this->compareXml('<emphasis><break key="value"/></emphasis>', $this->ssmlEmphasis);
    }

    public function testAddEmphasis(): void {
        $this->ssmlEmphasis->emphasis("test");
        $this->compareXml('<emphasis><emphasis>test</emphasis></emphasis>', $this->ssmlEmphasis);
    }

    public function testAddLang(): void {
        $this->ssmlEmphasis->lang("word",array('key'=>'value'));
        $this->compareXml('<emphasis><lang key="value">word</lang></emphasis>', $this->ssmlEmphasis);
    }

    public function testAddPhoneme(): void {
        $this->ssmlEmphasis->phoneme("phoneme",array('key'=>'value'));
        $this->compareXml('<emphasis><phoneme key="value">phoneme</phoneme></emphasis>', $this->ssmlEmphasis);
    }

    public function testAddProsody(): void {
        $this->ssmlEmphasis->prosody("prosody",array('key'=>'value'));
        $this->compareXml('<emphasis><prosody key="value">prosody</prosody></emphasis>', $this->ssmlEmphasis);
    }

    public function testAddSayAs(): void {
        $this->ssmlEmphasis->say_As("sayAs",array('key'=>'value'));
        $this->compareXml('<emphasis><say-as key="value">sayAs</say-as></emphasis>', $this->ssmlEmphasis);
    }

    public function testAddSub(): void {
        $this->ssmlEmphasis->sub("sub",array('key'=>'value'));
        $this->compareXml('<emphasis><sub key="value">sub</sub></emphasis>', $this->ssmlEmphasis);
    }

    public function testAddW(): void {
        $this->ssmlEmphasis->w("w",array('key'=>'value'));
        $this->compareXml('<emphasis><w key="value">w</w></emphasis>', $this->ssmlEmphasis);
    }

    public function testSetLevel(): void {
        $this->ssmlEmphasis->setLevel("test");
        $this->compareXml('<emphasis level="test"></emphasis>', $this->ssmlEmphasis);
    }
}
