<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Taskrouter\V1\Workspace\Worker;

use Twilio\Options;
use Twilio\Values;

abstract class WorkerStatisticsOptions {
    /**
     * @param int $minutes Only calculate statistics since this many minutes in the
     *                     past
     * @param \DateTime $startDate Only calculate statistics from on or after this
     *                             date
     * @param \DateTime $endDate Only include usage that occurred on or before this
     *                           date
     * @param string $taskChannel Only calculate statistics on this TaskChannel
     * @return FetchWorkerStatisticsOptions Options builder
     */
    public static function fetch($minutes = Values::NONE, $startDate = Values::NONE, $endDate = Values::NONE, $taskChannel = Values::NONE): FetchWorkerStatisticsOptions {
        return new FetchWorkerStatisticsOptions($minutes, $startDate, $endDate, $taskChannel);
    }
}

class FetchWorkerStatisticsOptions extends Options {
    /**
     * @param int $minutes Only calculate statistics since this many minutes in the
     *                     past
     * @param \DateTime $startDate Only calculate statistics from on or after this
     *                             date
     * @param \DateTime $endDate Only include usage that occurred on or before this
     *                           date
     * @param string $taskChannel Only calculate statistics on this TaskChannel
     */
    public function __construct($minutes = Values::NONE, $startDate = Values::NONE, $endDate = Values::NONE, $taskChannel = Values::NONE) {
        $this->options['minutes'] = $minutes;
        $this->options['startDate'] = $startDate;
        $this->options['endDate'] = $endDate;
        $this->options['taskChannel'] = $taskChannel;
    }

    /**
     * Only calculate statistics since this many minutes in the past. The default 15 minutes. This is helpful for displaying statistics for the last 15 minutes, 240 minutes (4 hours), and 480 minutes (8 hours) to see trends.
     *
     * @param int $minutes Only calculate statistics since this many minutes in the
     *                     past
     * @return $this Fluent Builder
     */
    public function setMinutes($minutes): self {
        $this->options['minutes'] = $minutes;
        return $this;
    }

    /**
     * Only calculate statistics from this date and time and later, specified in [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) format.
     *
     * @param \DateTime $startDate Only calculate statistics from on or after this
     *                             date
     * @return $this Fluent Builder
     */
    public function setStartDate($startDate): self {
        $this->options['startDate'] = $startDate;
        return $this;
    }

    /**
     * Only include usage that occurred on or before this date, specified in GMT as an [ISO 8601](https://en.wikipedia.org/wiki/ISO_8601) date-time.
     *
     * @param \DateTime $endDate Only include usage that occurred on or before this
     *                           date
     * @return $this Fluent Builder
     */
    public function setEndDate($endDate): self {
        $this->options['endDate'] = $endDate;
        return $this;
    }

    /**
     * Only calculate statistics on this TaskChannel. Can be the TaskChannel's SID or its `unique_name`, such as `voice`, `sms`, or `default`.
     *
     * @param string $taskChannel Only calculate statistics on this TaskChannel
     * @return $this Fluent Builder
     */
    public function setTaskChannel($taskChannel): self {
        $this->options['taskChannel'] = $taskChannel;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        $options = []];
        foreach ($this->options as $key => $value) {
            if ($value !== Values::NONE) {
                $options[] = "$key=$value";
            }
        }
        return '[Twilio.Taskrouter.V1.FetchWorkerStatisticsOptions ' . \implode(' ', $options) . ']';
    }
}