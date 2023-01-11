<?php

namespace Twilio\Rest;

use Twilio\Rest\Video\V1;

class Video extends VideoBase {
    /**
     * @deprecated Use v1->compositions instead.
     */
    protected function getCompositions(): \Twilio\Rest\Video\V1\CompositionList {
        echo "compositions is deprecated. Use v1->compositions instead.";
        return $this->v1->compositions;
    }

    /**
     * @deprecated Use v1->compositions(\$sid) instead.
     * @param string $sid The SID that identifies the resource to fetch
     */
    protected function contextCompositions(string $sid): \Twilio\Rest\Video\V1\CompositionContext {
        echo "compositions(\$sid) is deprecated. Use v1->compositions(\$sid) instead.";
        return $this->v1->compositions($sid);
    }

    /**
     * @deprecated Use v1->compositionHooks instead.
     */
    protected function getCompositionHooks(): \Twilio\Rest\Video\V1\CompositionHookList {
        echo "compositionHooks is deprecated. Use v1->compositionHooks instead.";
        return $this->v1->compositionHooks;
    }

    /**
     * @deprecated Use v1->compositionHooks(\$sid) instead.
     * @param string $sid The SID that identifies the resource to fetch
     */
    protected function contextCompositionHooks(string $sid): \Twilio\Rest\Video\V1\CompositionHookContext {
        echo "compositionHooks(\$sid) is deprecated. Use v1->compositionHooks(\$sid) instead.";
        return $this->v1->compositionHooks($sid);
    }

    /**
     * @deprecated Use v1->compositionSettings instead.
     */
    protected function getCompositionSettings(): \Twilio\Rest\Video\V1\CompositionSettingsList {
        echo "compositionSettings is deprecated. Use v1->compositionSettings instead.";
        return $this->v1->compositionSettings;
    }

    /**
     * @deprecated Use v1->compositionSettings() instead.
     */
    protected function contextCompositionSettings(): \Twilio\Rest\Video\V1\CompositionSettingsContext {
        echo "compositionSettings() is deprecated. Use v1->compositionSettings() instead.";
        return $this->v1->compositionSettings();
    }

    /**
     * @deprecated Use v1->recordings instead.
     */
    protected function getRecordings(): \Twilio\Rest\Video\V1\RecordingList {
        echo "recordings is deprecated. Use v1->recordings instead.";
        return $this->v1->recordings;
    }

    /**
     * @deprecated Use v1->recordings(\$sid) instead.
     * @param string $sid The SID that identifies the resource to fetch
     */
    protected function contextRecordings(string $sid): \Twilio\Rest\Video\V1\RecordingContext {
        echo "recordings(\$sid) is deprecated. Use v1->recordings(\$sid) instead.";
        return $this->v1->recordings($sid);
    }

    /**
     * @deprecated Use v1->recordingSettings instead.
     */
    protected function getRecordingSettings(): \Twilio\Rest\Video\V1\RecordingSettingsList {
        echo "recordingSettings is deprecated. Use v1->recordingSettings instead.";
        return $this->v1->recordingSettings;
    }

    /**
     * @deprecated Use v1->recordingSettings() instead.
     */
    protected function contextRecordingSettings(): \Twilio\Rest\Video\V1\RecordingSettingsContext {
        echo "recordingSettings() is deprecated. Use v1->recordingSettings() instead.";
        return $this->v1->recordingSettings();
    }

    /**
     * @deprecated Use v1->rooms instead.
     */
    protected function getRooms(): \Twilio\Rest\Video\V1\RoomList {
        echo "rooms is deprecated. Use v1->rooms instead.";
        return $this->v1->rooms;
    }

    /**
     * @deprecated Use v1->rooms(\$sid) instead.
     * @param string $sid The SID that identifies the resource to fetch
     */
    protected function contextRooms(string $sid): \Twilio\Rest\Video\V1\RoomContext {
        echo "rooms(\$sid) is deprecated. Use v1->rooms(\$sid) instead.";
        return $this->v1->rooms($sid);
    }
}