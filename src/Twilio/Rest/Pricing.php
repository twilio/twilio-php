<?php

namespace Twilio\Rest;

use Twilio\Rest\Pricing\V1;
use Twilio\Rest\Pricing\V2;

class Pricing extends PricingBase {
    /**
     * @deprecated Use v1->messaging instead.
     */
    protected function getMessaging(): \Twilio\Rest\Pricing\V1\MessagingList {
        echo "messaging is deprecated. Use v1->messaging instead.";
        return $this->v1->messaging;
    }

    /**
     * @deprecated Use v1->phoneNumbers instead.
     */
    protected function getPhoneNumbers(): \Twilio\Rest\Pricing\V1\PhoneNumberList {
        echo "phoneNumbers is deprecated. Use v1->phoneNumbers instead.";
        return $this->v1->phoneNumbers;
    }

    /**
     * @deprecated Use v2->voice instead.
     */
    protected function getVoice(): \Twilio\Rest\Pricing\V2\VoiceList {
        echo "voice is deprecated. Use v2->voice instead.";
        return $this->v2->voice;
    }

    /**
     * @deprecated Use v2->countries instead.
     */
    protected function getCountries(): \Twilio\Rest\Pricing\V2\CountryList {
        echo "countries is deprecated. Use v2->countries instead.";
        return $this->v2->countries;
    }

    /**
     * @deprecated Use v2->countries(\$isoCountry) instead.
     * @param string $isoCountry The ISO country code of the pricing information to
     *                           fetch
     */
    protected function contextCountries(string $isoCountry): \Twilio\Rest\Pricing\V2\CountryContext {
        echo "countries(\$isoCountry) is deprecated. Use v2->countries(\$isoCountry) instead.";
        return $this->v2->countries($isoCountry);
    }

    /**
     * @deprecated Use v2->numbers instead.
     */
    protected function getNumbers(): \Twilio\Rest\Pricing\V2\NumberList {
        echo "numbers is deprecated. Use v2->numbers instead.";
        return $this->v2->numbers;
    }

    /**
     * @deprecated Use v2->numbers(\$destinationNumber) instead.
     * @param string $destinationNumber The destination number for which to fetch
     *                                  pricing information
     */
    protected function contextNumbers(string $destinationNumber): \Twilio\Rest\Pricing\V2\NumberContext {
        echo "numbers(\$destinationNumber) is deprecated. Use v2->numbers(\$destinationNumber) instead.";
        return $this->v2->numbers($destinationNumber);
    }
}