<?php
require(__DIR__.'/../src/Twilio/autoload.php');

use Twilio\Rest\Client;
use Twilio\CredentialProvider\OrgsCredentialProviderBuilder;

$clientId = getenv('ORGS_CLIENT_ID');
$clientSecret = getenv('ORGS_CLIENT_SECRET');
$orgSid = getenv('ORG_SID');

$orgsCredentialProvider = (new OrgsCredentialProviderBuilder())->setClientId($clientId)->setClientSecret($clientSecret)->build();

$client = new Client();
$client->setCredentialProvider($orgsCredentialProvider);

//list users
$users = $client->previewIam->organization($orgSid)->users->read();
foreach ($users as $user) {
    printf("User SID: %s\n", $user->id);
}
