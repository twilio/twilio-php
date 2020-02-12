<?php


namespace Twilio\Jwt\TaskRouter;

/**
 * Twilio TaskRouter Worker Capability assigner
 *
 * @author Justin Witz <justin.witz@twilio.com>
 * @license  http://creativecommons.org/licenses/MIT/ MIT
 */
class WorkerCapability extends CapabilityToken {
    private $tasksUrl;
    private $workerReservationsUrl;
    private $activityUrl;

    public function __construct(string $accountSid, string $authToken, string $workspaceSid, string $workerSid,
                                string $overrideBaseUrl = null, string $overrideBaseWSUrl = null) {
        parent::__construct($accountSid, $authToken, $workspaceSid, $workerSid, null, $overrideBaseUrl, $overrideBaseWSUrl);

        $this->tasksUrl = $this->baseUrl . '/Tasks/**';
        $this->activityUrl = $this->baseUrl . '/Activities';
        $this->workerReservationsUrl = $this->resourceUrl . '/Reservations/**';

        //add permissions to fetch the list of activities, tasks, and worker reservations
        $this->allow($this->activityUrl, 'GET', null, null);
        $this->allow($this->tasksUrl, 'GET', null, null);
        $this->allow($this->workerReservationsUrl, 'GET', null, null);
    }

    protected function setupResource(): void {
        $this->resourceUrl = $this->baseUrl . '/Workers/' . $this->channelId;
    }

    public function allowActivityUpdates(): void {
        $method = 'POST';
        $queryFilter = [];
        $postFilter = ['ActivitySid' => $this->required];
        $this->allow($this->resourceUrl, $method, $queryFilter, $postFilter);
    }

    public function allowReservationUpdates(): void {
        $method = 'POST';
        $queryFilter = [];
        $postFilter = [];
        $this->allow($this->tasksUrl, $method, $queryFilter, $postFilter);
        $this->allow($this->workerReservationsUrl, $method, $queryFilter, $postFilter);
    }
}
