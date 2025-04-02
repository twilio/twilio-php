<?php

/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Messaging
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Twilio\Rest\Messaging\V1;

use Twilio\Exceptions\TwilioException;
use Twilio\ListResource;
use Twilio\Options;
use Twilio\Stream;
use Twilio\Values;
use Twilio\Version;
use Twilio\Serialize;


class TollfreeVerificationList extends ListResource
    {
    /**
     * Construct the TollfreeVerificationList
     *
     * @param Version $version Version that contains the resource
     */
    public function __construct(
        Version $version
    ) {
        parent::__construct($version);

        // Path Solution
        $this->solution = [
        ];

        $this->uri = '/Tollfree/Verifications';
    }

    /**
     * Create the TollfreeVerificationInstance
     *
     * @param string $businessName The name of the business or organization using the Tollfree number.
     * @param string $businessWebsite The website of the business or organization using the Tollfree number.
     * @param string $notificationEmail The email address to receive the notification about the verification result. .
     * @param string[] $useCaseCategories The category of the use case for the Tollfree Number. List as many are applicable..
     * @param string $useCaseSummary Use this to further explain how messaging is used by the business or organization.
     * @param string $productionMessageSample An example of message content, i.e. a sample message.
     * @param string[] $optInImageUrls Link to an image that shows the opt-in workflow. Multiple images allowed and must be a publicly hosted URL.
     * @param string $optInType
     * @param string $messageVolume Estimate monthly volume of messages from the Tollfree Number.
     * @param string $tollfreePhoneNumberSid The SID of the Phone Number associated with the Tollfree Verification.
     * @param array|Options $options Optional Arguments
     * @return TollfreeVerificationInstance Created TollfreeVerificationInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function create(string $businessName, string $businessWebsite, string $notificationEmail, array $useCaseCategories, string $useCaseSummary, string $productionMessageSample, array $optInImageUrls, string $optInType, string $messageVolume, string $tollfreePhoneNumberSid, array $options = []): TollfreeVerificationInstance
    {

        $options = new Values($options);

        $data = Values::of([
            'BusinessName' =>
                $businessName,
            'BusinessWebsite' =>
                $businessWebsite,
            'NotificationEmail' =>
                $notificationEmail,
            'UseCaseCategories' =>
                Serialize::map($useCaseCategories,function ($e) { return $e; }),
            'UseCaseSummary' =>
                $useCaseSummary,
            'ProductionMessageSample' =>
                $productionMessageSample,
            'OptInImageUrls' =>
                Serialize::map($optInImageUrls,function ($e) { return $e; }),
            'OptInType' =>
                $optInType,
            'MessageVolume' =>
                $messageVolume,
            'TollfreePhoneNumberSid' =>
                $tollfreePhoneNumberSid,
            'CustomerProfileSid' =>
                $options['customerProfileSid'],
            'BusinessStreetAddress' =>
                $options['businessStreetAddress'],
            'BusinessStreetAddress2' =>
                $options['businessStreetAddress2'],
            'BusinessCity' =>
                $options['businessCity'],
            'BusinessStateProvinceRegion' =>
                $options['businessStateProvinceRegion'],
            'BusinessPostalCode' =>
                $options['businessPostalCode'],
            'BusinessCountry' =>
                $options['businessCountry'],
            'AdditionalInformation' =>
                $options['additionalInformation'],
            'BusinessContactFirstName' =>
                $options['businessContactFirstName'],
            'BusinessContactLastName' =>
                $options['businessContactLastName'],
            'BusinessContactEmail' =>
                $options['businessContactEmail'],
            'BusinessContactPhone' =>
                $options['businessContactPhone'],
            'ExternalReferenceId' =>
                $options['externalReferenceId'],
        ]);

        $headers = Values::of(['Content-Type' => 'application/x-www-form-urlencoded' ]);
        $payload = $this->version->create('POST', $this->uri, [], $data, $headers);

        return new TollfreeVerificationInstance(
            $this->version,
            $payload
        );
    }


    /**
     * Reads TollfreeVerificationInstance records from the API as a list.
     * Unlike stream(), this operation is eager and will load `limit` records into
     * memory before returning.
     *
     * @param array|Options $options Optional Arguments
     * @param int $limit Upper limit for the number of records to return. read()
     *                   guarantees to never return more than limit.  Default is no
     *                   limit
     * @param mixed $pageSize Number of records to fetch per request, when not set
     *                        will use the default value of 50 records.  If no
     *                        page_size is defined but a limit is defined, read()
     *                        will attempt to read the limit with the most
     *                        efficient page size, i.e. min(limit, 1000)
     * @return TollfreeVerificationInstance[] Array of results
     */
    public function read(array $options = [], ?int $limit = null, $pageSize = null): array
    {
        return \iterator_to_array($this->stream($options, $limit, $pageSize), false);
    }

    /**
     * Streams TollfreeVerificationInstance records from the API as a generator stream.
     * This operation lazily loads records as efficiently as possible until the
     * limit
     * is reached.
     * The results are returned as a generator, so this operation is memory
     * efficient.
     *
     * @param array|Options $options Optional Arguments
     * @param int $limit Upper limit for the number of records to return. stream()
     *                   guarantees to never return more than limit.  Default is no
     *                   limit
     * @param mixed $pageSize Number of records to fetch per request, when not set
     *                        will use the default value of 50 records.  If no
     *                        page_size is defined but a limit is defined, stream()
     *                        will attempt to read the limit with the most
     *                        efficient page size, i.e. min(limit, 1000)
     * @return Stream stream of results
     */
    public function stream(array $options = [], ?int $limit = null, $pageSize = null): Stream
    {
        $limits = $this->version->readLimits($limit, $pageSize);

        $page = $this->page($options, $limits['pageSize']);

        return $this->version->stream($page, $limits['limit'], $limits['pageLimit']);
    }

    /**
     * Retrieve a single page of TollfreeVerificationInstance records from the API.
     * Request is executed immediately
     *
     * @param mixed $pageSize Number of records to return, defaults to 50
     * @param string $pageToken PageToken provided by the API
     * @param mixed $pageNumber Page Number, this value is simply for client state
     * @return TollfreeVerificationPage Page of TollfreeVerificationInstance
     */
    public function page(
        array $options = [],
        $pageSize = Values::NONE,
        string $pageToken = Values::NONE,
        $pageNumber = Values::NONE
    ): TollfreeVerificationPage
    {
        $options = new Values($options);

        $params = Values::of([
            'TollfreePhoneNumberSid' =>
                $options['tollfreePhoneNumberSid'],
            'Status' =>
                $options['status'],
            'ExternalReferenceId' =>
                $options['externalReferenceId'],
            'IncludeSubAccounts' =>
                Serialize::booleanToString($options['includeSubAccounts']),
            'PageToken' => $pageToken,
            'Page' => $pageNumber,
            'PageSize' => $pageSize,
        ]);

        $response = $this->version->page('GET', $this->uri, $params);

        return new TollfreeVerificationPage($this->version, $response, $this->solution);
    }

    /**
     * Retrieve a specific page of TollfreeVerificationInstance records from the API.
     * Request is executed immediately
     *
     * @param string $targetUrl API-generated URL for the requested results page
     * @return TollfreeVerificationPage Page of TollfreeVerificationInstance
     */
    public function getPage(string $targetUrl): TollfreeVerificationPage
    {
        $response = $this->version->getDomain()->getClient()->request(
            'GET',
            $targetUrl
        );

        return new TollfreeVerificationPage($this->version, $response, $this->solution);
    }


    /**
     * Constructs a TollfreeVerificationContext
     *
     * @param string $sid The unique string to identify Tollfree Verification.
     */
    public function getContext(
        string $sid
        
    ): TollfreeVerificationContext
    {
        return new TollfreeVerificationContext(
            $this->version,
            $sid
        );
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string
    {
        return '[Twilio.Messaging.V1.TollfreeVerificationList]';
    }
}
