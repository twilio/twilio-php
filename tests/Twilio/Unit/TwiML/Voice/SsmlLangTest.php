<?php

namespace Twilio\Tests\Unit\TwiML\Voice;

use Twilio\Tests\Unit\TwiML\TwiMLTest;
use Twilio\TwiML\Voice\SsmlLang;

class SsmlLangTest extends TwiMLTest {

    private $ssmlLang;

    protected function setUp(): void {
        $this->ssmlLang = new SsmlLang("");
    }

    public function testAddBreak(): void {
        $this->ssmlLang->break_(array('key'=>'value'));
        $this->compareXml('<lang><break key="value"/></lang>', $this->ssmlLang);
    }

    public function testAddEmphasis(): void {
        $this->ssmlLang->emphasis("test");
        $this->compareXml('<lang><emphasis>test</emphasis></lang>', $this->ssmlLang);
    }

    public function testAddLang(): void {
        $this->ssmlLang->lang("word",array('key'=>'value'));
        $this->compareXml('<lang><lang key="value">word</lang></lang>', $this->ssmlLang);
    }

    public function testAddP(): void {
        $this->ssmlLang->p("word");
        $this->compareXml('<lang><p>word</p></lang>', $this->ssmlLang);
    }

    public function testAddPhoneme(): void {
        $this->ssmlLang->phoneme("phoneme",array('key'=>'value'));
        $this->compareXml('<lang><phoneme key="value">phoneme</phoneme></lang>', $this->ssmlLang);
    }

    public function testAddProsody(): void {
        $this->ssmlLang->prosody("prosody",array('key'=>'value'));
        $this->compareXml('<lang><prosody key="value">prosody</prosody></lang>', $this->ssmlLang);
    }

    public function testAddS(): void {
        $this->ssmlLang->S("word");
        $this->compareXml('<lang><s>word</s></lang>', $this->ssmlLang);
    }

    public function testAddSayAs(): void {
        $this->ssmlLang->say_As("sayAs",array('key'=>'value'));
        $this->compareXml('<lang><say-as key="value">sayAs</say-as></lang>', $this->ssmlLang);
    }

    public function testAddSub(): void {
        $this->ssmlLang->sub("sub",array('key'=>'value'));
        $this->compareXml('<lang><sub key="value">sub</sub></lang>', $this->ssmlLang);
    }

    public function testAddW(): void {
        $this->ssmlLang->w("w",array('key'=>'value'));
        $this->compareXml('<lang><w key="value">w</w></lang>', $this->ssmlLang);
    }

    public function testSetXmlLang(): void {
        $this->ssmlLang->setXmlLang("test");
        $this->compareXml('<lang xml:Lang="test"></lang>', $this->ssmlLang);
    }
}
