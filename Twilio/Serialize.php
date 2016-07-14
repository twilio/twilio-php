<?php

namespace Twilio;

class Serialize {

    private static function flatten($map, $result = array(), $previous = array()) {
        foreach ($map as $key => $value) {
            if (is_array($value)) {
                $result = self::flatten($value, $result, array_merge($previous, array($key)));
            } else {
                $result[join(".", array_merge($previous, array($key)))] = $value;
            }
        }

        return $result;
    }

    public static function prefixedCollapsibleMap($map, $prefix) {
        if (is_null($map) || $map == \Twilio\Values::NONE) {
            return array();
        }

        $flattened = self::flatten($map);
        $result = array();
        foreach ($flattened as $key => $value) {
            $result[$prefix . '.' . $key] = $value;
        }

        return $result;
    }

}