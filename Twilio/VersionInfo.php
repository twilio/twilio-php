<?php


namespace Twilio;


class VersionInfo {
    const MAJOR = 5;
    const MINOR = 19;
    const PATCH = 2;

    public static function string() {
        return implode('.', array(self::MAJOR, self::MINOR, self::PATCH));
    }
}
