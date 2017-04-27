<?php

require 'vendor/autoload.php';

use Twilio\Rest\Client;

$client = new Client("ACa331707952cd0205ce5c916958c2344b", "95ba0d225baa6813b50fea5afaa8caa5");

$client->preview->sync->services('IS7cfe0487fd836f0cffe3d7e685aa48e2')->syncLists('ES5ddc228ee636487a9bb8a586e4f15218')->syncListItems->create(array("evan"=> "rocks"));
