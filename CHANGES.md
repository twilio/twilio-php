twilio-php Changelog
====================

[2024-01-14] Version 7.13.1
---------------------------
**Push**
- Migrated to new Push API V4 with Resilient Notification Delivery.


[2023-12-14] Version 7.13.0
---------------------------
**Api**
- Updated service base url for connect apps and authorized connect apps APIs **(breaking change)**

**Events**
- Marked as GA

**Insights**
- decommission voice-qualitystats-endpoint role

**Numbers**
- Add Get Port In request api

**Taskrouter**
- Add `jitter_buffer_size` param in update reservation

**Trusthub**
- Add additional optional fields in compliance_tollfree_inquiry.json

**Verify**
- Remove `Tags` from Public Docs **(breaking change)**


[2023-12-01] Version 7.12.3
---------------------------
**Verify**
- Add `VerifyEventSubscriptionEnabled` parameter to service create and update endpoints.


[2023-11-17] Version 7.12.2
---------------------------
**Api**
- Update documentation to reflect RiskCheck GA

**Messaging**
- Add tollfree edit_allowed and edit_reason fields
- Update Phone Number, Short Code, Alpha Sender, US A2P and Channel Sender documentation

**Taskrouter**
- Add container attribute to task_queue_bulk_real_time_statistics endpoint

**Trusthub**
- Rename did to tollfree_phone_number in compliance_tollfree_inquiry.json
- Add new optional field notification_email to compliance_tollfree_inquiry.json

**Verify**
- Add `Tags` optional parameter on Verification creation.


[2023-11-06] Version 7.12.1
---------------------------
**Flex**
- Adding `provisioning_status` for Email Manager

**Intelligence**
- Add text-generation operator (for example conversation summary) results to existing OperatorResults collection.

**Messaging**
- Add DELETE support to Tollfree Verification resource

**Serverless**
- Add node18 as a valid Build runtime

**Verify**
- Update Verify TOTP maturity to GA.


[2023-10-19] Version 7.12.0
---------------------------
**Accounts**
- Updated Safelist metadata to correct the docs.
- Add Global SafeList API changes

**Api**
- Added optional parameter `CallToken` for create participant api

**Flex**
- Adding `offline_config` to Flex Configuration

**Intelligence**
- Deleted `redacted` parameter from fetching transcript in v2 **(breaking change)**

**Lookups**
- Add new `phone_number_quality_score` package to the lookup response
- Remove `disposable_phone_number_risk` package **(breaking change)**

**Messaging**
- Update US App To Person documentation with current `message_samples` requirements

**Taskrouter**
- Remove beta_feature check on task_queue_bulk_real_time_statistics endpoint
- Add `virtual_start_time` property to tasks
- Updating `task_queue_data` format from `map` to `array` in the response of bulk get endpoint of TaskQueue Real Time Statistics API **(breaking change)**


