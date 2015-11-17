<?php


namespace Twilio;


class Values {
    const NONE = 'Twilio\\Values\\NONE';

    public static function of($array) {
        $result = array();
        foreach ($array as $key => $value) {
            if ($value == self::NONE) {
                continue;
            }
            $result[$key] = $value;
        }
        return $result;
    }
}