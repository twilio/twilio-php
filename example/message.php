<?php
require(__DIR__.'/../src/Twilio/autoload.php');

use Twilio\Rest\Client;
use \Twilio\Rest\Content\V1\ContentModels;

$sid = getenv('TWILIO_ACCOUNT_SID');
$token = getenv('TWILIO_AUTH_TOKEN');
$twilio = new Client($sid, $token);

$contentCreateRequest = ContentModels::createContentCreateRequest([
    'friendly_name' => 'my_template_friendly_name',
    'language' => 'en',
    'types' => [
        'twilio/text' => [
            'body' => 'this is a example body',
        ],
    ]
]);

$contentInstance = $twilio->content->v1->contents->create(
    $contentCreateRequest
);

print($contentInstance->sid);
