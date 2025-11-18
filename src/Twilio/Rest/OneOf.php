<?php

namespace Twilio\Rest;

use Twilio\Rest\OneOf\V1;

class OneOf extends OneOfBase {
    /**
     * @deprecated Use v1->oneOf instead.
     */
    protected function getPets(): \Twilio\Rest\OneOf\V1\PetList {
        echo "oneOf is deprecated. Use v1->oneOf instead.";
        return $this->v1->pets;
    }
}
