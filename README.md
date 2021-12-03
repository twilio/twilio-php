# twilio-php

[![Tests](https://github.com/twilio/twilio-php/actions/workflows/test-and-deploy.yml/badge.svg)](https://github.com/twilio/twilio-php/actions/workflows/test-and-deploy.yml)
[![Packagist](https://img.shields.io/packagist/v/twilio/sdk.svg)](https://packagist.org/packages/twilio/sdk)
[![Packagist](https://img.shields.io/packagist/dt/twilio/sdk.svg)](https://packagist.org/packages/twilio/sdk)
[![Learn with TwilioQuest](https://img.shields.io/static/v1?label=TwilioQuest&message=Learn%20to%20contribute%21&color=F22F46&labelColor=1f243c&style=flat-square&logo=data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAIAAAACACAMAAAD04JH5AAAASFBMVEUAAAAZGRkcHBwjIyMoKCgAAABgYGBoaGiAgICMjIyzs7PJycnMzMzNzc3UoBfd3d3m5ubqrhfrMEDu7u739/f4vSb/3AD///9tbdyEAAAABXRSTlMAAAAAAMJrBrEAAAKoSURBVHgB7ZrRcuI6EESdyxXGYoNFvMD//+l2bSszRgyUYpFAsXOeiJGmj4NkuWx1Qeh+Ekl9DgEXOBwOx+Px5xyQhDykfgq4wG63MxxaR4ddIkg6Ul3g84vCIcjPBA5gmUMeXESrlukuoK33+33uID8TWeLAdOWsKpJYzwVMB7bOzYSGOciyUlXSn0/ABXTosJ1M1SbypZ4O4MbZuIDMU02PMbauhhHMHXbmebmALIiEbbbbbUrpF1gwE9kFfRNAJaP+FQEXCCTGyJ4ngDrjOFo3jEL5JdqjF/pueR4cCeCGgAtwmuRS6gDwaRiGvu+DMFwSBLTE3+jF8JyuV1okPZ+AC4hDFhCHyHQjdjPHUKFDlHSJkHQXMB3KpSwXNGJPcwwTdZiXlRN0gSp0zpWxNtM0beYE0nRH6QIbO7rawwXaBYz0j78gxjokDuv12gVeUuBD0MDi0OQCLvDaAho4juP1Q/jkAncXqIcCfd+7gAu4QLMACCLxpRsSuQh0igu0C9Svhi7weAGZg50L3IE3cai4IfkNZAC8dfdhsUD3CgKBVC9JE5ABAFzg4QL/taYPAAWrHdYcgfLaIgAXWJ7OV38n1LEF8tt2TH29E+QAoDoO5Ve/LtCQDmKM9kPbvCEBApK+IXzbcSJ0cIGF6e8gpcRhUDogWZ8JnaWjPXc/fNnBBUKRngiHgTUSivSzDRDgHZQOLvBQgf8rRt+VdBUUhwkU6VpJ+xcOwQUqZr+mR0kvBUgv6cB4+37hQAkXqE8PwGisGhJtN4xAHMzrsgvI7rccXqSvKh6jltGlrOHA3Xk1At3LC4QiPdX9/0ndHpGVvTjR4bZA1ypAKgVcwE5vx74ulwIugDt8e/X7JgfkucBMIAr26ndnB4UCLnDOqvteQsHlgX9N4A+c4cW3DXSPbwAAAABJRU5ErkJggg==)](https://twil.io/learn-open-source)

**The default branch name for this repository has been changed to `main` as of 07/27/2020.**

## Documentation

The documentation for the Twilio API can be found [here][apidocs].

The PHP library documentation can be found [here][libdocs].

## Versions

`twilio-php` uses a modified version of [Semantic Versioning](https://semver.org) for all changes. [See this document](VERSIONS.md) for details.

### Supported PHP Versions

This library supports the following PHP implementations:

* PHP 7.2
* PHP 7.3
* PHP 7.4
* PHP 8.0
* PHP 8.1

## Installation

You can install **twilio-php** via composer or by downloading the source.

### Via Composer:

**twilio-php** is available on Packagist as the
[`twilio/sdk`](https://packagist.org/packages/twilio/sdk) package:

```
composer require twilio/sdk
```

## Quickstart

### Send an SMS

```php
// Send an SMS using Twilio's REST API and PHP
<?php
$sid = "ACXXXXXX"; // Your Account SID from www.twilio.com/console
$token = "YYYYYY"; // Your Auth Token from www.twilio.com/console

$client = new Twilio\Rest\Client($sid, $token);
$message = $client->messages->create(
  '8881231234', // Text this number
  [
    'from' => '9991231234', // From a valid Twilio number
    'body' => 'Hello from Twilio!'
  ]
);

print $message->sid;
```

### Make a Call

```php
<?php
$sid = "ACXXXXXX"; // Your Account SID from www.twilio.com/console
$token = "YYYYYY"; // Your Auth Token from www.twilio.com/console

$client = new Twilio\Rest\Client($sid, $token);

// Read TwiML at this URL when a call connects (hold music)
$call = $client->calls->create(
  '8881231234', // Call this number
  '9991231234', // From a valid Twilio number
  [
      'url' => 'https://twimlets.com/holdmusic?Bucket=com.twilio.music.ambient'
  ]
);
```

### Specify Region and/or Edge

To take advantage of Twilio's [Global Infrastructure](https://www.twilio.com/docs/global-infrastructure), specify the target Region and/or Edge for the client:

```php
<?php
$sid = "ACXXXXXX"; // Your Account SID from www.twilio.com/console
$token = "YYYYYY"; // Your Auth Token from www.twilio.com/console

$client = new Twilio\Rest\Client($sid, $token, null, 'au1');
$client->setEdge('sydney');
```
A `Client` constructor without these parameters will also look for `TWILIO_REGION` and `TWILIO_EDGE` variables inside the current environment.

This will result in the `hostname` transforming from `api.twilio.com` to `api.sydney.au1.twilio.com`.

### Enable Debug Logging
There are two ways to enable debug logging in the default HTTP client. You can create an environment variable called `TWILIO_LOG_LEVEL` and set it to `debug` or you can set the log level to debug:
```php
$sid = "ACXXXXXX"; // Your Account SID from www.twilio.com/console
$token = "YYYYYY"; // Your Auth Token from www.twilio.com/console

$client = new Twilio\Rest\Client($sid, $token);
$client->setLogLevel('debug');
```

### Generating TwiML

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

### Handling Exceptions

For an example on how to handle exceptions in this helper library, please see the [Twilio documentation](https://www.twilio.com/docs/libraries/php/usage-guide#exceptions).

## Using a Custom HTTP Client

To use a custom HTTP client with this helper library, please see the [Twilio documentation](https://www.twilio.com/docs/libraries/php/custom-http-clients-php).

## Docker Image

The `Dockerfile` present in this repository and its respective `twilio/twilio-php` Docker image are currently used by Twilio for testing purposes only.

## Getting help

If you need help installing or using the library, please check the [Twilio Support Help Center](https://support.twilio.com) first, and [file a support ticket](https://twilio.com/help/contact) if you don't find an answer to your question.

If you've instead found a bug in the library or would like new features added, go ahead and open issues or pull requests against this repo!

[apidocs]: https://www.twilio.com/docs/api
[twiml]: https://www.twilio.com/docs/api/twiml
[libdocs]: https://twilio.github.io/twilio-php
