twilio-php Changelog
====================

[2020-02-05] Version 5.42.2
---------------------------
**Library - Fix**
- [PR #599](https://github.com/twilio/twilio-php/pull/599): handle '200 Tunnel established header'. Thanks to [@alimohammad1995](https://github.com/alimohammad1995)!

**Api**
- Making content retention and address retention public
- Update `status` enum for Messages to include 'partially_delivered'

**Authy**
- Added support for push factors

**Autopilot**
- Add one new property in Query i.e dialogue_sid

**Verify**
- Add `SendCodeAttempts` to create verification response.

**Video**
- Clarification in composition creation documentation: one source is mandatory, either `audio_sources` or `video_layout`, but on of them has to be provided

**Twiml**
- Add Polly Neural voices.


[2020-01-22] Version 5.42.1
---------------------------
**Library - Docs**
- [PR #597](https://github.com/twilio/twilio-php/pull/597): baseline all the templated markdown docs. Thanks to [@childish-sambino](https://github.com/childish-sambino)!

**Api**
- Add payments public APIs
- Add optional parameter `byoc` to call create request.

**Flex**
- Updating a Flex Flow `creation_on_message` parameter documentation

**Preview**
-
- Removed Verify v2 from preview in favor of its own namespace as GA **(breaking change)**

**Studio**
- Flow definition type update from string to object

**Verify**
- Add `AppHash` parameter when creating a Verification.
- Add `DoNotShareWarningEnabled` parameter to the Service resource.

**Twiml**
- Add `track` attribute to siprec noun.
- Add attribute `byoc` to `<Number>`


[2020-01-08] Version 5.42.0
---------------------------
**Library - Chore**
- [PR #594](https://github.com/twilio/twilio-php/pull/594): remove deprecated code. Thanks to [@childish-sambino](https://github.com/childish-sambino)! **(breaking change)**

**Numbers**
- Add Regulatory Compliance CRUD APIs

**Studio**
- Add parameter validation for Studio v2 Flows API

**Twiml**
- Add support for `speech_model` to `Gather` verb


[2019-12-18] Version 5.41.1
---------------------------
**Preview**
- Add `/Insights/SuccessRate` endpoint for Businesses Branded Calls (Verified by Twilio)

**Studio**
- StudioV2 API in beta

**Verify**
- Add `MailerSid` property to Verify Service resource.

**Wireless**
- Added `data_limit_strategy` to Rate Plan resource.


[2019-12-12] Version 5.41.0
---------------------------
**Api**
- Make `twiml` conditional for create. One of `url`, `twiml`, or `application_sid` is now required.
- Add `bundle_sid` parameter to /IncomingPhoneNumbers API
- Removed discard / obfuscate parameters from ContentRetention, AddressRetention **(breaking change)**

**Chat**
- Added `last_consumed_message_index` and `last_consumption_timestamp` parameters in update method for UserChannel resource **(breaking change)**

**Conversations**
- Add Participant SID to Message properties

**Messaging**
- Fix incorrectly typed capabilities property for ShortCodes. **(breaking change)**


[2019-12-04] Version 5.40.0
---------------------------
**Library**
- [PR #588](https://github.com/twilio/twilio-php/pull/588): docs: add supported language versions to README. Thanks to [@childish-sambino](https://github.com/childish-sambino)!
- [PR #586](https://github.com/twilio/twilio-php/pull/586): fix: Curl client now handles proxy responses over HTTP/1.0. Thanks to [@ytetsuro](https://github.com/ytetsuro)!
- [PR #584](https://github.com/twilio/twilio-php/pull/584): fix: update native_function_invocation calls to be fully qualified. Thanks to [@draco2003](https://github.com/draco2003)!

**Api**
- Add optional `twiml` parameter for call create

**Chat**
- Added `delete` method in UserChannel resource

**Conversations**
- Allow Messaging Service update

**Taskrouter**
- Support ReEvaluateTasks parameter on Workflow update

**Twiml**
- Remove unsupported `mixed_track` value from `<Stream>` **(breaking change)**
- Add missing fax `<Receive>` optional attributes


[2019-11-13] Version 5.39.0
---------------------------
**Library**
- [PR #583](https://github.com/twilio/twilio-php/pull/583): Notice of BREAKING CHANGE for PHP version 5. Thanks to [@thinkingserious](https://github.com/thinkingserious)! **(breaking change)**

**Api**
- Make `persistent_action` parameter public
- Add `twiml` optional private parameter for call create

**Autopilot**
- Add Export resource to Autopilot Assistant.

**Flex**
- Added Integration.RetryCount attribute to Flex Flow
- Updating a Flex Flow `channel_type` options documentation

**Insights**
- Added edges to events and metrics
- Added new endpoint definitions for Events and Metrics

**Messaging**
- **create** support for sender registration
- **fetch** support for fetching a sender
- **update** support for sender verification

**Supersim**
- Add `Direction` filter parameter to list commands endpoint
- Allow filtering commands list by Sim Unique Name
- Add `Iccid` filter parameter to list sims endpoint

**Twiml**
- Add support for `<Refer>` verb


[2019-10-30] Version 5.38.0
---------------------------
**Library**
- [PR #581](https://github.com/twilio/twilio-php/pull/581): Update resources after sorting. Thanks to [@childish-sambino](https://github.com/childish-sambino)!

**Api**
- Add new usage categories to the public api `sms-messages-carrierfees` and `mms-messages-carrierfees`

**Conversations**
- Add ProjectedAddress to Conversations Participant resource

**Preview**
- Implemented different `Sid` for Current Calls (Verified by Twilio), instead of relying in `Call.Sid` from Voice API team **(breaking change)**

**Supersim**
- Add List endpoint to Commands resource for Super Sim Pilot
- Add UsageRecords resource for the Super Sim Pilot
- Add List endpoint to UsageRecords resource for the Super Sim Pilot
- Allow assigning a Sim to a Fleet by Fleet SID or Unique Name for Super SIM Pilot
- Add Update endpoint to Fleets resource for Super Sim Pilot
- Add Fetch endpoint to Commands resource for Super Sim Pilot
- Allow filtering the Sims resource List endpoint by Fleet
- Add List endpoint to Fleets resource for Super Sim Pilot

**Wireless**
- Added `account_sid` to Sim update parameters.

**Twiml**
- Add new locales and voices for `Say` from Polly


[2019-10-16] Version 5.37.0
---------------------------
**Library**
- [PR #579](https://github.com/twilio/twilio-php/pull/579): Update instance property ordering. Thanks to [@childish-sambino](https://github.com/childish-sambino)!
- [PR #578](https://github.com/twilio/twilio-php/pull/578): added validation of signature without stripping port number. Thanks to [@eshanholtz](https://github.com/eshanholtz)!
- [PR #577](https://github.com/twilio/twilio-php/pull/577): breaking: Correct video composition date types. Thanks to [@childish-sambino](https://github.com/childish-sambino)! **(breaking change)**
- [PR #576](https://github.com/twilio/twilio-php/pull/576): Fix curl client fails through squid proxy. Thanks to [@jmo161](https://github.com/jmo161)!
- [PR #574](https://github.com/twilio/twilio-php/pull/574): Do not update new dependencies or versioning during testing and doc generation. Thanks to [@childish-sambino](https://github.com/childish-sambino)!

**Api**
- Add new property `attempt` to sms_messages
- Fixed a typo in the documentation for Feedback outcome enum **(breaking change)**
- Update the call price to be optional for deserializing **(breaking change)**

**Flex**
- Added `JanitorEnabled` attribute to Flex Flow
- Change `features_enabled` Flex Configuration key to private **(breaking change)**

**Supersim**
- Add Fetch endpoint to Fleets resource for Super Sim Pilot
- Allow assigning a Sim to a Fleet for Super Sim Pilot
- Add Create endpoint to Fleets resource for Super Sim Pilot

**Twiml**
- Update `<Conference>` rename "whisper" attribute to "coach" **(breaking change)**


[2019-10-02] Version 5.36.1
---------------------------
**Library**
- [PR #572](https://github.com/twilio/twilio-php/pull/572): Dependency Fix for PHPUnit. Thanks to [@thinkingserious](https://github.com/thinkingserious)!

**Conversations**
- Add media to Conversations Message resource

**Supersim**
- Add List endpoint to Sims resource for Super Sim Pilot


[2019-09-18] Version 5.36.0
----------------------------
**Library**
- [PR #570](https://github.com/twilio/twilio-php/pull/570): Revert to using composer to install apigen for doc generation. Thanks to [@childish-sambino](https://github.com/childish-sambino)!
- [PR #569](https://github.com/twilio/twilio-php/pull/569): Re-add DeserializeTest.php. Thanks to [@thinkingserious](https://github.com/thinkingserious)!
- [PR #568](https://github.com/twilio/twilio-php/pull/568): Update the Dockerfile for PHP 7.1 and new code structure. Thanks to [@childish-sambino](https://github.com/childish-sambino)!
- [PR #567](https://github.com/twilio/twilio-php/pull/567): Put back the parent directory directive in 'autoload'. Thanks to [@childish-sambino](https://github.com/childish-sambino)!
- [PR #563](https://github.com/twilio/twilio-php/pull/563): Support running docker tests in Jenkins. Thanks to [@thinkingserious](https://github.com/thinkingserious)!
- [PR #562](https://github.com/twilio/twilio-php/pull/562): Allow for usage of older PHP unit versions. Thanks to [@thinkingserious](https://github.com/thinkingserious)!
- [PR #561](https://github.com/twilio/twilio-php/pull/561): Make docker-build work with new Dockerfile format. Thanks to [@thinkingserious](https://github.com/thinkingserious)!
- [PR #560](https://github.com/twilio/twilio-php/pull/560): Loosen hard php version restriction. Thanks to [@thinkingserious](https://github.com/thinkingserious)!
- [PR #557](https://github.com/twilio/twilio-php/pull/557): Prevent null date-time strings from deserializing to 'now'. Thanks to [@childish-sambino](https://github.com/childish-sambino)!
- [PR #549](https://github.com/twilio/twilio-php/pull/549): [RFC] Test SDK on PHP 7.2 and 7.3. Thanks to [@rvanlaak](https://github.com/rvanlaak)!

**Numbers**
- Add v2 of the Identites API

**Preview**
- Changed authentication method for SDK Trusted Comms endpoints: `/CPS`, `/CurrentCall`, and `/Devices`. Please use `Authorization: Bearer <xCNAM JWT>` **(breaking change)**

**Voice**
- Add Recordings endpoints


[2019-09-04] Version 5.35.0
----------------------------
**Library**
- [PR #558](https://github.com/twilio/twilio-php/pull/558): Adds local dockerized tests for configurable PHP versions. Thanks to [@thinkingserious](https://github.com/thinkingserious)!
- [PR #552](https://github.com/twilio/twilio-php/pull/552): GuzzleClient - change body retrieval to rewind stream. Thanks to [@DavidGoodwin](https://github.com/DavidGoodwin)!
- [PR #551](https://github.com/twilio/twilio-php/pull/551): Request validator small changes. Thanks to [@Mcgurk-Adam](https://github.com/Mcgurk-Adam)!
- [PR #555](https://github.com/twilio/twilio-php/pull/555): Correct the 'array' type hint for a few resource instance properties. Thanks to [@childish-sambino](https://github.com/childish-sambino)!

**Api**
-  Pass Twiml in call update request

**Conversations**
- Add attributes to Conversations resources

**Flex**
- Adding `features_enabled` and `serverless_service_sids` to Flex Configuration

**Messaging**
- Message API required params updated **(breaking change)**

**Preview**
- Added support for the optional `CallSid` to `/BrandedCalls` endpoint


[2019-08-21] Version 5.34.4
----------------------------
**Library**
- [PR #554](https://github.com/twilio/twilio-php/pull/554): Update the IP messaging domain name to be 'chat'. Thanks to [@childish-sambino](https://github.com/childish-sambino)!

**Conversations**
- Add Chat Conversation SID to conversation default output properties

**Flex**
- Adding `outbound_call_flows` object to Flex Configuration
- Adding read and fetch to channels API

**Supersim**
- Add Sims and Commands resources for the Super Sim Pilot

**Sync**
- Added configuration option for enabling webhooks from REST.

**Wireless**
- Added `usage_notification_method` and `usage_notification_url` properties to `rate_plan`.

**Twiml**
- Add support for `ach-debit` transactions in `Pay` verb


[2019-08-05] Version 5.34.3
----------------------------
**Preview**
- Added support for the header `Twilio-Sandbox-Mode` to mock all Voice dependencies

**Twiml**
- Add support for `<Siprec>` noun
- Add support for `<Stream>` noun
- Create verbs `<Start>` and `<Stop>`


[2019-07-24] Version 5.34.2
----------------------------
**Insights**
- Added `properties` to summary.

**Preview**
- Added endpoint to brand a call without initiating it, so it can be initiated manually by the Customer

**Twiml**
- Update `<Conference>` recording events **(breaking change)**


[2019-07-10] Version 5.34.1
----------------------------
**Api**
- Make `friendly_name` optional for applications create
- Add new property `as_of` date to Usage Record API calls

**Wireless**
- Added Usage Records resource.


[2019-06-26] Version 5.34.0
----------------------------
**Library**
- [PR #547](https://github.com/twilio/twilio-php/pull/547): Added Guzzle HTTP client. Thanks to [@gmponos](https://github.com/gmponos)!

**Autopilot**
- Adds two new properties in Assistant i.e needs_model_build and development_stage

**Preview**
- Changed phone numbers from _URL|Path_ to `X-XCNAM-Sensitive` headers **(breaking change)**

**Verify**
- Add `MessagingConfiguration` resource to verify service


[2019-06-12] Version 5.33.0
----------------------------
**Autopilot**
- Add Webhooks resource to Autopilot Assistant.

**Flex**
- Added missing 'custom' type to Flex Flow
- Adding `integrations` to Flex Configuration

**Insights**
- Added attributes to summary.

**Messaging**
- Message API Create updated with conditional params **(breaking change)**

**Proxy**
- Document that Proxy will return a maximum of 100 records for read/list endpoints **(breaking change)**
- Remove non-updatable property parameters for Session update (mode, participants) **(breaking change)**

**Sync**
- Added reachability debouncing configuration options.

**Verify**
- Add `RateLimits` and `Buckets` resources to Verify Services
- Add `RateLimits` optional parameter on `Verification` creation.

**Twiml**
- Fix `<Room>` participantIdentity casing


[2019-05-29] Version 5.32.1
----------------------------
**Library**
- [PR #545](https://github.com/twilio/twilio-php/pull/545): Commonize usage of 'TwilioException' in doc strings. Thanks to [@childish-sambino](https://github.com/childish-sambino)!
- [PR #514](https://github.com/twilio/twilio-php/pull/514): Fix wrong twilio exception namespace in doc. Thanks to [@brainrepo](https://github.com/brainrepo)!
- [PR #544](https://github.com/twilio/twilio-php/pull/544): Add missing dollar sign to property doc tags. Thanks to [@childish-sambino](https://github.com/childish-sambino)!
- [PR #512](https://github.com/twilio/twilio-php/pull/512): Properties should use dollar sign ($) in phpDoc. Thanks to [@andreshg112](https://github.com/andreshg112)!
- [PR #542](https://github.com/twilio/twilio-php/pull/542): Update TwiML doc types. Thanks to [@childish-sambino](https://github.com/childish-sambino)!
- [PR #541](https://github.com/twilio/twilio-php/pull/541): Switch boolean and integer to using primitive types in doc tags. Thanks to [@childish-sambino](https://github.com/childish-sambino)!
- [PR #499](https://github.com/twilio/twilio-php/pull/499): Fix doc blocks typing for TwiML. Thanks to [@erickskrauch](https://github.com/erickskrauch)!

**Verify**
- Add `approved` to status enum


[2019-05-15] Version 5.32.0
----------------------------
**Library**
- [PR #540](https://github.com/twilio/twilio-php/pull/540): Update Readme TwiML Documentation. Thanks to [@gjrdiesel](https://github.com/gjrdiesel)!

**Api**
- Make `method` optional for queue members update

**Chat**
- Removed `webhook.*.format` update parameters in Service resource from public library visibility in v1 **(breaking change)**

**Insights**
- Added client metrics as sdk_edge to summary.
- Added optional query param processing_state.

**Numbers**
- Add addtional metadata fields on a Document
- Add status callback fields and parameters

**Taskrouter**
- Added `channel_optimized_routing` attribute to task-channel endpoint

**Video**
- [Rooms] Add Video Subscription API

**Wireless**
- Added `imei` to Data Session resource.
- Remove `imeisv` from Data Session resource. **(breaking change)**


[2019-05-01] Version 5.31.3
----------------------------
**Serverless**
- Documentation

**Wireless**
- Added `imeisv` to Data Session resource.


[2019-04-24] Version 5.31.2
----------------------------
**Library**
- PR #539: Drop all the unused 'read_the_docs' stuff. Thanks to @childish-sambino!

**Api**
- Add `verified` property to Addresses

**Numbers**
- Add API for Identites and documents

**Proxy**
- Add in use count on number instance


[2019-04-12] Version 5.31.1
----------------------------
**Flex**
- Adding PluginService to Flex Configuration

**Numbers**
- Add API for Proof of Addresses

**Proxy**
- Clarify documentation for Service and Session fetch

**Serverless**
- Serverless scaffolding


[2019-03-28] Version 5.31.0
----------------------------
**Api**
- Remove optional `if_machine` call create parameter from helper libraries **(breaking change)**
- Changed `call_sid` path parameter type on QueueMember fetch and update requests **(breaking change)**

**Voice**
- changed file names to dialing_permissions prefix **(breaking change)**

**Wireless**
- Added `ResetStatus` property to Sim resource to allow resetting connectivity via the API.


[2019-03-15] Version 5.30.2
----------------------------
**Library**
- PR #536: Add Help Center and Support Ticket links to the README. Thanks to @childish-sambino!

**Api**
- Add `machine_detection_speech_threshold`, `machine_detection_speech_end_threshold`, `machine_detection_silence_timeout` optional params to Call create request

**Flex**
- Adding Flex Channel Orchestration
- Adding Flex Flow


[2019-03-06] Version 5.30.1
----------------------------
**Twiml**
- Add `de1` to `<Conference>` regions


[2019-03-01] Version 5.30.0
----------------------------
**Api**
- Make conference participant preview parameters public

**Authy**
- Added support for FactorType and FactorStrength for Factors and Challenges

**Iam**
- First public release

**Verify**
- Add endpoint to update/cancel a Verification **(breaking change)**

**Video**
- [Composer] Make RoomSid mandatory **(breaking change)**
- [Composer] Add `enqueued` state to Composition

**Twiml**
- Update message body to not be required for TwiML `Dial` noun.


[2019-02-20] Version 5.29.1
----------------------------
**Library**
- PR #533: Pin hhvm to pre-4.0 because of lack of composer support. Thanks to @cjcodes!

**Api**
- Add `force_opt_in` optional param to Messages create request
- Add agent conference category to usage records

**Flex**
- First public release

**Taskrouter**
- Adding `reject_pending_reservations` to worker update endpoint
- Added `event_date_ms` and `worker_time_in_previous_activity_ms` to Events API response
- Add ability to filter events by TaskChannel

**Verify**
- Add `EnablePsd2` optional parameter for PSD2 on Service resource creation or update.
- Add `Amount`, `Payee` optional parameters for PSD2.


[2019-02-04] Version 5.29.0
----------------------------
**Library**
- PR #523: Switch body validator to use hex instead of base64. Thanks to @cjcodes!

**Video**
- [Recordings] Add media type filter to list operation
- [Composer] Filter Composition Hook resources by FriendlyName

**Twiml**
- Update `language` enum for `Gather` to fix language code for Filipino (Philippines) and include additional supported languages **(breaking change)**


[2019-01-11] Version 5.28.1
----------------------------
**Verify**
- Add `lookup` information in the response when creating a new verification (depends on the LookupEnabled flag being enabled at the service level)
- Add `VerificationSid` optional parameter on Verification check.


[2019-01-10] Version 5.28.0
----------------------------
**Chat**
- Mark Member attributes as PII

**Proxy**
- Remove unsupported query parameters **(breaking change)**
- Remove invalid session statuses in doc


[2019-01-02] Version 5.27.1
----------------------------
**Insights**
- Initial revision.


[2018-12-17] Version 5.27.0
----------------------------
**Authy**
- Reverted the change to `FactorType` and `FormType`, avoiding conflicts with Helper Libraries reserved words (`type`) **(breaking change)**

**Proxy**
- Remove incorrect parameter for Session List

**Studio**
- Support date created filtering on list of executions

**Taskrouter**
- Adding ability to Create, Modify and Delete Task Channels.

**Verify**
- Add `SkipSmsToLandlines`, `TtsName`, `DtmfInputRequired` optional parameters on Service resource creation or update.

**Wireless**
- Added delete action on Command resource.
- Added delete action on Sim resource.

**Twiml**
- Change `currency` from enum to string for `Pay` **(breaking change)**


[2018-11-30] Version 5.26.0
----------------------------
**Api**
- Add `interactive_data` optional param to Messages create request

**Authy**
- Required authentication for `/v1/Forms/{type}` endpoint **(breaking change)**
- Removed `Challenge.reason` to `Challenge.responded_reason`
- Removed `verification_sid` from Challenge responses
- Removed `config` param from the Factor creation
- Replaced all occurrences of `FactorType` and `FormType` in favor of a unified `Type` **(breaking change)**

**Chat**
- Add Member attributes

**Preview**
- Removed `Authy` version from `preview` subdomain in favor to `authy` subdomain. **(breaking change)**

**Verify**
- Add `CustomCode` optional parameter on Verication creation.


[2018-11-16] Version 5.25.0
----------------------------
**Messaging**
- Session API

**Twiml**
- Change `master-card` to `mastercard` as `cardType` for `Pay` and `Prompt`, remove attribute `credential_sid` from `Pay` **(breaking change)**


[2018-10-29] Version 5.24.2
----------------------------
**Library**
- PR #511: Include composer require command. Thanks to @cjcodes!
- PR #503: Fix invalid generated XML in README. Thanks to @giggsey!

**Api**
- Add new Balance resource:
    - url: '/v1/Accounts/{account sid}/Balance'
    - supported methods: GET
    - returns the balance of the account

**Proxy**
- Add chat_instance_sid to Service

**Verify**
- Add `Locale` optional parameter on Verification creation.


[2018-10-15] Version 5.24.1
----------------------------
**Api**
- Add <Pay> Verb Transactions category to usage records

**Twiml**
- Add support for `Pay` verb


[2018-10-15] Version 5.24.0
----------------------------
**Api**
- Add `coaching` and `call_sid_to_coach` to participant properties, create and update requests.

**Authy**
- Set public library visibility, and added PII stanza
- Dropped support for `FactorType` param given new Factor prefixes **(breaking change)**
- Supported `DELETE` actions for Authy resources
- Move Authy Services resources to `authy` subdomain

**Autopilot**
- Introduce `autopilot` subdomain with all resources from `preview.understand`

**Preview**
- Renamed Understand intent to task **(breaking change)**
- Deprecated Authy endpoints from `preview` to `authy` subdomain

**Taskrouter**
- Allow TaskQueue ReservationActivitySid and AssignmentActivitySid to not be configured for MultiTask Workspaces

**Verify**
- Add `LookupEnabled` optional parameter on Service resource creation or update.
- Add `SendDigits` optional parameter on Verification creation.
- Add delete action on Service resourse.

**Twiml**
- Add custom parameters to TwiML `Client` noun and renamed the optional `name` field to `identity`. This is a breaking change in Ruby, and applications will need to transition from `dial.client ''` and `dial.client 'alice'` formats to `dial.client` and `dial.client(identity: alice)` formats. **(breaking change)**


[2018-10-04] Version 5.23.1
----------------------------
**Preview**
- Renamed response headers for Challenge and Factors Signatures

**Video**
- [Composer] Add Composition Hook resources

**Twiml**
- Add `debug` to `Gather`
- Add `participantIdentity` to `Room`


[2018-09-28] Version 5.23.0
----------------------------
**Api**
- Set `call_sid_to_coach` parameter in participant to be `preview`

**Preview**
- Supported `totp` in Authy preview endpoints
- Allowed `latest` in Authy Challenges endpoints

**Voice**
- changed path param name from parent_iso_code to iso_code for highrisk_special_prefixes api **(breaking change)**
- added geo permissions public api


[2018-09-21] Version 5.22.0
----------------------------
**Preview**
- Add `Form` resource to Authy preview given a `form_type`
- Add Authy initial api-definitions in the 4 main resources: Services, Entities, Factors, Challenges

**Pricing**
- add voice_numbers resource (v2)

**Verify**
- Move from preview to beta **(breaking change)**


[2018-08-31] Version 5.21.4
----------------------------
**Api**
- Add `call_sid_to_coach` parameter to participant create request
- Add `voice_receive_mode` param to IncomingPhoneNumbers create

**Video**
- [Recordings] Expose `offset` property in resource


[2018-08-23] Version 5.21.3
----------------------------
**Chat**
- Add User Channel instance resource


[2018-08-17] Version 5.21.2
----------------------------
**Api**
- Add Proxy Active Sessions category to usage records

**Preview**
- Add `Actions` endpoints and remove `ResponseUrl` from assistants on the Understand api

**Pricing**
- add voice_country resource (v2)


[2018-08-09] Version 5.21.1
----------------------------
**Library**
- PR #498: Add deprecation warning to the old Twiml class. Thanks to @ekarson!
- PR #497: Add tests for namespacing and twiml constructors. Thanks to @cjcodes!

**Studio**
- Studio is now GA


[2018-08-03] Version 5.21.0
----------------------------
**Library**
- PR #492: Tag and push Docker latest image when deploying with TravisCI. Thanks to @jonatasbaldin!

**Api**
- Add support for sip domains to map credential lists for registrations

**Chat**
- Make message From field updatable
- Add REST API webhooks

**Notify**
- Removing deprecated `segments`, `users`, `segment_memberships`, `user_bindings` classes from helper libraries. **(breaking change)**

**Preview**
- Add new Intent Statistics endpoint
- Remove `ttl` from Assistants

**Proxy**
- Enable setting a proxy number as reserved

**Video**
- Add `group-small` room type

**Twiml**
- Add `Connect` and `Room` for Programmable Video Rooms
- Add support for SSML lang tag on Say verb


[2018-07-16] Version 5.20.0
----------------------------
**Library**
- PR #489: Add a request body validator. Thanks to @cjcodes!

**Twiml**
- Add support for SSML on Say verb, the message body is changed to be optional **(breaking change)**


[2018-07-11] Version 5.19.7
----------------------------
**Api**
- Add `cidr_prefix_length` param to SIP IpAddresses API

**Studio**
- Add new /Execution endpoints to begin Engagement -> Execution migration

**Video**
- [Rooms] Allow deletion of individual recordings from a room


[2018-07-05] Version 5.19.6
----------------------------
**Library**
- PR #483: Add Dockerfile and related changes to build the Docker image. Thanks to @jonatasbaldin!

**Api**
- Release `Call Recording Controls` feature support in helper libraries
- Add Voice Insights sub-category keys to usage records


[2018-06-21] Version 5.19.5
----------------------------
**Library**
- PR #484: Fixes for adding child nodes / text. Thanks to @ekarson!
- PR #482: Allow adding TwiML children with generic tag names. Thanks to @yannieyip!

**Api**
- Add Fraud Lookups category to usage records

**Video**
- Allow user to set `ContentDisposition` when obtaining media URLs for Room Recordings and Compositions
- Add Composition Settings resource


[2018-06-15] Version 5.19.4
----------------------------
**Library**
- PR #480: Allow adding mixed content in TwiML nodes. Thanks to @ekarson!
- PR #481: Add method to validate ssl certificate. Thanks to @yannieyip!
- PR #469: Ability to specify custom claims when creating ClientToken. Thanks to @erickskrauch!

**Twiml**
- Add methods to helper libraries to inject arbitrary text under a TwiML node


[2018-06-04] Version 5.19.3
----------------------------
**Chat**
- Add Binding and UserBinding documentation

**Lookups**
- Add back support for `fraud` lookup type


[2018-05-25] Version 5.19.2
----------------------------
**Studio**
- Add endpoint to delete engagements


[2018-05-18] Version 5.19.1
----------------------------
**Api**
- Add more programmable video categories to usage records
- Add 'include_subaccounts' parameter to all variation of usage_record fetch

**Trunking**
- Added cnam_lookup_enabled parameter to Trunk resource.
- Added case-insensitivity for recording parameter to Trunk resource.


[2018-05-11] Version 5.19.0
----------------------------
**Library**
- PR #472: Added @throws PHPDoc tags to Sync API Context and Version classes. Thanks to @lamungu!

**Chat**
- Add Channel Webhooks resource

**Monitor**
- Update event filtering to support date/time **(breaking change)**

**Wireless**
- Updated `maturity` to `ga` for all wireless apis


[2018-04-28] Version 5.18.0
----------------------------
**Video**
- Redesign API by adding custom `VideoLayout` object. **(breaking change)**


[2018-04-20] Version 5.17.1
----------------------------
**Twiml**
- Gather input Enum: remove unnecessary "dtmf speech" value as you can now specify multiple enum values for this parameter and both "dtmf" and "speech" are already available.


[2018-04-13] Version 5.17.0
----------------------------
**Library**
- PR #468: Add incoming.allow to AccessToken VoiceGrant. Thanks to @ryan-rowland!

**Preview**
- Support for Understand V2 APIs - renames various resources and adds new fields

**Studio**
- Change parameters type from string to object in engagement resource

**Video**
- [Recordings] Change `size` type to `long`. **(breaking change)**


[2018-03-22] Version 5.16.7
----------------------------
**Lookups**
- Disable support for `fraud` lookups *(breaking change)*

**Preview**
- Add `BuildDuration` and `ErrorCode` to Understand ModelBuild

**Studio**
- Add new /Context endpoint for step and engagement resources.


[2018-03-09] Version 5.16.6
----------------------------
**Api**
- Add `caller_id` param to Outbound Calls API
- Release `trim` recording Outbound Calls API functionality in helper libraries
- Add `trim` param to Outbound Calls API

**Lookups**
- Add support for `fraud` lookup type

**Numbers**
- Initial Release

**Video**
- [composer] Add `room_sid` to Composition resource.
- [composer] Add `SEQUENCE` value to available layouts, and `trim` and `reuse` params.

**Twiml**
- Adds support for passing in multiple input type enums when setting `input` on `Gather`


[2018-02-09] Version 5.16.5
----------------------------
**Api**
- Add `AnnounceUrl` and `AnnounceMethod` params for conference announce

**Chat**
- Add support to looking up user channels by identity in v1


[2018-01-30] Version 5.16.4
----------------------------
**Api**
- Add `studio-engagements` usage key

**Preview**
- Remove Studio Engagement Deletion

**Studio**
- Initial Release

**Video**
- [omit] Beta: Allow updates to `SubscribedTracks`.
- Add `SubscribedTracks`.
- Add track name to Video Recording resource
- Add Composition and Composition Media resources


[2018-01-19] Version 5.16.3
----------------------------
**Api**
- Add `conference_sid` property on Recordings
- Add proxy and sms usage key

**Chat**
- Make user channels accessible by identity
- Add notifications logs flag parameter

**Fax**
- Added `ttl` parameter
  `ttl` is the number of minutes a fax is considered valid.

**Preview**
- Add `call_delay`, `extension`, `verification_code`, and `verification_call_sids`.
- Add `failure_reason` to HostedNumberOrders.
- Add DependentHostedNumberOrders endpoint for AuthorizationDocuments preview API.

**Taskrouter**
- Less verbose naming of cumulative and real time statistics *(breaking change)*


[2017-12-15] Version 5.16.2
----------------------------
**Api**
- Add `voip`, `national`, `shared_cost`, and `machine_to_machine` sub-resources to `/2010-04-01/Accounts/{AccountSid}/AvailablePhoneNumbers/{IsoCountryCode}/`
- Add programmable video keys

**Preview**
- Add `verification_type` and `verification_document_sid` to HostedNumberOrders.

**Proxy**
- Fixed typo in session status enum value

**Twiml**
- Fix Dial record property incorrectly typed as accepting TrimEnum values when it actually has its own enum of values. *(breaking change)*
- Add `priority` and `timeout` properties to Task TwiML.
- Add support for `recording_status_callback_event` for Dial verb and for Conference


[2017-12-01] Version 5.16.1
----------------------------
**Api**
- Use the correct properties for Dependent Phone Numbers of an Address *(breaking change)*
- Update Call Recordings with the correct properties

**Preview**
- Add `status` and `email` query param filters for AuthorizationDocument list endpoint

**Proxy**
- Added DELETE support to Interaction
- Standardized enum values to dash-case
- Rename Service#friendly_name to Service#unique_name

**Video**
- Remove beta flag from `media_region` and `video_codecs`

**Wireless**
- Bug fix: Changed `operator_mcc` and `operator_mnc` in `DataSessions` subresource from `integer` to `string`


[2017-11-17] Version 5.16.0
----------------------------
**Sync**
- Add TTL support for Sync objects *(breaking change)*
  - The required `data` parameter on the following actions is now optional: "Update Document", "Update Map Item", "Update List Item"
  - New actions available for updating TTL of Sync objects: "Update List", "Update Map", "Update Stream"

**Video**
- [bi] Rename `RoomParticipant` to `Participant`
- Add Recording Settings resource
- Expose EncryptionKey and MediaExternalLocation properties in Recording resource


[2017-11-10] Version 5.15.6
----------------------------
**Accounts**
- Add AWS credential type

**Preview**
- Removed `iso_country` as required field for creating a HostedNumberOrder.

**Proxy**
- Added new fields to Service: geo_match_level, number_selection_behavior, intercept_callback_url, out_of_session_callback_url


[2017-11-03] Version 5.15.5
----------------------------
**Library**
- Issue 451: Do not set CURLOPT_INFILESIZE by default
- PR #454: Fix the JsonSerializable. Thanks @vinu!

**Api**
- Add programmable video keys

**Video**
- Add `Participants`


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
