<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Preview\Understand\Assistant\Task;

use Twilio\Options;
use Twilio\Values;

/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 */
abstract class TaskActionsOptions {
    /**
     * @param array $actions The JSON actions that instruct the Assistant how to
     *                       perform this task.
     * @return UpdateTaskActionsOptions Options builder
     */
    public static function update(array $actions = Values::ARRAY_NONE): UpdateTaskActionsOptions {
        return new UpdateTaskActionsOptions($actions);
    }
}

class UpdateTaskActionsOptions extends Options {
    /**
     * @param array $actions The JSON actions that instruct the Assistant how to
     *                       perform this task.
     */
    public function __construct(array $actions = Values::ARRAY_NONE) {
        $this->options['actions'] = $actions;
    }

    /**
     * The JSON actions that instruct the Assistant how to perform this task.
     *
     * @param array $actions The JSON actions that instruct the Assistant how to
     *                       perform this task.
     * @return $this Fluent Builder
     */
    public function setActions(array $actions): self {
        $this->options['actions'] = $actions;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        $options = [];
        foreach (Values::of($this->options) as $key => $value) {
                $options[] = "$key=$value";
        }
        return '[Twilio.Preview.Understand.UpdateTaskActionsOptions ' . \implode(' ', $options) . ']';
    }
}