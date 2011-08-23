## A Brief Introduction

With version 3.0 we've simplified interaction with the Twilio REST API. No more manually creating URLS or parsing XML/JSON. You now interact with resources directly. Follow the [Quickstart Guide](http://readthedocs.org/docs/twilio-php/en/latest/#quickstart) to get up and running right now. The [User Guide](http://readthedocs.org/docs/twilio-php/en/latest/#user-guide) shows you how to get the most out of **twilio-php**.

## Prerequisites

* PHP >= 5.2.1
* The PHP JSON extension

## Installing

### Via PEAR (>= 1.9.3):

    pear channel-discover twilio.github.com/pear
    pear install twilio/Services_Twilio

### From Source

Not using PEAR? Not a problem. Download the [source](https://github.com/twilio/twilio-php/zipball/master) which includes all dependencies.

## Quickstart

Want to get up running with **twilio-php** in minutes? Read through the quickstart [here](http://readthedocs.org/docs/twilio-php/en/latest/#quickstart). Highly suggested reading.

## Full Documentation

http://readthedocs.org/docs/twilio-php/en/latest/

## Reporting Issues

Report issues using the [Github Issue Tracker](https://github.com/twilio/twilio-php/issues) or email [help@twilio.com](mailto:help@twilio.com).

## Sample Code

### Making a Call

```php
require "Services/Twilio.php";

$sid = "ACXXXXXX"; // Your Twilio account sid
$token = "YYYYYY"; // Your Twilio auth token

$client = new Services_Twilio($sid, $token);
$call = $client->account->calls->create(
    '9991231234', // From this number
    '8881231234', // Call this number
    'http://foo.com/call.xml'
);
```

### Generating TwiML

To control phone calls, your application need to output TwiML. Use `Services_Twilio_Twiml` to easily create such responses.

```php
$response = new Services_Twilio_Twiml();
$response->say('Hello');
$response->play('monkey.mp3', array("loop" => 5));
print $response;
```

```xml
<?xml version="1.0" encoding="utf-8"?>
<Response>
  <Say>Hello</Say>
  <Play loop="5">monkey.mp3</Play>
</Response>
```


