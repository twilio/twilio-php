<?php

require 'vendor/autoload.php';

use Twilio\Rest\Client;

$client = new Client("ACb43d7209487f2797fb93c284cb46103b", "1698bb9b93e465b6d8eccca91add41bb", null, "stage");


print("Getting recordings\n");
$recordings = $client->recordings->page();
// print_r($recordings);

print("\nGetting calls\n");
$call = $client->calls("CAe891c5946fede836551f64ddded4b328");
// print_r($call);

// print("Gettings recordings for call");
//$call_recordings = $call->recordings->read();
// print_r($call_recordings);
