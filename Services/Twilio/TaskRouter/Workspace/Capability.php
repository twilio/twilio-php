<?php
include_once (dirname(__FILE__).'/../Capability.php');
/**
 * Twilio TaskRouter Workspace Capability assigner
 *
 * @category Services
 * @package  Services_Twilio
 * @author Justin Witz <justin.witz@twilio.com>
 * @license  http://creativecommons.org/licenses/MIT/ MIT
 */
class Services_Twilio_TaskRouter_Workspace_Capability extends Services_Twilio_TaskRouter_Capability
{
	public function __construct($accountSid, $authToken, $workspaceSid, $overrideBaseUrl = null, $overrideBaseWSUrl = null)
	{
		parent::__construct($accountSid, $authToken, $workspaceSid, $workspaceSid, null, $overrideBaseUrl, $overrideBaseWSUrl);
	}

	protected function setupResource() {
		$this->resourceUrl = $this->baseUrl;
	}
}