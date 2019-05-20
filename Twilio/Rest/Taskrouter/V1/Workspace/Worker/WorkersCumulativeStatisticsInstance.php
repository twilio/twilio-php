<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Taskrouter\V1\Workspace\Worker;

use Twilio\Deserialize;
use Twilio\Exceptions\TwilioException;
use Twilio\InstanceResource;
use Twilio\Options;
use Twilio\Values;
use Twilio\Version;

/**
 * @property string accountSid
 * @property \DateTime startTime
 * @property \DateTime endTime
 * @property array activityDurations
 * @property int reservationsCreated
 * @property int reservationsAccepted
 * @property int reservationsRejected
 * @property int reservationsTimedOut
 * @property int reservationsCanceled
 * @property int reservationsRescinded
 * @property string workspaceSid
 * @property string url
 */
class WorkersCumulativeStatisticsInstance extends InstanceResource {
    /**
     * Initialize the WorkersCumulativeStatisticsInstance
     * 
     * @param \Twilio\Version $version Version that contains the resource
     * @param mixed[] $payload The response payload
     * @param string $workspaceSid The workspace_sid
     * @return \Twilio\Rest\Taskrouter\V1\Workspace\Worker\WorkersCumulativeStatisticsInstance 
     */
    public function __construct(Version $version, array $payload, $workspaceSid) {
        parent::__construct($version);

        // Marshaled Properties
        $this->properties = array(
            'accountSid' => Values::array_get($payload, 'account_sid'),
            'startTime' => Deserialize::dateTime(Values::array_get($payload, 'start_time')),
            'endTime' => Deserialize::dateTime(Values::array_get($payload, 'end_time')),
            'activityDurations' => Values::array_get($payload, 'activity_durations'),
            'reservationsCreated' => Values::array_get($payload, 'reservations_created'),
            'reservationsAccepted' => Values::array_get($payload, 'reservations_accepted'),
            'reservationsRejected' => Values::array_get($payload, 'reservations_rejected'),
            'reservationsTimedOut' => Values::array_get($payload, 'reservations_timed_out'),
            'reservationsCanceled' => Values::array_get($payload, 'reservations_canceled'),
            'reservationsRescinded' => Values::array_get($payload, 'reservations_rescinded'),
            'workspaceSid' => Values::array_get($payload, 'workspace_sid'),
            'url' => Values::array_get($payload, 'url'),
        );

        $this->solution = array('workspaceSid' => $workspaceSid, );
    }

    /**
     * Generate an instance context for the instance, the context is capable of
     * performing various actions.  All instance actions are proxied to the context
     * 
     * @return \Twilio\Rest\Taskrouter\V1\Workspace\Worker\WorkersCumulativeStatisticsContext Context for this
     *                                                                                        WorkersCumulativeStatisticsInstance
     */
    protected function proxy() {
        if (!$this->context) {
            $this->context = new WorkersCumulativeStatisticsContext(
                $this->version,
                $this->solution['workspaceSid']
            );
        }

        return $this->context;
    }

    /**
     * Fetch a WorkersCumulativeStatisticsInstance
     * 
     * @param array|Options $options Optional Arguments
     * @return WorkersCumulativeStatisticsInstance Fetched
     *                                             WorkersCumulativeStatisticsInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch($options = array()) {
        return $this->proxy()->fetch($options);
    }

    /**
     * Magic getter to access properties
     * 
     * @param string $name Property to access
     * @return mixed The requested property
     * @throws TwilioException For unknown properties
     */
    public function __get($name) {
        if (array_key_exists($name, $this->properties)) {
            return $this->properties[$name];
        }

        if (property_exists($this, '_' . $name)) {
            $method = 'get' . ucfirst($name);
            return $this->$method();
        }

        throw new TwilioException('Unknown property: ' . $name);
    }

    /**
     * Provide a friendly representation
     * 
     * @return string Machine friendly representation
     */
    public function __toString() {
        $context = array();
        foreach ($this->solution as $key => $value) {
            $context[] = "$key=$value";
        }
        return '[Twilio.Taskrouter.V1.WorkersCumulativeStatisticsInstance ' . implode(' ', $context) . ']';
    }
}