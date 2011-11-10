## A Brief Introduction

With version 3.0 we've simplified interaction with the Twilio
REST API. No more manually creating URLS or parsing XML/JSON.
You now interact with resources directly. Follow the [Quickstart
Guide](http://readthedocs.org/docs/twilio-php/en/latest/#quickstart)
to get up and running right now. The [User
Guide](http://readthedocs.org/docs/twilio-php/en/latest/#user-guide) shows you
how to get the most out of **twilio-php**.

## Prerequisites

* PHP >= 5.2.1
* The PHP JSON extension

## Quickstart

### Send a SMS

    require('Services/Twilio.php');

    $client = new Services_Twilio('AC123', '123');
    $message = $client->account->sms_messages->create(
      '9991231234', // From this number
      '8881231234', // Text this number
      "Hello monkey!"
    );

    print $message->sid;

### Make a Call

    require('Services/Twilio.php');

    $sid = "ACXXXXXX"; // Your Account SID from www.twilio.com/user/account
    $token = "YYYYYY"; // Your Auth Token from www.twilio.com/user/account

    $client = new Services_Twilio($sid, $token);
    $call = $client->account->calls->create(
      '9991231234', // From this number
      '8881231234', // Call this number

      // Read TwiML at this URL when a call connects (hold music)
      'http://twimlets.com/holdmusic?Bucket=com.twilio.music.ambient'
    );

### Generating TwiML

To control phone calls, your application needs to output
[TwiML](http://www.twilio.com/docs/api/twiml/ "Twilio Markup Language"). Use
`Services_Twilio_Twiml` to easily create such responses.

    require('Services/Twilio.php');

    $response = new Services_Twilio_Twiml();
    $response->say('Hello');
    $response->play('https://api.twilio.com/cowbell.mp3', array("loop" => 5));
    print $response;

That will output XML that looks like this:

    <?xml version="1.0" encoding="utf-8"?>
    <Response>
        <Say>Hello</Say>
        <Play loop="5">https://api.twilio.com/cowbell.mp3</Play>
    <Response>

## Installation

You can install **twilio-php** via PEAR or by downloading the source.

Download the [source](https://github.com/twilio/twilio-php/zipball/master)
which includes all dependencies.

Once you download the library, stick the folder in your project directory and
then include the library file:

    require 'Services/Twilio.php';

and you're good to go! 

### Via PEAR (>= 1.9.3):

Or use these PEAR commands to download the helper library:

    $ pear channel-discover twilio.github.com/pear
    $ pear install twilio/Services_Twilio

## Full Documentation

The documentation for **twilio-php** is hosted
at Read the Docs. [Click here to read our full
documentation.](http://readthedocs.org/docs/twilio-php/en/latest/ "Twilio PHP
Library Documentation")

## Reporting Issues

Did you run into trouble using our documentation? We would love
to hear your feedback. Report issues using the [Github Issue
Tracker](https://github.com/twilio/twilio-php/issues) or email
[help@twilio.com](mailto:help@twilio.com).

