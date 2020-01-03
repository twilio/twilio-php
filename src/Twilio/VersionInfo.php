<?php


namespace Twilio;


class VersionInfo {
    const MAJOR = 5;
    const MINOR = 41;
    const PATCH = 1;

    public static function string(): string {
        return implode('.', [self::MAJOR, self::MINOR, self::PATCH]);
    }
}
