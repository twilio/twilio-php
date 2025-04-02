<?php

/**
 * This code was generated by
 * ___ _ _ _ _ _    _ ____    ____ ____ _    ____ ____ _  _ ____ ____ ____ ___ __   __
 *  |  | | | | |    | |  | __ |  | |__| | __ | __ |___ |\ | |___ |__/ |__|  | |  | |__/
 *  |  |_|_| | |___ | |__|    |__| |  | |    |__] |___ | \| |___ |  \ |  |  | |__| |  \
 *
 * Twilio - Conversations
 * This is the public Twilio REST API.
 *
 * NOTE: This class is auto generated by OpenAPI Generator.
 * https://openapi-generator.tech
 * Do not edit the class manually.
 */

namespace Twilio\Rest\Conversations\V1\Service;

use Twilio\Exceptions\TwilioException;
use Twilio\ListResource;
use Twilio\Options;
use Twilio\Stream;
use Twilio\Values;
use Twilio\Version;
use Twilio\Serialize;


class ConversationList extends ListResource
    {
    /**
     * Construct the ConversationList
     *
     * @param Version $version Version that contains the resource
     * @param string $chatServiceSid The SID of the [Conversation Service](https://www.twilio.com/docs/conversations/api/service-resource) the Conversation resource is associated with.
     */
    public function __construct(
        Version $version,
        string $chatServiceSid
    ) {
        parent::__construct($version);

        // Path Solution
        $this->solution = [
        'chatServiceSid' =>
            $chatServiceSid,
        
        ];

        $this->uri = '/Services/' . \rawurlencode($chatServiceSid)
        .'/Conversations';
    }

    /**
     * Create the ConversationInstance
     *
     * @param array|Options $options Optional Arguments
     * @return ConversationInstance Created ConversationInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function create(array $options = []): ConversationInstance
    {

        $options = new Values($options);

        $data = Values::of([
            'FriendlyName' =>
                $options['friendlyName'],
            'UniqueName' =>
                $options['uniqueName'],
            'Attributes' =>
                $options['attributes'],
            'MessagingServiceSid' =>
                $options['messagingServiceSid'],
            'DateCreated' =>
                Serialize::iso8601DateTime($options['dateCreated']),
            'DateUpdated' =>
                Serialize::iso8601DateTime($options['dateUpdated']),
            'State' =>
                $options['state'],
            'Timers.Inactive' =>
                $options['timersInactive'],
            'Timers.Closed' =>
                $options['timersClosed'],
            'Bindings.Email.Address' =>
                $options['bindingsEmailAddress'],
            'Bindings.Email.Name' =>
                $options['bindingsEmailName'],
        ]);

        $headers = Values::of(['Content-Type' => 'application/x-www-form-urlencoded' , 'X-Twilio-Webhook-Enabled' => $options['xTwilioWebhookEnabled']]);
        $payload = $this->version->create('POST', $this->uri, [], $data, $headers);

        return new ConversationInstance(
            $this->version,
            $payload,
            $this->solution['chatServiceSid']
        );
    }


    /**
     * Reads ConversationInstance records from the API as a list.
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
     * @return ConversationInstance[] Array of results
     */
    public function read(array $options = [], ?int $limit = null, $pageSize = null): array
    {
        return \iterator_to_array($this->stream($options, $limit, $pageSize), false);
    }

    /**
     * Streams ConversationInstance records from the API as a generator stream.
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
     * Retrieve a single page of ConversationInstance records from the API.
     * Request is executed immediately
     *
     * @param mixed $pageSize Number of records to return, defaults to 50
     * @param string $pageToken PageToken provided by the API
     * @param mixed $pageNumber Page Number, this value is simply for client state
     * @return ConversationPage Page of ConversationInstance
     */
    public function page(
        array $options = [],
        $pageSize = Values::NONE,
        string $pageToken = Values::NONE,
        $pageNumber = Values::NONE
    ): ConversationPage
    {
        $options = new Values($options);

        $params = Values::of([
            'StartDate' =>
                $options['startDate'],
            'EndDate' =>
                $options['endDate'],
            'State' =>
                $options['state'],
            'PageToken' => $pageToken,
            'Page' => $pageNumber,
            'PageSize' => $pageSize,
        ]);

        $response = $this->version->page('GET', $this->uri, $params);

        return new ConversationPage($this->version, $response, $this->solution);
    }

    /**
     * Retrieve a specific page of ConversationInstance records from the API.
     * Request is executed immediately
     *
     * @param string $targetUrl API-generated URL for the requested results page
     * @return ConversationPage Page of ConversationInstance
     */
    public function getPage(string $targetUrl): ConversationPage
    {
        $response = $this->version->getDomain()->getClient()->request(
            'GET',
            $targetUrl
        );

        return new ConversationPage($this->version, $response, $this->solution);
    }


    /**
     * Constructs a ConversationContext
     *
     * @param string $sid A 34 character string that uniquely identifies this resource. Can also be the `unique_name` of the Conversation.
     */
    public function getContext(
        string $sid
        
    ): ConversationContext
    {
        return new ConversationContext(
            $this->version,
            $this->solution['chatServiceSid'],
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
        return '[Twilio.Conversations.V1.ConversationList]';
    }
}
