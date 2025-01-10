<?php


namespace Twilio\Jwt\TaskRouter;


class WorkspaceCapability extends CapabilityToken {
    public function __construct(string $accountSid, string $authToken, string $workspaceSid,
                                ?string $overrideBaseUrl = null, ?string $overrideBaseWSUrl = null) {
        parent::__construct($accountSid, $authToken, $workspaceSid, $workspaceSid, null, $overrideBaseUrl, $overrideBaseWSUrl);
    }

    protected function setupResource(): void {
        $this->resourceUrl = $this->baseUrl;
    }
}
