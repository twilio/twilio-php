twilio-php Changelog
====================

[2017-10-27] Version 5.15.4
----------------------------
**Chat**
- Add Binding resource
- Add UserBinding resource


[2017-10-20] Version 5.15.3
----------------------------
**Api**
- Add `address_sid` param to IncomingPhoneNumbers create and update
- Add 'fax_enabled' option for Phone Number Search


[2017-10-13] Version 5.15.2
----------------------------
**Api**
- Add `smart_encoded` param for Messages
- Add `identity_sid` param to IncomingPhoneNumbers create and update

**Preview**
- Make 'address_sid' and 'email' optional fields when creating a HostedNumberOrder
- Add AuthorizationDocuments preview API.

**Proxy**
- Initial Release

**Wireless**
- Added `ip_address` to sim resource


[2017-10-06] Version 5.15.1
----------------------------
**Preview**
- Add `acc_security` (authy-phone-verification) initial api-definitions

**Taskrouter**
- [bi] Less verbose naming of cumulative and real time statistics


[2017-09-28] Version 5.15.0
----------------------------
**Library**
- Add warnings when trying to import/use objects from legacy versions of the library.

**Chat**
- Make member accessible through identity
- Make channel subresources accessible by channel unique name
- Set get list 'max_page_size' parameter to 100
- Add service instance webhook retry configuration
- Add media message capability
- Make `body` an optional parameter on Message creation. *(breaking change)*

**Notify**
- `data`, `apn`, `gcm`, `fcm`, `sms` parameters in `Notifications` create resource now accept objects instead of strings. Passing manually stringified json objects will continue to work.

**Taskrouter**
- Add new query ability by TaskChannelSid or TaskChannelUniqueName
- Move Events, Worker, Workers endpoint over to CPR
- Add new RealTime and Cumulative Statistics endpoints

**Video**
- Create should allow an array of video_codecs.
- Add video_codecs as a property of room to make it externally visible.


[2017-09-15] Version 5.14.1
----------------------------
**Api**
- Add `sip_registration` property on SIP Domains
- Add new video and market usage category keys


[2017-09-01] Version 5.14.0
----------------------------
**TwiML**
- Add classes for all TwiML verbs.

[2017-09-01] Version 5.13.4
----------------------------
**Sync**
- Add support for Streams

**Wireless**
- Added DataSessions sub-resource to Sims.


[2017-08-25] Version 5.13.3
----------------------------
**Library**
- Add `lastRequest` and `lastResponse` properties to `CurlClient` to help debugging.

**Api**
- Update `status` enum for Recordings to include 'failed'
- Add `errorCode` property on Recordings

**Chat**
- Add mutable parameters for channel, members and messages

**Video**
- New `media_region` parameter when creating a room, which controls which region media will be served out of.


[2017-08-18] Version 5.13.2
----------------------------
**Api**
- Add VoiceReceiveMode {'voice', 'fax'} option to IncomingPhoneNumber UPDATE requests

**Chat**
- Add channel message media information
- Add service instance message media information

**Preview**
- Removed 'email' from bulk_exports configuration api [bi]. No migration plan needed because api has not been used yet.
- Add DeployedDevices.

**Sync**
- Add support for Service Instance unique names


[2017-08-10] Version 5.13.1
----------------------------
**Api**
- Add New wireless usage keys added
- Add `auto_correct_address` param for Addresses create and update
- Add ChatGrant to Grants and deprecate IpMessagingGrant

**Video**
- Add `video_codec` enum and `video_codecs` parameter, which can be set to either `VP8` or `H264` during room creation.
- Restrict recordings page size to 100


[2017-07-27] Version 5.13.0
----------------------------
This release adds Beta and Preview products to main artifact.

Previously, Beta and Preview products were only included in the `alpha`
artifact. They are now being included in the main artifact to ease product
discoverability and the collective operational overhead of maintaining multiple
artifacts per library.

