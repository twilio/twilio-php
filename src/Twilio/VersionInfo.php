<?php


namespace Twilio;


class VersionInfo {
    const MAJOR = 6;
    const MINOR = 15;
    const PATCH = 1;

    public static function string() {
        return implode('.', array(self::MAJOR, self::MINOR, self::PATCH));
    }
}
