<?php

\error_reporting(E_ALL | E_STRICT);
\ini_set('display_errors', 1);

$root = \realpath(\dirname(__DIR__));
$library = "$root/Rest";

$path = [$library, \get_include_path()];
\set_include_path(\implode(PATH_SEPARATOR, $path));

$vendorFilename = \dirname(__DIR__) . '/vendor/autoload.php';
if (\file_exists($vendorFilename)) {
    /* composer install */
    /** @noinspection PhpIncludeInspection */
    require $vendorFilename;
}

unset($root, $library, $path);

