[![Build Status](https://secure.travis-ci.org/twilio/twilio-php.png?branch=master)](http://travis-ci.org/twilio/twilio-php)

## Installation

You can install **twilio-php** via composer or by downloading the source.

#### Via Composer:

**twilio-php** is available on Packagist as the
[`twilio/sdk`](http://packagist.org/packages/twilio/sdk) package.

## Quickstart

### Send an SMS

```php
<?php
$sid = "ACXXXXXX"; // Your Account SID from www.twilio.com/user/account
$token = "YYYYYY"; // Your Auth Token from www.twilio.com/user/account

$client = new Twilio\Rest\Client($sid, $token);
$message = $client->account->messages->create(
  '8881231234', // Text this number
  '9991231234', // From a valid Twilio number
  array(
    'body' => "Hello monkey!"
  )
);

print $message->sid;
```

### Make a Call

```php
<?php
$sid = "ACXXXXXX"; // Your Account SID from www.twilio.com/user/account
$token = "YYYYYY"; // Your Auth Token from www.twilio.com/user/account

$client = new Twilio\Rest\Client($sid, $token);
$call = $client->account->calls->create(
  '8881231234', // Call this number
  '9991231234', // From a valid Twilio number
  array(
    // Read TwiML at this URL when a call connects (hold music)
    'url' => 'http://twimlets.com/holdmusic?Bucket=com.twilio.music.ambient'
  )
);
```

### Generating TwiML

To control phone calls, your application needs to output
[TwiML](http://www.twilio.com/docs/api/twiml/ "Twilio Markup Language"). Use
`Services_Twilio_Twiml` to easily create such responses.

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

### Release Candidate
This is a release candidate version of the PHP library. To submit feedback, open an issue on the Github repo.

## Documentation

The documentation for the Twilio API is located [here][apidocs].

The PHP library documentation can be found [here][documentation].

## Prerequisites

* PHP >= 5.3
* The PHP JSON extension

# Getting help

If you need help installing or using the library, please contact Twilio Support at help@twilio.com first. Twilio's Support staff are well-versed in all of the Twilio Helper Libraries, and usually reply within 24 hours.

If you've instead found a bug in the library or would like new features added, go ahead and open issues or pull requests against this repo!

[apidocs]: http://twilio.github.io/twilio-php/
[documentation]: https://twilio.com/api/docs
