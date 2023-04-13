# twilio-php

[![Tests](https://github.com/twilio/twilio-php/actions/workflows/test-and-deploy.yml/badge.svg)](https://github.com/twilio/twilio-php/actions/workflows/test-and-deploy.yml)
[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=twilio_twilio-php&metric=alert_status)](https://sonarcloud.io/summary/new_code?id=twilio_twilio-php)
[![Packagist](https://img.shields.io/packagist/v/twilio/sdk.svg)](https://packagist.org/packages/twilio/sdk)
[![Packagist](https://img.shields.io/packagist/dt/twilio/sdk.svg)](https://packagist.org/packages/twilio/sdk)
[![Learn with TwilioQuest](https://img.shields.io/static/v1?label=TwilioQuest&message=Learn%20to%20contribute%21&color=F22F46&labelColor=1f243c&style=flat-square&logo=data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIAAAACACAMAAAD04JH5AAAASFBMVEUAAAAZGRkcHBwjIyMoKCgAAABgYGBoaGiAgICMjIyzs7PJycnMzMzNzc3UoBfd3d3m5ubqrhfrMEDu7u739/f4vSb/3AD///9tbdyEAAAABXRSTlMAAAAAAMJrBrEAAAKoSURBVHgB7ZrRcuI6EESdyxXGYoNFvMD//+l2bSszRgyUYpFAsXOeiJGmj4NkuWx1Qeh+Ekl9DgEXOBwOx+Px5xyQhDykfgq4wG63MxxaR4ddIkg6Ul3g84vCIcjPBA5gmUMeXESrlukuoK33+33uID8TWeLAdOWsKpJYzwVMB7bOzYSGOciyUlXSn0/ABXTosJ1M1SbypZ4O4MbZuIDMU02PMbauhhHMHXbmebmALIiEbbbbbUrpF1gwE9kFfRNAJaP+FQEXCCTGyJ4ngDrjOFo3jEL5JdqjF/pueR4cCeCGgAtwmuRS6gDwaRiGvu+DMFwSBLTE3+jF8JyuV1okPZ+AC4hDFhCHyHQjdjPHUKFDlHSJkHQXMB3KpSwXNGJPcwwTdZiXlRN0gSp0zpWxNtM0beYE0nRH6QIbO7rawwXaBYz0j78gxjokDuv12gVeUuBD0MDi0OQCLvDaAho4juP1Q/jkAncXqIcCfd+7gAu4QLMACCLxpRsSuQh0igu0C9Svhi7weAGZg50L3IE3cai4IfkNZAC8dfdhsUD3CgKBVC9JE5ABAFzg4QL/taYPAAWrHdYcgfLaIgAXWJ7OV38n1LEF8tt2TH29E+QAoDoO5Ve/LtCQDmKM9kPbvCEBApK+IXzbcSJ0cIGF6e8gpcRhUDogWZ8JnaWjPXc/fNnBBUKRngiHgTUSivSzDRDgHZQOLvBQgf8rRt+VdBUUhwkU6VpJ+xcOwQUqZr+mR0kvBUgv6cB4+37hQAkXqE8PwGisGhJtN4xAHMzrsgvI7rccXqSvKh6jltGlrOHA3Xk1At3LC4QiPdX9/0ndHpGVvTjR4bZA1ypAKgVcwE5vx74ulwIugDt8e/X7JgfkucBMIAr26ndnB4UCLnDOqvteQsHlgX9N4A+c4cW3DXSPbwAAAABJRU5ErkJggg==)](https://twil.io/learn-open-source)

## Documentation

The documentation for the Twilio API can be found [here][apidocs].

The PHP library documentation can be found [here][libdocs].

## Versions

`twilio-php` uses a modified version of [Semantic Versioning](https://semver.org) for all changes. [See this document](VERSIONS.md) for details.

### Supported PHP Versions

This library supports the following PHP implementations:

- PHP 7.2
- PHP 7.3
- PHP 7.4
- PHP 8.0
- PHP 8.1

## Installation

You can install `twilio-php` via [composer](https://getcomposer.org/) or by downloading the source.

### Via Composer

`twilio-php` is available on Packagist as the [`twilio/sdk`](https://packagist.org/packages/twilio/sdk) package:

```shell
composer require twilio/sdk
```

### Test your installation

Here is an example of using the SDK to send a text message:

```php
// Send an SMS using Twilio's REST API and PHP
<?php
// Required if your environment does not handle autoloading
require __DIR__ . '/vendor/autoload.php';

// Your Account SID and Auth Token from console.twilio.com
$sid = "ACXXXXXX";
$token = "YYYYYY";
$client = new Twilio\Rest\Client($sid, $token);

// Use the Client to make requests to the Twilio REST API
$client->messages->create(
    // The number you'd like to send the message to
    '+15558675309',
    [
        // A Twilio phone number you purchased at https://console.twilio.com
        'from' => '+15017250604',
        // The body of the text message you'd like to send
        'body' => "Hey Jenny! Good luck on the bar exam!"
    ]
);
```

### Without Composer

While we recommend using a package manager to track the dependencies in your application, it is possible to download and use the PHP SDK manually. You can download the full source of the PHP SDK from GitHub, and browse the repo if you would like. To use the SDK in your application, unzip the SDK download file in the same directory as your PHP code. In your code, you can then require the autoload file bundled with the SDK.

```php
<?php
// Require the bundled autoload file - the path may need to change
// based on where you downloaded and unzipped the SDK
require __DIR__ . '/twilio-php-main/src/Twilio/autoload.php';

// Your Account SID and Auth Token from console.twilio.com
$sid = "ACXXXXXX";
$token = "YYYYYY";
$client = new Twilio\Rest\Client($sid, $token);

// Use the Client to make requests to the Twilio REST API
$client->messages->create(
    // The number you'd like to send the message to
    '+15558675309',
    [
        // A Twilio phone number you purchased at https://console.twilio.com
        'from' => '+15017250604',
        // The body of the text message you'd like to send
        'body' => "Hey Jenny! Good luck on the bar exam!"
    ]
);
```

## Usage

### Make a Call

```php
<?php
$sid = "ACXXXXXX";
$token = "YYYYYY";

$client = new Twilio\Rest\Client($sid, $token);

// Read TwiML at this URL when a call connects (hold music)
$call = $client->calls->create(
    '8881231234',
    // Call this number
    '9991231234',
    // From a valid Twilio number
    [
        'url' => 'https://twimlets.com/holdmusic?Bucket=com.twilio.music.ambient'
    ]
);
```

> **Warning**
> It's okay to hardcode your credentials when testing locally, but you should use environment variables to keep them secret before committing any code or deploying to production. Check out [How to Set Environment Variables](https://www.twilio.com/blog/2017/01/how-to-set-environment-variables.html) for more information.

### Get an existing Call

```php
<?php
require_once '/path/to/vendor/autoload.php';

$sid = "ACXXXXXX";
$token = "YYYYYY";
$client = new Twilio\Rest\Client($sid, $token);

// Get an object using its SID. If you do not have a SID,
// check out the list resource examples on this page
$call = $client->calls("CA42ed11f93dc08b952027ffbc406d0868")->fetch();
print $call->to;
```

### Iterate through records

The library automatically handles paging for you. Collections, such as `calls` and `messages`, have `read` and `stream` methods that page under the hood. With both `read` and `stream`, you can specify the number of records you want to receive (`limit`) and the maximum size you want each page fetch to be (`pageSize`). The library will then handle the task for you.

`read` eagerly fetches all records and returns them as a list, whereas `stream` returns an iterator and lazily retrieves pages of records as you iterate over the collection. You can also page manually using the `page` method.

For more information about these methods, view the [auto-generated library docs](https://www.twilio.com/docs/libraries/reference/twilio-php/).

### Use the `read` method

```php
<?php
require_once '/path/to/vendor/autoload.php';

$sid = "ACXXXXXX";
$token = "YYYYYY";
$client = new Twilio\Rest\Client($sid, $token);

// Loop over the list of calls and print a property from each one
foreach ($client->calls->read() as $call) {
    print $call->direction;
}
```

### Specify Region and/or Edge

To take advantage of Twilio's [Global Infrastructure](https://www.twilio.com/docs/global-infrastructure), specify the target Region and/or Edge for the client:

```php
<?php
$sid = "ACXXXXXX";
$token = "YYYYYY";

$client = new Twilio\Rest\Client($sid, $token, null, 'au1');
$client->setEdge('sydney');
```

A `Client` constructor without these parameters will also look for `TWILIO_REGION` and `TWILIO_EDGE` variables inside the current environment.

This will result in the `hostname` transforming from `api.twilio.com` to `api.sydney.au1.twilio.com`.

### Enable Debug Logging

There are two ways to enable debug logging in the default HTTP client. You can create an environment variable called `TWILIO_LOG_LEVEL` and set it to `debug` or you can set the log level to debug:

```php
$sid = "ACXXXXXX";
$token = "YYYYYY";

$client = new Twilio\Rest\Client($sid, $token);
$client->setLogLevel('debug');
```

### Generate TwiML

To control phone calls, your application needs to output [TwiML][twiml].

Use `Twilio\TwiML\(Voice|Messaging|Fax)Response` to easily chain said responses.

```php
<?php
$response = new Twilio\TwiML\VoiceResponse();
$response->say('Hello');
$response->play('https://api.twilio.com/cowbell.mp3', ['loop' => 5]);
print $response;
```

That will output XML that looks like this:

```xml
<?xml version="1.0" encoding="utf-8"?>
<Response>
    <Say>Hello</Say>
    <Play loop="5">https://api.twilio.com/cowbell.mp3</Play>
</Response>
```

### Handle exceptions

When something goes wrong during client initialization, in an API request, or when creating TwiML, twilio-php will throw an appropriate exception. You should handle these exceptions to keep your application running and avoid unnecessary crashes.

#### The Twilio client

For example, it is possible to get an authentication exception when initiating your client, perhaps with the wrong credentials. This can be handled like so:

```php
<?php
require_once('/path/to/twilio-php/Services/Twilio.php');

use Twilio\Exceptions\ConfigurationException;
use Twilio\Rest\Client;

$sid = "ACXXXXXX";
$token = "YYYYYY";

// Attempt to create a new Client, but your credentials may contain a typo
try {
    $client = new Twilio\Rest\Client($sid, $token);
} catch (ConfigurationException $e) {
    // You can `catch` the exception, and perform any recovery method of your choice
    print $e . getCode();
}

$call = $client->account->calls
    ->get("CAXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX");

print $call->to;
```

#### CurlClient

When initializing the curl client, you will see an EnvironmentException if curl is not installed on your system.

```php
<?php
require_once('/path/to/twilio-php/Services/Twilio.php');

use Twilio\Exceptions\TwilioException;
use Twilio\Http\CurlClient;

$sid = "ACXXXXXX";
$token = "YYYYYY";
$client = new Twilio\Rest\Client($sid, $token);

try {
    $client = new CurlClient();

    $client->options(
        'GET',
        'http://api.twilio.com',
        array(),
        array(),
        array(),
        $sid,
        $token
    );
} catch (EnvironmentException $e) {
    print $e . getCode();
}

print $call->to;
```

#### TwilioException

`TwilioException` can be used to handle API errors, as shown below. This is the most common exception type that you will most likely use.

```php
<?php
require_once('/path/to/twilio-php/Services/Twilio.php');

use Twilio\Exceptions\TwilioException;

$sid = "ACXXXXXX";
$token = "YYYYYY";
$client = new Twilio\Rest\Client($sid, $token);

try {
    $call = $client->account->calls
        ->get("CAXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX");
} catch (TwilioException $e) {
    print $e->getCode();
}

print $call->to;
```

### TwimlException

When building [TwiML](https://www.twilio.com/docs/api/twiml) with `twilio-php`, if the result does not conform to what the API expects, you will see a `TwimlException` which you then need to handle like so:

```php
<?php
require_once './vendor/autoload.php';
use Twilio\Twiml;

try {
    $response = new Twiml();
    $dial = $response->dial();
    $dial->conference('Room 1234');
    print $response;
} catch (TwimlException $e) {
    print $e->getCode();
}
```

### Debug API requests

To assist with debugging, the library allows you to access the underlying request and response objects. This capability is built into the default Curl client that ships with the library.

For example, you can retrieve the status code of the last response like so:

```php
<?php
$sid = "ACXXXXXX";
$token = "YYYYYY";

$client = new Twilio\Rest\Client($sid, $token);
$message = $client->messages->create(
    '+15558675309',
    [
        'from' => '+15017250604',
        'body' => "Hey Jenny! Good luck on the bar exam!"
    ]
);

// Print the message's SID
print $message->sid;

// Print details about the last request
print $client->lastRequest->method;
print $client->lastRequest->url;
print $client->lastRequest->auth;
print $client->lastRequest->params;
print $client->lastRequest->headers;
print $client->lastRequest->data;

// Print details about the last response
print $client->lastResponse->statusCode;
print $client->lastResponse->body;
```

## Use a custom HTTP Client

To use a custom HTTP client with this helper library, please see the [advanced example of how to do so](./advanced-examples/custom-http-client.md).

## Docker image

The `Dockerfile` present in this repository and its respective `twilio/twilio-php` Docker image are currently used by Twilio for testing purposes only.

## Getting help

If you need help installing or using the library, please check the [Twilio Support Help Center](https://support.twilio.com) first, and [file a support ticket](https://twilio.com/help/contact) if you don't find an answer to your question.

If you've instead found a bug in the library or would like new features added, go ahead and open issues or pull requests against this repo!

[apidocs]: https://www.twilio.com/docs/api
[twiml]: https://www.twilio.com/docs/api/twiml
[libdocs]: https://twilio.github.io/twilio-php
