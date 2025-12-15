<?php
require(__DIR__.'/../src/Twilio/autoload.php');

use Twilio\Rest\Client;
use Twilio\Exceptions\TwilioException;

function printMessageObject($msg) {
    if(is_bool($msg)) {
        print "Status: " . $msg . "\n";
    }
    else {
        print "Sid: " . $msg->sid . "\n";
        print "From: " . $msg->from . "\n";
        print "To: " . $msg->to . "\n";
        print "Body: " . $msg->body . "\n";
    }
}

function handleResponse($responseMetadata) {
    if(is_bool($responseMetadata)) {
        print printMessageObject($responseMetadata) . "\n\n";
    }
    else if(\method_exists($responseMetadata, "getHeaders")) {
        $resource = $responseMetadata->getResource();
        $statusCode = $responseMetadata->getStatusCode();
        print printMessageObject($resource) . "\n\n";
        print "Status code: " . $statusCode . "\n\n";
        print "Headers: " . json_encode($responseMetadata->getHeaders()) . "\n\n";
    }
    else {
        print printMessageObject($responseMetadata) . "\n\n";
    }
}

function handlePage($page, $limit, $pageSize) {
    $current_page = $page;
    $pages = ceil($limit / $pageSize);
    for ($i = 0; $i < $pages; $i++) {
        print "Page: " . $i . "\n";
        if (\method_exists($page, "getHeaders")) {
            $headers = $page->getHeaders();
            $statusCode = $page->getStatusCode();
            print "Status code: " . $statusCode . "\n\n";
            print "Headers: " . json_encode($headers) . "\n\n";
        }
        foreach ($current_page as $msg) {
            print printMessageObject($msg) . "\n";
        }
        $current_page = $current_page->nextPage();
    }
}


function handleSteam($stream) {
    foreach ($stream as $msg) {
        if (\method_exists($stream, "getHeaders")) {
            $headers = $stream->getHeaders();
            $statusCode = $stream->getStatusCode();
            print "Status code: " . $statusCode . "\n\n";
            print "Headers: " . json_encode($headers) . "\n\n";
        }
        print printMessageObject($msg) . "\n";
    }
}

function handleRead($obj) {
    if(!is_array($obj))
    {
        if (\method_exists($obj, "getHeaders")) {
            $headers = $obj->getHeaders();
            $statusCode = $obj->getStatusCode();
            print "Status code: " . $statusCode . "\n\n";
            print "Headers: " . json_encode($headers) . "\n\n";
        }
    }
    foreach ($obj as $msg) {
        print printMessageObject($msg) . "\n";
    }
}

function createMessage(Client $client, string $from, string $to)
{
    try {
        $message = $client->messages->create($to,[
            'From' => $from,
            'Body' => 'Hello from metadata'
        ]);
        handleResponse($message);
    } catch (TwilioException $e) {
        print "Error: " . $e->getCode() . "\n" . $e->getMessage() . "\n"  . "\n";

    }
}

function createMessageWithMetadata(Client $client, string $from, string $to)
{
    try {
        $message = $client->messages->createWithMetadata($to,[
            'From' => $from,
            'Body' => 'Hello from metadata'
        ]);
        handleResponse($message);
    } catch (TwilioException $e) {
        print "Error: " . $e->getCode() . "\n" . $e->getMessage() . "\n"  . "\n";

    }
}


function fetchMessage(Client $client, string $sid)
{
    try {
        $message = $client->messages($sid)->fetch();
        handleResponse($message);
    } catch (TwilioException $e) {
        print "Error: " . $e->getCode() . "\n" . $e->getMessage() . "\n"  . "\n";

    }
}

function fetchMessageWithMetadata(Client $client, string $sid)
{
    try {
        $message = $client->messages($sid)->fetchWithMetadata();
        handleResponse($message);
    } catch (TwilioException $e) {
        print "Error: " . $e->getCode() . "\n" . $e->getMessage() . "\n"  . "\n";

    }
}


function updateMessage(Client $client, string $sid)
{
    try {
        $message = $client->messages($sid)->update([
            'Body' => ''
        ]);
        handleResponse($message);
    } catch (TwilioException $e) {
        print "Error: " . $e->getCode() . "\n" . $e->getMessage() . "\n"  . "\n";

    }
}

function updateMessageWithMetadata(Client $client, string $sid)
{
    try {
        $message = $client->messages($sid)->updateWithMetadata([
            'Body' => ''
        ]);
        handleResponse($message);
    } catch (TwilioException $e) {
        print "Error: " . $e->getCode() . "\n" . $e->getMessage() . "\n"  . "\n";

    }
}


