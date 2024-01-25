<?php


namespace Twilio;


class VersionInfo {
    const MAJOR = "7";
    const MINOR = "14";
    const PATCH = "0";

    public static function string() {
        return implode('.', array(self::MAJOR, self::MINOR, self::PATCH));
    }
}
