<?php

require 'vendor/autoload.php';

use Twilio\VersionInfo;

$args = $_SERVER['argv'];

// Discard script name
array_shift($args);

if ($args) {
    $version = $args[0];
} else {
    $patchParts = explode('-', VersionInfo::PATCH);
    $lastPatch = array_pop($patchParts);
    preg_match('/\\d+$/', $lastPatch, $matches);
    $patchVersion = (int)$matches[0] + 1;
    $patchPrefix = substr($lastPatch, 0, -1 * strlen($patchVersion));
    $patchParts[] = $patchPrefix . $patchVersion;
    $patch = implode('-', $patchParts);

    $version = implode('.', array(
        VersionInfo::MAJOR,
        VersionInfo::MINOR,
        $patch,
    ));
}

list($major, $minor, $patch) = explode('.', $version);

echo "Release $version (MAJOR = $major, MINOR = $minor, PATCH = $patch)";

$major = is_numeric($major) ? $major : "'" . $major . "'";
$minor = is_numeric($minor) ? $minor : "'" . $minor . "'";
$patch = is_numeric($patch) ? $patch : "'" . $patch . "'";

$versionInfoSrc = <<<SRC
<?php


namespace Twilio;


class VersionInfo {
    const MAJOR = $major;
    const MINOR = $minor;
    const PATCH = $patch;

    public static function string() {
        return implode('.', array(self::MAJOR, self::MINOR, self::PATCH));
    }
}

SRC;

file_put_contents('Twilio/VersionInfo.php', $versionInfoSrc);

exec("git commit -am \"Bumping to version $version\"");
exec("git push");
exec("git tag $version");
exec("git push --tags");