function deleteMessage(Client $client, string $sid)
{
    try {
        $message = $client->messages($sid)->delete();
        handleResponse($message);
    } catch (TwilioException $e) {
        print "Error: " . $e->getCode() . "\n" . $e->getMessage() . "\n"  . "\n";

    }
}

function deleteMessageWithMetadata(Client $client, string $sid)
{
    try {
        $message = $client->messages($sid)->deleteWithMetadata();
        handleResponse($message);
    } catch (TwilioException $e) {
        print "Error: " . $e->getCode() . "\n" . $e->getMessage() . "\n"  . "\n";

    }
}


function pageMessage(Client $client, string $to)
{
    $limit = 6;
    $pageSize = 2;
    try {
        $response = $client->messages->page([
            'To' => $to,
        ], $pageSize);
        handlePage($response, $limit, $pageSize);
    } catch (TwilioException $e) {
        print "Error: " . $e->getCode() . "\n" . $e->getMessage() . "\n"  . "\n";

    }
}

function pageMessageWithMetadata(Client $client, string $to)
{
    $limit = 6;
    $pageSize = 2;
    try {
        $response = $client->messages->pageWithMetadata([
            'To' => $to,
        ], $pageSize);
        handlePage($response, $limit, $pageSize);
    } catch (TwilioException $e) {
        print "Error: " . $e->getCode() . "\n" . $e->getMessage() . "\n"  . "\n";

    }
}


function streamMessage(Client $client, string $to)
{
    $limit = 5;
    $pageSize = 2;
    try {
        $response = $client->messages->stream([
            'To' => $to,
        ], $limit, $pageSize);
        handleSteam($response);
    } catch (TwilioException $e) {
        print "Error: " . $e->getCode() . "\n" . $e->getMessage() . "\n"  . "\n";

    }
}

function streamMessageWithMetadata(Client $client, string $to)
{
    $limit = 5;
    $pageSize = 2;
    try {
        $response = $client->messages->streamWithMetadata([
            'To' => $to,
        ], $limit, $pageSize);
        handleSteam($response);
    } catch (TwilioException $e) {
        print "Error: " . $e->getCode() . "\n" . $e->getMessage() . "\n"  . "\n";

    }
}


function readMessageWithMetadata(Client $client, string $to)
{
    $limit = 5;
    $pageSize = 2;
    try {
        $response = $client->messages->readWithMetadata([], $limit, $pageSize);
        handleRead($response);
    } catch (TwilioException $e) {
        print "Error: " . $e->getCode() . "\n" . $e->getMessage() . "\n"  . "\n";
    }
}

function readMessage(Client $client, string $to)
{
    $limit = 5;
    $pageSize = 2;
    try {
        $response = $client->messages->read([], $limit, $pageSize);
        handleRead($response);
    } catch (TwilioException $e) {
        print "Error: " . $e->getCode() . "\n" . $e->getMessage() . "\n"  . "\n";
    }
}


$sid = getenv('TWILIO_ACCOUNT_SID');
$token = getenv('TWILIO_AUTH_TOKEN');
$client = new Client($sid, $token);
$from = getenv('TWILIO_PHONE_NUMBER');
$to = getenv('RECEIVER_PHONE_NUMBER');

$messageSid = getenv('MESSAGE_SID');

//createMessage($client, $from, $to);
//print "------------------------------------------------------------------------------------------------------\n";
//createMessageWithMetadata($client, $from, $to);

//fetchMessage($client, $messageSid);
//print "------------------------------------------------------------------------------------------------------\n";
//fetchMessageWithMetadata($client, $messageSid);

//updateMessage($client, $messageSid);
//print "------------------------------------------------------------------------------------------------------\n";
//updateMessageWithMetadata($client, $messageSid);

//deleteMessage($client, $messageSid);
//print "------------------------------------------------------------------------------------------------------\n";
//deleteMessageWithMetadata($client, $messageSid);

//pageMessage($client, $to);
//print "------------------------------------------------------------------------------------------------------\n";
//pageMessageWithMetadata($client, $to);

//streamMessage($client, $to);
//print "------------------------------------------------------------------------------------------------------\n";
//streamMessageWithMetadata($client, $to);

//readMessage($client, $to);
//print "------------------------------------------------------------------------------------------------------\n";
//readMessageWithMetadata($client, $to);
