<?php


namespace Twilio;


class VersionInfo {
    const MAJOR = 5;
    const MINOR = 23;
    const PATCH = 1;

    public static function string() {
        return implode('.', array(self::MAJOR, self::MINOR, self::PATCH));
    }
}
