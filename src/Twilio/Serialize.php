<?php

namespace Twilio;

class Serialize {

    private static function flatten(array $map, array $result = [], array $previous = []): array {
        foreach ($map as $key => $value) {
            if (\is_array($value)) {
                $result = self::flatten($value, $result, \array_merge($previous, [$key]));
            } else {
                $result[\implode('.', \array_merge($previous, [$key]))] = $value;
            }
        }

        return $result;
    }

    public static function prefixedCollapsibleMap($map, string $prefix): array {
        if ($map === null || $map === Values::NONE) {
            return [];
        }

        $flattened = self::flatten($map);
        $result = [];
        foreach ($flattened as $key => $value) {
            $result[$prefix . '.' . $key] = $value;
        }

        return $result;
    }

    public static function iso8601Date($dateTime): string {
        if ($dateTime === null || $dateTime === Values::NONE) {
            return Values::NONE;
        }

        if (\is_string($dateTime)) {
            return $dateTime;
        }

        $utcDate = clone $dateTime;
        $utcDate->setTimezone(new \DateTimeZone('+0000'));
        return $utcDate->format('Y-m-d');
    }

    public static function iso8601DateTime($dateTime): string {
        if ($dateTime === null || $dateTime === Values::NONE) {
            return Values::NONE;
        }

        if (\is_string($dateTime)) {
            return $dateTime;
        }

        $utcDate = clone $dateTime;
        $utcDate->setTimezone(new \DateTimeZone('+0000'));
        return $utcDate->format('Y-m-d\TH:i:s\Z');
    }

    public static function booleanToString($boolOrStr) {
        if ($boolOrStr === null || \is_string($boolOrStr)) {
            return $boolOrStr;
        }

        return $boolOrStr ? 'true' : 'false';
    }

    public static function jsonObject($object) {
        if (\is_array($object)) {
            return \json_encode($object);
        }
        return $object;
    }

    public static function map($values, $map_func) {
        if (!\is_array($values)) {
            return $values;
        }
        return \array_map($map_func, $values);
    }

}
