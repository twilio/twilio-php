Twilio API helper library

## Installing

Via PEAR:

    pear channel-discover twilio.github.com/pear
    pear install twilio/Services_Twilio

If you aren't using PEAR, you can just download the [source](https://github.com/twilio/pear/blob/gh-pages/get/Services_Twilio-3.0.0.tar?raw=true>)

## Quickstart

Getting started with the Twilio API couldn't be easier. Create a Twilio REST client to get started. For example, the following code makes a call using the Twilio REST API.

### Making a Call

```php
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
print $response;
```

```xml
<?xml version="1.0" encoding="utf-8"?>
<Response><Play loop="5">monkey.mp3</Play><Response>
```

### Full Documentation

http://readthedocs.org/docs/twilio-php/en/latest/
