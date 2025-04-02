<?php
/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Api
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Twilio\Rest\Api\V2010\Account;

use Twilio\Options;
use Twilio\Values;

abstract class ConferenceOptions
{

    /**
     * @param string $dateCreatedBefore Only include conferences that were created on this date. Specify a date as `YYYY-MM-DD` in UTC, for example: `2009-07-06`, to read only conferences that were created on this date. You can also specify an inequality, such as `DateCreated<=YYYY-MM-DD`, to read conferences that were created on or before midnight of this date, and `DateCreated>=YYYY-MM-DD` to read conferences that were created on or after midnight of this date.
     * @param string $dateCreated Only include conferences that were created on this date. Specify a date as `YYYY-MM-DD` in UTC, for example: `2009-07-06`, to read only conferences that were created on this date. You can also specify an inequality, such as `DateCreated<=YYYY-MM-DD`, to read conferences that were created on or before midnight of this date, and `DateCreated>=YYYY-MM-DD` to read conferences that were created on or after midnight of this date.
     * @param string $dateCreatedAfter Only include conferences that were created on this date. Specify a date as `YYYY-MM-DD` in UTC, for example: `2009-07-06`, to read only conferences that were created on this date. You can also specify an inequality, such as `DateCreated<=YYYY-MM-DD`, to read conferences that were created on or before midnight of this date, and `DateCreated>=YYYY-MM-DD` to read conferences that were created on or after midnight of this date.
     * @param string $dateUpdatedBefore Only include conferences that were last updated on this date. Specify a date as `YYYY-MM-DD` in UTC, for example: `2009-07-06`, to read only conferences that were last updated on this date. You can also specify an inequality, such as `DateUpdated<=YYYY-MM-DD`, to read conferences that were last updated on or before midnight of this date, and `DateUpdated>=YYYY-MM-DD` to read conferences that were last updated on or after midnight of this date.
     * @param string $dateUpdated Only include conferences that were last updated on this date. Specify a date as `YYYY-MM-DD` in UTC, for example: `2009-07-06`, to read only conferences that were last updated on this date. You can also specify an inequality, such as `DateUpdated<=YYYY-MM-DD`, to read conferences that were last updated on or before midnight of this date, and `DateUpdated>=YYYY-MM-DD` to read conferences that were last updated on or after midnight of this date.
     * @param string $dateUpdatedAfter Only include conferences that were last updated on this date. Specify a date as `YYYY-MM-DD` in UTC, for example: `2009-07-06`, to read only conferences that were last updated on this date. You can also specify an inequality, such as `DateUpdated<=YYYY-MM-DD`, to read conferences that were last updated on or before midnight of this date, and `DateUpdated>=YYYY-MM-DD` to read conferences that were last updated on or after midnight of this date.
     * @param string $friendlyName The string that identifies the Conference resources to read.
     * @param string $status The status of the resources to read. Can be: `init`, `in-progress`, or `completed`.
     * @return ReadConferenceOptions Options builder
     */
    public static function read(
        
        ?string $dateCreatedBefore = null,
        ?string $dateCreated = null,
        ?string $dateCreatedAfter = null,
        ?string $dateUpdatedBefore = null,
        ?string $dateUpdated = null,
        ?string $dateUpdatedAfter = null,
        string $friendlyName = Values::NONE,
        string $status = Values::NONE

    ): ReadConferenceOptions
    {
        return new ReadConferenceOptions(
            $dateCreatedBefore,
            $dateCreated,
            $dateCreatedAfter,
            $dateUpdatedBefore,
            $dateUpdated,
            $dateUpdatedAfter,
            $friendlyName,
            $status
        );
    }

    /**
     * @param string $status
     * @param string $announceUrl The URL we should call to announce something into the conference. The URL may return an MP3 file, a WAV file, or a TwiML document that contains `<Play>`, `<Say>`, `<Pause>`, or `<Redirect>` verbs.
     * @param string $announceMethod The HTTP method used to call `announce_url`. Can be: `GET` or `POST` and the default is `POST`
     * @return UpdateConferenceOptions Options builder
     */
    public static function update(
        
        string $status = Values::NONE,
        string $announceUrl = Values::NONE,
        string $announceMethod = Values::NONE

    ): UpdateConferenceOptions
    {
        return new UpdateConferenceOptions(
            $status,
            $announceUrl,
            $announceMethod
        );
    }

}


