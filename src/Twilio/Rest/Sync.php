<?php

namespace Twilio\Rest;

use Twilio\Rest\Sync\V1;
class Sync extends SyncBase {
    /**
     * @deprecated Use v1->services instead.
     */
    protected function getServices(): \Twilio\Rest\Sync\V1\ServiceList {
        echo "services is deprecated. Use v1->services instead.";
        return $this->v1->services;
    }

    /**
     * @deprecated Use v1->services(\$sid) instead.
     * @param string $sid The SID of the Service resource to fetch
     */
    protected function contextServices(string $sid): \Twilio\Rest\Sync\V1\ServiceContext {
        echo "services(\$sid) is deprecated. Use v1->services(\$sid) instead.";
        return $this->v1->services($sid);
    }
}