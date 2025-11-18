<?php
require(__DIR__.'/../src/Twilio/autoload.php');

use Twilio\Rest\Client;

$sid = getenv('TWILIO_ACCOUNT_SID');
$token = getenv('TWILIO_AUTH_TOKEN');
$client = new Client($sid, $token);

$dog = Twilio\Rest\OneOf\V1\PetModels::createDog([
    'type' => 'dog',
    'name' => 'Tommy',
    'packSize' => 2
]);

// create cat with option "one"
$catOne = Twilio\Rest\OneOf\V1\PetModels::createCat([
    'account_sid' => $sid,
    'param1' => 'value1',
    'param2' => 'value2',
    'dog' => $dog,
]);

$pet = $client->oneOf->v1->pets->create($catOne);
print($pet->accountSid . "\n");
print($pet->param1 . "\n");
print($pet->param2 . "\n");
print($pet->dog . "\n");


// create cat with option "two"
$catTwo = Twilio\Rest\OneOf\V1\PetModels::createCat([
    'account_sid' => $sid,
    'object1' => ['key1' => 'value1'],
    'object2' => ['key2' => 'value2'],
]);

$pet = $client->oneOf->v1->pets->create($catTwo);
print($pet->accountSid . "\n");
print($pet->object1 . "\n");
print($pet->object2 . "\n");
