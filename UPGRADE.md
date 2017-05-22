# Upgrade Guide

_After `5.1.1` all `MINOR` and `MAJOR` version bumps will have upgrade notes
posted here._

[2017-05-22] 5.9.x to 5.10.x
---------------------------

### CHANGED - Rename room `Recordings` resource to `RoomRecordings` to avoid class name conflict (backwards incompatible).

[2017-03-03] 5.5.x to 5.6.x
---------------------------

### CHANGED - Removed end of life Sandbox Resource

#### 5.5.x
```php
<?php

use Twilio\Rest\Client;

$client = new Client();
$client->api->v2010->sandbox->read();
```

#### 5.6.x
Not Supported.

#### Rationale
The Sandbox resource has been removed from the API and is no longer supported.

### CHANGED - Accounts property on Client now references Accounts subdomain

#### 5.5.x
```php
<?php

use Twilio\Rest\Client;

$client = new Client();
// Access api.twilio.com/2010-04-01/Accounts
$client->accounts->read();
```

#### 5.6.x
```php
<?php

use Twilio\Rest\Client;

$client = new Client();
// Access accounts.twilio.com/v1
$client->accounts;
// Access new PublicKeys resource
$client->accounts->credentials->publicKey->read();

// Access api.twilio.com/2010-04-01/Accounts
$client->api->v2010->accounts->read();
```

#### Rationale
`accounts.twilio.com` is now publicly available, following our convention of
accessing subdomains of twilio via `client->{subdomain}` we replaced the shortcut
to 2010 Accounts with a reference to the new Accounts subdomain. 2010 Accounts
are still accessible the long way `client->api->v2010->accounts` or `client->api->accounts`.

### CHANGED - Chat Messages listing methods now take options array as first parameter

#### 5.5.x
```php
<?php

use Twilio\Rest\Client;

$client = new Client();
$client->chat->messages->read(10); // limit to 10 messages
```

#### 5.6.x
```php
<?php

use Twilio\Rest\Client;

$client = new Client();
$client->chat->messages->read(array(), 10); // limit to 10 messages
$client->chat->messages->read(array(
    "order" => "asc"
), 10); // limit to 10 messages and filter by order
```

#### Rationale
Options arrays are placed at the beginning of the function signature if the resource accepts optional params and is ommited if the resource does not accept any. Chat messages previously did not accept any optional params and now do.


[2017-02-01] 5.4.x to 5.5.x
---------------------------

### CHANGED - Removed uri field from Pricing Phone Number Countries resource
  - the `uri` property on this object has been removed and is no longer returned by the api.
  - the `url` property is still present and unchanged and should be used instead of the `uri` property.

#### Rationale
This corrects a oversight in our code generation, new style resources such as this use `url` and `links` properties
while legacy resources use `uri` and `subresource_uris`. Previously we were incorrectly returning both `uri` and `url`.

### CHANGED - Use DateTime objects for dates and remove unsupported date query param filters
  - Listing some resources and filtering by `StartDate<`, `StartDate>`, `EndDate<`, and `EndDate>` will no longer work.
  - Filtering by `StartDate` and `EndDate` will continue to work, these dates are inclusive.
  - `StartDate` and `EndDate` params are now `DateTime` objects rather than `strings`. They will automcatically be converted to UTC timezone, the original DateTime object will not be modified.

#### Affected Resources
  - All Account Usage Record Resources (Last Month, This Month, Yesterday, All Time, Monthly, Yearly, Today, Daily).
  - Monitor Alerts, Events.
  - Taskrouter All Statistics endpoints (Workspace, TaskQueues, Workers...), Workspace Events.
  - Call Feedback Summaries.

#### 5.4.x
```php
<?php

use Twilio\Rest\Client;

$client = new Client();
$client->usage->records->read(array(
    "StartDate" => "1999-09-07",
    "EndDate<" => "2000-01-01"      // Allowed but would have had no effect.
));
```

#### 5.5.x
```php
<?php

use Twilio\Rest\Client;

$startDate = new DateTime("now", new DateTimeZone("America/Los_Angeles"));
$endDate = clone $startDate;
$endDate->add(new DateInterval("P2D")); // Add 2 days

$client = new Client();
$client->usage->records->read(array(
    "StartDate" => $startDate,
    "EndDate" => $endDate
));

// Passing strings will still work
$client->usage->records->read(array(
    "StartDate" => "1999-09-07" // OK
));
```

