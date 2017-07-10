<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Taskrouter\V1\Workspace\Worker;

use Twilio\Options;
use Twilio\Values;

abstract class ReservationOptions
{
    /**
     * @param string $reservationStatus The reservation_status
     * @return ReadReservationOptions Options builder
     */
    public static function read($reservationStatus = Values::NONE)
    {
        return new ReadReservationOptions($reservationStatus);
    }

    /**
     * @param string $reservationStatus The reservation_status
     * @param string $workerActivitySid The worker_activity_sid
     * @param string $instruction The instruction
     * @param string $dequeuePostWorkActivitySid The dequeue_post_work_activity_sid
     * @param string $dequeueFrom The dequeue_from
     * @param string $dequeueRecord The dequeue_record
     * @param integer $dequeueTimeout The dequeue_timeout
     * @param string $dequeueTo The dequeue_to
     * @param string $dequeueStatusCallbackUrl The dequeue_status_callback_url
     * @param string $callFrom The call_from
     * @param string $callRecord The call_record
     * @param integer $callTimeout The call_timeout
     * @param string $callTo The call_to
     * @param string $callUrl The call_url
     * @param string $callStatusCallbackUrl The call_status_callback_url
     * @param boolean $callAccept The call_accept
     * @param string $redirectCallSid The redirect_call_sid
     * @param boolean $redirectAccept The redirect_accept
     * @param string $redirectUrl The redirect_url
     * @return UpdateReservationOptions Options builder
     */
    public static function update($reservationStatus = Values::NONE, $workerActivitySid = Values::NONE, $instruction = Values::NONE, $dequeuePostWorkActivitySid = Values::NONE, $dequeueFrom = Values::NONE, $dequeueRecord = Values::NONE, $dequeueTimeout = Values::NONE, $dequeueTo = Values::NONE, $dequeueStatusCallbackUrl = Values::NONE, $callFrom = Values::NONE, $callRecord = Values::NONE, $callTimeout = Values::NONE, $callTo = Values::NONE, $callUrl = Values::NONE, $callStatusCallbackUrl = Values::NONE, $callAccept = Values::NONE, $redirectCallSid = Values::NONE, $redirectAccept = Values::NONE, $redirectUrl = Values::NONE)
    {
        return new UpdateReservationOptions($reservationStatus, $workerActivitySid, $instruction, $dequeuePostWorkActivitySid, $dequeueFrom, $dequeueRecord, $dequeueTimeout, $dequeueTo, $dequeueStatusCallbackUrl, $callFrom, $callRecord, $callTimeout, $callTo, $callUrl, $callStatusCallbackUrl, $callAccept, $redirectCallSid, $redirectAccept, $redirectUrl);
    }
}

class ReadReservationOptions extends Options
{
    /**
     * @param string $reservationStatus The reservation_status
     */
    public function __construct($reservationStatus = Values::NONE)
    {
        $this->options['reservationStatus'] = $reservationStatus;
    }

