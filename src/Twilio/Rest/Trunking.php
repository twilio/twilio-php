<?php

namespace Twilio\Rest;

use Twilio\Rest\Trunking\V1;
class Trunking extends TrunkingBase {

    /**
     * @deprecated Use v1->trunks instead.
     */
    protected function getTrunks(): \Twilio\Rest\Trunking\V1\TrunkList {
        echo "trunks is deprecated. Use v1->trunks instead.";
        return $this->v1->trunks;
    }

    /**
     * @deprecated Use v1->trunks(\$sid) instead.
     * @param string $sid The unique string that identifies the resource
     */
    protected function contextTrunks(string $sid): \Twilio\Rest\Trunking\V1\TrunkContext {
        echo "trunks(\$sid) is deprecated. Use v1->trunks(\$sid) instead.";
        return $this->v1->trunks($sid);
    }
}