**Api**
- Remove unused `encryption_type` property on Recordings *(breaking change)*
- Update `status` enum for Messages to include 'accepted'

**Messaging**
- Fix incorrectly typed capabilities property for PhoneNumbers.

**Notify**
- Add `ToBinding` optional parameter on Notifications resource creation. Accepted values are json strings.

**Preview**
- Add `sms_application_sid` to HostedNumberOrders.

**Taskrouter**
- Fully support conference functionality in reservations.


[2017-07-13] Version 5.12.1
---------------------------
- This release drops official support for PHP 5.3 and PHP 5.4, which were EOL'd
  in 2014 and 2015 respectively.
- Reinstate `getPage` functionality.


[2017-07-13] Version 5.12.0
----------------------------
**Api**
- Update `AnnounceMethod` parameter naming for consistency

**Notify**
- Add `ToBinding` optional parameter on Notifications resource creation. Accepted values are json strings.

**Preview**
- Add `verification_attempts` to HostedNumberOrders.
- Add `status_callback_url` and `status_callback_method` to HostedNumberOrders.

**Video**
- Filter recordings by date using the parameters `DateCreatedAfter` and `DateCreatedBefore`.
- Override the default time-to-live of a recording's media URL through the `Ttl` parameter (in seconds, default value is 3600).
- Add query parameters `SourceSid`, `Status`, `DateCreatedAfter` and `DateCreatedBefore` to the convenience method for retrieving Room recordings.

**Wireless**
- Added national and international data limits to the RatePlans resource.


[2017-06-16] Version 5.11.0
---------------------------

- Add `locality` field to `AvailablePhoneNumbers`.
- Add `origin` field to `IncomingPhoneNumbers`.
- Add `in_locality` parameter to `AvailablePhoneNumbers`.
- Add `origin` parameter to `IncomingPhoneNumbers`.
- Add `announce_url` parameter to `Participants`.
- Add `announce_url_method` parameter to `Participants`.
- Add `getPage()` methods to lists to begin paging starting from a given url.

[2017-05-24] Version 5.10.0
--------------------------
- Rename room `Recordings` resource to `RoomRecordings` to avoid class name conflict (backwards incompatible).

[2017-05-19] Version 5.9.0
--------------------------
- Add support for video.twilio.com.

[2017-04-27] Version 5.8.0
--------------------------
- Add support for Twilio Chat v2
- Add `recordingChannels`, `recordingStatusCallback`, `recordingStatusCallbackMethod`, `sipAuthUsername`, `sipAuthPassword`, `region`, `conferenceRecordingStatusCallback`, `conferenceRecordingStatusCallbackMethod` optional parameters to conference participant resource.
- Add support for setting `DEBUG_HTTP_TRAFFIC=true` environment varibale to dump request and response information. Thanks @kevinburke, PR #394.
- Add deprecation warning to `ConversationsGrant`, it is being replaced by `VideoGrant`.

[2017-04-12] Version 5.7.3
--------------------------
- Add TaskRouterGrant.
- Update VideoGrant.
    - Add `room` as preferred grant granularity.
    - Deprecate setting `configurationProfileSid` on grant.

[2017-04-04] Version 5.7.2
--------------------------
- Add `validityPeriod` parameter to Message creation

[2017-03-22] Version 5.7.1
--------------------------
- Add Answering Machine Detection to Call creation
- Add `WRAPPING` entry to Status for Task

- **Twilio Chat**
  - Add `limits` map to Service
  - Add `limitsChannelMembers` and `limitsUserChannels` field to ServiceUpdater

[2017-03-13] Version 5.7.0
--------------------------
Breaking Changes, refer to [Upgrade Guide][upgrade]

 - Restore ability to transfer IncomingPhoneNumbers between accounts.

