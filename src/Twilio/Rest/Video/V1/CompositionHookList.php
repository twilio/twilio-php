<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Video\V1;

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
class CompositionHookList extends ListResource {
    /**
     * Construct the CompositionHookList
     *
     * @param Version $version Version that contains the resource
     */
    public function __construct(Version $version) {
        parent::__construct($version);

        // Path Solution
        $this->solution = [];

        $this->uri = '/CompositionHooks';
    }

    /**
     * Streams CompositionHookInstance records from the API as a generator stream.
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
    public function stream(array $options = [], int $limit = null, $pageSize = null): Stream {
        $limits = $this->version->readLimits($limit, $pageSize);

        $page = $this->page($options, $limits['pageSize']);

        return $this->version->stream($page, $limits['limit'], $limits['pageLimit']);
    }

    /**
     * Reads CompositionHookInstance records from the API as a list.
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
     * @return CompositionHookInstance[] Array of results
     */
    public function read(array $options = [], int $limit = null, $pageSize = null): array {
        return \iterator_to_array($this->stream($options, $limit, $pageSize), false);
    }

    /**
     * Retrieve a single page of CompositionHookInstance records from the API.
     * Request is executed immediately
     *
     * @param array|Options $options Optional Arguments
     * @param mixed $pageSize Number of records to return, defaults to 50
     * @param string $pageToken PageToken provided by the API
     * @param mixed $pageNumber Page Number, this value is simply for client state
     * @return CompositionHookPage Page of CompositionHookInstance
     */
    public function page(array $options = [], $pageSize = Values::NONE, string $pageToken = Values::NONE, $pageNumber = Values::NONE): CompositionHookPage {
        $options = new Values($options);
        $params = Values::of([
            'Enabled' => Serialize::booleanToString($options['enabled']),
            'DateCreatedAfter' => Serialize::iso8601DateTime($options['dateCreatedAfter']),
            'DateCreatedBefore' => Serialize::iso8601DateTime($options['dateCreatedBefore']),
            'FriendlyName' => $options['friendlyName'],
            'PageToken' => $pageToken,
            'Page' => $pageNumber,
            'PageSize' => $pageSize,
        ]);

        $response = $this->version->page(
            'GET',
            $this->uri,
            $params
        );

        return new CompositionHookPage($this->version, $response, $this->solution);
    }

    /**
     * Retrieve a specific page of CompositionHookInstance records from the API.
     * Request is executed immediately
     *
     * @param string $targetUrl API-generated URL for the requested results page
     * @return CompositionHookPage Page of CompositionHookInstance
     */
    public function getPage(string $targetUrl): CompositionHookPage {
        $response = $this->version->getDomain()->getClient()->request(
            'GET',
            $targetUrl
        );

        return new CompositionHookPage($this->version, $response, $this->solution);
    }

    /**
     * Create a new CompositionHookInstance
     *
     * @param string $friendlyName A unique string to describe the resource
     * @param array|Options $options Optional Arguments
     * @return CompositionHookInstance Newly created CompositionHookInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function create(string $friendlyName, array $options = []): CompositionHookInstance {
        $options = new Values($options);

        $data = Values::of([
            'FriendlyName' => $friendlyName,
            'Enabled' => Serialize::booleanToString($options['enabled']),
            'VideoLayout' => Serialize::jsonObject($options['videoLayout']),
            'AudioSources' => Serialize::map($options['audioSources'], function($e) { return $e; }),
            'AudioSourcesExcluded' => Serialize::map($options['audioSourcesExcluded'], function($e) { return $e; }),
            'Resolution' => $options['resolution'],
            'Format' => $options['format'],
            'StatusCallback' => $options['statusCallback'],
            'StatusCallbackMethod' => $options['statusCallbackMethod'],
            'Trim' => Serialize::booleanToString($options['trim']),
        ]);

        $payload = $this->version->create(
            'POST',
            $this->uri,
            [],
            $data
        );

        return new CompositionHookInstance($this->version, $payload);
    }

    /**
     * Constructs a CompositionHookContext
     *
     * @param string $sid The SID that identifies the resource to fetch
     */
    public function getContext(string $sid): CompositionHookContext {
        return new CompositionHookContext($this->version, $sid);
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        return '[Twilio.Video.V1.CompositionHookList]';
    }
}