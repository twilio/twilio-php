<?php


namespace Twilio\Jwt\TaskRouter;


class WorkspaceCapability extends CapabilityToken {
    public function __construct($accountSid, $authToken, $workspaceSid, $overrideBaseUrl = null, $overrideBaseWSUrl = null) {
        parent::__construct($accountSid, $authToken, $workspaceSid, $workspaceSid, null, $overrideBaseUrl, $overrideBaseWSUrl);
    }

    protected function setupResource() {
        $this->resourceUrl = $this->baseUrl;
    }
}