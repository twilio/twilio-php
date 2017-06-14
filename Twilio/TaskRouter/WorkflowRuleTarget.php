<?php

namespace Twilio\TaskRouter;

/**
 * Twilio TaskRouter Workflow Rule Target
 *
 * @author Justin Witz <jwitz@twilio.com>
 * @license  http://creativecommons.org/licenses/MIT/ MIT
 */
class WorkflowRuleTarget implements JsonSerializable {
    public $queue;
    public $expression;
    public $priority;
    public $timeout;

    public function __construct($queue, $priority = null, $timeout = null, $expression = null)
    {
        $this->queue = $queue;
        $this->priority = $priority;
        $this->timeout = $timeout;
        $this->expression = $expression;
    }

    public function jsonSerialize() {
        $json = array();
        $json["queue"] = $this->queue;
        if($this->priority != null) {
            $json["priority"] = $this->priority;
        }
        if($this->timeout != null) {
            $json["timeout"] = $this->timeout;
        }
        if($this->expression != null) {
            $json["expression"] = $this->expression;
        }
        return $json;
    }
}