<?php


namespace Twilio;


class VersionInfo {
    const MAJOR = "8";
    const MINOR = "3";
    const PATCH = "15";

    public static function string() {
        return implode('.', array(self::MAJOR, self::MINOR, self::PATCH));
    }
}
