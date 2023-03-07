<?php

namespace Twilio\Rest;

use Twilio\Rest\Chat\V2;
use Twilio\Rest\Chat\V3;
class Chat extends ChatBase {

    /**
     * @deprecated Use v2->credentials instead.
     */
    protected function getCredentials(): \Twilio\Rest\Chat\V2\CredentialList {
        echo "credentials is deprecated. Use v2->credentials instead.";
        return $this->v2->credentials;
    }

    /**
     * @deprecated Use v2->credentials(\$sid) instead.
     * @param string $sid The SID of the Credential resource to fetch
     */
    protected function contextCredentials(string $sid): \Twilio\Rest\Chat\V2\CredentialContext {
        echo "credentials(\$sid) is deprecated. Use v2->credentials(\$sid) instead.";
        return $this->v2->credentials($sid);
    }

    /**
     * @deprecated Use v2->services instead.
     */
    protected function getServices(): \Twilio\Rest\Chat\V2\ServiceList {
        echo "services is deprecated. Use v2->services instead.";
        return $this->v2->services;
    }

    /**
     * @deprecated Use v2->services(\$sid) instead.
     * @param string $sid The SID of the Service resource to fetch
     */
    protected function contextServices(string $sid): \Twilio\Rest\Chat\V2\ServiceContext {
        echo "services(\$sid) is deprecated. Use v2->services(\$sid) instead.";
        return $this->v2->services($sid);
    }

    /**
     * @deprecated Use v3->channels instead.
     */
    protected function getChannels(): \Twilio\Rest\Chat\V3\ChannelList {
        echo "channels is deprecated. Use v3->channels instead.";
        return $this->v3->channels;
    }

    /**
     * @deprecated Use v3->channels(\$serviceSid, \$sid) instead.
     * @param string $serviceSid Service Sid.
     * @param string $sid A string that uniquely identifies this Channel.
     */
    protected function contextChannels(string $serviceSid, string $sid): \Twilio\Rest\Chat\V3\ChannelContext {
        echo "channels(\$serviceSid, \$sid) is deprecated. Use v3->channels(\$serviceSid, \$sid) instead.";
        return $this->v3->channels($serviceSid, $sid);
    }
}