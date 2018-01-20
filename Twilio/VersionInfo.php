<?php


namespace Twilio;


class VersionInfo {
    const MAJOR = 5;
    const MINOR = 16;
    const PATCH = 3;

    public static function string() {
        return implode('.', array(self::MAJOR, self::MINOR, self::PATCH));
    }
}
