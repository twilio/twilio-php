<?php
require(__DIR__.'/../src/Twilio/autoload.php');

use Twilio\Exceptions\RestExceptionV1;
use Twilio\Rest\Client;


function createServices(Client $client)
{
    try {
        $requestBody = $client->accounts->v1->service->create([
            'name' => "friendlyName",
        ]);
        print $requestBody->id . "\n";
    } catch (RestExceptionV1 $e) {
        print "Error ------------------------------------------------------------------------------------ " . $e->getCode() . "\n" . $e->getMessage() . "\n" . $e->getHttpStatusCode() . "\n" . $e->getParams() . "\n" . $e->getUserError() . "\n";
    }
}

function readServices(Client $client)
{
        $services = $client->accounts->v1->service->read([
            'Type' => 'sip',
            'pageSize' => 2,
        ]);
        foreach ($services as $record) {
            print $record->id . "\n";
        }
}


$sid = getenv('TWILIO_ACCOUNT_SID');
$token = getenv('TWILIO_AUTH_TOKEN');
$client = new Client($sid, $token);

createServices($client);
//readServices($client);