[2023-10-05] Version 7.11.1
---------------------------
**Library - Chore**
- [PR #785](https://github.com/twilio/twilio-php/pull/785): twilio help changes. Thanks to [@kridai](https://github.com/kridai)!

**Library - Fix**
- [PR #786](https://github.com/twilio/twilio-php/pull/786): Update ValidateSslCertificate method with security testing method. Thanks to [@AsabuHere](https://github.com/AsabuHere)!

**Lookups**
- Add test api support for Lookup v2


[2023-09-21] Version 7.11.0
---------------------------
**Conversations**
- Enable conversation email bindings, email address configurations and email message subjects

**Flex**
- Adding `console_errors_included` to Flex Configuration field `debugger_integrations`
- Introducing new channel status as `inactive` in modify channel endpoint for leave functionality **(breaking change)**
- Adding `citrix_voice_vdi` to Flex Configuration

**Taskrouter**
- Add Update Queues, Workers, Workflow Real Time Statistics API to flex-rt-data-api-v2 endpoint
- Add Update Workspace Real Time Statistics API to flex-rt-data-api-v2 endpoint


[2023-09-07] Version 7.10.0
---------------------------
**Api**
- Make message tagging parameters public **(breaking change)**

**Flex**
- Adding `agent_conv_end_methods` to Flex Configuration

**Messaging**
- Mark Mesasging Services fallback_to_long_code feature obsolete

**Numbers**
- Add Create Port In request api
- Renaming sid for bulk_hosting_sid and remove account_sid response field in numbers/v2/BulkHostedNumberOrders **(breaking change)**

**Pricing**
- gate resources behind a beta_feature


[2023-08-24] Version 7.9.0
--------------------------
**Api**
- Add new property `RiskCheck` for SMS pumping protection feature only (public beta to be available soon): Include this parameter with a value of `disable` to skip any kind of risk check on the respective message request

**Flex**
- Changing `sid<UO>` path param to `sid<UT>` in interaction channel participant update endpoint **(breaking change)**

**Messaging**
- Add Channel Sender api
- Fixing country code docs and removing Zipwhip references

**Numbers**
- Request status changed in numbers/v2/BulkHostedNumberOrders **(breaking change)**
- Add bulk hosting orders API under version `/v2


[2023-08-10] Version 7.8.0
--------------------------
**Insights**
- Normalize annotations parameters in list summary api to be prefixed

**Numbers**
- Change Bulk_hosted_sid from BHR to BH prefix in HNO and dependent under version `/v2` API's. **(breaking change)**
- Added parameter target_account_sid to portability and account_sid to response body

**Verify**
- Remove beta feature flag to list attempts API.
- Remove beta feature flag to verifications summary attempts API.


[2023-07-27] Version 7.7.1
--------------------------
**Api**
- Added `voice-intelligence`, `voice-intelligence-transcription` and `voice-intelligence-operators` to `usage_record` API.
- Added `tts-google` to `usage_record` API.

**Lookups**
- Add new `disposable_phone_number_risk` package to the lookup response

**Verify**
- Documentation of list attempts API was improved by correcting `date_created_after` and `date_created_before` expected date format.
- Documentation was improved by correcting `date_created_after` and `date_created_before` expected date format parameter on attempts summary API.
- Documentation was improved by adding `WHATSAPP` as optional valid parameter on attempts summary API.

**Twiml**
- Added support for he-il inside of ssm_lang.json that was missing
- Added support for he-il language in say.json that was missing
- Add `statusCallback` and `statusCallbackMethod` attributes to `<Siprec>`.


[2023-07-13] Version 7.7.0
--------------------------
**Flex**
- Adding `interaction_context_sid` as optional parameter in Interactions API

**Messaging**
- Making visiblity public for tollfree_verification API

**Numbers**
- Remove Sms capability property from HNO creation under version `/v2` of HNO API. **(breaking change)**
- Update required properties in LOA creation under version `/v2` of Authorization document API. **(breaking change)**

**Taskrouter**
- Add api to fetch task queue statistics for multiple TaskQueues

**Verify**
- Add `RiskCheck` optional parameter on Verification creation.

**Twiml**
- Add Google Voices and languages


[2023-06-28] Version 7.6.0
--------------------------
**Lookups**
- Add `reassigned_number` package to the lookup response

**Numbers**
- Add hosted_number_order under version `/v2`.
- Update properties in Porting and Bulk Porting APIs. **(breaking change)**
- Added bulk Portability API under version `/v1`.
- Added Portability API under version `/v1`.


[2023-06-15] Version 7.5.0
--------------------------
**Api**
- Added `content_sid` as conditional parameter
- Removed `content_sid` as optional field **(breaking change)**

**Insights**
- Added `annotation` to list summary output


[2023-06-01] Version 7.4.2
--------------------------
**Api**
- Add `Trim` to create Conference Participant API

**Intelligence**
- First public beta release for Voice Intelligence APIs with client libraries

**Messaging**
- Add new `errors` attribute to us_app_to_person resource. This attribute will provide additional information about campaign registration errors.


[2023-05-18] Version 7.4.1
--------------------------
**Conversations**
- Added  `AddressCountry` parameter to Address Configuration endpoint, to support regional short code addresses
- Added query parameters `start_date`, `end_date` and `state` in list Conversations resource for filtering

**Insights**
- Added annotations parameters to list summary api

**Messaging**
- Add GET domainByMessagingService endpoint to linkShortening service
- Add `disable_https` to link shortening domain_config properties

**Numbers**
- Add bulk_eligibility api under version `/v1`.


[2023-05-04] Version 7.4.0
--------------------------
**Conversations**
- Remove `start_date`, `end_date` and `state` query parameters from list operation on Conversations resource **(breaking change)**

**Twiml**
- Add support for new Amazon Polly voices (Q1 2023) for `Say` verb


[2023-04-19] Version 7.3.0
--------------------------
**Library - Docs**
- [PR #775](https://github.com/twilio/twilio-php/pull/775): consolidate. Thanks to [@stern-shawn](https://github.com/stern-shawn)!

**Messaging**
- Remove `messaging_service_sids` and `messaging_service_sid_action` from domain config endpoint **(breaking change)**
- Add error_code and rejection_reason properties to tollfree verification API response

**Numbers**
- Added the new Eligibility API under version `/v1`.


[2023-04-05] Version 7.2.0
--------------------------
**Conversations**
- Expose query parameters `start_date`, `end_date` and `state` in list operation on Conversations resource for sorting and filtering

**Insights**
- Added answered by filter in Call Summaries

**Lookups**
- Remove `disposable_phone_number_risk` package **(breaking change)**

**Messaging**
- Add support for `SOLE_PROPRIETOR` brand type and `SOLE_PROPRIETOR` campaign use case.
- New Sole Proprietor Brands should be created with `SOLE_PROPRIETOR` brand type. Brand registration requests with `STARTER` brand type will be rejected.
- New Sole Proprietor Campaigns should be created with `SOLE_PROPRIETOR` campaign use case. Campaign registration requests with `STARTER` campaign use case will be rejected.
- Add Brand Registrations OTP API


[2023-03-22] Version 7.1.0
--------------------------
**Api**
- Revert Corrected the data type for `friendly_name` in Available Phone Number Local, Mobile and TollFree resources
- Corrected the data type for `friendly_name` in Available Phone Number Local, Mobile and TollFree resources **(breaking change)**

**Messaging**
- Add `linkshortening_messaging_service` resource
- Add new endpoint for GetDomainConfigByMessagingServiceSid
- Remove `validated` parameter and add `cert_in_validation` parameter to Link Shortening API **(breaking change)**


[2023-03-09] Version 7.0.0
--------------------------
**Note:** This release contains breaking changes, check our [upgrade guide](./UPGRADE.md#2023-03-08-6xx-to-7xx) for detailed migration notes.

**Library - Feature**
- [PR #771](https://github.com/twilio/twilio-php/pull/771): Merge branch '7.0.0-rc' to main. Thanks to [@charan678](https://github.com/charan678)! **(breaking change)**

**Api**
- Add new categories for whatsapp template

**Lookups**
- Remove `validation_results` from the `default_output_properties`

**Supersim**
- Add ESimProfile's `matching_id` and `activation_code` parameters to libraries


[2023-02-22] Version 6.44.4
---------------------------
**Api**
- Remove `scheduled_for` property from message resource
- Add `scheduled_for` property to message resource


[2023-02-08] Version 6.44.3
---------------------------
**Library - Fix**
- [PR #770](https://github.com/twilio/twilio-php/pull/770): test failures for PhpUnit >=10. Thanks to [@isha689](https://github.com/isha689)!

**Lookups**
- Add `disposable_phone_number_risk` package to the lookup response
- Add `sms_pumping_risk` package to the lookup response


[2023-01-25] Version 6.44.2
---------------------------
**Api**
- Add `public_application_connect_enabled` param to Application resource

**Messaging**
- Add new tollfree verification API property (ExternalReferenceId)]

**Verify**
- Add `device_ip` parameter and channel `auto` for sna/sms orchestration

**Twiml**
- Add support for `<Application>` noun and `<ApplicationSid>` noun, nested `<Parameter>` to `<Hangup>` and `<Leave>` verb


[2023-01-11] Version 6.44.1
---------------------------
**Conversations**
- Add support for creating Multi-Channel Rich Content Messages

**Lookups**
- Changed the no data message for match postal code from `no_data` to `data_not_available` in identity match package

**Messaging**
- Add update/edit tollfree verification API


[2022-12-14] Version 6.44.0
---------------------------
**Api**
- Add `street_secondary` param to address create and update
- Make `method` optional for user defined message subscription **(breaking change)**

**Flex**
- Flex Conversations is now Generally Available
- Adding the ie1 mapping for authorization api, updating service base uri and base url response attribute **(breaking change)**
- Change web channels to GA and library visibility to public
- Changing the uri for authorization api from using Accounts to Insights **(breaking change)**

**Media**
- Gate Twilio Live endpoints behind beta_feature for EOS

**Messaging**
- Mark `MessageFlow` as a required field for Campaign Creation **(breaking change)**

**Oauth**
- updated openid discovery endpoint uri **(breaking change)**
- Added device code authorization endpoint

**Supersim**
- Allow filtering the SettingsUpdates resource by `status`

**Twiml**
- Add new Polly Neural voices
- Add tr-TR, ar-AE, yue-CN, fi-FI languages to SSML `<lang>` element.
- Add x-amazon-jyutping, x-amazon-pinyin, x-amazon-pron-kana, x-amazon-yomigana alphabets to SSML `<phoneme>` element.
- Rename `character` value for SSML `<say-as>` `interpret-as` attribute to `characters`. **(breaking change)**
- Rename `role` attribute to `format` in SSML `<say-as>` element. **(breaking change)**


[2022-11-30] Version 6.43.4
---------------------------
**Flex**
- Adding new `assessments` api in version `v1`

**Lookups**
- Add `identity_match` package to the lookup response

**Messaging**
- Added `validated` parameter to Link Shortening API

**Serverless**
- Add node16 as a valid Build runtime
- Add ie1 and au1 as supported regions for all endpoints.


[2022-11-16] Version 6.43.3
---------------------------
**Library - Chore**
- [PR #749](https://github.com/twilio/twilio-php/pull/749): upgrade GitHub Actions dependencies. Thanks to [@childish-sambino](https://github.com/childish-sambino)!

**Api**
- Set the Content resource to have public visibility as Preview

**Flex**
- Adding new parameter `base_url` to 'gooddata' response in version `v1`

**Insights**
- Added `answered_by` field in List Call Summary
- Added `answered_by` field in call summary


[2022-11-10] Version 6.43.2
---------------------------
**Flex**
- Adding two new authorization API 'user_roles' and 'gooddata' in version `v1`

**Messaging**
- Add new Campaign properties (MessageFlow, OptInMessage, OptInKeywords, OptOutMessage, OptOutKeywords, HelpMessage, HelpKeywords)

**Twiml**
- Add new speech models to `Gather`.


[2022-10-31] Version 6.43.1
---------------------------
**Api**
- Added `contentSid` and `contentVariables` to Message resource with public visibility as Beta
- Add `UserDefinedMessageSubscription` and `UserDefinedMessage` resource

**Proxy**
- Remove FailOnParticipantConflict param from Proxy Session create and update and Proxy Participant create

**Supersim**
- Update SettingsUpdates resource to remove PackageSid

**Taskrouter**
- Add `Ordering` query parameter to Workers and TaskQueues for sorting by
- Add `worker_sid` query param for list reservations endpoint

**Twiml**
- Add `url` and `method` attributes to `<Conversation>`


[2022-10-19] Version 6.43.0
---------------------------
**Api**
- Make link shortening parameters public **(breaking change)**

**Oauth**
- added oauth JWKS endpoint
- Get userinfo resource
- OpenID discovery resource
- Add new API for token endpoint

**Supersim**
- Add SettingsUpdates resource

**Verify**
- Update Verify Push endpoints to `ga` maturity
- Verify BYOT add Channels property to the Get Templates response

**Twiml**
- Add `requireMatchingInputs` attribute and `input-matching-failed` errorType to `<Prompt>`


[2022-10-05] Version 6.42.2
---------------------------
**Api**
- Added `virtual-agent` to `usage_record` API.
- Add AMD attributes to participant create request

**Twiml**
- Add AMD attributes to `Number` and `Sip`


[2022-09-21] Version 6.42.1
---------------------------
**Library - Fix**
- [PR #745](https://github.com/twilio/twilio-php/pull/745): support duplicate query param values. Thanks to [@childish-sambino](https://github.com/childish-sambino)!


[2022-09-07] Version 6.42.0
---------------------------
**Flex**
- Removed redundant `close` status from Flex Interactions flow **(breaking change)**
- Adding `debugger_integration` and `flex_ui_status_report` to Flex Configuration

**Messaging**
- Add create, list and get tollfree verification API

**Verify**
- Verify SafeList API endpoints added.

**Video**
- Add `Anonymize` API

**Twiml**
- Update `event` value `call-in-progress` to `call-answered`


[2022-08-24] Version 6.41.0
---------------------------
**Library - Test**
- [PR #742](https://github.com/twilio/twilio-php/pull/742): add test-docker rule. Thanks to [@beebzz](https://github.com/beebzz)!

**Api**
- Remove `beta feature` from scheduling params and remove optimize parameters. **(breaking change)**

**Routes**
- Remove Duplicate Create Method - Update Method will work even if Inbound Processing Region is currently empty/404. **(breaking change)**

**Twiml**
- Add new Polly Neural voices
- Add new languages to SSML `<lang>`.


[2022-08-10] Version 6.40.1
---------------------------
**Routes**
- Inbound Proccessing Region API - Public GA

**Supersim**
- Allow updating `DataLimit` on a Fleet


[2022-07-21] Version 6.40.0
---------------------------
**Library - Fix**
- [PR #660](https://github.com/twilio/twilio-php/pull/660): Multipart support. Thanks to [@erickskrauch](https://github.com/erickskrauch)!

**Flex**
- Add `status`, `error_code`, and `error_message` fields to Interaction `Channel`
- Adding `messenger` and `gbm` as supported channels for Interactions API

**Messaging**
- Update alpha_sender docs with new valid characters

**Verify**
- Reorder Verification Check parameters so `code` stays as the first parameter **(breaking change)**
- Rollback List Attempts API V2 back to pilot stage.


[2022-07-13] Version 6.39.0
---------------------------
**Library - Fix**
- [PR #739](https://github.com/twilio/twilio-php/pull/739): useragent regrex unit test for RC branch. Thanks to [@claudiachua](https://github.com/claudiachua)!

**Library - Test**
- [PR #738](https://github.com/twilio/twilio-php/pull/738): Adding misc as PR type. Thanks to [@rakatyal](https://github.com/rakatyal)!

**Conversations**
- Allowed to use `identity` as part of Participant's resource **(breaking change)**

**Lookups**
- Remove `enhanced_line_type` from the lookup response **(breaking change)**

**Supersim**
- Add support for `sim_ip_addresses` resource to helper libraries

**Verify**
- Changed summary param `service_sid` to `verify_service_sid` to be consistent with list attempts API **(breaking change)**
- Make `code` optional on Verification check to support `sna` attempts. **(breaking change)**


[2022-06-29] Version 6.38.0
---------------------------
**Api**
- Added `amazon-polly` to `usage_record` API.

**Insights**
- Added `annotation` field in call summary
- Added new endpoint to fetch/create/update Call Annotations

**Verify**
- Remove `api.verify.totp` beta flag and set maturity to `beta` for Verify TOTP properties and parameters. **(breaking change)**
- Changed summary param `verify_service_sid` to `service_sid` to be consistent with list attempts API **(breaking change)**

**Twiml**
- Add `maxQueueSize` to `Enqueue`


[2022-06-15] Version 6.37.3
---------------------------
**Lookups**
- Adding support for Lookup V2 API

**Studio**
- Corrected PII labels to be 30 days and added context to be PII

**Twiml**
- Add `statusCallbackMethod` attribute, nested `<Config` and `<Parameter>` elements to `<VirtualAgent>` noun.
- Add support for new Amazon Polly voices (Q2 2022) for `Say` verb
- Add support for `<Conversation>` noun


[2022-06-01] Version 6.37.2
---------------------------
**Library - Chore**
- [PR #736](https://github.com/twilio/twilio-php/pull/736): use Docker 'rc' tag for release candidate images. Thanks to [@childish-sambino](https://github.com/childish-sambino)!

**Library - Test**
- [PR #735](https://github.com/twilio/twilio-php/pull/735): increase code coverage for sonar analysis. Thanks to [@claudiachua](https://github.com/claudiachua)!
- [PR #734](https://github.com/twilio/twilio-php/pull/734): increase code coverage for sonar analysis. Thanks to [@claudiachua](https://github.com/claudiachua)!

**Library - Fix**
- [PR #732](https://github.com/twilio/twilio-php/pull/732): Disable redirects for the Guzzle HTTP client. Thanks to [@erickskrauch](https://github.com/erickskrauch)!


[2022-05-18] Version 6.37.1
---------------------------
**Api**
- Add property `media_url` to the recording resources

**Verify**
- Include `silent` as a channel type in the verifications API.


[2022-05-04] Version 6.37.0
---------------------------
**Library - Test**
- [PR #728](https://github.com/twilio/twilio-php/pull/728): add SonarCloud data collection. Thanks to [@childish-sambino](https://github.com/childish-sambino)!

**Conversations**
- Expose query parameter `type` in list operation on Address Configurations resource

**Supersim**
- Add `data_total_billed` and `billed_units` fields to Super SIM UsageRecords API response.
- Change ESimProfiles `Eid` parameter to optional to enable Activation Code download method support **(breaking change)**

**Verify**
- Deprecate `push.include_date` parameter in create and update service.


[2022-04-06] Version 6.36.1
---------------------------
**Library - Chore**
- [PR #726](https://github.com/twilio/twilio-php/pull/726): update user agent string for twilio-php. Thanks to [@claudiachua](https://github.com/claudiachua)!

**Api**
- Updated `provider_sid` visibility to private

**Verify**
- Verify List Attempts API summary endpoint added.
- Update PII documentation for `AccessTokens` `factor_friendly_name` property.

**Voice**
- make annotation parameter from /Calls API private


[2022-03-23] Version 6.36.0
---------------------------
**Library - Docs**
- [PR #725](https://github.com/twilio/twilio-php/pull/725): add upgrade guide for Php 5.x to 6.x. Thanks to [@JenniferMah](https://github.com/JenniferMah)!

**Api**
- Change `stream` url parameter to non optional
- Add `verify-totp` and `verify-whatsapp-conversations-business-initiated` categories to `usage_record` API

**Chat**
- Added v3 Channel update endpoint to support Public to Private channel migration

**Flex**
- Private Beta release of the Interactions API to support the upcoming release of Flex Conversations at the end of Q1 2022.
- Adding `channel_configs` object to Flex Configuration

**Media**
- Add max_duration param to PlayerStreamer

**Supersim**
- Remove Commands resource, use SmsCommands resource instead **(breaking change)**

**Taskrouter**
- Add limits to `split_by_wait_time` for Cumulative Statistics Endpoint

**Video**
- Change recording `status_callback_method` type from `enum` to `http_method` **(breaking change)**
- Add `status_callback` and `status_callback_method` to composition
- Add `status_callback` and `status_callback_method` to recording


[2022-03-09] Version 6.35.1
---------------------------
**Library - Chore**
- [PR #722](https://github.com/twilio/twilio-php/pull/722): push Datadog Release Metric upon deploy success. Thanks to [@eshanholtz](https://github.com/eshanholtz)!

**Api**
- Add optional boolean include_soft_deleted parameter to retrieve soft deleted recordings

**Chat**
- Add `X-Twilio-Wehook-Enabled` header to `delete` method in UserChannel resource

**Numbers**
- Expose `failure_reason` in the Supporting Documents resources

**Verify**
- Add optional `metadata` parameter to "verify challenge" endpoint, so the SDK/App can attach relevant information from the device when responding to challenges.
- remove beta feature flag to list atempt api operations.
- Add `ttl` and `date_created` properties to `AccessTokens`.


[2022-02-23] Version 6.35.0
---------------------------
**Api**
- Add `uri` to `stream` resource
- Add A2P Registration Fee category (`a2p-registration-fee`) to usage records
- Detected a bug and removed optional boolean include_soft_deleted parameter to retrieve soft deleted recordings. **(breaking change)**
- Add optional boolean include_soft_deleted parameter to retrieve soft deleted recordings.

**Numbers**
- Unrevert valid_until and sort filter params added to List Bundles resource
- Revert valid_until and sort filter params added to List Bundles resource
- Update sorting params added to List Bundles resource in the previous release

**Preview**
- Moved `web_channels` from preview to beta under `flex-api` **(breaking change)**

**Taskrouter**
- Add `ETag` as Response Header to List of Task, Reservation & Worker

**Verify**
- Remove outdated documentation commentary to contact sales. Product is already in public beta.
- Add optional `metadata` to factors.

**Twiml**
- Add new Polly Neural voices


[2022-02-09] Version 6.34.0
---------------------------
**Library - Fix**
- [PR #721](https://github.com/twilio/twilio-php/pull/721): install docs dependencies in separate step. Thanks to [@childish-sambino](https://github.com/childish-sambino)!
- [PR #720](https://github.com/twilio/twilio-php/pull/720): use offset +0000 for iso8601 conversion. Thanks to [@JenniferMah](https://github.com/JenniferMah)!
- [PR #713](https://github.com/twilio/twilio-php/pull/713): Php 8.1 support. Thanks to [@phpfui](https://github.com/phpfui)!
- [PR #719](https://github.com/twilio/twilio-php/pull/719): use offset +0000 for iso8601 conversions. Thanks to [@childish-sambino](https://github.com/childish-sambino)!
- [PR #718](https://github.com/twilio/twilio-php/pull/718): install and remove phpdox as required. Thanks to [@childish-sambino](https://github.com/childish-sambino)!

**Api**
- Add `stream` resource

**Conversations**
- Fixed DELETE request to accept "sid_like" params in Address Configuration resources **(breaking change)**
- Expose Address Configuration resource for `sms` and `whatsapp`

**Fax**
- Removed deprecated Programmable Fax Create and Update methods **(breaking change)**

**Insights**
- Rename `call_state` to `call_status` and remove `whisper` in conference participant summary **(breaking change)**

**Numbers**
- Expose valid_until filters as part of provisionally-approved compliance feature on the List Bundles resource

**Supersim**
- Fix typo in Fleet resource docs
- Updated documentation for the Fleet resource indicating that fields related to commands have been deprecated and to use sms_command fields instead.
- Add support for setting and reading `ip_commands_url` and `ip_commands_method` on Fleets resource for helper libraries
- Changed `sim` property in requests to create an SMS Command made to the /SmsCommands to accept SIM UniqueNames in addition to SIDs

**Verify**
- Update list attempts API to include new filters and response fields.


[2022-01-26] Version 6.33.1
---------------------------
**Insights**
- Added new endpoint to fetch Conference Participant Summary
- Added new endpoint to fetch Conference Summary

**Messaging**
- Add government_entity parameter to brand apis

**Verify**
- Add Access Token fetch endpoint to retrieve a previously created token.
- Add Access Token payload to the Access Token creation endpoint, including a unique Sid, so it's addressable while it's TTL is valid.


[2022-01-12] Version 6.33.0
---------------------------
**Library - Feature**
- [PR #714](https://github.com/twilio/twilio-php/pull/714): add GitHub release step during deploy. Thanks to [@childish-sambino](https://github.com/childish-sambino)!

**Api**
- Make fixed time scheduling parameters public **(breaking change)**

**Messaging**
- Add update brand registration API

**Numbers**
- Add API endpoint for List Bundle Copies resource

**Video**
- Enable external storage for all customers


[2021-12-15] Version 6.32.0
---------------------------
**Library - Feature**
- [PR #708](https://github.com/twilio/twilio-php/pull/708): run tests before deploying. Thanks to [@childish-sambino](https://github.com/childish-sambino)!

**Api**
- Add optional boolean send_as_mms parameter to the create action of Message resource **(breaking change)**
- Change team ownership for `call` delete

**Conversations**
- Change wording for `Service Webhook Configuration` resource fields

**Insights**
- Added new APIs for updating and getting voice insights flags by accountSid.

**Media**
- Add max_duration param to MediaProcessor

**Video**
- Add `EmptyRoomTimeout` and `UnusedRoomTimeout` properties to a room; add corresponding parameters to room creation

**Voice**
- Add endpoint to delete archived Calls


[2021-12-01] Version 6.31.2
---------------------------
**Library - Chore**
- [PR #707](https://github.com/twilio/twilio-php/pull/707): Test against php 8.1. Thanks to [@sergiy-petrov](https://github.com/sergiy-petrov)!

**Conversations**
- Add `Service Webhook Configuration` resource

**Flex**
- Adding `flex_insights_drilldown` and `flex_url` objects to Flex Configuration

**Messaging**
- Update us_app_to_person endpoints to remove beta feature flag based access

**Supersim**
- Add IP Commands resource

**Verify**
- Add optional `factor_friendly_name` parameter to the create access token endpoint.

**Video**
- Add maxParticipantDuration param to Rooms

**Twiml**
- Unrevert Add supported SSML children to `<emphasis>`, `<lang>`, `<p>`, `<prosody>`, `<s>`, and `<w>`.
- Revert Add supported SSML children to `<emphasis>`, `<lang>`, `<p>`, `<prosody>`, `<s>`, and `<w>`.


[2021-11-17] Version 6.31.1
---------------------------
**Library - Chore**
- [PR #706](https://github.com/twilio/twilio-php/pull/706): ignore directory and not just the content. Thanks to [@shwetha-manvinkurke](https://github.com/shwetha-manvinkurke)!
- [PR #705](https://github.com/twilio/twilio-php/pull/705): remove install as a dependency of test. Thanks to [@shwetha-manvinkurke](https://github.com/shwetha-manvinkurke)!

**Library - Fix**
- [PR #704](https://github.com/twilio/twilio-php/pull/704): docker publish issues. Thanks to [@shwetha-manvinkurke](https://github.com/shwetha-manvinkurke)!
- [PR #703](https://github.com/twilio/twilio-php/pull/703): git log retrieval issues. Thanks to [@shwetha-manvinkurke](https://github.com/shwetha-manvinkurke)!

**Frontline**
- Added `is_available` to User's resource

**Messaging**
- Added GET vetting API

**Verify**
- Add `WHATSAPP` to the attempts API.
- Allow to update `config.notification_platform` from `none` to `apn` or `fcm` and viceversa for Verify Push
- Add `none` as a valid `config.notification_platform` value for Verify Push

**Twiml**
- Add supported SSML children to `<emphasis>`, `<lang>`, `<p>`, `<prosody>`, `<s>`, and `<w>`.


[2021-11-03] Version 6.31.0
---------------------------
**Library - Chore**
- [PR #702](https://github.com/twilio/twilio-php/pull/702): add github action for test and deploy. Thanks to [@shwetha-manvinkurke](https://github.com/shwetha-manvinkurke)!

**Api**
- Updated `media_url` property to be treated as PII

**Messaging**
- Added a new enum for brand registration status named DELETED **(breaking change)**
- Add a new K12_EDUCATION use case in us_app_to_person_usecase api transaction
- Added a new enum for brand registration status named IN_REVIEW

**Serverless**
- Add node14 as a valid Build runtime

**Verify**
- Fix typos in Verify Push Factor documentation for the `config.notification_token` parameter.
- Added `TemplateCustomSubstitutions` on verification creation
- Make `TemplateSid` parameter public for Verification resource and `DefaultTemplateSid` parameter public for Service resource. **(breaking change)**


[2021-10-18] Version 6.30.0
---------------------------
**Library - Feature**
- [PR #700](https://github.com/twilio/twilio-php/pull/700): Add PlaybackGrant. Thanks to [@sarahcstringer](https://github.com/sarahcstringer)!

**Library - Fix**
- [PR #699](https://github.com/twilio/twilio-php/pull/699): use time insensitive string comparison. Thanks to [@eshanholtz](https://github.com/eshanholtz)!

**Library - Chore**
- [PR #698](https://github.com/twilio/twilio-php/pull/698): add time safe jwt verification logic. Thanks to [@shwetha-manvinkurke](https://github.com/shwetha-manvinkurke)!

**Api**
- Corrected enum values for `emergency_address_status` values in `/IncomingPhoneNumbers` response. **(breaking change)**
- Clarify `emergency_address_status` values in `/IncomingPhoneNumbers` response.

**Messaging**
- Add PUT and List brand vettings api
- Removes beta feature flag based visibility for us_app_to_person_registered and usecase field.Updates test cases to add POLITICAL usecase. **(breaking change)**
- Add brand_feedback as optional field to BrandRegistrations

**Video**
- Add `AudioOnly` to create room


[2021-10-06] Version 6.29.0
---------------------------
**Api**
- Add `emergency_address_status` attribute to `/IncomingPhoneNumbers` response.
- Add `siprec` resource

**Conversations**
- Added attachment parameters in configuration for `NewMessage` type of push notifications

**Flex**
- Adding `flex_insights_hr` object to Flex Configuration

**Numbers**
- Add API endpoint for Bundle ReplaceItems resource
- Add API endpoint for Bundle Copies resource

**Serverless**
- Add domain_base field to Service response

**Taskrouter**
- Add `If-Match` Header based on ETag for Worker Delete **(breaking change)**
- Add `If-Match` Header based on Etag for Reservation Update
- Add `If-Match` Header based on ETag for Worker Update
- Add `If-Match` Header based on ETag for Worker Delete
- Add `ETag` as Response Header to Worker

**Trunking**
- Added `transfer_caller_id` property on Trunks.

**Verify**
- Document new pilot `whatsapp` channel.


[2021-09-22] Version 6.28.3
---------------------------
**Events**
- Add segment sink

**Messaging**
- Add post_approval_required attribute in GET us_app_to_person_usecase api response
- Add Identity Status, Russell 3000, Tax Exempt Status and Should Skip SecVet fields for Brand Registrations
- Add Should Skip Secondary Vetting optional flag parameter to create Brand API


[2021-09-08] Version 6.28.2
---------------------------
**Api**
- Revert adding `siprec` resource
- Add `siprec` resource

**Messaging**
- Add 'mock' as an optional field to brand_registration api
- Add 'mock' as an optional field to us_app_to_person api
- Adds more Use Cases in us_app_to_person_usecase api transaction and updates us_app_to_person_usecase docs

**Verify**
- Verify List Templates API endpoint added.


[2021-08-25] Version 6.28.1
---------------------------
**Api**
- Add Programmabled Voice SIP Refer call transfers (`calls-transfers`) to usage records
- Add Flex Voice Usage category (`flex-usage`) to usage records

**Conversations**
- Add `Order` query parameter to Message resource read operation

**Insights**
- Added `partial` to enum processing_state_request
- Added abnormal session filter in Call Summaries

**Messaging**
- Add brand_registration_sid as an optional query param for us_app_to_person_usecase api

**Pricing**
- add trunking_numbers resource (v2)
- add trunking_country resource (v2)

**Verify**
- Changed to private beta the `TemplateSid` optional parameter on Verification creation.
- Added the optional parameter `Order` to the list Challenges endpoint to define the list order.


[2021-08-11] Version 6.28.0
---------------------------
**Api**
- Corrected the `price`, `call_sid_to_coach`, and `uri` data types for Conference, Participant, and Recording **(breaking change)**
- Made documentation for property `time_limit` in the call api public. **(breaking change)**
- Added `domain_sid` in sip_credential_list_mapping and sip_ip_access_control_list_mapping APIs **(breaking change)**

**Insights**
- Added new endpoint to fetch Call Summaries

**Messaging**
- Add brand_type field to a2p brand_registration api
- Revert brand registration api update to add brand_type field
- Add brand_type field to a2p brand_registration api

**Taskrouter**
- Add `X-Rate-Limit-Limit`, `X-Rate-Limit-Remaining`, and `X-Rate-Limit-Config` as Response Headers to all TaskRouter endpoints

**Verify**
- Add `TemplateSid` optional parameter on Verification creation.
- Include `whatsapp` as a channel type in the verifications API.


[2021-07-28] Version 6.27.1
---------------------------
**Conversations**
- Expose ParticipantConversations resource

**Taskrouter**
- Adding `links` to the activity resource

**Verify**
- Added a `Version` to Verify Factors `Webhooks` to add new fields without breaking old Webhooks.


[2021-07-14] Version 6.27.0
---------------------------
**Library - Fix**
- [PR #689](https://github.com/twilio/twilio-php/pull/689): replace deprecated method build_query with Query::build. Thanks to [@eshanholtz](https://github.com/eshanholtz)!

**Conversations**
- Changed `last_read_message_index` and `unread_messages_count` type in User Conversation's resource **(breaking change)**
- Expose UserConversations resource

**Messaging**
- Add brand_score field to brand registration responses


[2021-06-30] Version 6.26.0
---------------------------
**Conversations**
- Read-only Conversation Email Binding property `binding`

**Supersim**
- Add Billing Period resource for the Super Sim Pilot
- Add List endpoint to Billing Period resource for Super Sim Pilot
- Add Fetch endpoint to Billing Period resource for Super Sim Pilot

**Taskrouter**
- Update `transcribe` & `transcription_configuration` form params in Reservation update endpoint to have private visibility **(breaking change)**
- Add `transcribe` & `transcription_configuration` form params to Reservation update endpoint

**Twiml**
- Add `modify` event to `statusCallbackEvent` for `<Conference>`.


[2021-06-16] Version 6.25.0
---------------------------
**Api**
- Update `status` enum for Messages to include 'canceled'
- Update `update_status` enum for Messages to include 'canceled'

**Trusthub**
- Corrected the sid for policy sid in customer_profile_evaluation.json and trust_product_evaluation.json **(breaking change)**


[2021-06-02] Version 6.24.1
---------------------------
**Events**
- join Sinks and Subscriptions service

**Verify**
- Improved the documentation of `challenge` adding the maximum and minimum expected lengths of some fields.
- Improve documentation regarding `notification` by updating the documentation of the field `ttl`.


[2021-05-19] Version 6.24.0
---------------------------
**Events**
- add query param to return types filtered by Schema Id
- Add query param to return sinks filtered by status
- Add query param to return sinks used/not used by a subscription

**Messaging**
- Add fetch and delete instance endpoints to us_app_to_person api **(breaking change)**
- Remove delete list endpoint from us_app_to_person api **(breaking change)**
- Update read list endpoint to return a list of us_app_to_person compliance objects **(breaking change)**
- Add `sid` field to Preregistered US App To Person response

**Supersim**
- Mark `unique_name` in Sim, Fleet, NAP resources as not PII

**Video**
- [Composer] GA maturity level


[2021-05-05] Version 6.23.0
---------------------------
**Api**
- Corrected the data types for feedback summary fields **(breaking change)**
- Update the conference participant create `from` and `to` param to be endpoint type for supporting client identifier and sip address

**Bulkexports**
- promoting API maturity to GA

**Events**
- Add endpoint to update description in sink
- Remove beta-feature account flag

**Messaging**
- Update `status` field in us_app_to_person api to `campaign_status` **(breaking change)**

**Verify**
- Improve documentation regarding `push` factor and include extra information about `totp` factor.


[2021-04-21] Version 6.22.0
---------------------------
**Library - Chore**
- [PR #684](https://github.com/twilio/twilio-php/pull/684): Travis test for PHP8. Thanks to [@ibpavlov](https://github.com/ibpavlov)!

**Api**
- Revert Update the conference participant create `from` and `to` param to be endpoint type for supporting client identifier and sip address
- Update the conference participant create `from` and `to` param to be endpoint type for supporting client identifier and sip address

**Bulkexports**
- moving enum to doc root for auto generating documentation
- adding status enum and default output properties

**Events**
- Change schema_versions prop and key to versions **(breaking change)**

**Messaging**
- Add `use_inbound_webhook_on_number` field in Service API for fetch, create, update, read

**Taskrouter**
- Add `If-Match` Header based on ETag for Task Delete

**Verify**
- Add `AuthPayload` parameter to support verifying a `Challenge` upon creation. This is only supported for `totp` factors.
- Add support to resend the notifications of a `Challenge`. This is only supported for `push` factors.

**Twiml**
- Add Polly Neural voices.


[2021-04-07] Version 6.21.0
---------------------------
**Api**
- Added `announcement` event to conference status callback events
- Removed optional property `time_limit` in the call create request. **(breaking change)**

**Messaging**
- Add rate_limits field to Messaging Services US App To Person API
- Add usecase field in Service API for fetch, create, update, read
- Add us app to person api and us app to person usecase api as dependents in service
- Add us_app_to_person_registered field in service api for fetch, read, create, update
- Add us app to person api
- Add us app to person usecase api
- Add A2P external campaign api
- Add Usecases API

**Supersim**
- Add Create endpoint to Sims resource

**Verify**
- The `Binding` field is now returned when creating a `Factor`. This value won't be returned for other endpoints.

**Video**
- [Rooms] max_concurrent_published_tracks has got GA maturity

**Twiml**
- Add `announcement` event to `statusCallbackEvent` for `<Conference>`.


[2021-03-24] Version 6.20.0
---------------------------
**Api**
- Added optional parameter `CallToken` for create calls api
- Add optional property `time_limit` in the call create request.

**Bulkexports**
- adding two new fields with job api queue_position and estimated_completion_time

**Events**
- Add new endpoints to manage subscribed_events in subscriptions

**Numbers**
- Remove feature flags for RegulatoryCompliance endpoints

**Supersim**
- Add SmsCommands resource
- Add fields `SmsCommandsUrl`, `SmsCommandsMethod` and `SmsCommandsEnabled` to a Fleet resource

**Taskrouter**
- Add `If-Match` Header based on ETag for Task Update
- Add `ETag` as Response Headers to Tasks and Reservations

**Video**
- Recording rule beta flag **(breaking change)**
- [Rooms] Add RecordingRules param to Rooms


[2021-03-15] Version 6.19.0
---------------------------
**Events**
- Set maturity to beta

**Messaging**
- Adjust A2P brand registration status enum **(breaking change)**

**Studio**
- Remove internal safeguards for Studio V2 API usage now that it's GA

**Verify**
- Add support for creating and verifying totp factors. Support for totp factors is behind the `api.verify.totp` beta feature.

**Twiml**
- Add support for `<VirtualAgent>` noun


[2021-02-24] Version 6.18.0
---------------------------
**Events**
- Update description of types in the create sink resource

**Messaging**
- Add WA template header and footer
- Remove A2P campaign and use cases API **(breaking change)**
- Add number_registration_status field to read and fetch campaign responses

**Trusthub**
- Make all resources public

**Verify**
- Verify List Attempts API endpoints added.


[2021-02-10] Version 6.17.0
---------------------------
**Library - Fix**
- [PR #675](https://github.com/twilio/twilio-php/pull/675): shortcut syntax for new non-GA versions. Thanks to [@eshanholtz](https://github.com/eshanholtz)!

**Api**
- Revert change that conference participant create `from` and `to` param to be endpoint type for supporting client identifier and sip address
- Update the conference participant create `from` and `to` param to be endpoint type for supporting client identifier and sip address

**Events**
- Documentation should state that no fields are PII

**Flex**
- Adding `notifications` and `markdown` to Flex Configuration

**Messaging**
- Add A2P use cases API
- Add Brand Registrations API
- Add Campaigns API

**Serverless**
- Add runtime field to Build response and as an optional parameter to the Build create endpoint.
- Add @twilio/runtime-handler dependency to Build response example.

**Sync**
- Remove If-Match header for Document **(breaking change)**

**Twiml**
- Add `refer_url` and `refer_method` to `Dial`.


[2021-01-27] Version 6.16.1
---------------------------
**Studio**
- Studio V2 API is now GA

**Supersim**
- Allow updating `CommandsUrl` and `CommandsMethod` on a Fleet

**Twiml**
- Add `status_callback` and `status_callback_method` to `Stream`.


[2021-01-13] Version 6.16.0
---------------------------
**Api**
- Add 'Electric Imp v1 Usage' to usage categories

**Conversations**
- Changed `last_read_message_index` type in Participant's resource **(breaking change)**

**Insights**
- Added `created_time` to call summary.

**Sync**
- Remove HideExpired query parameter for filtering Sync Documents with expired **(breaking change)**

**Video**
- [Rooms] Expose maxConcurrentPublishedTracks property in Room resource


[2020-12-16] Version 6.15.1
---------------------------
**Api**
- Updated `call_event` default_output_properties to request and response.

**Conversations**
- Added `last_read_message_index` and `last_read_timestamp` to Participant's resource update operation
- Added `is_notifiable` and `is_online` to User's resource
- Added `reachability_enabled` parameters to update method for Conversation Service Configuration resource

**Messaging**
- Added WA template quick reply, URL, and phone number buttons

**Twiml**
- Add `sequential` to `Dial`.


[2020-12-08] Version 6.15.0
---------------------------
**Api**
- Added optional `RecordingTrack` parameter for create calls, create participants, and create call recordings
- Removed deprecated Programmable Chat usage record categories **(breaking change)**

**Twiml**
- Add `recordingTrack` to `Dial`.


[2020-12-02] Version 6.14.0
---------------------------
**Api**
- Remove `RecordingTrack` parameter for create calls, create participants, and create call recordings **(breaking change)**
- Added `RecordingTrack` parameter for create calls and create call recordings
- Add optional property `recording_track` in the participant create request

**Lookups**
- Changed `caller_name` and `carrier` properties type to object **(breaking change)**

**Trunking**
- Added dual channel recording options for Trunks.

**Twiml**
- Add `jitterBufferSize` and `participantLabel` to `Conference`.


[2020-11-18] Version 6.13.0
---------------------------
**Library - Feature**
- [PR #667](https://github.com/twilio/twilio-php/pull/667): add http logging for php. Thanks to [@JenniferMah](https://github.com/JenniferMah)!

**Api**
- Add new call events resource - GET /2010-04-01/Accounts/{account_sid}/Calls/{call_sid}/Events.json

**Conversations**
- Fixed default response property issue for Service Notifications Configuration

**Insights**
- Removing call_sid from participant summary. **(breaking change)**

**Serverless**
- Allow Service unique name to be used in path (in place of SID) in Service update request

**Sync**
- Added HideExpired query parameter for filtering Sync Documents with expired

**Verify**
- Challenge `Details` and `HiddenDetails` properties are now marked as `PII`
- Challenge `expiration_date` attribute updated to set a default value of five (5) minutes and to allow max dates of one (1) hour after creation.
- Entity `identity` attribute updated to allow values between 8 and 64 characters.
- Verify Service frinedly_name attribute updated from 64 max lenght to 30 characters.


[2020-11-05] Version 6.12.0
---------------------------
**Library - Feature**
- [PR #669](https://github.com/twilio/twilio-php/pull/669): Add region to access token. Thanks to [@ryan-rowland](https://github.com/ryan-rowland)!
- [PR #664](https://github.com/twilio/twilio-php/pull/664): Remove final from RequestValidator declaration. Thanks to [@hdimitrov1](https://github.com/hdimitrov1)!

**Api**
- Added `verify-push` to `usage_record` API

**Bulkexports**
- When creating a custom export the StartDay, EndDay, and FriendlyName fields were required but this was not reflected in the API documentation.  The API itself failed the request without these fields. **(breaking change)**
- Added property descriptions for Custom Export create method
- Clarified WebhookUrl and WebhookMethod must be provided together for Custom Export

**Insights**
- Added video room and participant summary apis.

**Ip_messaging**
- Create separate definition for ip-messaging
- Restore v2 endpoints for ip-messaging

**Verify**
- Verify Push madurity were updated from `preview` to `beta`
- `twilio_sandbox_mode` header was removed from Verify Push resources **(breaking change)**

**Video**
- [Rooms] Add Recording Rules API


[2020-10-14] Version 6.11.0
---------------------------
**Ai**
- Add `Annotation Project` and `Annotation Task` endpoints
- Add `Primitives` endpoints
- Add `meta.total` to the search endpoint

**Conversations**
- Mutable Conversation Unique Names

**Insights**
- Added `trust` to summary.

**Preview**
- Simplified `Channels` resource. The path is now `/BrandedChannels/branded_channel_sid/Channels` **(breaking change)**

**Verify**
- Changed parameters (`config` and `binding`) to use dot notation instead of JSON string (e.i. Before: `binding={"alg":"ES256", "public_key": "xxx..."}`, Now: `Binding.Alg="ES256"`, `Binding.PublicKey="xxx..."`). **(breaking change)**
- Changed parameters (`details` and `hidden_details`) to use dot notation instead of JSON string (e.i. Before: `details={"message":"Test message", "fields": "[{\"label\": \"Action 1\", \"value\":\"value 1\"}]"}`, Now: `details.Message="Test message"`, `Details.Fields=["{\"label\": \"Action 1\", \"value\":\"value 1\"}"]`). **(breaking change)**
- Removed `notify_service_sid` from `push` service configuration object. Add `Push.IncludeDate`, `Push.ApnCredentialSid` and `Push.FcmCredentialSid` service configuration parameters. **(breaking change)**


[2020-09-28] Version 6.10.4
---------------------------
**Api**
- Add optional property `call_reason` in the participant create request
- Make sip-domain-service endpoints available in stage-au1 and prod-au1

**Messaging**
- Removed beta feature gate from WhatsApp Templates API

**Serverless**
- Add Build Status endpoint

**Video**
- [Rooms] Add new room type "go" for WebRTC Go


[2020-09-21] Version 6.10.3
---------------------------
**Library - Fix**
- [PR #656](https://github.com/twilio/twilio-php/pull/656): Fix Deactivations API. Thanks to [@ssigwart](https://github.com/ssigwart)!

**Accounts**
- Add Auth Token rotation API

**Conversations**
- Change resource path for Webhook Configuration

**Events**
- Schemas API get all Schemas names and versions


[2020-09-16] Version 6.10.2
---------------------------
**Library - Fix**
- [PR #654](https://github.com/twilio/twilio-php/pull/654): drop the page limit calculation. Thanks to [@childish-sambino](https://github.com/childish-sambino)!

**Conversations**
- Expose Configuration and Service Configuration resources
- Add Unique Name support for Conversations
- Add Services Push Notification resource
- Add Service scoped Conversation resources
- Support Identity in Users resource endpoint

**Messaging**
- GA Deactivation List API
- Add domain cert API's(fetch, update, create) for link tracker

**Numbers**
- Add API endpoint for Supporting Document deletion

**Proxy**
- Updated usage of FailOnParticipantConflict param to apply only to accounts with ProxyAllowParticipantConflict account flag

**Supersim**
- Add `AccountSid` parameter to Sim resource update request
- Add `ready` status as an available status for a Sim resource


[2020-09-02] Version 6.10.1
---------------------------
**Ai**
- Initial release

**Bulkexports**
- removing public beta feature flag from BulkExports Jobs API

**Messaging**
- Add Deactivation List API
- Added page token parameter for fetch in WhatsApp Templates API

**Numbers**
- Add API endpoint for End User deletion

**Routes**
- Add Resource Route Configurations API
- Add Route Configurations API
- Initial Release

**Trunking**
- Added `transfer_mode` property on Trunks.


[2020-08-19] Version 6.10.0
---------------------------
**Library - Chore**
- [PR #651](https://github.com/twilio/twilio-php/pull/651): update GitHub branch references to use HEAD. Thanks to [@thinkingserious](https://github.com/thinkingserious)!

**Conversations**
- Allow Identity addition to Participants

**Events**
- Sinks API Get all Sinks

**Proxy**
- Clarified usage of FailOnParticipantConflict param as experimental
- Add FailOnParticipantConflict param to Proxy Session create and Proxy Participant create

**Supersim**
- Add fleet, network, and isoCountryCode to the UsageRecords resource
- Change sort order of UsageRecords from ascending to descending with respect to start time field, records are now returned newest to oldest

**Wireless**
- Removed `Start` and `End` parameters from the Data Sessions list endpoint. **(breaking change)**


[2020-08-05] Version 6.9.2
--------------------------
**Library - Fix**
- [PR #650](https://github.com/twilio/twilio-php/pull/650): support array parameters for Guzzle POSTs. Thanks to [@childish-sambino](https://github.com/childish-sambino)!

**Messaging**
- Add rejection reason support to WhatsApp API
- Removed status parameter for create and update in WhatsApp Templates API

**Proxy**
- Add FailOnParticipantConflict param to Proxy Session update

**Verify**
- Add `CustomFriendlyName` optional parameter on Verification creation.
- Changes in `Challenge` resource to update documentation of both `details` and `hidden_details` properties.


[2020-07-22] Version 6.9.1
--------------------------
**Api**
- Add optional Click Tracking and Scheduling parameters to Create action of Message resource

**Supersim**
- Add callback_url and callback_method parameters to Sim resource update request


[2020-07-08] Version 6.9.0
--------------------------
**Library - Chore**
- [PR #645](https://github.com/twilio/twilio-php/pull/645): Add Guzzle 7. Thanks to [@gmponos](https://github.com/gmponos)!

**Conversations**
- Allow Address updates for Participants
- Message delivery receipts

**Events**
- Add account_sid to subscription and subscribed_events resources

**Flex**
- Changed `wfm_integrations` Flex Configuration key to private **(breaking change)**

**Messaging**
- Add error states to WhatsApp Sender status with failed reason **(breaking change)**
- Delete WhatsApp Template API
- Update WhatsApp Template API
- Add WhatsApp Template Get Api (fetch and read)

**Numbers**
- Add `valid_until` in the Bundles resource
- Add API for Bundle deletion

**Verify**
- Removed support for `sms`, `totp` and `app-push` factor types in Verify push **(breaking change)**


[2020-06-24] Version 6.8.0
--------------------------
**Library - Fix**
- [PR #644](https://github.com/twilio/twilio-php/pull/644): Remove undefined variable and close an open file pointer. Thanks to [@Clivern](https://github.com/Clivern)!

**Api**
- Added optional `JitterBufferSize` parameter for creating conference participant
- Added optional `label` property for conference participants
- Added optional parameter `caller_id` for creating conference participant endpoint.

**Autopilot**
- Remove Export resource from Autopilot Assistant

**Conversations**
- Expose Conversation timers

**Monitor**
- Update start/end date filter params to support date-or-time format **(breaking change)**

**Numbers**
- Add `provisionally-approved` as a Supporting Document status

**Preview**
- Removed `Authy` resources. **(breaking change)**

**Supersim**
- Add ready state to the allowed transitions in the sim update call behind the feature flag supersim.ready-state.v1

**Verify**
- Webhook resources added to Verify services and put behind the `api.verify.push` beta feature

**Twiml**
- Add more supported locales for the `Gather` verb.


[2020-06-10] Version 6.7.0
--------------------------
**Library - Docs**
- [PR #642](https://github.com/twilio/twilio-php/pull/642): link to descriptive exception types. Thanks to [@thinkingserious](https://github.com/thinkingserious)!
- [PR #641](https://github.com/twilio/twilio-php/pull/641): link to custom HTTP client instructions. Thanks to [@thinkingserious](https://github.com/thinkingserious)!

**Api**
- Added `pstnconnectivity` to `usage_record` API

**Autopilot**
- Add dialogue_sid param to Query list resource

**Notify**
- delivery_callback_url and delivery_callback_enabled added

**Numbers**
- Add `provisionally-approved` as a Bundle status

**Preview**
- `BrandsInformation` endpoint now returns a single `BrandsInformation`
- Deleted phone number required field in the brand phone number endpoint from `kyc-api`
- Removed insights `preview API` from API Definitions **(breaking change)**
- Added `BrandsInformation` endpoint to query brands information stored in KYC

**Supersim**
- Require a Network Access Profile when creating a Fleet **(breaking change)**


[2020-05-27] Version 6.6.0
--------------------------
**Api**
- Added `reason_conference_ended` and `call_sid_ending_conference` to Conference read/fetch/update
- Fixed some examples to use the correct "TK" SID prefix for Trunk resources.

**Authy**
- Renamed `twilio_authy_sandbox_mode` headers to `twilio_sandbox_mode` **(breaking change)**
- Renamed `Twilio-Authy-*` headers to `Twilio-Veriry-*` **(breaking change)**

**Flex**
- Adding `flex_service_instance_sid` to Flex Configuration

**Preview**
- Removed insights preview API from API Definitions **(breaking change)**
- Added `Channels` endpoint to brand a phone number for BrandedCalls

**Serverless**
- Add Build Sid to Log results

**Supersim**
- Add Network Access Profile resource Networks subresource
- Allow specifying a Data Limit on Fleets

**Trunking**
- Fixed some examples to use the correct "TK" SID prefix for Trunk resources.


[2020-05-20] Version 6.5.0
--------------------------
**Library - Feature**
- [PR #635](https://github.com/twilio/twilio-php/pull/635): add __isset magic method for resource instance properties. Thanks to [@eshanholtz](https://github.com/eshanholtz)!
- [PR #633](https://github.com/twilio/twilio-php/pull/633): add regional and edge support. Thanks to [@eshanholtz](https://github.com/eshanholtz)!

**Library - Fix**
- [PR #634](https://github.com/twilio/twilio-php/pull/634): env var retrieval and url unparsing. Thanks to [@eshanholtz](https://github.com/eshanholtz)!

**Api**
- Add optional `emergency_caller_sid` parameter to SIP Domain
- Updated `call_reason` optional property to be treated as PII
- Added optional BYOC Trunk Sid property to Sip Domain API resource

**Autopilot**
- Add Restore resource to Autopilot Assistant

**Contacts**
- Added contacts Create API definition

**Events**
- Subscriptions API initial release

**Numbers**
- Add Evaluations API

**Supersim**
- Allow filtering the Fleets resource by Network Access Profile
- Allow assigning a Network Access Profile when creating and updating a Fleet
- Add Network Access Profiles resource

**Verify**
- Add `CustomCode` optional parameter on Verification creation.
- Add delete action on Service resource.

**Voice**
- Added endpoints for BYOC trunks, SIP connection policies and source IP mappings


[2020-04-29] Version 6.4.0
--------------------------
**Library - Feature**
- [PR #629](https://github.com/twilio/twilio-php/pull/629): add details to rest exception. Thanks to [@ashish-s](https://github.com/ashish-s)!

**Preview**
- Added `Dispatch` version to `preview`

**Studio**
- Reroute Create Execution for V2 to the V2 downstream

**Supersim**
- Add Networks resource


[2020-04-15] Version 6.3.0
--------------------------
**Note:** This release contains breaking changes, check our [upgrade guide](./UPGRADE.md#2020-04-15-62x-to-63x) for detailed migration notes.

**Library - Feature**
- [PR #623](https://github.com/twilio/twilio-php/pull/623): add custom header support. Thanks to [@eshanholtz](https://github.com/eshanholtz)! **(breaking change)**

**Library - Chore**
- [PR #625](https://github.com/twilio/twilio-php/pull/625): remove S3 URLs from test data. Thanks to [@childish-sambino](https://github.com/childish-sambino)!

**Api**
- Updated description for property `call_reason` in the call create request

**Contacts**
- Added Read, Delete All, and Delete by SID docs
- Initial Release

**Studio**
- Rename `flow_valid` to `flow_validate`
- Removed `errors` and `warnings` from flows error response and added new property named `details`
- Add Update Execution endpoints to v1 and v2 to end execution via API
- Add new `warnings` attribute v2 flow POST api

**Twiml**
- Add enhanced attribute to use with `speech_model` for the `Gather` verb


[2020-04-01] Version 6.2.0
--------------------------
**Library - Chore**
- [PR #621](https://github.com/twilio/twilio-php/pull/621): regenerate the library after generator refactor. Thanks to [@eshanholtz](https://github.com/eshanholtz)!

**Library - Fix**
- [PR #620](https://github.com/twilio/twilio-php/pull/620): php array types. Thanks to [@eshanholtz](https://github.com/eshanholtz)!

**Api**
- Add optional 'secure' parameter to SIP Domain

**Authy**
- Added an endpoint to list the challenges of a factor
- Added optional parameter `Push` when updating a service to send the service level push factor configuration

**Bulkexports**
- exposing bulk exports (vault/slapchop) API as public beta API

**Flex**
- Adding `queue_stats_configuration` and `wfm_integrations` to Flex Configuration

**Serverless**
- Add Function Version Content endpoint
- Allow build_sid to be optional for deployment requests

**Supersim**
- Remove `deactivated` status for Super SIM which is replaced by `inactive` **(breaking change)**


[2020-03-18] Version 6.1.0
--------------------------
**Library - Fix**
- [PR #617](https://github.com/twilio/twilio-php/pull/617): rename the TwiML 'Echo.php' filename to 'Echo_.php' to match the class name. Thanks to [@childish-sambino](https://github.com/childish-sambino)!

**Api**
- Add optional `emergency_calling_enabled` parameter to SIP Domain
- Add optional property `call_reason` in the call create request

**Authy**
- Added `friendly_name` and `config` as optional params to Factor update
- Added `config` param to Factor creation **(breaking change)**

**Preview**
- Renamed `SuccessRate` endpoint to `ImpressionsRate` for Branded Calls (fka. Verified by Twilio) **(breaking change)**


[2020-03-04] Version 6.0.1
--------------------------
**Library - Chore**
- [PR #611](https://github.com/twilio/twilio-php/pull/611): simplify Travis configuration. Thanks to [@childish-sambino](https://github.com/childish-sambino)!

**Authy**
- Added the `configuration` property to services to return the service level configurations
- Added optional parameter `Push` when creating a service to send the service level push factor configuration
- Remove FactorStrength support for Factors and Challenges **(breaking change)**

**Messaging**
- Correct the alpha sender capabilities property type **(breaking change)**

**Preview**
- Removed `/Devices` register Branded Calls endpoint, as per iOS sample app deprecation **(breaking change)**
- Removed `Twilio-Sandbox-Mode` request header from the Branded Calls endpoints, as not officially supported **(breaking change)**
- Removed `Verify` version from `preview` subdomain in favor to `verify` subdomain. **(breaking change)**

**Serverless**
- Add UI-Editable field to Services

**Supersim**
- Add `inactive` status for Super SIM which is an alias for `deactivated`

**Taskrouter**
- Adding value range to `priority` in task endpoint

**Verify**
- Fix `SendCodeAttempts` type. It's an array of objects instead of a unique object. **(breaking change)**


[2020-02-19] Version 6.0.0
--------------------------
**Library - Fix**
- [PR #607](https://github.com/twilio/twilio-php/pull/607): migrate to phpdox for source code doc generation. Thanks to [@childish-sambino](https://github.com/childish-sambino)!
- [PR #602](https://github.com/twilio/twilio-php/pull/602): only pass query option to Guzzle client if it is provided. Thanks to [@childish-sambino](https://github.com/childish-sambino)!

**Library - Feature**
- [PR #606](https://github.com/twilio/twilio-php/pull/606): add scalar param type declarations to generated API code. Thanks to [@childish-sambino](https://github.com/childish-sambino)! **(breaking change)**
- [PR #605](https://github.com/twilio/twilio-php/pull/605): add scalar param type declarations. Thanks to [@childish-sambino](https://github.com/childish-sambino)! **(breaking change)**

**Library - Chore**
- [PR #604](https://github.com/twilio/twilio-php/pull/604): add return types, drop 'array()' syntax, and address linter warnings in generated API code. Thanks to [@childish-sambino](https://github.com/childish-sambino)! **(breaking change)**
- [PR #603](https://github.com/twilio/twilio-php/pull/603): add return types, drop 'array()' syntax, and address linter warnings. Thanks to [@childish-sambino](https://github.com/childish-sambino)! **(breaking change)**
- [PR #595](https://github.com/twilio/twilio-php/pull/595): drop support for EOL versions of PHP. Thanks to [@childish-sambino](https://github.com/childish-sambino)! **(breaking change)**

**Api**
- Make call create parameters `async_amd`, `async_amd_status_callback`, and `async_amd_status_callback_method` public
- Add `trunk_sid` as an optional field to Call resource fetch/read responses
- Add property `queue_time` to successful response of create, fetch, and update requests for Call
- Add optional parameter `byoc` to conference participant create.

**Authy**
- Added support for challenges associated to push factors

**Flex**
- Adding `ui_dependencies` to Flex Configuration

**Messaging**
- Deprecate Session API **(breaking change)**

**Numbers**
- Add Regulations API

**Studio**
- Add Execution and Step endpoints to v2 API
- Add webhook_url to Flow response and add new /TestUsers endpoint to v2 API

**Taskrouter**
- Adding `longest_relative_task_age_in_queue` and `longest_relative_task_sid_in_queue` to TaskQueue Real Time Statistics API.
- Add `wait_duration_in_queue_until_accepted` aggregations to TaskQueues Cumulative Statistics endpoint
- Add TaskQueueEnteredDate property to Tasks.

**Video**
- [Composer] Clarification for the composition hooks creation documentation: one source is mandatory, either the `audio_sources` or the `video_layout`, but one of them has to be provided
- [Composer] `audio_sources` type on the composer HTTP POST command, changed from `sid[]` to `string[]` **(breaking change)**
- [Composer] Clarification for the composition creation documentation: one source is mandatory, either the `audio_sources` or the `video_layout`, but one of them has to be provided


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

[upgrade]: UPGRADE.md
