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

    public static function iso8601Date($dateTime) {
        if (is_null($dateTime) || $dateTime == \Twilio\Values::NONE) {
            return \Twilio\Values::NONE;
        }

        if (is_string($dateTime)) {
            return $dateTime;
        }

        $utcDate = clone $dateTime;
        $utcDate->setTimezone(new \DateTimeZone('UTC'));
        return $utcDate->format('Y-m-d');
    }

    public static function iso8601DateTime($dateTime) {
        if (is_null($dateTime) || $dateTime == \Twilio\Values::NONE) {
            return \Twilio\Values::NONE;
        }

        if (is_string($dateTime)) {
            return $dateTime;
        }

        $utcDate = clone $dateTime;
        $utcDate->setTimezone(new \DateTimeZone('UTC'));
        return $utcDate->format('Y-m-d\TH:i:s\Z');
    }

    public static function booleanToString($boolOrStr) {
        if (is_null($boolOrStr) || is_string($boolOrStr)) {
            return $boolOrStr;
        }

        return $boolOrStr ? 'True' : 'False';
    }

    public static function json_object($object) {
        if (is_array($object)) {
            return json_encode($object);
        }
        return $object;
    }

}
