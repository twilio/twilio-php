<?php

/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Sync
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Twilio\Rest\Sync\V1\Service\SyncMap;

use Twilio\Exceptions\TwilioException;
use Twilio\ListResource;
use Twilio\Options;
use Twilio\Stream;
use Twilio\Values;
use Twilio\Version;
use Twilio\Serialize;


class SyncMapItemList extends ListResource
    {
    /**
     * Construct the SyncMapItemList
     *
     * @param Version $version Version that contains the resource
     * @param string $serviceSid The SID of the [Sync Service](https://www.twilio.com/docs/sync/api/service) to create the Map Item in.
     * @param string $mapSid The SID of the Sync Map to add the new Map Item to. Can be the Sync Map resource's `sid` or its `unique_name`.
     */
    public function __construct(
        Version $version,
        string $serviceSid,
        string $mapSid
    ) {
        parent::__construct($version);

        // Path Solution
        $this->solution = [
        'serviceSid' =>
            $serviceSid,
        
        'mapSid' =>
            $mapSid,
        
        ];

        $this->uri = '/Services/' . \rawurlencode($serviceSid)
        .'/Maps/' . \rawurlencode($mapSid)
        .'/Items';
    }

    /**
     * Create the SyncMapItemInstance
     *
     * @param string $key The unique, user-defined key for the Map Item. Can be up to 320 characters long.
     * @param array $data A JSON string that represents an arbitrary, schema-less object that the Map Item stores. Can be up to 16 KiB in length.
     * @param array|Options $options Optional Arguments
     * @return SyncMapItemInstance Created SyncMapItemInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function create(string $key, array $data, array $options = []): SyncMapItemInstance
    {

        $options = new Values($options);

        $data = Values::of([
            'Key' =>
                $key,
            'Data' =>
                Serialize::jsonObject($data),
            'Ttl' =>
                $options['ttl'],
            'ItemTtl' =>
                $options['itemTtl'],
            'CollectionTtl' =>
                $options['collectionTtl'],
        ]);

        $headers = Values::of(['Content-Type' => 'application/x-www-form-urlencoded', 'Accept' => 'application/json' ]);
        $payload = $this->version->create('POST', $this->uri, [], $data, $headers);

        return new SyncMapItemInstance(
            $this->version,
            $payload,
            $this->solution['serviceSid'],
            $this->solution['mapSid']
        );
    }


    /**
     * Reads SyncMapItemInstance records from the API as a list.
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
     * @return SyncMapItemInstance[] Array of results
     */
    public function read(array $options = [], ?int $limit = null, $pageSize = null): array
    {
        return \iterator_to_array($this->stream($options, $limit, $pageSize), false);
    }

    /**
     * Streams SyncMapItemInstance records from the API as a generator stream.
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
     * Retrieve a single page of SyncMapItemInstance records from the API.
     * Request is executed immediately
     *
     * @param mixed $pageSize Number of records to return, defaults to 50
     * @param string $pageToken PageToken provided by the API
     * @param mixed $pageNumber Page Number, this value is simply for client state
     * @return SyncMapItemPage Page of SyncMapItemInstance
     */
    public function page(
        array $options = [],
        $pageSize = Values::NONE,
        string $pageToken = Values::NONE,
        $pageNumber = Values::NONE
    ): SyncMapItemPage
    {
        $options = new Values($options);

        $params = Values::of([
            'Order' =>
                $options['order'],
            'From' =>
                $options['from'],
            'Bounds' =>
                $options['bounds'],
            'PageToken' => $pageToken,
            'Page' => $pageNumber,
            'PageSize' => $pageSize,
        ]);

        $headers = Values::of(['Content-Type' => 'application/x-www-form-urlencoded', 'Accept' => 'application/json']);
        $response = $this->version->page('GET', $this->uri, $params, [], $headers);

        return new SyncMapItemPage($this->version, $response, $this->solution);
    }

    /**
     * Retrieve a specific page of SyncMapItemInstance records from the API.
     * Request is executed immediately
     *
     * @param string $targetUrl API-generated URL for the requested results page
     * @return SyncMapItemPage Page of SyncMapItemInstance
     */
    public function getPage(string $targetUrl): SyncMapItemPage
    {
        $response = $this->version->getDomain()->getClient()->request(
            'GET',
            $targetUrl
        );

        return new SyncMapItemPage($this->version, $response, $this->solution);
    }


    /**
     * Constructs a SyncMapItemContext
     *
     * @param string $key The `key` value of the Sync Map Item resource to delete.
     */
    public function getContext(
        string $key
        
    ): SyncMapItemContext
    {
        return new SyncMapItemContext(
            $this->version,
            $this->solution['serviceSid'],
            $this->solution['mapSid'],
            $key
        );
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string
    {
        return '[Twilio.Sync.V1.SyncMapItemList]';
    }
}
