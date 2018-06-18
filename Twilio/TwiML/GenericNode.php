<?php

namespace Twilio\TwiML;

class GenericNode extends TwiML {

	/**
	 * GenericNode constructor.
	 *
	 * @param string $name XML element name
	 * @param string $value XML value
	 * @param array $attributes XML attributes
	 */
	public function __construct($name, $value, $attributes) {
		parent::__construct($name, $value, $attributes);
		$this->name = $name;
		$this->value = $value;
	}}
