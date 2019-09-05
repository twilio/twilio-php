<?php


namespace Twilio;


abstract class Options implements \IteratorAggregate {
    protected $options = array();

    public function getIterator() {
        return new \ArrayIterator($this->options);
    }
}