#### Rationale
Not serializing API Dates into DateTimes was an oversight initially, removing library support for date inequality filters (ie `StartDate>` etc) brings the library into alignment with the API behavior. Only select resources on our 2010 API support date inequalities, date inequalities were included on unsupported resources mistakenly and that functionality would never have worked anyways.

### CHANGED - Chat Members and Channels List Takes Optional Parameters
  - Reading members of channel and listing channels now takes an array of options as is its first argument.
  - Affects the `read`, `stream`, and `page` methods of MemberList.

#### 5.4.x
```php
<?php

use Twilio\Rest\Client;

$client = new Client();
$client->chat->v1->services('IS123')->channels('CH123')->members->read(10);
$client->chat->v1->services('IS123')->channels->read(10);
```

#### 5.5.x
```php
<?php

use Twilio\Rest\Client;

$client = new Client();
$client->chat->v1->services('IS123')->channels('CH123')->members->read(array(), 10);
$client->chat->v1->services('IS123')->channels->read(array(), 10);
$client->chat->v1->services('IS123')->channels('CH123')->members->read(array('type' => 'public'), 10);
```

### CHANGED - Remove ability to update type on Twilio Chat Channels

#### 5.5.x
```php
<?php

use Twilio\Rest\Client;

$client = new Client();
$client->chat->v1->services('IS123')->channels('CH123')->update(array('type'=>'public'));
```

#### 5.5.x
Not Supported

#### Rationale
Make library consistent with public API, changing channel type was never supported and wouldnt have worked in previous versions anyways.

### CHANGED - Chat Message Body parameter is no longer required on updates
  - Updating a message body no longer requires passing the body directly and is not required.

#### 5.4.x
```php
<?php

use Twilio\Rest\Client;

$client = new Client();
$client->chat->v1->services('IS123')->channels('CH123')->messages('IM123')->update('new body', array());
```

#### 5.5.x
```php
<?php

use Twilio\Rest\Client;

$client = new Client();
$client->chat->v1->services('IS123')->channels('CH123')->messages('IM123')->update(array('body' => 'new body'));
```

#### Rationale
This is a correction for what the API actually expects.

### CHANGED - Taskrouter Activity demote some parameters to be optional
  - Updating a taskrouter activity now optionally takes a `friendlyName` parameter (was previously required).
  - Creating a taskrouter activity now optionally takes a `available` parameter (was previously required).
  - Creating a taskrouter task now optional takes `workflowSid` and `attributes` (were both previously required).


#### 5.4.x
```php
<?php

use Twilio\Rest\Client;

$client = new Client();
$client->taskrouter->v1->workspaces('WS123')->activities('WA123')->update('new friendly name');
$client->taskrouter->v1->workspaces('WS123')->activities->create('new friendly name', true);
$client->taskrouter->v1->workspaces('WS123')->tasks->create('attributes', 'WW123', array('timeout' => 10));
```

#### 5.5.x
```php
<?php

use Twilio\Rest\Client;

$client = new Client();
$client->taskrouter->v1->workspaces('WS123')->activities('WA123')->update(array('friendlyName' => 'new friendly name'));
$client->taskrouter->v1->workspaces('WS123')->activities->create('new friendly name', array('available' => true));
$client->taskrouter->v1->workspaces('WS123')->tasks->create(array(
    'attributes' => 'attributes',
    'workflowSid' => 'WW123',
    'timeout' => 10
));
```

#### Rationale
This is a correction for what the API actually expects.

### CHANGED - Taskrouter Task list no longer filterable by TaskChannel
  - Previous version incorrectly allowed setting a `taskChannel` on a `TaskReadOptions` object, this is no longer supported.

#### Rationale
This is a correction for what the API actually allows. Previous versions allowed this to be set but it would not have
had any effect.

### CHANGED - Rename getStatistics to getTaskQueueStatistics method on Taskrouter TaskQueues

