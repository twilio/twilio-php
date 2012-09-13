twilio-php Changelog
====================

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

