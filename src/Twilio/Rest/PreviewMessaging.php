<?php

namespace Twilio\Rest;

use Twilio\Rest\PreviewMessaging\V1;

class PreviewMessaging extends PreviewMessagingBase {
    /**
     * @deprecated Use v1->oauth instead.
     */
    protected function getMessages(): \Twilio\Rest\PreviewMessaging\V1\MessageList {
        return $this->v1->messages;
    }

    /**
     * @deprecated Use v1->oauth() instead.
     */
    protected function getBroadcasts(): \Twilio\Rest\PreviewMessaging\V1\BroadcastList {
        return $this->v1->broadcasts;
    }
}
