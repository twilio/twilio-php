<?php

namespace Twilio\Rest;

use Twilio\Rest\Content\V1;

class Content extends ContentBase {

    /**
     * @deprecated Use v1->contents instead.
     */
    protected function getContents(): \Twilio\Rest\Content\V1\ContentList {
        echo "contents is deprecated. Use v1->contents instead.";
        return $this->v1->contents;
    }

    /**
     * @deprecated Use v1->contents(\$sid) instead.
     * @param string $sid The unique string that identifies the resource
     */
    protected function contextContents(string $sid): \Twilio\Rest\Content\V1\ContentContext {
        echo "contents(\$sid) is deprecated. Use v1->contents(\$sid) instead.";
        return $this->v1->contents($sid);
    }
}