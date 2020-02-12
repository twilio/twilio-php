<?php


namespace Twilio;


class VersionInfo {
    const MAJOR = 5;
    const MINOR = 42;
    const PATCH = 2;

    public static function string(): string {
        return implode('.', [self::MAJOR, self::MINOR, self::PATCH]);
    }
}
