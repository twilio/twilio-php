<?php
require(__DIR__.'/../src/Twilio/autoload.php');

use Twilio\Rest\Client;
use Twilio\Rest\PreviewMessaging\V1\MessageModels;

$sid = getenv('TWILIO_ACCOUNT_SID');
$token = getenv('TWILIO_AUTH_TOKEN');
$client = new Client($sid, $token);

// Specify the phone numbers in [E.164 format](https://www.twilio.com/docs/glossary/what-e164) (e.g., +16175551212)
// This parameter determines the destination phone number for your SMS message. Format this number with a '+' and a country code
$phoneNumber1 = "+XXXXXXXXXX";
$phoneNumber2 = "+XXXXXXXXXX";

// Create message object for the recipients
$message1 = MessageModels::createMessagingV1Message(
    [
        'to' => $phoneNumber1,
    ]
);
$message2 = MessageModels::createMessagingV1Message(
    [
        'to' => $phoneNumber2,
    ]
);

// Create list of the message objects
$messages = [$message1, $message2];

// This must be a Twilio phone number that you own, formatted with a '+' and country code
$twilioPurchasedNumber = "+XXXXXXXXXX";
// Specify the message to be sent - JSON string supported
$messageBody = "Hello from twilio-php!";

// Create Message Request object
$createMessagesRequest = MessageModels::createCreateMessagesRequest(
    [
        'messages' => $messages,
        'from' => $twilioPurchasedNumber,
        'body' => $messageBody,
    ]
);

// Send a Bulk Message
$message = $client->previewMessaging->v1->messages->create($createMessagesRequest);

// Print how many messages were successful
print($message->successCount . " messages sent successfully!" . "\n\n");

// Print the message details
foreach ($message->messageReceipts as $msg) {
    print("ID:: " . $msg["sid"] . " | " . "TO:: " . $msg["to"] . "\n");
}
