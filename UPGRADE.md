# Upgrade Guide

_After `5.1.1` all `MINOR` and `MAJOR` version bumps will have upgrade notes 
posted here._

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