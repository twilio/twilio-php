<?php
require(__DIR__.'/../src/Twilio/autoload.php');

use Twilio\Rest\Client;
use Twilio\CredentialProvider\ClientCredentialProviderBuilder;

$accountSid = getenv('TWILIO_ACCOUNT_SID');
$token = getenv('TWILIO_AUTH_TOKEN');

$clientId = getenv('OAUTH_CLIENT_ID');
$clientSecret = getenv('OAUTH_CLIENT_SECRET');

$clientCredentialProvider = (new ClientCredentialProviderBuilder())->setClientId($clientId)->setClientSecret($clientSecret)->build();

$client = new Client();
$client->setCredentialProvider($clientCredentialProvider);
$client->setAccountSid($accountSid);

$messageList = $client->messages->read([],10);
foreach ($messageList as $msg) {
    print("ID:: ". $msg->sid . " | " . "From:: " . $msg->from . " | " . "TO:: " . $msg->to . " | "  .  " Status:: " . $msg->status . " | " . " Body:: ". $msg->body ."\n");
}
