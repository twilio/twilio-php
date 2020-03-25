<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Video\V1;

use Twilio\Options;
use Twilio\Values;

abstract class RoomOptions {
    /**
     * @param bool $enableTurn Enable Twilio's Network Traversal TURN service
     * @param string $type The type of room
     * @param string $uniqueName An application-defined string that uniquely
     *                           identifies the resource
     * @param string $statusCallback The URL to send status information to your
     *                               application
     * @param string $statusCallbackMethod The HTTP method we should use to call
     *                                     status_callback
     * @param int $maxParticipants The maximum number of concurrent Participants
     *                             allowed in the room
     * @param bool $recordParticipantsOnConnect Whether to start recording when
     *                                          Participants connect
     * @param string[] $videoCodecs An array of the video codecs that are supported
     *                              when publishing a track in the room
     * @param string $mediaRegion The region for the media server in Group Rooms
     * @return CreateRoomOptions Options builder
     */
    public static function create(bool $enableTurn = Values::NONE, string $type = Values::NONE, string $uniqueName = Values::NONE, string $statusCallback = Values::NONE, string $statusCallbackMethod = Values::NONE, int $maxParticipants = Values::NONE, bool $recordParticipantsOnConnect = Values::NONE, array $videoCodecs = Values::ARRAY_NONE, string $mediaRegion = Values::NONE): CreateRoomOptions {
        return new CreateRoomOptions($enableTurn, $type, $uniqueName, $statusCallback, $statusCallbackMethod, $maxParticipants, $recordParticipantsOnConnect, $videoCodecs, $mediaRegion);
    }

    /**
     * @param string $status Read only the rooms with this status
     * @param string $uniqueName Read only rooms with this unique_name
     * @param \DateTime $dateCreatedAfter Read only rooms that started on or after
     *                                    this date, given as YYYY-MM-DD
     * @param \DateTime $dateCreatedBefore Read only rooms that started before this
     *                                     date, given as YYYY-MM-DD
     * @return ReadRoomOptions Options builder
     */
    public static function read(string $status = Values::NONE, string $uniqueName = Values::NONE, \DateTime $dateCreatedAfter = Values::NONE, \DateTime $dateCreatedBefore = Values::NONE): ReadRoomOptions {
        return new ReadRoomOptions($status, $uniqueName, $dateCreatedAfter, $dateCreatedBefore);
    }
}

class CreateRoomOptions extends Options {
    /**
     * @param bool $enableTurn Enable Twilio's Network Traversal TURN service
     * @param string $type The type of room
     * @param string $uniqueName An application-defined string that uniquely
     *                           identifies the resource
     * @param string $statusCallback The URL to send status information to your
     *                               application
     * @param string $statusCallbackMethod The HTTP method we should use to call
     *                                     status_callback
     * @param int $maxParticipants The maximum number of concurrent Participants
     *                             allowed in the room
     * @param bool $recordParticipantsOnConnect Whether to start recording when
     *                                          Participants connect
     * @param string[] $videoCodecs An array of the video codecs that are supported
     *                              when publishing a track in the room
     * @param string $mediaRegion The region for the media server in Group Rooms
     */
    public function __construct(bool $enableTurn = Values::NONE, string $type = Values::NONE, string $uniqueName = Values::NONE, string $statusCallback = Values::NONE, string $statusCallbackMethod = Values::NONE, int $maxParticipants = Values::NONE, bool $recordParticipantsOnConnect = Values::NONE, array $videoCodecs = Values::ARRAY_NONE, string $mediaRegion = Values::NONE) {
        $this->options['enableTurn'] = $enableTurn;
        $this->options['type'] = $type;
        $this->options['uniqueName'] = $uniqueName;
        $this->options['statusCallback'] = $statusCallback;
        $this->options['statusCallbackMethod'] = $statusCallbackMethod;
        $this->options['maxParticipants'] = $maxParticipants;
        $this->options['recordParticipantsOnConnect'] = $recordParticipantsOnConnect;
        $this->options['videoCodecs'] = $videoCodecs;
        $this->options['mediaRegion'] = $mediaRegion;
    }

    /**
     * Deprecated. Whether to enable [Twilio's Network Traversal TURN service](https://www.twilio.com/stun-turn). TURN service is used when direct peer-to-peer media connections cannot be established due to firewall restrictions. This setting only applies to rooms with type `peer-to-peer`.
     *
     * @param bool $enableTurn Enable Twilio's Network Traversal TURN service
     * @return $this Fluent Builder
     */
    public function setEnableTurn(bool $enableTurn): self {
        $this->options['enableTurn'] = $enableTurn;
        return $this;
    }

    /**
     * The type of room. Can be: `peer-to-peer`, `group-small`, or `group`. The default value is `group`.
     *
     * @param string $type The type of room
     * @return $this Fluent Builder
     */
    public function setType(string $type): self {
        $this->options['type'] = $type;
        return $this;
    }

    /**
     * An application-defined string that uniquely identifies the resource. It can be used as a `room_sid` in place of the resource's `sid` in the URL to address the resource. This value is unique for `in-progress` rooms. SDK clients can use this name to connect to the room. REST API clients can use this name in place of the Room SID to interact with the room as long as the room is `in-progress`.
     *
     * @param string $uniqueName An application-defined string that uniquely
     *                           identifies the resource
     * @return $this Fluent Builder
     */
    public function setUniqueName(string $uniqueName): self {
        $this->options['uniqueName'] = $uniqueName;
        return $this;
    }

