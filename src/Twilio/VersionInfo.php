<?php


namespace Twilio;


class VersionInfo {
    const MAJOR = "8";
    const MINOR = "0";
    const PATCH = "0";
    const PRERELEASE = "rc.2";

    public static function string() {
        $version = implode('.', array(self::MAJOR, self::MINOR, self::PATCH));
        if (self::PRERELEASE !== "") {
            $version .= '-' . self::PRERELEASE;
        }
        return $version;
    }
}