    /**
     * The reservation_status
     *
     * @param string $reservationStatus The reservation_status
     * @return $this Fluent Builder
     */
    public function setReservationStatus($reservationStatus)
    {
        $this->options['reservationStatus'] = $reservationStatus;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString()
    {
        $options = array();
        foreach ($this->options as $key => $value) {
            if ($value != Values::NONE) {
                $options[] = "$key=$value";
            }
        }
        return '[Twilio.Taskrouter.V1.ReadReservationOptions ' . implode(' ', $options) . ']';
    }
}

class UpdateReservationOptions extends Options
{
    /**
     * @param string $reservationStatus The reservation_status
     * @param string $workerActivitySid The worker_activity_sid
     * @param string $instruction The instruction
     * @param string $dequeuePostWorkActivitySid The dequeue_post_work_activity_sid
     * @param string $dequeueFrom The dequeue_from
     * @param string $dequeueRecord The dequeue_record
     * @param integer $dequeueTimeout The dequeue_timeout
     * @param string $dequeueTo The dequeue_to
     * @param string $dequeueStatusCallbackUrl The dequeue_status_callback_url
     * @param string $callFrom The call_from
     * @param string $callRecord The call_record
     * @param integer $callTimeout The call_timeout
     * @param string $callTo The call_to
     * @param string $callUrl The call_url
     * @param string $callStatusCallbackUrl The call_status_callback_url
     * @param boolean $callAccept The call_accept
     * @param string $redirectCallSid The redirect_call_sid
     * @param boolean $redirectAccept The redirect_accept
     * @param string $redirectUrl The redirect_url
     */
    public function __construct($reservationStatus = Values::NONE, $workerActivitySid = Values::NONE, $instruction = Values::NONE, $dequeuePostWorkActivitySid = Values::NONE, $dequeueFrom = Values::NONE, $dequeueRecord = Values::NONE, $dequeueTimeout = Values::NONE, $dequeueTo = Values::NONE, $dequeueStatusCallbackUrl = Values::NONE, $callFrom = Values::NONE, $callRecord = Values::NONE, $callTimeout = Values::NONE, $callTo = Values::NONE, $callUrl = Values::NONE, $callStatusCallbackUrl = Values::NONE, $callAccept = Values::NONE, $redirectCallSid = Values::NONE, $redirectAccept = Values::NONE, $redirectUrl = Values::NONE)
    {
        $this->options['reservationStatus'] = $reservationStatus;
        $this->options['workerActivitySid'] = $workerActivitySid;
        $this->options['instruction'] = $instruction;
        $this->options['dequeuePostWorkActivitySid'] = $dequeuePostWorkActivitySid;
        $this->options['dequeueFrom'] = $dequeueFrom;
        $this->options['dequeueRecord'] = $dequeueRecord;
        $this->options['dequeueTimeout'] = $dequeueTimeout;
        $this->options['dequeueTo'] = $dequeueTo;
        $this->options['dequeueStatusCallbackUrl'] = $dequeueStatusCallbackUrl;
        $this->options['callFrom'] = $callFrom;
        $this->options['callRecord'] = $callRecord;
        $this->options['callTimeout'] = $callTimeout;
        $this->options['callTo'] = $callTo;
        $this->options['callUrl'] = $callUrl;
        $this->options['callStatusCallbackUrl'] = $callStatusCallbackUrl;
        $this->options['callAccept'] = $callAccept;
        $this->options['redirectCallSid'] = $redirectCallSid;
        $this->options['redirectAccept'] = $redirectAccept;
        $this->options['redirectUrl'] = $redirectUrl;
    }

    /**
     * The reservation_status
     *
     * @param string $reservationStatus The reservation_status
     * @return $this Fluent Builder
     */
    public function setReservationStatus($reservationStatus)
    {
        $this->options['reservationStatus'] = $reservationStatus;
        return $this;
    }

    /**
     * The worker_activity_sid
     *
     * @param string $workerActivitySid The worker_activity_sid
     * @return $this Fluent Builder
     */
    public function setWorkerActivitySid($workerActivitySid)
    {
        $this->options['workerActivitySid'] = $workerActivitySid;
        return $this;
    }

    /**
     * The instruction
     *
     * @param string $instruction The instruction
     * @return $this Fluent Builder
     */
    public function setInstruction($instruction)
    {
        $this->options['instruction'] = $instruction;
        return $this;
    }

    /**
     * The dequeue_post_work_activity_sid
     *
     * @param string $dequeuePostWorkActivitySid The dequeue_post_work_activity_sid
     * @return $this Fluent Builder
     */
    public function setDequeuePostWorkActivitySid($dequeuePostWorkActivitySid)
    {
        $this->options['dequeuePostWorkActivitySid'] = $dequeuePostWorkActivitySid;
        return $this;
    }

    /**
     * The dequeue_from
     *
     * @param string $dequeueFrom The dequeue_from
     * @return $this Fluent Builder
     */
    public function setDequeueFrom($dequeueFrom)
    {
        $this->options['dequeueFrom'] = $dequeueFrom;
        return $this;
    }

