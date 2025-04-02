<?php

/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Numbers
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Twilio\Rest\Numbers\V2;

use Twilio\Exceptions\TwilioException;
use Twilio\ListResource;
use Twilio\Options;
use Twilio\Stream;
use Twilio\Values;
use Twilio\Version;
use Twilio\Serialize;


class HostedNumberOrderList extends ListResource
    {
    /**
     * Construct the HostedNumberOrderList
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

        $this->uri = '/HostedNumber/Orders';
    }

    /**
     * Create the HostedNumberOrderInstance
     *
     * @param string $phoneNumber The number to host in [+E.164](https://en.wikipedia.org/wiki/E.164) format
     * @param string $contactPhoneNumber The contact phone number of the person authorized to sign the Authorization Document.
     * @param string $addressSid Optional. A 34 character string that uniquely identifies the Address resource that represents the address of the owner of this phone number.
     * @param string $email Optional. Email of the owner of this phone number that is being hosted.
     * @param array|Options $options Optional Arguments
     * @return HostedNumberOrderInstance Created HostedNumberOrderInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function create(string $phoneNumber, string $contactPhoneNumber, string $addressSid, string $email, array $options = []): HostedNumberOrderInstance
    {

        $options = new Values($options);

        $data = Values::of([
            'PhoneNumber' =>
                $phoneNumber,
            'ContactPhoneNumber' =>
                $contactPhoneNumber,
            'AddressSid' =>
                $addressSid,
            'Email' =>
                $email,
            'AccountSid' =>
                $options['accountSid'],
            'FriendlyName' =>
                $options['friendlyName'],
            'CcEmails' =>
                Serialize::map($options['ccEmails'], function ($e) { return $e; }),
            'SmsUrl' =>
                $options['smsUrl'],
            'SmsMethod' =>
                $options['smsMethod'],
            'SmsFallbackUrl' =>
                $options['smsFallbackUrl'],
            'SmsCapability' =>
                Serialize::booleanToString($options['smsCapability']),
            'SmsFallbackMethod' =>
                $options['smsFallbackMethod'],
            'StatusCallbackUrl' =>
                $options['statusCallbackUrl'],
            'StatusCallbackMethod' =>
                $options['statusCallbackMethod'],
            'SmsApplicationSid' =>
                $options['smsApplicationSid'],
            'ContactTitle' =>
                $options['contactTitle'],
        ]);

        $headers = Values::of(['Content-Type' => 'application/x-www-form-urlencoded' ]);
        $payload = $this->version->create('POST', $this->uri, [], $data, $headers);

        return new HostedNumberOrderInstance(
            $this->version,
            $payload
        );
    }


    /**
     * Reads HostedNumberOrderInstance records from the API as a list.
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
     * @return HostedNumberOrderInstance[] Array of results
     */
    public function read(array $options = [], ?int $limit = null, $pageSize = null): array
    {
        return \iterator_to_array($this->stream($options, $limit, $pageSize), false);
    }

    /**
     * Streams HostedNumberOrderInstance records from the API as a generator stream.
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
     * Retrieve a single page of HostedNumberOrderInstance records from the API.
     * Request is executed immediately
     *
     * @param mixed $pageSize Number of records to return, defaults to 50
     * @param string $pageToken PageToken provided by the API
     * @param mixed $pageNumber Page Number, this value is simply for client state
     * @return HostedNumberOrderPage Page of HostedNumberOrderInstance
     */
    public function page(
        array $options = [],
        $pageSize = Values::NONE,
        string $pageToken = Values::NONE,
        $pageNumber = Values::NONE
    ): HostedNumberOrderPage
    {
        $options = new Values($options);

        $params = Values::of([
            'Status' =>
                $options['status'],
            'SmsCapability' =>
                Serialize::booleanToString($options['smsCapability']),
            'PhoneNumber' =>
                $options['phoneNumber'],
            'IncomingPhoneNumberSid' =>
                $options['incomingPhoneNumberSid'],
            'FriendlyName' =>
                $options['friendlyName'],
            'PageToken' => $pageToken,
            'Page' => $pageNumber,
            'PageSize' => $pageSize,
        ]);

        $response = $this->version->page('GET', $this->uri, $params);

        return new HostedNumberOrderPage($this->version, $response, $this->solution);
    }

    /**
     * Retrieve a specific page of HostedNumberOrderInstance records from the API.
     * Request is executed immediately
     *
     * @param string $targetUrl API-generated URL for the requested results page
     * @return HostedNumberOrderPage Page of HostedNumberOrderInstance
     */
    public function getPage(string $targetUrl): HostedNumberOrderPage
    {
        $response = $this->version->getDomain()->getClient()->request(
            'GET',
            $targetUrl
        );

        return new HostedNumberOrderPage($this->version, $response, $this->solution);
    }


    /**
     * Constructs a HostedNumberOrderContext
     *
     * @param string $sid A 34 character string that uniquely identifies this HostedNumberOrder.
     */
    public function getContext(
        string $sid
        
    ): HostedNumberOrderContext
    {
        return new HostedNumberOrderContext(
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
        return '[Twilio.Numbers.V2.HostedNumberOrderList]';
    }
}
