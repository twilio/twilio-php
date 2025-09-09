<?php

namespace Twilio;

use Twilio\Base\PhoneNumberCapabilities;

class Deserialize
{

    /**
     * Deserialize a string date into a DateTime object
     *
     * @param ?string $s A date or date and time, can be iso8601, rfc2822,
     *                  YYYY-MM-DD format.
     * @return \DateTime|string DateTime corresponding to the input string, in UTC time.
     */
    public static function dateTime(?string $s)
    {
        try {
            if ($s) {
                return new \DateTime($s, new \DateTimeZone('UTC'));
            }
        } catch (\Exception $e) {
            // no-op
        }

        return $s;
    }

    /**
     * Deserialize an array into a PhoneNumberCapabilities object
     *
     * @param array|null $arr An array
     * @return PhoneNumberCapabilities|array PhoneNumberCapabilities object corresponding to the input array.
     */
    public static function phoneNumberCapabilities(?array $arr)
    {
        try {
            if ($arr) {
                $required = ["mms", "sms", "voice", "fax"];
                if (count(array_intersect($required, array_keys($arr))) > 0) {
                    return new PhoneNumberCapabilities($arr);
                }
            }
        } catch (\Exception $e) {
            // no-op
        }

        return $arr;
    }
}
