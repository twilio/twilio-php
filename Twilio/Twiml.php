<?php

namespace Twilio;

use Twilio\Exceptions\TwimlException;

/**
 * Twiml response generator.
 */
class Twiml {

    protected $element;

    /**
     * Constructs a Twiml response.
     *
     * @param \SimpleXmlElement|array $arg
     * @throws TwimlException
     * :param SimpleXmlElement|array $arg: Can be any of
     *
     *   - the element to wrap
     *   - attributes to add to the element
     *   - if null, initialize an empty element named 'Response'
     */
    public function __construct($arg = null) {
        switch (true) {
            case $arg instanceof \SimpleXMLElement:
                $this->element = $arg;
                break;
            case $arg === null:
                $this->element = new \SimpleXMLElement('<Response/>');
                break;
            case is_array($arg):
                $this->element = new \SimpleXMLElement('<Response/>');
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
     * A basic example:
     *
     * .. code-block:: php
     *
     *     php> print $this->say('hello');
     *     <Say>hello</Say>
     *
     * An example with attributes:
     *
     * .. code-block:: php
     *
     *     print $this->say('hello', array('voice' => 'woman'));
     *     <Say voice="woman">hello</Say>
     *
     * You could even just pass in an attributes array, omitting the noun:
     *
     * .. code-block:: php
     *
     *     print $this->gather(array('timeout' => '20'));
     *     <Gather timeout="20"/>
     *
     * @param string $verb The Twiml verb.
     * @param mixed[] $args
     * @return self
     * :param string $verb: The Twiml verb.
     * :param array  $args:
     *   - (noun string)
     *   - (noun string, attributes array)
     *   - (attributes array)
     *
     * :return: A SimpleXmlElement
     * :rtype: SimpleXmlElement
     */
    public function __call($verb, array $args) {
        list($noun, $attrs) = $args + array('', array());
        if (is_array($noun)) {
            list($attrs, $noun) = array($noun, '');
        }
        /* addChild does not escape XML, while addAttribute does. This means if
         * you pass unescaped ampersands ("&") to addChild, you will generate
         * an error.
         *
         * Some inexperienced developers will pass in unescaped ampersands, and
         * we want to make their code work, by escaping the ampersands for them
         * before passing the string to addChild. (with htmlentities)
         *
         * However other people will know what to do, and their code
         * already escapes ampersands before passing them to addChild. We don't
         * want to break their existing code by turning their &amp;'s into
         * &amp;amp;
         *
         * We also want to use numeric entities, not named entities so that we
         * are fully compatible with XML
         *
         * The following lines accomplish the desired behavior.
         */
        $decoded = html_entity_decode($noun, ENT_COMPAT, 'UTF-8');
        $normalized = htmlspecialchars($decoded, ENT_COMPAT, 'UTF-8', false);
        $hasNoun = is_scalar($noun) && strlen($noun);
        $child = $hasNoun
               ? $this->element->addChild(ucfirst($verb), $normalized)
               : $this->element->addChild(ucfirst($verb));

        if (is_array($attrs)) {
            foreach ($attrs as $name => $value) {
                /* Note that addAttribute escapes raw ampersands by default, so we
                 * haven't touched its implementation. So this is the matrix for
                 * addAttribute:
                 *
                 * & turns into &amp;
                 * &amp; turns into &amp;amp;
                 */
                if (is_bool($value)) {
                    $value = ($value === true) ? 'true' : 'false';
                }
                $child->addAttribute($name, $value);
            }
        }
        return new static($child);
    }

    /**
     * Returns the object as XML.
     *
     * :return: The response as an XML string
     * :rtype: string
     */
    public function __toString() {
        $xml = $this->element->asXML();
        return (string)str_replace(
            '<?xml version="1.0"?>',
            '<?xml version="1.0" encoding="UTF-8"?>', $xml);
    }
}
