<?php

namespace Twilio;

class Deserialize {

    public static function iso8601DateTime($s) {
        try {
            return new \DateTime($s, new \DateTimeZone('UTC'));
        } catch (\Exception $e) {
            return $s;
        }
    }

}