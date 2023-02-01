<?php

namespace Twilio\Rest;

use Twilio\Rest\Taskrouter\V1;
class Taskrouter extends TaskrouterBase {

    /**
     * @deprecated Use v1->workspaces instead.
     */
    protected function getWorkspaces(): \Twilio\Rest\Taskrouter\V1\WorkspaceList {
        echo "workspaces is deprecated. Use v1->workspaces instead.";
        return $this->v1->workspaces;
    }

    /**
     * @deprecated Use v1->workspaces(\$sid) instead.
     * @param string $sid The SID of the resource to fetch
     */
    protected function contextWorkspaces(string $sid): \Twilio\Rest\Taskrouter\V1\WorkspaceContext {
        echo "workspaces(\$sid) is deprecated. Use v1->workspaces(\$sid) instead.";
        return $this->v1->workspaces($sid);
    }
}