<?php
require(__DIR__.'/../src/Twilio/autoload.php');

use Twilio\Rest\Client;

$sid = getenv('TWILIO_ACCOUNT_SID');
$token = getenv('TWILIO_AUTH_TOKEN');
$client = new Client($sid, $token);

function buyNumber(): ?Twilio\Rest\Api\V2010\Account\IncomingPhoneNumberInstance{
    // Look up some phone numbers
    global $client;
    $numbers = $client->availablePhoneNumbers("US")->local->read();

    // Buy the first phone number
    if(count($numbers)>0){
        $local = $numbers[0];
        return $client->incomingPhoneNumbers->create(["phoneNumber" => $local->phoneNumber]);
    }

    return null;
}

$phoneNumber = "+18885551234";

// Get last 10 records
$recordList = $client->usage->records->read([], 10);
foreach ($recordList as $record) {
    print_r("Record(accountSid=" . $record->accountSid . ", apiVersion=" . $record->apiVersion . ", asOf=" . $record->asOf . ", category=" . $record->category . ", count=" . $record->count . ", countUnit=" . $record->countUnit . ", description=" . $record->description . ", endDate=" . $record->endDate->format("Y-m-d H:i:s") . ", price=" . $record->price . ", priceUnit=" . $record->priceUnit . ", startDate=" . $record->startDate->format("Y-m-d H:i:s") . ", uri=" . $record->uri . ", usage=" . $record->usage . ", usageUnit=" . $record->usageUnit . "\n");
}

// Get a number
$number = buyNumber();
print("\nTwilio purchased phoneNumber: ".$number->phoneNumber."\n\n");

// Send a text message
$message = $client->messages->create(
    $phoneNumber,
    [
        'from' => $number->phoneNumber,
        'body' => "Hey Jenny! Good luck on the bar exam!"
    ]
);
print("Message sent successfully with sid = " . $message->sid ."\n\n");

// Print the last 10 messages
$messageList = $client->messages->read([],10);
foreach ($messageList as $mesg) {
    print("ID:: ". $mesg->sid . " | " . "From:: " . $mesg->from . " | " . "TO:: " . $mesg->to . " | "  .  " Status:: " . $mesg->status . " | " . " Body:: ". $mesg->body ."\n");
}

// Make a phone call
$call = $client->calls->create(
        $phoneNumber,
        $number->phoneNumber,
        ["url" => "https://twilio.com"]
    );
print("\n".$call->sid."\n\n");

// Get some calls
$callsList = $client->calls->read([],null,2);
foreach ($callsList as $call) {
    print("Call sid: ".$call->sid."\n");
}

// Create Trunk
$trunk = $client->trunking->v1->trunks->create(
    [
        "friendlyName" => "shiny trunk",
        "secure" => false
    ]
);
print("\n".$trunk."\n");
