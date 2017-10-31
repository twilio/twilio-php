<?php

namespace Twilio\TaskRouter;

/**
 * Twilio TaskRouter Workflow Rule
 *
 * @author Justin Witz <jwitz@twilio.com>
 * @license  http://creativecommons.org/licenses/MIT/ MIT
 */
class WorkflowRule implements \JsonSerializable {
    public $expression;
    public $friendly_name;
    public $targets;

    public function __construct($expression, $targets, $friendly_name = null)
    {
        $this->expression = $expression;
        $this->targets = $targets;
        $this->friendly_name = $friendly_name;
    }

    public function jsonSerialize() {
        $json = array();
        $json["expression"] = $this->expression;
        $json["targets"] = $this->targets;
        if($this->friendly_name != null) {
            $json["friendly_name"] = $this->friendly_name;
        }
        return $json;
    }
}