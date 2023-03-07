<?php
require(__DIR__.'/../src/Twilio/autoload.php');

use Twilio\Rest\Client;

$sid = getenv('TWILIO_ACCOUNT_SID');
$token = getenv('TWILIO_AUTH_TOKEN');
$client = new Client($sid, $token);

function buyNumber(): ?Twilio\Rest\Api\V2010\Account\IncomingPhoneNumberInstance{
    // Look up some phone numbers
    global $client;

    // Specify the [ISO country code](https://en.wikipedia.org/wiki/ISO_3166-1_alpha-2) of the country
    // from which to read phone numbers, eg: "US"
    $numbers = $client->availablePhoneNumbers("XX")->local->read();

    // Buy the first phone number
    if(!empty($numbers)){
        $local = $numbers[0];
        return $client->incomingPhoneNumbers->create(["phoneNumber" => $local->phoneNumber]);
    }

    return null;
}

// Get a number
$number = buyNumber();
print("Twilio purchased phoneNumber: ".$number->phoneNumber."\n");