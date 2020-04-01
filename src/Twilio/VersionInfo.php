<?php


namespace Twilio;


class VersionInfo {
    const MAJOR = 6;
    const MINOR = 2;
    const PATCH = 0;

    public static function string() {
        return implode('.', array(self::MAJOR, self::MINOR, self::PATCH));
    }
}
