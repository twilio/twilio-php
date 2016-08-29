<?php


namespace Twilio;


class VersionInfo {
    const MAJOR = '';
    const MINOR = '';
    const PATCH = '';

    public static function string() {
        return implode('.', array(self::MAJOR, self::MINOR, self::PATCH));
    }
}