    /**
     * The URL we should call using the `status_callback_method` to send status information to your application on every room event. See [Status Callbacks](https://www.twilio.com/docs/video/api/status-callbacks) for more info.
     *
     * @param string $statusCallback The URL to send status information to your
     *                               application
     * @return $this Fluent Builder
     */
    public function setStatusCallback(string $statusCallback): self {
        $this->options['statusCallback'] = $statusCallback;
        return $this;
    }

    /**
     * The HTTP method we should use to call `status_callback`. Can be `POST` or `GET`.
     *
     * @param string $statusCallbackMethod The HTTP method we should use to call
     *                                     status_callback
     * @return $this Fluent Builder
     */
    public function setStatusCallbackMethod(string $statusCallbackMethod): self {
        $this->options['statusCallbackMethod'] = $statusCallbackMethod;
        return $this;
    }

    /**
     * The maximum number of concurrent Participants allowed in the room. Peer-to-peer rooms can have up to 10 Participants. Small Group rooms can have up to 4 Participants. Group rooms can have up to 50 Participants.
     *
     * @param int $maxParticipants The maximum number of concurrent Participants
     *                             allowed in the room
     * @return $this Fluent Builder
     */
    public function setMaxParticipants(int $maxParticipants): self {
        $this->options['maxParticipants'] = $maxParticipants;
        return $this;
    }

    /**
     * Whether to start recording when Participants connect. ***This feature is not available in `peer-to-peer` rooms.***
     *
     * @param bool $recordParticipantsOnConnect Whether to start recording when
     *                                          Participants connect
     * @return $this Fluent Builder
     */
    public function setRecordParticipantsOnConnect(bool $recordParticipantsOnConnect): self {
        $this->options['recordParticipantsOnConnect'] = $recordParticipantsOnConnect;
        return $this;
    }

    /**
     * An array of the video codecs that are supported when publishing a track in the room.  Can be: `VP8` and `H264`.  ***This feature is not available in `peer-to-peer` rooms***
     *
     * @param string[] $videoCodecs An array of the video codecs that are supported
     *                              when publishing a track in the room
     * @return $this Fluent Builder
     */
    public function setVideoCodecs(array $videoCodecs): self {
        $this->options['videoCodecs'] = $videoCodecs;
        return $this;
    }

    /**
     * The region for the media server in Group Rooms.  Can be: one of the [available Media Regions](https://www.twilio.com/docs/video/ip-address-whitelisting#group-rooms-media-servers). ***This feature is not available in `peer-to-peer` rooms.***
     *
     * @param string $mediaRegion The region for the media server in Group Rooms
     * @return $this Fluent Builder
     */
    public function setMediaRegion(string $mediaRegion): self {
        $this->options['mediaRegion'] = $mediaRegion;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        $options = [];
        foreach ($this->options as $key => $value) {
            if ($value !== Values::NONE || $value !== Values::ARRAY_NONE) {
                $options[] = "$key=$value";
            }
        }
        return '[Twilio.Video.V1.CreateRoomOptions ' . \implode(' ', $options) . ']';
    }
}

class ReadRoomOptions extends Options {
    /**
     * @param string $status Read only the rooms with this status
     * @param string $uniqueName Read only rooms with this unique_name
     * @param \DateTime $dateCreatedAfter Read only rooms that started on or after
     *                                    this date, given as YYYY-MM-DD
     * @param \DateTime $dateCreatedBefore Read only rooms that started before this
     *                                     date, given as YYYY-MM-DD
     */
    public function __construct(string $status = Values::NONE, string $uniqueName = Values::NONE, \DateTime $dateCreatedAfter = Values::NONE, \DateTime $dateCreatedBefore = Values::NONE) {
        $this->options['status'] = $status;
        $this->options['uniqueName'] = $uniqueName;
        $this->options['dateCreatedAfter'] = $dateCreatedAfter;
        $this->options['dateCreatedBefore'] = $dateCreatedBefore;
    }

    /**
     * Read only the rooms with this status. Can be: `in-progress` (default) or `completed`
     *
     * @param string $status Read only the rooms with this status
     * @return $this Fluent Builder
     */
    public function setStatus(string $status): self {
        $this->options['status'] = $status;
        return $this;
    }

    /**
     * Read only rooms with the this `unique_name`.
     *
     * @param string $uniqueName Read only rooms with this unique_name
     * @return $this Fluent Builder
     */
    public function setUniqueName(string $uniqueName): self {
        $this->options['uniqueName'] = $uniqueName;
        return $this;
    }

    /**
     * Read only rooms that started on or after this date, given as `YYYY-MM-DD`.
     *
     * @param \DateTime $dateCreatedAfter Read only rooms that started on or after
     *                                    this date, given as YYYY-MM-DD
     * @return $this Fluent Builder
     */
    public function setDateCreatedAfter(\DateTime $dateCreatedAfter): self {
        $this->options['dateCreatedAfter'] = $dateCreatedAfter;
        return $this;
    }

    /**
     * Read only rooms that started before this date, given as `YYYY-MM-DD`.
     *
     * @param \DateTime $dateCreatedBefore Read only rooms that started before this
     *                                     date, given as YYYY-MM-DD
     * @return $this Fluent Builder
     */
    public function setDateCreatedBefore(\DateTime $dateCreatedBefore): self {
        $this->options['dateCreatedBefore'] = $dateCreatedBefore;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        $options = [];
        foreach ($this->options as $key => $value) {
            if ($value !== Values::NONE || $value !== Values::ARRAY_NONE) {
                $options[] = "$key=$value";
            }
        }
        return '[Twilio.Video.V1.ReadRoomOptions ' . \implode(' ', $options) . ']';
    }
}