class ReadConferenceOptions extends Options
    {
    /**
     * @param string $dateCreatedBefore Only include conferences that were created on this date. Specify a date as `YYYY-MM-DD` in UTC, for example: `2009-07-06`, to read only conferences that were created on this date. You can also specify an inequality, such as `DateCreated<=YYYY-MM-DD`, to read conferences that were created on or before midnight of this date, and `DateCreated>=YYYY-MM-DD` to read conferences that were created on or after midnight of this date.
     * @param string $dateCreated Only include conferences that were created on this date. Specify a date as `YYYY-MM-DD` in UTC, for example: `2009-07-06`, to read only conferences that were created on this date. You can also specify an inequality, such as `DateCreated<=YYYY-MM-DD`, to read conferences that were created on or before midnight of this date, and `DateCreated>=YYYY-MM-DD` to read conferences that were created on or after midnight of this date.
     * @param string $dateCreatedAfter Only include conferences that were created on this date. Specify a date as `YYYY-MM-DD` in UTC, for example: `2009-07-06`, to read only conferences that were created on this date. You can also specify an inequality, such as `DateCreated<=YYYY-MM-DD`, to read conferences that were created on or before midnight of this date, and `DateCreated>=YYYY-MM-DD` to read conferences that were created on or after midnight of this date.
     * @param string $dateUpdatedBefore Only include conferences that were last updated on this date. Specify a date as `YYYY-MM-DD` in UTC, for example: `2009-07-06`, to read only conferences that were last updated on this date. You can also specify an inequality, such as `DateUpdated<=YYYY-MM-DD`, to read conferences that were last updated on or before midnight of this date, and `DateUpdated>=YYYY-MM-DD` to read conferences that were last updated on or after midnight of this date.
     * @param string $dateUpdated Only include conferences that were last updated on this date. Specify a date as `YYYY-MM-DD` in UTC, for example: `2009-07-06`, to read only conferences that were last updated on this date. You can also specify an inequality, such as `DateUpdated<=YYYY-MM-DD`, to read conferences that were last updated on or before midnight of this date, and `DateUpdated>=YYYY-MM-DD` to read conferences that were last updated on or after midnight of this date.
     * @param string $dateUpdatedAfter Only include conferences that were last updated on this date. Specify a date as `YYYY-MM-DD` in UTC, for example: `2009-07-06`, to read only conferences that were last updated on this date. You can also specify an inequality, such as `DateUpdated<=YYYY-MM-DD`, to read conferences that were last updated on or before midnight of this date, and `DateUpdated>=YYYY-MM-DD` to read conferences that were last updated on or after midnight of this date.
     * @param string $friendlyName The string that identifies the Conference resources to read.
     * @param string $status The status of the resources to read. Can be: `init`, `in-progress`, or `completed`.
     */
    public function __construct(
        
        ?string $dateCreatedBefore = null,
        ?string $dateCreated = null,
        ?string $dateCreatedAfter = null,
        ?string $dateUpdatedBefore = null,
        ?string $dateUpdated = null,
        ?string $dateUpdatedAfter = null,
        string $friendlyName = Values::NONE,
        string $status = Values::NONE

    ) {
        $this->options['dateCreatedBefore'] = $dateCreatedBefore;
        $this->options['dateCreated'] = $dateCreated;
        $this->options['dateCreatedAfter'] = $dateCreatedAfter;
        $this->options['dateUpdatedBefore'] = $dateUpdatedBefore;
        $this->options['dateUpdated'] = $dateUpdated;
        $this->options['dateUpdatedAfter'] = $dateUpdatedAfter;
        $this->options['friendlyName'] = $friendlyName;
        $this->options['status'] = $status;
    }

    /**
     * Only include conferences that were created on this date. Specify a date as `YYYY-MM-DD` in UTC, for example: `2009-07-06`, to read only conferences that were created on this date. You can also specify an inequality, such as `DateCreated<=YYYY-MM-DD`, to read conferences that were created on or before midnight of this date, and `DateCreated>=YYYY-MM-DD` to read conferences that were created on or after midnight of this date.
     *
     * @param string $dateCreatedBefore Only include conferences that were created on this date. Specify a date as `YYYY-MM-DD` in UTC, for example: `2009-07-06`, to read only conferences that were created on this date. You can also specify an inequality, such as `DateCreated<=YYYY-MM-DD`, to read conferences that were created on or before midnight of this date, and `DateCreated>=YYYY-MM-DD` to read conferences that were created on or after midnight of this date.
     * @return $this Fluent Builder
     */
    public function setDateCreatedBefore(string $dateCreatedBefore): self
    {
        $this->options['dateCreatedBefore'] = $dateCreatedBefore;
        return $this;
    }

    /**
     * Only include conferences that were created on this date. Specify a date as `YYYY-MM-DD` in UTC, for example: `2009-07-06`, to read only conferences that were created on this date. You can also specify an inequality, such as `DateCreated<=YYYY-MM-DD`, to read conferences that were created on or before midnight of this date, and `DateCreated>=YYYY-MM-DD` to read conferences that were created on or after midnight of this date.
     *
     * @param string $dateCreated Only include conferences that were created on this date. Specify a date as `YYYY-MM-DD` in UTC, for example: `2009-07-06`, to read only conferences that were created on this date. You can also specify an inequality, such as `DateCreated<=YYYY-MM-DD`, to read conferences that were created on or before midnight of this date, and `DateCreated>=YYYY-MM-DD` to read conferences that were created on or after midnight of this date.
     * @return $this Fluent Builder
     */
    public function setDateCreated(string $dateCreated): self
    {
        $this->options['dateCreated'] = $dateCreated;
        return $this;
    }

    /**
     * Only include conferences that were created on this date. Specify a date as `YYYY-MM-DD` in UTC, for example: `2009-07-06`, to read only conferences that were created on this date. You can also specify an inequality, such as `DateCreated<=YYYY-MM-DD`, to read conferences that were created on or before midnight of this date, and `DateCreated>=YYYY-MM-DD` to read conferences that were created on or after midnight of this date.
     *
     * @param string $dateCreatedAfter Only include conferences that were created on this date. Specify a date as `YYYY-MM-DD` in UTC, for example: `2009-07-06`, to read only conferences that were created on this date. You can also specify an inequality, such as `DateCreated<=YYYY-MM-DD`, to read conferences that were created on or before midnight of this date, and `DateCreated>=YYYY-MM-DD` to read conferences that were created on or after midnight of this date.
     * @return $this Fluent Builder
     */
    public function setDateCreatedAfter(string $dateCreatedAfter): self
    {
        $this->options['dateCreatedAfter'] = $dateCreatedAfter;
        return $this;
    }

    /**
     * Only include conferences that were last updated on this date. Specify a date as `YYYY-MM-DD` in UTC, for example: `2009-07-06`, to read only conferences that were last updated on this date. You can also specify an inequality, such as `DateUpdated<=YYYY-MM-DD`, to read conferences that were last updated on or before midnight of this date, and `DateUpdated>=YYYY-MM-DD` to read conferences that were last updated on or after midnight of this date.
     *
     * @param string $dateUpdatedBefore Only include conferences that were last updated on this date. Specify a date as `YYYY-MM-DD` in UTC, for example: `2009-07-06`, to read only conferences that were last updated on this date. You can also specify an inequality, such as `DateUpdated<=YYYY-MM-DD`, to read conferences that were last updated on or before midnight of this date, and `DateUpdated>=YYYY-MM-DD` to read conferences that were last updated on or after midnight of this date.
     * @return $this Fluent Builder
     */
    public function setDateUpdatedBefore(string $dateUpdatedBefore): self
    {
        $this->options['dateUpdatedBefore'] = $dateUpdatedBefore;
        return $this;
    }

    /**
     * Only include conferences that were last updated on this date. Specify a date as `YYYY-MM-DD` in UTC, for example: `2009-07-06`, to read only conferences that were last updated on this date. You can also specify an inequality, such as `DateUpdated<=YYYY-MM-DD`, to read conferences that were last updated on or before midnight of this date, and `DateUpdated>=YYYY-MM-DD` to read conferences that were last updated on or after midnight of this date.
     *
     * @param string $dateUpdated Only include conferences that were last updated on this date. Specify a date as `YYYY-MM-DD` in UTC, for example: `2009-07-06`, to read only conferences that were last updated on this date. You can also specify an inequality, such as `DateUpdated<=YYYY-MM-DD`, to read conferences that were last updated on or before midnight of this date, and `DateUpdated>=YYYY-MM-DD` to read conferences that were last updated on or after midnight of this date.
     * @return $this Fluent Builder
     */
    public function setDateUpdated(string $dateUpdated): self
    {
        $this->options['dateUpdated'] = $dateUpdated;
        return $this;
    }

    /**
     * Only include conferences that were last updated on this date. Specify a date as `YYYY-MM-DD` in UTC, for example: `2009-07-06`, to read only conferences that were last updated on this date. You can also specify an inequality, such as `DateUpdated<=YYYY-MM-DD`, to read conferences that were last updated on or before midnight of this date, and `DateUpdated>=YYYY-MM-DD` to read conferences that were last updated on or after midnight of this date.
     *
     * @param string $dateUpdatedAfter Only include conferences that were last updated on this date. Specify a date as `YYYY-MM-DD` in UTC, for example: `2009-07-06`, to read only conferences that were last updated on this date. You can also specify an inequality, such as `DateUpdated<=YYYY-MM-DD`, to read conferences that were last updated on or before midnight of this date, and `DateUpdated>=YYYY-MM-DD` to read conferences that were last updated on or after midnight of this date.
     * @return $this Fluent Builder
     */
    public function setDateUpdatedAfter(string $dateUpdatedAfter): self
    {
        $this->options['dateUpdatedAfter'] = $dateUpdatedAfter;
        return $this;
    }

    /**
     * The string that identifies the Conference resources to read.
     *
     * @param string $friendlyName The string that identifies the Conference resources to read.
     * @return $this Fluent Builder
     */
    public function setFriendlyName(string $friendlyName): self
    {
        $this->options['friendlyName'] = $friendlyName;
        return $this;
    }

    /**
     * The status of the resources to read. Can be: `init`, `in-progress`, or `completed`.
     *
     * @param string $status The status of the resources to read. Can be: `init`, `in-progress`, or `completed`.
     * @return $this Fluent Builder
     */
    public function setStatus(string $status): self
    {
        $this->options['status'] = $status;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string
    {
        $options = \http_build_query(Values::of($this->options), '', ' ');
        return '[Twilio.Api.V2010.ReadConferenceOptions ' . $options . ']';
    }
}

class UpdateConferenceOptions extends Options
    {
    /**
     * @param string $status
     * @param string $announceUrl The URL we should call to announce something into the conference. The URL may return an MP3 file, a WAV file, or a TwiML document that contains `<Play>`, `<Say>`, `<Pause>`, or `<Redirect>` verbs.
     * @param string $announceMethod The HTTP method used to call `announce_url`. Can be: `GET` or `POST` and the default is `POST`
     */
    public function __construct(
        
        string $status = Values::NONE,
        string $announceUrl = Values::NONE,
        string $announceMethod = Values::NONE

    ) {
        $this->options['status'] = $status;
        $this->options['announceUrl'] = $announceUrl;
        $this->options['announceMethod'] = $announceMethod;
    }

    /**
     * @param string $status
     * @return $this Fluent Builder
     */
    public function setStatus(string $status): self
    {
        $this->options['status'] = $status;
        return $this;
    }

    /**
     * The URL we should call to announce something into the conference. The URL may return an MP3 file, a WAV file, or a TwiML document that contains `<Play>`, `<Say>`, `<Pause>`, or `<Redirect>` verbs.
     *
     * @param string $announceUrl The URL we should call to announce something into the conference. The URL may return an MP3 file, a WAV file, or a TwiML document that contains `<Play>`, `<Say>`, `<Pause>`, or `<Redirect>` verbs.
     * @return $this Fluent Builder
     */
    public function setAnnounceUrl(string $announceUrl): self
    {
        $this->options['announceUrl'] = $announceUrl;
        return $this;
    }

    /**
     * The HTTP method used to call `announce_url`. Can be: `GET` or `POST` and the default is `POST`
     *
     * @param string $announceMethod The HTTP method used to call `announce_url`. Can be: `GET` or `POST` and the default is `POST`
     * @return $this Fluent Builder
     */
    public function setAnnounceMethod(string $announceMethod): self
    {
        $this->options['announceMethod'] = $announceMethod;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string
    {
        $options = \http_build_query(Values::of($this->options), '', ' ');
        return '[Twilio.Api.V2010.UpdateConferenceOptions ' . $options . ']';
    }
}