    /**
     * The dequeue_record
     *
     * @param string $dequeueRecord The dequeue_record
     * @return $this Fluent Builder
     */
    public function setDequeueRecord($dequeueRecord)
    {
        $this->options['dequeueRecord'] = $dequeueRecord;
        return $this;
    }

    /**
     * The dequeue_timeout
     *
     * @param integer $dequeueTimeout The dequeue_timeout
     * @return $this Fluent Builder
     */
    public function setDequeueTimeout($dequeueTimeout)
    {
        $this->options['dequeueTimeout'] = $dequeueTimeout;
        return $this;
    }

    /**
     * The dequeue_to
     *
     * @param string $dequeueTo The dequeue_to
     * @return $this Fluent Builder
     */
    public function setDequeueTo($dequeueTo)
    {
        $this->options['dequeueTo'] = $dequeueTo;
        return $this;
    }

    /**
     * The dequeue_status_callback_url
     *
     * @param string $dequeueStatusCallbackUrl The dequeue_status_callback_url
     * @return $this Fluent Builder
     */
    public function setDequeueStatusCallbackUrl($dequeueStatusCallbackUrl)
    {
        $this->options['dequeueStatusCallbackUrl'] = $dequeueStatusCallbackUrl;
        return $this;
    }

    /**
     * The call_from
     *
     * @param string $callFrom The call_from
     * @return $this Fluent Builder
     */
    public function setCallFrom($callFrom)
    {
        $this->options['callFrom'] = $callFrom;
        return $this;
    }

    /**
     * The call_record
     *
     * @param string $callRecord The call_record
     * @return $this Fluent Builder
     */
    public function setCallRecord($callRecord)
    {
        $this->options['callRecord'] = $callRecord;
        return $this;
    }

    /**
     * The call_timeout
     *
     * @param integer $callTimeout The call_timeout
     * @return $this Fluent Builder
     */
    public function setCallTimeout($callTimeout)
    {
        $this->options['callTimeout'] = $callTimeout;
        return $this;
    }

    /**
     * The call_to
     *
     * @param string $callTo The call_to
     * @return $this Fluent Builder
     */
    public function setCallTo($callTo)
    {
        $this->options['callTo'] = $callTo;
        return $this;
    }

    /**
     * The call_url
     *
     * @param string $callUrl The call_url
     * @return $this Fluent Builder
     */
    public function setCallUrl($callUrl)
    {
        $this->options['callUrl'] = $callUrl;
        return $this;
    }

    /**
     * The call_status_callback_url
     *
     * @param string $callStatusCallbackUrl The call_status_callback_url
     * @return $this Fluent Builder
     */
    public function setCallStatusCallbackUrl($callStatusCallbackUrl)
    {
        $this->options['callStatusCallbackUrl'] = $callStatusCallbackUrl;
        return $this;
    }

    /**
     * The call_accept
     *
     * @param boolean $callAccept The call_accept
     * @return $this Fluent Builder
     */
    public function setCallAccept($callAccept)
    {
        $this->options['callAccept'] = $callAccept;
        return $this;
    }

    /**
     * The redirect_call_sid
     *
     * @param string $redirectCallSid The redirect_call_sid
     * @return $this Fluent Builder
     */
    public function setRedirectCallSid($redirectCallSid)
    {
        $this->options['redirectCallSid'] = $redirectCallSid;
        return $this;
    }

    /**
     * The redirect_accept
     *
     * @param boolean $redirectAccept The redirect_accept
     * @return $this Fluent Builder
     */
    public function setRedirectAccept($redirectAccept)
    {
        $this->options['redirectAccept'] = $redirectAccept;
        return $this;
    }

    /**
     * The redirect_url
     *
     * @param string $redirectUrl The redirect_url
     * @return $this Fluent Builder
     */
    public function setRedirectUrl($redirectUrl)
    {
        $this->options['redirectUrl'] = $redirectUrl;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString()
    {
        $options = array();
        foreach ($this->options as $key => $value) {
            if ($value != Values::NONE) {
                $options[] = "$key=$value";
            }
        }
        return '[Twilio.Taskrouter.V1.UpdateReservationOptions ' . implode(' ', $options) . ']';
    }
}
