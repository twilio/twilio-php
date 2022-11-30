<?php


namespace Twilio;


class VersionInfo {
    const MAJOR = 6;
    const MINOR = 43;
    const PATCH = 4;

    public static function string() {
        return implode('.', array(self::MAJOR, self::MINOR, self::PATCH));
    }
}
