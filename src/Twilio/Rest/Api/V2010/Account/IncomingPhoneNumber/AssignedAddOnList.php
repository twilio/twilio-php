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

namespace Twilio\Rest\Api\V2010\Account\IncomingPhoneNumber;

use Twilio\Exceptions\TwilioException;
use Twilio\ListResource;
use Twilio\Stream;
use Twilio\Values;
use Twilio\Version;


class AssignedAddOnList extends ListResource
    {
    /**
     * Construct the AssignedAddOnList
     *
     * @param Version $version Version that contains the resource
     * @param string $accountSid The SID of the [Account](https://www.twilio.com/docs/iam/api/account) that will create the resource.
     * @param string $resourceSid The SID of the Phone Number to assign the Add-on.
     */
    public function __construct(
        Version $version,
        string $accountSid,
        string $resourceSid
    ) {
        parent::__construct($version);

        // Path Solution
        $this->solution = [
        'accountSid' =>
            $accountSid,
        
        'resourceSid' =>
            $resourceSid,
        
        ];

        $this->uri = '/Accounts/' . \rawurlencode($accountSid)
        .'/IncomingPhoneNumbers/' . \rawurlencode($resourceSid)
        .'/AssignedAddOns.json';
    }

    /**
     * Create the AssignedAddOnInstance
     *
     * @param string $installedAddOnSid The SID that identifies the Add-on installation.
     * @return AssignedAddOnInstance Created AssignedAddOnInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function create(string $installedAddOnSid): AssignedAddOnInstance
    {

        $data = Values::of([
            'InstalledAddOnSid' =>
                $installedAddOnSid,
        ]);

        $headers = Values::of(['Content-Type' => 'application/x-www-form-urlencoded' ]);
        $payload = $this->version->create('POST', $this->uri, [], $data, $headers);

        return new AssignedAddOnInstance(
            $this->version,
            $payload,
            $this->solution['accountSid'],
            $this->solution['resourceSid']
        );
    }


    /**
     * Reads AssignedAddOnInstance records from the API as a list.
     * Unlike stream(), this operation is eager and will load `limit` records into
     * memory before returning.
     *
     * @param int $limit Upper limit for the number of records to return. read()
     *                   guarantees to never return more than limit.  Default is no
     *                   limit
     * @param mixed $pageSize Number of records to fetch per request, when not set
     *                        will use the default value of 50 records.  If no
     *                        page_size is defined but a limit is defined, read()
     *                        will attempt to read the limit with the most
     *                        efficient page size, i.e. min(limit, 1000)
     * @return AssignedAddOnInstance[] Array of results
     */
    public function read(?int $limit = null, $pageSize = null): array
    {
        return \iterator_to_array($this->stream($limit, $pageSize), false);
    }

    /**
     * Streams AssignedAddOnInstance records from the API as a generator stream.
     * This operation lazily loads records as efficiently as possible until the
     * limit
     * is reached.
     * The results are returned as a generator, so this operation is memory
     * efficient.
     *
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
    public function stream(?int $limit = null, $pageSize = null): Stream
    {
        $limits = $this->version->readLimits($limit, $pageSize);

        $page = $this->page($limits['pageSize']);

        return $this->version->stream($page, $limits['limit'], $limits['pageLimit']);
    }

    /**
     * Retrieve a single page of AssignedAddOnInstance records from the API.
     * Request is executed immediately
     *
     * @param mixed $pageSize Number of records to return, defaults to 50
     * @param string $pageToken PageToken provided by the API
     * @param mixed $pageNumber Page Number, this value is simply for client state
     * @return AssignedAddOnPage Page of AssignedAddOnInstance
     */
    public function page(
        $pageSize = Values::NONE,
        string $pageToken = Values::NONE,
        $pageNumber = Values::NONE
    ): AssignedAddOnPage
    {

        $params = Values::of([
            'PageToken' => $pageToken,
            'Page' => $pageNumber,
            'PageSize' => $pageSize,
        ]);

        $response = $this->version->page('GET', $this->uri, $params);

        return new AssignedAddOnPage($this->version, $response, $this->solution);
    }

    /**
     * Retrieve a specific page of AssignedAddOnInstance records from the API.
     * Request is executed immediately
     *
     * @param string $targetUrl API-generated URL for the requested results page
     * @return AssignedAddOnPage Page of AssignedAddOnInstance
     */
    public function getPage(string $targetUrl): AssignedAddOnPage
    {
        $response = $this->version->getDomain()->getClient()->request(
            'GET',
            $targetUrl
        );

        return new AssignedAddOnPage($this->version, $response, $this->solution);
    }


    /**
     * Constructs a AssignedAddOnContext
     *
     * @param string $sid The Twilio-provided string that uniquely identifies the resource to delete.
     */
    public function getContext(
        string $sid
        
    ): AssignedAddOnContext
    {
        return new AssignedAddOnContext(
            $this->version,
            $this->solution['accountSid'],
            $this->solution['resourceSid'],
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
        return '[Twilio.Api.V2010.AssignedAddOnList]';
    }
}
