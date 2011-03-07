<?php
/**
 * Twiml response generator from https://gist.github.com/855985.
 * Copyright 2011, Neuman Vong. BSD License.
 */

class Services_Twilio_TwimlException extends Exception {}

class Services_Twilio_Twiml {

  protected $element;

  /**
   * Constructs a Twiml response.
   *
   * @param arg:
   *   - SimpleXmlElement The element to wrap
   *   - array An array of attributes to add to the element
   *   - null Initialize an empty element named 'Response'
   */
  public function __construct($arg = null) {
    switch (true) {
    case $arg instanceof SimpleXmlElement:
      $this->element = $arg;
      break;
    case $arg === null:
      $this->element = new SimpleXmlElement('<Response/>');
      break;
    case is_array($arg):
      $this->element = new SimpleXmlElement('<Response/>');
      foreach ($arg as $name => $value) {
        $this->element->addAttribute($name, $value);
      }
      break;
    default:
      throw new TwimlException('Invalid argument');
    }
  }

  /**
   * Converts method calls into Twiml verbs.
   *
   * An basic example:
   *
   *     php> print $this->say('hello');
   *     <Say>hello</Say>
   *
   * An example with attributes:
   *
   *     php> print $this->say('hello', array('voice' => 'woman'));
   *     <Say voice="woman">hello</Say>
   *
   * You could even just pass in an attributes array, omitting the noun:
   *
   *     php> print $this->gather(array('timeout' => '20'));
   *     <Gather timeout="20"/>
   *
   * @param verb string The Twiml verb.
   * @param args array:
   *   - (noun string)
   *   - (noun string, attributes array)
   *   - (attributes array)
   */
  public function __call($verb, array $args) {
    list($noun, $attrs) = $args + array('', array());
    if (is_array($noun)) {
      list($attrs, $noun) = array($noun, '');
    }
    $child = empty($noun)
      ? $this->element->addChild(ucfirst($verb))
      : $this->element->addChild(ucfirst($verb), $noun);
    foreach ($attrs as $name => $value) {
      $child->addAttribute($name, $value);
    }
    return new self($child);
  }

  /**
   * Returns the object as XML.
   */
  public function __toString() {
    return $this->element->asXml();
  }
}
