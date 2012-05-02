<?php

/**
 * Exception class for Services_Twilio_Twiml.
 */
class Services_Twilio_TwimlException extends Exception {}

/**
 * Twiml response generator.
 *
 * @category Services
 * @package  Services_Twilio
 * @author   Neuman Vong <neuman at ashmoremusic dot com>
 * @license  http://creativecommons.org/licenses/MIT/ MIT
 * @link     https://gist.github.com/855985
 */
class Services_Twilio_Twiml
{

    protected $element;

    /**
     * Constructs a Twiml response.
     *
     * @param SimpleXmlElement|array $arg:
     *   - the element to wrap
     *   - attributes to add to the element
     *   - if null, initialize an empty element named 'Response'
     */
    public function __construct($arg = null)
    {
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
     * A basic example:
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
     * @param string $verb The Twiml verb.
     * @param array  $args:
     *   - (noun string)
     *   - (noun string, attributes array)
     *   - (attributes array)
     *
     * @return SimpleXmlElement A SimpleXmlElement
     */
    public function __call($verb, array $args)
    {
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
         * So we end up with the following matrix:
         *
         * We want & to turn into &amp; before passing to addChild
         * We want &amp; to stay as &amp; before passing to addChild
         *
         * The following line accomplishes the desired behavior.
         */
        $normalized = htmlentities($noun, null, null, false);
        //then escape it again
        $child = empty($noun)
            ? $this->element->addChild(ucfirst($verb))
            : $this->element->addChild(ucfirst($verb), $normalized);
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
        return new self($child);
    }

    /**
     * Returns the object as XML.
     *
     * @return string The response as an XML string
     */
    public function __toString()
    {
        $xml = $this->element->asXml();
        return str_replace(
            '<?xml version="1.0"?>', 
            '<?xml version="1.0" encoding="UTF-8"?>', $xml);
    }
}
