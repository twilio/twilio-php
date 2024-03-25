<?php


namespace Twilio;


class VersionInfo {
    const MAJOR = "8";
    const MINOR = "0";
    const PATCH = "0-rc.0";

    public static function string() {
        return implode('.', array(self::MAJOR, self::MINOR, self::PATCH));
    }
}
