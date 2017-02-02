<?php

namespace Twilio;

class Deserialize {

    /**
     * Deserialize a string date into a DateTime object
     *
     * @param string $s A date or date and time, can be iso8601, rfc2822, 
     *                  YYYY-MM-DD format.
     */
    public static function dateTime($s) {
        try {
            return new \DateTime($s, new \DateTimeZone('UTC'));
        } catch (\Exception $e) {
            return $s;
        }
    }

}
