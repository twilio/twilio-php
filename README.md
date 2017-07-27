# twilio-php

[![Build Status](https://secure.travis-ci.org/twilio/twilio-php.png?branch=master)](http://travis-ci.org/twilio/twilio-php)
[![Packagist](https://img.shields.io/packagist/v/twilio/sdk.svg)](https://packagist.org/packages/twilio/sdk)
[![Packagist](https://img.shields.io/packagist/dt/twilio/sdk.svg)](https://packagist.org/packages/twilio/sdk)

## Recent Update

As of release 5.13.0, Beta and Developer Preview products are now exposed via
the main `twilio-php` artifact. Releases of the `alpha` branch have been
discontinued.

If you were using the `alpha` release line, you should be able to switch back
to the normal release line without issue.

If you were using the normal release line, you should now see several new
product lines that were historically hidden from you due to their Beta or
Developer Preview status. Such products are explicitly documented as
Beta/Developer Preview both in the Twilio docs and console, as well as through
in-line code documentation here in the library.

## Installation

You can install **twilio-php** via composer or by downloading the source.

#### Via Composer:

**twilio-php** is available on Packagist as the
[`twilio/sdk`](http://packagist.org/packages/twilio/sdk) package.

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
  array(
    'from' => '9991231234', // From a valid Twilio number
    'body' => 'Hello from Twilio!'
  )
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
  array(
      'url' => 'https://twimlets.com/holdmusic?Bucket=com.twilio.music.ambient'
  )
);
```

### Generating TwiML

To control phone calls, your application needs to output
[TwiML](https://www.twilio.com/docs/api/twiml/ "Twilio Markup Language"). Use
`Twilio\Twiml` to easily create such responses.

```php
<?php
$response = new Twilio\Twiml();
$response->say('Hello');
$response->play('https://api.twilio.com/cowbell.mp3', array("loop" => 5));
print $response;
```

That will output XML that looks like this:

```xml
<?xml version="1.0" encoding="utf-8"?>
<Response>
    <Say>Hello</Say>
    <Play loop="5">https://api.twilio.com/cowbell.mp3</Play>
<Response>
```

## Documentation

The documentation for the Twilio API is located [here][apidocs].

The PHP library documentation can be found [here][documentation].

## Versions

`twilio-php`'s versioning strategy can be found [here][versioning].

## Prerequisites

* PHP >= 5.3
* The PHP JSON extension

# Getting help

If you need help installing or using the library, please contact Twilio Support at help@twilio.com first. Twilio's Support staff are well-versed in all of the Twilio Helper Libraries, and usually reply within 24 hours.

If you've instead found a bug in the library or would like new features added, go ahead and open issues or pull requests against this repo!

[apidocs]: https://twilio.com/api/docs
[documentation]: https://twilio.github.io/twilio-php/
[versioning]: https://github.com/twilio/twilio-php/blob/master/VERSIONS.md
