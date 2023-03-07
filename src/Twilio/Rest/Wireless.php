<?php

namespace Twilio\Rest;

use Twilio\Rest\Wireless\V1;

class Wireless extends WirelessBase {

    /**
     * @deprecated Use v1->usageRecords instead.
     */
    protected function getUsageRecords(): \Twilio\Rest\Wireless\V1\UsageRecordList {
        echo "usageRecords is deprecated. Use v1->usageRecords instead.";
        return $this->v1->usageRecords;
    }

    /**
     * @deprecated Use v1->commands instead.
     */
    protected function getCommands(): \Twilio\Rest\Wireless\V1\CommandList {
        echo "commands is deprecated. Use v1->commands instead.";
        return $this->v1->commands;
    }

    /**
     * @deprecated Use v1->commands(\$sid) instead.
     * @param string $sid The SID that identifies the resource to fetch
     */
    protected function contextCommands(string $sid): \Twilio\Rest\Wireless\V1\CommandContext {
        echo "commands(\$sid) is deprecated. Use v1->commands(\$sid) instead.";
        return $this->v1->commands($sid);
    }

    /**
     * @deprecated  Use v1->ratePlans instead.
     */
    protected function getRatePlans(): \Twilio\Rest\Wireless\V1\RatePlanList {
        echo "ratePlans is deprecated. Use v1->ratePlans instead.";
        return $this->v1->ratePlans;
    }

    /**
     * @deprecated Use v1->ratePlans(\$sid) instead.
     * @param string $sid The SID that identifies the resource to fetch
     */
    protected function contextRatePlans(string $sid): \Twilio\Rest\Wireless\V1\RatePlanContext {
        echo "ratePlans(\$sid) is deprecated. Use v1->ratePlans(\$sid) instead.";
        return $this->v1->ratePlans($sid);
    }

    /**
     * @deprecated Use v1->sims instead.
     */
    protected function getSims(): \Twilio\Rest\Wireless\V1\SimList {
        echo "sims is deprecated. Use v1->sims instead.";
        return $this->v1->sims;
    }

    /**
     * @deprecated Use v1->sims(\$sid) instead.
     * @param string $sid The SID of the Sim resource to fetch
     */
    protected function contextSims(string $sid): \Twilio\Rest\Wireless\V1\SimContext {
        echo "sims(\$sid) is deprecated. Use v1->sims(\$sid) instead.";
        return $this->v1->sims($sid);
    }
}