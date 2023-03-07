<?php

namespace Twilio\Rest;

use Twilio\Rest\Lookups\V1;

class Lookups extends  LookupsBase {

    /**
     * @deprecated Use v1->phoneNumbers instead.
     */
    protected function getPhoneNumbers(): \Twilio\Rest\Lookups\V1\PhoneNumberList {
        echo "phoneNumbers is deprecated. Use v1->phoneNumbers instead.";
        return $this->v1->phoneNumbers;
    }

    /**
     * @deprecated Use v1->phoneNumbers(\$phoneNumber) instead.
     * @param string $phoneNumber The phone number to fetch in E.164 format
     */
    protected function contextPhoneNumbers(string $phoneNumber): \Twilio\Rest\Lookups\V1\PhoneNumberContext {
        echo "phoneNumbers(\$phoneNumber) is deprecated. Use v1->phoneNumbers(\$phoneNumber) instead.";
        return $this->v1->phoneNumbers($phoneNumber);
    }
}