<?php

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', 1);

$root = realpath(dirname(dirname(__FILE__)));
$library = "$root/Rest";
$tests = "$root/Tests";

$path = array($library, $tests, get_include_path());
set_include_path(implode(PATH_SEPARATOR, $path));

$vendorFilename = dirname(__FILE__) . '/../../vendor/autoload.php';
if (file_exists($vendorFilename)) {
    /* composer install */
    /** @noinspection PhpIncludeInspection */
    require $vendorFilename;
}

/** @noinspection PhpIncludeInspection */
require_once 'Client.php';

unset($root, $library, $tests, $path);

