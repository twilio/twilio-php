twilio-php Changelog
====================

Version 3.2.4
-------------

Released on March 14, 2012

- If no version is passed to the Services_Twilio constructor, the library will
  default to the most recent API version.

Version 3.3.1
-------------

Released on May 1, 2012

- Use the 'Accept-Charset' header to specify we want to receive UTF-8 encoded 
data from the Twilio API. Remove unused XML parsing logic, as the library never 
requests XML data.

Version 3.3.2
-------------

Released on May 3, 2012

- If you pass booleans in as TwiML (ex transcribe="true"), convert them to
  the strings "true" and "false" instead of outputting the incorrect values 
  1 and "".

Version 3.5.0
-------------

Released on June 30, 2012

- Support paging through resources using the "next_page_uri" parameter instead
of manually constructing parameters using the "Page" and "PageSize" parameters.
Specifically, this allows the library to use the "AfterSid" parameter, which
leads to improved performance when paging deep into your resource list.

This involved a major refactor of the library. The documented interface to
twilio-php will not change. However, some undocumented public methods are no
longer supported. Specifically, the following classes are no longer available:

- Services/Twilio/ArrayDataProxy.php
- Services/Twilio/CachingDataProxy.php
- Services/Twilio/DataProxy.php

In addition, the following public methods have been removed:

- `setProxy`, in Services/Twilio/InstanceResource.php
- `getSchema`, in Services/Twilio/ListResource.php,
    Services/Twilio/Rest/AvailablePhoneNumbers.php,
    Services/Twilio/Rest/SMSMessages.php

- `retrieveData`, in Services/Twilio/Resource.php
- `deleteData`, in Services/Twilio/Resource.php
- `addSubresource`, in Services/Twilio/Resource.php

Please check your own code for compatibility before upgrading.
