<?php
require(__DIR__.'/../src/Twilio/autoload.php');

use Twilio\Rest\Client;

$sid = getenv('TWILIO_ACCOUNT_SID');
$token = getenv('TWILIO_AUTH_TOKEN');
$client = new Client($sid, $token);

// The phone number, SIP address, Client identifier or SIM SID that received this call.
// Phone numbers are in [E.164 format](https://www.twilio.com/docs/glossary/what-e164) (e.g., +16175551212).
// SIP addresses are formatted as name@company.com.
// Client identifiers are formatted client:name.
// SIM SIDs are formatted as sim:sid
$to = "+XXXXXXXXXX";

// The phone number or client identifier to use as the caller id.
// If using a phone number, it must be a Twilio number or a Verified outgoing caller id for your account.
// If the "to" parameter is a phone number, "from" must also be a phone number.
$from = "+XXXXXXXXXX";

// Make a phone call
$call = $client->calls->create(
    $to,
    $from,
    ["url" => "https://twilio.com"]
);
print("Call made successfully with sid: ".$call->sid."\n\n");

// Get some calls
$callsList = $client->calls->read([],null,2);
foreach ($callsList as $call) {
    print("Call {$call->sid}: {$call->duration} seconds\n");
}