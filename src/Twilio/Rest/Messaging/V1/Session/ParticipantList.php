<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Messaging\V1\Session;

use Twilio\Exceptions\TwilioException;
use Twilio\ListResource;
use Twilio\Options;
use Twilio\Serialize;
use Twilio\Stream;
use Twilio\Values;
use Twilio\Version;

/**
 * PLEASE NOTE that this class contains preview products that are subject to change. Use them with caution. If you currently do not have developer preview access, please contact help@twilio.com.
 */
class ParticipantList extends ListResource {
    /**
     * Construct the ParticipantList
     *
     * @param Version $version Version that contains the resource
     * @param string $sessionSid The SID of the Session for the participant
     */
    public function __construct(Version $version, string $sessionSid) {
        parent::__construct($version);

        // Path Solution
        $this->solution = ['sessionSid' => $sessionSid, ];

        $this->uri = '/Sessions/' . \rawurlencode($sessionSid) . '/Participants';
    }

    /**
     * Create a new ParticipantInstance
     *
     * @param array|Options $options Optional Arguments
     * @return ParticipantInstance Newly created ParticipantInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function create(array $options = []): ParticipantInstance {
        $options = new Values($options);

        $data = Values::of([
            'Identity' => $options['identity'],
            'UserAddress' => $options['userAddress'],
            'Attributes' => $options['attributes'],
            'TwilioAddress' => $options['twilioAddress'],
            'DateCreated' => Serialize::iso8601DateTime($options['dateCreated']),
            'DateUpdated' => Serialize::iso8601DateTime($options['dateUpdated']),
        ]);

        $payload = $this->version->create(
            'POST',
            $this->uri,
            [],
            $data
        );

        return new ParticipantInstance($this->version, $payload, $this->solution['sessionSid']);
    }

    /**
     * Streams ParticipantInstance records from the API as a generator stream.
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
    public function stream(int $limit = null, $pageSize = null): Stream {
        $limits = $this->version->readLimits($limit, $pageSize);

        $page = $this->page($limits['pageSize']);

        return $this->version->stream($page, $limits['limit'], $limits['pageLimit']);
    }

    /**
     * Reads ParticipantInstance records from the API as a list.
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
     * @return ParticipantInstance[] Array of results
     */
    public function read(int $limit = null, $pageSize = null): array {
        return \iterator_to_array($this->stream($limit, $pageSize), false);
    }

    /**
     * Retrieve a single page of ParticipantInstance records from the API.
     * Request is executed immediately
     *
     * @param mixed $pageSize Number of records to return, defaults to 50
     * @param string $pageToken PageToken provided by the API
     * @param mixed $pageNumber Page Number, this value is simply for client state
     * @return ParticipantPage Page of ParticipantInstance
     */
    public function page($pageSize = Values::NONE, string $pageToken = Values::NONE, $pageNumber = Values::NONE): ParticipantPage {
        $params = Values::of(['PageToken' => $pageToken, 'Page' => $pageNumber, 'PageSize' => $pageSize, ]);

        $response = $this->version->page(
            'GET',
            $this->uri,
            $params
        );

        return new ParticipantPage($this->version, $response, $this->solution);
    }

    /**
     * Retrieve a specific page of ParticipantInstance records from the API.
     * Request is executed immediately
     *
     * @param string $targetUrl API-generated URL for the requested results page
     * @return ParticipantPage Page of ParticipantInstance
     */
    public function getPage(string $targetUrl): ParticipantPage {
        $response = $this->version->getDomain()->getClient()->request(
            'GET',
            $targetUrl
        );

        return new ParticipantPage($this->version, $response, $this->solution);
    }

    /**
     * Constructs a ParticipantContext
     *
     * @param string $sid The SID that identifies the resource to fetch
     */
    public function getContext(string $sid): ParticipantContext {
        return new ParticipantContext($this->version, $this->solution['sessionSid'], $sid);
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        return '[Twilio.Messaging.V1.ParticipantList]';
    }
}