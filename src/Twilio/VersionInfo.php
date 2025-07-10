<?php


namespace Twilio;


class VersionInfo {
    const MAJOR = "8";
    const MINOR = "6";
    const PATCH = "5";

    public static function string() {
        return implode('.', array(self::MAJOR, self::MINOR, self::PATCH));
    }
}