#### 5.4.x
```php
<?php

use Twilio\Rest\Client;

$client = new Client();

// Get statistics for a single task queue
$taskQueue = $client->taskrouter->v1->workspaces('WS123')->taskQueues('WQ123')->fetch();
$taskQueueStatistics = $taskQueue->getStatistics();

// Get statistics for all task queues
$client->taskrouter->v1->workspaces('WS123')->taskQueues->getStatistics();
```

#### 5.5.x
```php
<?php

use Twilio\Rest\Client;

$client = new Client();

// Get statistics for a single task queue
$taskQueue = $client->taskrouter->v1->workspaces('WS123')->taskQueues('WQ123')->fetch();
$taskQueueStatistics = $taskQueue->getTaskQueueStatistics();

// Get statistics for all task queues
$client->taskrouter->v1->workspaces('WS123')->taskQueues->getTaskQueuesStatistics();
```

#### Rationale
There was a naming conflict between TaskQueueStatistics and TaskQueuesStatistics. Both were trying to generate
methods named `getStatistics`.

### CHANGED - MMS Message Body parameter is now required on updates
  - Updating a message body now requires passing the body directly and is required.

#### 5.4.x
```php
<?php

use Twilio\Rest\Client;

$client = new Client();
$client->api->v2010->accounts('AC123')->messages('MM123')->update(array('body' => ''));
```

#### 5.5.x
```php
<?php

use Twilio\Rest\Client;

$client = new Client();
$client->api->v2010->accounts('AC123')->messages('MM123')->update('');
```

#### Rationale
This is used to redact a message body and the api expects the body parameter to be present, allowing
this to be an optional parameter was an oversight.

### CHANGED - Queues now require friendlyName parameter on creation
  - Updating a message body now requires passing the body directly and is required.

#### 5.4.x
```php
<?php

use Twilio\Rest\Client;

$client = new Client();
$client->api->v2010->accounts('AC123')->queues('QU123')->create(array('friendlyName' => 'Test'));
```

#### 5.5.x
```php
<?php

use Twilio\Rest\Client;

$client = new Client();
$client->api->v2010->accounts('AC123')->queues('QU123')->create('Test', array());
```

#### Rationale
This was made to enforce consistency with the API, the API will return a 400 if a friendlyName is not
provided.


[2016-09-15] 5.3.x to 5.4.x
---------------------------

### CHANGED - IP Messaging / Chat Roles Update
  - `RoleInstance::update(string $friendlyName, string[] $permission)` to `RoleInstance::update(string[] $permission)`
  - `RoleContext::update(string $friendlyName, string[] $permission)` to `RoleContext::update(string[] $permission)`

#### 5.3.x
```php
<?php

use Twilio\Rest\Client;

$client = new Client();
$client->chat->services('IS123')->roles('RL123')->update('Example Role', array('permission'));

```

#### 5.4.x
```php
<?php

use Twilio\Rest\Client;

$client = new Client();
$client->chat->services('IS123')->roles('RL123')->update(array('permission'));

```

#### Rationale
Role Updates do not support updating the friendlyName.

### CHANGED - Page Load Exception
  - `Page::processResponse(Response $response) throws DeserializeException` to `Page::processResponse(Response $response) throws RestException`

#### 5.3.x
```php
<?php

use Twilio\Rest\Client;
use Twilio\Exceptions\DeserializeException;

$client = new Client();

try {
    $calls = $client->calls->read();
} catch (DeserializeException $e) {
    echo("Error reading: {$e->getMessage()}");
}
```

#### 5.4.x
```php
<?php

use Twilio\Rest\Client;
use Twilio\Exceptions\RestException;

$client = new Client();

try {
    $calls = $client->calls->read();
} catch (RestException $e) {
    echo("Error reading: {$e->getMessage()}");
}
```

Alternatively

```php
<?php

use Twilio\Rest\Client;
use Twilio\Exceptions\TwilioException;

$client = new Client();

try {
    $calls = $client->calls->read();
} catch (TwilioException $e) {
    echo("Error reading: {$e->getMessage()}");
}
```

#### Rationale
Exceptions were improved to include more information about what went wrong.  The
`Page` class that is used by `read` and `stream` was missed, this bring `Page`
up to parity with other exceptions.

The Exception class was changed to reflect that the failure is not in processing
the response (Deserialization) but that the response is invalid (Rest).

