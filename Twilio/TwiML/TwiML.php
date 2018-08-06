<?php

namespace Twilio\TwiML;

use DOMDocument;
use DOMElement;

/**
 * @property $name string XML element name
 * @property $attributes array XML attributes
 * @property $value string XML body
 * @property $children TwiML[] nested TwiML elements
 */
abstract class TwiML {
    protected $name;
    protected $attributes;
    protected $children;

    /**
     * TwiML constructor.
     *
     * @param string $name XML element name
     * @param string $value XML value
     * @param array $attributes XML attributes
     */
    public function __construct($name, $value = null, $attributes = []) {
        $this->name = $name;
        $this->attributes = $attributes;
        $this->children = [];

        if ($value !== null) {
        	$this->children[] = $value;
		}
    }

    /**
     * Add a TwiML element.
     *
     * @param TwiML|string $twiml TwiML element to add
     * @return TwiML $this
     */
    public function append($twiml) {
        $this->children[] = $twiml;
        return $this;
    }

    /**
     * Add a TwiML element.
     *
     * @param TwiML $twiml TwiML element to add
     * @return TwiML added TwiML element
     */
    public function nest($twiml) {
        $this->children[] = $twiml;
        return $twiml;
    }

    /**
     * Set TwiML attribute.
     *
     * @param string $key name of attribute
     * @param string $value value of attribute
     * @return TwiML $this
     */
    public function setAttribute($key, $value) {
        $this->attributes[$key] = $value;
        return $this;
    }

	/**
	 * @param string $name XML element name
	 * @param string $value XML value
	 * @param array $attributes XML attributes
	 */
	public function addChild($name, $value = null, $attributes = []) {
		return $this->nest(new GenericNode($name, $value, $attributes));
	}

    /**
     * Convert TwiML to XML string.
     *
     * @return string TwiML XML representation
     */
    public function asXML() {
        return $this->__toString();
    }

    /**
     * Convert TwiML to XML string.
     *
     * @return string TwiML XML representation
     */
    public function __toString() {
        return $this->xml()->saveXML();
    }

    /**
     * Build TwiML element.
     *
     * @param TwiML $twiml TwiML element to convert to XML
     * @param DOMDocument $document XML document for the element
     * @return DOMElement $element
     */
    private function buildElement($twiml, $document) {
    	$element = $document->createElement($twiml->name);

        foreach ($twiml->attributes as $name => $value) {
            if (is_bool($value)) {
                $value = ($value === true) ? 'true' : 'false';
            }
            $element->setAttribute($name, $value);
        }

        foreach ($twiml->children as $child) {
			if (is_string($child)) {
				$element->appendChild($document->createTextNode($child));
			} else {
				$element->appendChild($this->buildElement($child, $document));
			}
		}

        return $element;
    }

    /**
     * Build XML element.
     *
     * @return DOMDocument Build TwiML element
     */
    private function xml() {
    	$document = new DOMDocument('1.0', 'UTF-8');
    	$document->appendChild($this->buildElement($this, $document));
    	return $document;
    }

}
