<?php


namespace Twilio;


class VersionInfo {
    const MAJOR = 5;
    const MINOR = 38;
    const PATCH = 0;

    public static function string() {
        return implode('.', array(self::MAJOR, self::MINOR, self::PATCH));
    }
}