[2015-08-30] 5.2.x to 5.3.x
---------------------------

### CHANGED - SIP Credential Update
  - `CredentialInstance::update(string $username, string $password)` to `CredentialInstance::update(array|CredentialOptions $options)`
  - `CredentialContext::update(string $username, string $password)` to `CredentialContext::update(array|CredentialOptions $options)`

#### 5.2.x
```php
<?php

use Twilio\Rest\Client;

$client = new Client();
$client->sip->credentialLists('CL123')->credentials('CA123')->update('username', 'password');
```

#### 5.3.x
```php
<?php

use Twilio\Rest\Client;

$client = new Client();
$client->sip->credentialLists('CL123')->credentials('CA123')->update(array(
    'password' => 'password'
));
```

#### Rationale
Credential Updates only supported Updating the password and it is an optional parameter.


### CHANGED - Chat/IP Messaging Role Creation

#### 5.2.x
```php
<?php

use Twilio\Rest\Client;

$client = new Client();
$client->chat->v1->services('IS123')->users->create('identity', 'RL123');
```

#### 5.3.x
```php
<?php

use Twilio\Rest\Client;

$client = new Client();
$client->chat->v1->services('IS123')->users->create('identity', array(
    'roleSid' => 'RL123'
));
```

#### Rationale
As the Chat product has evolved, we have added a default Role sid to User creation
making the parameter optional.


[2016-08-29] 5.1.x to 5.2.x
---------------------------

### CHANGED - Conference Participant Update

  - `ParticipantInstance::update(boolean $muted)` to `ParticipantInstance::update(array|ParticipantOptions $options)`
  - `ParticipantContext::update(boolean $muted)` to `ParticipantContext::update(array|ParticipantOptions $options)`

#### 5.1.x
```php
<?php

use Twilio\Rest\Client;

$client = new Client();
$client->conferences('CF123')->participants('CA123')->update(true);
```

#### 5.2.x
```php
<?php

use Twilio\Rest\Client;

$client = new Client();
$client->conferences('CF123')->participants('CA123')->update(array(
    'muted' => true,
));
```
#### Rationale

Conference Participants actually support a wider range of mutations than the
`5.1.x` library supported.  Mute was incorrectly marked as a `required` property
when it is actually `optional`.  This change allows the library to provide
support for the full range of mutation options.

|  Option    | Definition                                                                                                                                                                             |
|:-----------|:---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|
| hold       | Specifying true will hold the participant, while false will un-hold.                                                                                                                   |
| holdUrl    | The 'HoldUrl' attribute lets you specify a URL for music that plays when a participant is held. The URL may be an MP3, a WAV or a TwiML document that uses <Play> <Say> or <Redirect>. |
| holdMethod | Specify GET or POST, defaults to POST                                                                                                                                                  |
| muted      | Specifying true will mute the participant, while false will un-mute. Anything other than true or false is interpreted as false.                                                        |

[Full documentation](https://www.twilio.com/docs/api/rest/participant#instance-post)

### CHANGED - Taskrouter Workflow Create

  - `WorkflowList::create(string $friendlyName, string $configuration, string $assignmentCallbackUrl, array|WorkflowOptions $options)` to `WorkflowList::create(string $friendlyName, string $configuration, array|WorkflowOptions $options)`

#### 5.1.x
```php
<?php

use Twilio\Rest\Client;

$client = new Client();
$client->taskrouter->workspaces('WS123')->workflows->create(
    'My New Workflow',
    '{...}',
    'http://assignment-callback-url.com'
);
```

#### 5.2.x
```php
<?php

use Twilio\Rest\Client;

$client = new Client();
$client->taskrouter->workspaces('WS123')->workflows->create(
    'My New Workflow',
    '{...}',
    array(
        'assignmentCallbackUrl' => 'http://assignment-callback-url.com',
    )
);
```

#### Rationale

When Taskrouter was first released all workflows had to communicate reservations
back to a server for handling.  As the product has matured a capable JavaScript
SDK has been released that can handle reservations.  This change allows one to
use Taskrouter without an `assignmentCallbackUrl` instead using the client
events to handle reservations.

[Full documentation](https://www.twilio.com/docs/api/taskrouter/worker-js)
