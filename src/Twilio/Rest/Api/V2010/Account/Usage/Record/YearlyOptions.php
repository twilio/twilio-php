<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Api\V2010\Account\Usage\Record;

use Twilio\Options;
use Twilio\Values;

abstract class YearlyOptions {
    /**
     * @param string $category The usage category of the UsageRecord resources to
     *                         read
     * @param \DateTime $startDate Only include usage that has occurred on or after
     *                             this date
     * @param \DateTime $endDate Only include usage that occurred on or before this
     *                           date
     * @param bool $includeSubaccounts Whether to include usage from the master
     *                                 account and all its subaccounts
     * @return ReadYearlyOptions Options builder
     */
    public static function read(string $category = Values::NONE, \DateTime $startDate = Values::NONE, \DateTime $endDate = Values::NONE, bool $includeSubaccounts = Values::NONE): ReadYearlyOptions {
        return new ReadYearlyOptions($category, $startDate, $endDate, $includeSubaccounts);
    }
}

class ReadYearlyOptions extends Options {
    /**
     * @param string $category The usage category of the UsageRecord resources to
     *                         read
     * @param \DateTime $startDate Only include usage that has occurred on or after
     *                             this date
     * @param \DateTime $endDate Only include usage that occurred on or before this
     *                           date
     * @param bool $includeSubaccounts Whether to include usage from the master
     *                                 account and all its subaccounts
     */
    public function __construct(string $category = Values::NONE, \DateTime $startDate = Values::NONE, \DateTime $endDate = Values::NONE, bool $includeSubaccounts = Values::NONE) {
        $this->options['category'] = $category;
        $this->options['startDate'] = $startDate;
        $this->options['endDate'] = $endDate;
        $this->options['includeSubaccounts'] = $includeSubaccounts;
    }

    /**
     * The [usage category](https://www.twilio.com/docs/usage/api/usage-record#usage-categories) of the UsageRecord resources to read. Only UsageRecord resources in the specified category are retrieved.
     *
     * @param string $category The usage category of the UsageRecord resources to
     *                         read
     * @return $this Fluent Builder
     */
    public function setCategory(string $category): self {
        $this->options['category'] = $category;
        return $this;
    }

    /**
     * Only include usage that has occurred on or after this date. Specify the date in GMT and format as `YYYY-MM-DD`. You can also specify offsets from the current date, such as: `-30days`, which will set the start date to be 30 days before the current date.
     *
     * @param \DateTime $startDate Only include usage that has occurred on or after
     *                             this date
     * @return $this Fluent Builder
     */
    public function setStartDate(\DateTime $startDate): self {
        $this->options['startDate'] = $startDate;
        return $this;
    }

    /**
     * Only include usage that occurred on or before this date. Specify the date in GMT and format as `YYYY-MM-DD`.  You can also specify offsets from the current date, such as: `+30days`, which will set the end date to 30 days from the current date.
     *
     * @param \DateTime $endDate Only include usage that occurred on or before this
     *                           date
     * @return $this Fluent Builder
     */
    public function setEndDate(\DateTime $endDate): self {
        $this->options['endDate'] = $endDate;
        return $this;
    }

    /**
     * Whether to include usage from the master account and all its subaccounts. Can be: `true` (the default) to include usage from the master account and all subaccounts or `false` to retrieve usage from only the specified account.
     *
     * @param bool $includeSubaccounts Whether to include usage from the master
     *                                 account and all its subaccounts
     * @return $this Fluent Builder
     */
    public function setIncludeSubaccounts(bool $includeSubaccounts): self {
        $this->options['includeSubaccounts'] = $includeSubaccounts;
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
        return '[Twilio.Api.V2010.ReadYearlyOptions ' . \implode(' ', $options) . ']';
    }
}