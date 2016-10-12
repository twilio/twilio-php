<?php


namespace Twilio;


class TwilioCollection {
    protected $items;

    public function __construct(Array $collection) {
        $this->items    = $collection;
    }

    public function toArray()
    {
        $collection = array();
        foreach($this->items as $item) {
            if ($item instanceof InstanceResource) {
                array_push($collection, $item->toArray());
            } else {
                array_push($collection, $item);
            }
        }

        return $collection;
    }

    public function __toString() {
        return '[TwilioCollection]';
    }
}