[2017-03-03] Version 5.6.0
-------------------------
Breaking Changes, refer to [Upgrade Guide][upgrade]

 - Remove end of life Sandbox resource (backwards incompatible).
 - Support new `accounts.twilio.com` subdomain and products.
    - `client->accounts` now references `accounts.twilio.com` instead of Accounts resource (backwards incompatible).
 - Fix resources throwing error on instantiation when response is missing a field.
 - Chat:
    - Add `order` as filter when listing Messages.
    - Messages `.read()`, `.stream()`, `.page()` now accept options array as first parameter (backwards incompatible).


[2017-02-01] Version 5.5.0
-------------------------
Breaking Changes, refer to [Upgrade Guide][upgrade]

 - Fix broken default page size for all reads, thanks @rtek! Issue [#388] (https://github.com/twilio/twilio-php/issues/388)
    - Credential List Mappings, IP ACL Mappings, SIP Domains.
 - Fix incorrect types documentation of `links`/`subresourceUri` fields on various resources. Was incorrectly documented as string, actual type was an array.
 - Fix some properties incorrectly documented as `string` when actually were `array` types.
 - Fix boolean parameters did not accept boolean values, now accept both boolean and strings for backwards compatibility.
 - Add `emergencyEnabled` field to Addresses.
 - Add `price` and `callSid` fields to Recordings.
    - Allow filtering recordings list by call sid.
 - Add `trunkSid`, `emergencyStatus`, and `emergencyAddressSid` fields to IncomingPhoneNumbers.
 - Add `messagingServiceSid` field to Messages.
 - Add `url` and/or `links` fields to various resources which were missing them.
    - Lookups PhoneNumber, Monitor Events.
 - Add `subresourceUri` fields to resources where missing.
 - Accept DateTime inputs for date parameters for various resources, previously expected strings.
 - Remove `uri` field from Pricing Phone Number Countries resource (backwards incompatible).
 - Properly deserialize date times for various resources (backwards incompatible).
 - Remove library support for date inquality for resources that don't support them (backwards incompatible).
 - Message `body` parameter now required on update (backwards incompatible).
 - Require `friendlyName` on Queue creation (backwards incompatible).

 - Taskrouter
    - Add `url` and/or `links` fields to resources where missing.
        - Activities, Reservations, TaskQueue Statistics, WorkerStatistics, WorkersStatistics, Worker, Workflow, WorkflowStatistics, WorkspaceStatistics, Tasks, TaskQueues, Workspaces.
    - Add `addons`, `taskQueueFriendlyName`, `workflowFriendlyName` fields to Tasks.
    - Add `taskOrder` field to TaskQueues, allow updating `taskOrder`.
    - Add `prioritizeQueueOrder` field to Workspace.
    - Allow filtering Tasks list by `evaluateTaskAttributes`, `ordering`, `hasAddons`.
    - Disallow filtering Tasks list by `taskChannel`, was never supported.
    - Allow filtering TaskQueues list by `workerSid` and `taskOrder`.
    - Allow updating `prioritizeQueueOrder` on Workspaces.
    - Demote `friendlyName` to optional parameter when updating Activities (backwards incompatible).
    - Demote `available` to optional parameter when creating Activities (backwards incompatible).
    - Demote `workflowSid` and `attributes` to optional parameters when creating a Task (backwards incompatible).
    - Remove `friendlyName` as optional parameter when fetching Task Queue Statistics (backwards incompatible).
    - WorkspaceStatistics now take `DateTime` objects when filtering by `startDate` and `endDate` (backwards incompatible).

 - Chat
    - Add `Secret` field to Chat credentials and allow setting on create and update.
    - Add Channel Invite resource.
    - Add `lastConsumedMessageIndex` and `lastConsumptionTimestamp` fields to Channel Members.
    - `Body` parameter no longer required for updating a message.
    - Add `attributes` and `index` fields to Messages.
    - Add `membersCount` and `messagesCount` to Channels.
    - Add UserChannel resource.
    - Add `attributes`, `friendlyName`, `isOnline`, `isNotifiable`, `links` to Users.
    - Add `reachabilityEnabled`, `preWebhookUrl`, `postWebhookUrl`, `webhookMethod`, `webhookFilters`, `notifications` to Services.
    - Fix webhooks, notifications updating on Service by separating into individual parameters.
    - Remove ability to update `type` on Channels, was never supported by api (backwards incompatible).
    - Demote update Message `body` to optional parameter (backwards incompatible).

 - Conferences
    - Add `status` field to Participants.
    - Add ability to add/remove Participants via the API.
    - Add ability to end Conferences via the API.
    - Add `region` and `subresourceUri` fields to Conference.

 - Marketplace
    - Add resources for Recording AddOns.
        - AddOnResults.
        - AddOnResultPayloads.
    - Add `getAddOnResults` helper to Recordings.


[2016-10-12] Version 5.4.2
--------------------------

 - Add `InstanceResource::toArray()`

Thanks to @johnpaulmedina for this suggestion.

[2016-09-19] Version 5.4.1
--------------------------

  - Add Video Grant

[2016-09-15] Version 5.4.0
--------------------------
**Breaking Changes, refer to [Upgrade Guide][upgrade]**

  - Remove required parameter `friendlyName` on IP Messaging/Chat Role update.
  - Alphabetize domain mounts
  - Better exceptions when an error is encountered loading a page of records,
    the exception class has been corrected from `DeserializeException` to
    `RestException`.

[2016-08-30] Version 5.3.0
--------------------------
**Breaking Changes, refer to [Upgrade Guide][upgrade]**

  - Demote `password` to optional and remove unsupported `username` on
    SIP Credential Update
  - Demote `RoleSid` to optional and add optional `attributes`, `friendlyName`
    parameters on IP Messaging/Chat User creation
  - Add optional `attributes` parameter on IP Messaging/Chat message creation


[2016-08-29] Version 5.2.0
--------------------------
**Breaking Changes, refer to [Upgrade Guide][upgrade]**

  - New options for Conference Participant management.
     - Adds support for `hold`, `holdUrl`, `holdMethod`
  - Mount `ip-messaging` under the new `chat` domain
  - Demote `assignmentCallbackUrl` from a required argument to optional for
    Taskrouter Workflows to better support client managed reservations.

[2016-08-29] Version 5.1.1
--------------------------
Changes the way that `uri`s are constructed to make sure that they are always
`rawurlencode()`d by the `twilio-php` library

Updates the output of the unit tests on failure introducing a new method,
`assertRequest()`, that will output a friendlier error message when a request is
missing in the `Holodeck` network mock.

[2016-08-19] Version 5.1.0
--------------------------
Optional arguments are handled in the `twilio-php` by accepting an associative
array of optional keys and values to pass to the API.  This makes it easy to
support all the optional parameters, but lessens developer ergonomics, since it
doesn't provide any inline documentation or autocomplete for optional arguments.

This change introduces new Options builders that support 2 new ways for
specifying optional arguments that provide better usability.

```php
<?php

use Twilio\Values;
use Twilio\Rest\Client;
use Twilio\Rest\Api\V2010\Account\CallOptions;

$client = new Client();

// Original Way (5.0.x)
$client->calls->create(
    '+14155551234',
    '+14155557890',
    array(
        'applicationSid' => 'AP123',
        'method' => 'POST',
    )
);

// Options Factory
$client->calls->create(
    '+14155551234',
    '+14155557890',
    CallOptions::create(
        Values::NONE,
        'AP123',
        'POST'
    )
);

// Options Builder
$client->calls->create(
    '+14155551234',
    '+14155557890',
    CallOptions::create()->setApplicationSid('AP123')
                         ->setMethod('POST')
);
```

The `Options Factory` provides fully documented optional arguments for every
optional argument supported by the Resource's Action.  This is a fast way to
handle endpoints that have a few optional arguments.

The `Options Builder` provides fully documented setters for every optional
arguments, this is great for actions that support a large number of optional
arguments, so that you don't need to provided tons of default values.

Both of these options work well with autocompleting IDEs.

[2016-08-18] Version 5.0.3
--------------------------
- Adds the ability to pass options into `Twilio\Http\CurlClient`.  This feature
  brings `CurlClient` closer to parity with `Services_Twilio_TinyHttp`.

[2016-08-16] Version 5.0.2
--------------------------
- Fixes a bug where reading lists with a `$limit` and no `$pageSize` would cause
  a divide by zero error.
- Sanity check in the `Twiml` generator
- Better tests for `Twiml` and `Version`

[2016-08-15] Version 5.0.1
--------------------------
Add the VERSIONS.md to explain the versioning strategy, first alpha release.

[2016-08-15] Version 5.0.0
--------------------------
**New Major Version**

The newest version of the `twilio-php` helper library, supporting PHP 5.3+

This version brings a host of changes to update and modernize the `twilio-php`
helper library.  It is auto-generated to produce a more consistent and correct
product.

- [Migration Guide](https://www.twilio.com/docs/libraries/php/migration-guide)
- [Full API Documentation](https://twilio.github.io/twilio-php/)
- [General Documentation](https://www.twilio.com/docs/libraries/php)

Version 4.11.0
--------------
Released August 9, 2016

- Add `synchronize` method to InstanceResoure

Version 4.10.0
-------------
Released January 28, 2016

- Add support for filter_friendly_name in WorkflowConfig
- Load reservations by default in TaskRouter

Version 4.9.2
-------------
Released January 22, 2016

- Fix Address instance reference

Version 4.9.1
-------------
Released January 19, 2016

- Add missing create/delete methods on Address

Version 4.9.0
-------------
Released December 18, 2015

- Add IP Messaging capability

Version 4.8.1
-------------
Released December 8, 2015

- Fix issue with empty grant encoding

Version 4.8.0
-------------
Released December 8, 2015

- Update access tokens to support optional NBF

Version 4.7.0
-------------
Released December 3, 2015

- Add access tokens

Version 4.6.1
-------------
Released November 9, 2015

- Secured Signature header validation from timing attack

Version 4.6.0
-------------
Released October 30, 2015

- Add support for Keys

Version 4.4.0
-------------
Released September 21, 2015

- Add support for messaging in Twilio Pricing API
- Add support for Elastic SIP Trunking API

Version 4.3.0
-------------

Released August 11, 2015

- Add support for new Taskrouter JWT Functionality, JWTs now grant access to
  - Workspace
  - Worker
  - TaskQueue

Version 4.2.1
-------------

Released June 9, 2015

- Update install documentation

Version 4.2.0
-------------

Released May 19, 2015

- Add support for the beta field in IncomingPhoneNumbers and AvailablePhoneNumbers

Version 4.1.0
-------------

Released May 7, 2015

- Add support for Twilio Monitor Events and Alerts

Version 4.0.4
-------------

Released May 6, 2015

- Add support for the new Pricing API.

Version 4.0.3
-------------

Released on April 29, 2015

- Fix to add rawurlencoding to phone number lookups to support spaces

Version 4.0.2
-------------

Released on April 27, 2015

- Fix the autoloading so that Lookups_Services_Twilio and
  TaskRouter_Services_Twilio are available independently of Services_Twilio

Version 4.0.1
-------------

Released on April 22, 2015

- Make Lookups_Services_Twilio and TaskRouter_Services_Twilio available through
  Composer.

Version 4.0.0
-------------

Released on April 16, 2015

- Removes counts from ListResource
- Change Services_Twilio::getRequestUri() from a static method to an instance
  method.

Version 3.13.1
--------------

Released on March 31, 2015

- Add new Lookups API client

Version 3.13.0
--------------

Released on February 18, 2015

- Add new TaskRouter API client
- Miscellaneous doc fixes

Version 3.12.8
--------------

Released on December 4, 2014

- Add support for the new Addresses endpoints.

Version 3.12.7
--------------

Released on November 21, 2014

- Add support for the new Tokens endpoint

Version 3.12.6
--------------

Released on November 13, 2014

- Add support for redacting Messages and deleting Messages or Calls
- Remove pinned SSL certificates

Version 3.12.5
--------------

Released on July 15, 2014

- Changed the naming of the SIP class to comply with PSR-0

Version 3.12.4
--------------

Released on January 30, 2014

- Fix incorrect use of static:: which broke compatibility with PHP 5.2.

Version 3.12.3
--------------

Released on January 28, 2014

- Add link from recordings to associated transcriptions.
- Document how to debug requests, improve TwiML generation docs.

Version 3.12.2
--------------

Released on January 5, 2014

- Fixes string representation of resources
- Support PHP 5.5

Version 3.12.1
--------------

Released on October 21, 2013

- Add support for filtering by type for IncomingPhoneNumbers.
- Add support for searching for mobile numbers for both
IncomingPhoneNumbers and AvailablePhoneNumbers.

Version 3.12.0
--------------

Released on September 18, 2013

- Support MMS
- Support SIP In
- $params arrays will now turn lists into multiple HTTP keys with the same name,

        array("Twilio" => array('foo', 'bar'))

    will turn into Twilio=foo&Twilio=bar when sent to the API.

- Update the documentation to use php-autodoc and Sphinx.

Version 3.11.0
--------------

Released on June 13

- Support Streams when curl is not available for PHP installations

Version 3.10.0
--------------

Released on February 2, 2013

- Uses the [HTTP status code for error reporting][http], instead of the
`status` attribute of the JSON response. (Reporter: [Ruud Kamphuis](/ruudk))

[http]: https://github.com/twilio/twilio-php/pull/116

Version 3.9.1
-------------

Released on December 30, 2012

- Adds a `$last_response` parameter to the `$client` object that can be
used to [retrieve the raw API response][last-response]. (Reporter: [David
Jones](/dxjones))

[last-response]: https://github.com/twilio/twilio-php/pull/112/files

Version 3.9.0
-------------

Released on December 20, 2012

- [Fixes TwiML generation to handle non-ASCII characters properly][utf-8]. Note
  that as of version 3.9.0, **the library requires PHP version 5.2.3, at least
  for TwiML generation**. (Reporter: [Walker Hamilton](/walker))

[utf-8]: https://github.com/twilio/twilio-php/pull/111

Version 3.8.3
-------------

Released on December 15, 2012

- [Fixes the ShortCode resource][shortcode] so it is queryable via the PHP library.

 [shortcode]: https://github.com/twilio/twilio-php/pull/108

Version 3.8.2
-------------

Released on November 26, 2012

- Fixes an issue where you [could not iterate over the members in a
queue][queue-members]. (Reporter: [Alex Chan](/alexcchan))

[queue-members]: https://github.com/twilio/twilio-php/pull/107

Version 3.8.1
-------------

Released on November 23, 2012

- [Implements the Countable interface on the ListResource][countable], so you
  can call count() on any resource.
- [Adds a convenience method for retrieving a phone number object][get-number],
  so you can retrieve all of a number's properties by its E.164 representation.

Internally:

- Adds [unit tests for url encoding of Unicode characters][unicode-tests].
- Updates [Travis CI configuration to use Composer][travis-composer],
shortening build time from 83 seconds to 21 seconds.

[countable]: https://twilio-php.readthedocs.org/en/latest/usage/rest.html#retrieving-the-total-number-of-resources
[get-number]: https://twilio-php.readthedocs.org/en/latest/usage/rest/phonenumbers.html#retrieving-all-of-a-number-s-properties
[unicode-tests]: https://github.com/twilio/twilio-php/commit/6f8aa57885796691858e460c8cea748e241c47e3
[travis-composer]: https://github.com/twilio/twilio-php/commit/a732358e90e1ae9a5a3348ad77dda8cc8b5ec6bc

Version 3.8.0
-------------

Released on October 17, 2012

- Support the new Usage API, with Usage Records and Usage Triggers. Read the
  PHP documentation for [usage records][records] or [usage triggers][triggers]

  [records]: https://twilio-php.readthedocs.org/en/latest/usage/rest/usage-records.html
  [triggers]: https://twilio-php.readthedocs.org/en/latest/usage/rest/usage-triggers.html

Version 3.7.2
-------------

- The library will now [use a standard CA cert whitelist][whitelist] for SSL
    validation, replacing a file that contained only Twilio's SSL certificate.
    (Reporter: [Andrew Benton](/andrewmbenton))

 [whitelist]: https://github.com/twilio/twilio-php/issues/88

Version 3.7.1
-------------

Released on August 16, 2012

- Fix a bug in the 3.5.0 release where [updating an instance
  resource would cause subsequent updates to request an incorrect
  URI](/twilio/twilio-php/pull/82).
  (Reporter: [Dan Bowen](/crucialwebstudio))

Version 3.7.0
-------------

Released on August 6, 2012

- Add retry support for idempotent HTTP requests that result in a 500 server
  error (default is 1 attempt, however this can be configured).
- Throw a Services_Twilio_RestException instead of a DomainException if the
  response content cannot be parsed as JSON (usually indicates a 500 error)

Version 3.6.0
-------------

Released on August 5, 2012

- Add support for Queues and Members. Includes tests and documentation for the
  new functionality.

Version 3.5.2
-------------

Released on July 23, 2012

- Fix an issue introduced in the 3.5.0 release where updating or muting
  a participant would [throw an exception instead of muting the
  participant][mute-request].
  (Reporter: [Alex Chan](/alexcchan))

- Fix an issue introduced in the 3.5.0 release where [filtering an iterator
with parameters would not work properly][paging-request] on subsequent HTTP
requests. (Reporters: [Alex Chan](/alexcchan), Ivor O'Connor)

[mute-request]: /twilio/twilio-php/pull/74
[paging-request]: /twilio/twilio-php/pull/75

Version 3.5.1
-------------

Released on July 2, 2012

- Fix an issue introduced in the 3.5.0 release that would cause a second HTTP
request for an instance resource [to request an incorrect URI][issue-71].

[issue-71]: https://github.com/twilio/twilio-php/pull/71

Version 3.5.0
-------------

Released on June 30, 2012

- Support paging through resources using the `next_page_uri` parameter instead
of manually constructing parameters using the `Page` and `PageSize` parameters.
Specifically, this allows the library to use the `AfterSid` parameter, which
leads to improved performance when paging deep into your resource list.

This involved a major refactor of the library. The documented interface to
twilio-php will not change. However, some undocumented public methods are no
longer supported. Specifically, the following classes are no longer available:

- `Services/Twilio/ArrayDataProxy.php`
- `Services/Twilio/CachingDataProxy.php`
- `Services/Twilio/DataProxy.php`

In addition, the following public methods have been removed:

- `setProxy`, in `Services/Twilio/InstanceResource.php`
- `getSchema`, in `Services/Twilio/ListResource.php`,
    `Services/Twilio/Rest/AvailablePhoneNumbers.php`,
    `Services/Twilio/Rest/SMSMessages.php`

- `retrieveData`, in `Services/Twilio/Resource.php`
- `deleteData`, in `Services/Twilio/Resource.php`
- `addSubresource`, in `Services/Twilio/Resource.php`

Please check your own code for compatibility before upgrading.

Version 3.3.2
-------------

Released on May 3, 2012

- If you pass booleans in as TwiML (ex transcribe="true"), convert them to
  the strings "true" and "false" instead of outputting the incorrect values
  1 and "".

Version 3.3.1
-------------

Released on May 1, 2012

- Use the 'Accept-Charset' header to specify we want to receive UTF-8 encoded
data from the Twilio API. Remove unused XML parsing logic, as the library never
requests XML data.

Version 3.2.4
-------------

Released on March 14, 2012

- If no version is passed to the Services_Twilio constructor, the library will
  default to the most recent API version.

[upgrade]: https://github.com/twilio/twilio-php/blob/master/UPGRADE.md
