<?php

namespace Twilio\Jwt\Grants;

class TaskRouterGrant implements Grant {
    private $workspaceSid;
    private $workerSid;
    private $role;

    /**
     * Returns the workspace sid
     *
     * @return string the workspace sid
     */
    public function getWorkspaceSid(): string {
        return $this->workspaceSid;
    }

    /**
     * Set the workspace sid of this grant
     *
     * @param string $workspaceSid workspace sid of the grant
     *
     * @return $this updated grant
     */
    public function setWorkspaceSid(string $workspaceSid): self {
        $this->workspaceSid = $workspaceSid;
        return $this;
    }

    /**
     * Returns the worker sid
     *
     * @return string the worker sid
     */
    public function getWorkerSid(): string {
        return $this->workerSid;
    }

    /**
     * Set the worker sid of this grant
     *
     * @param string $workerSid worker sid of the grant
     *
     * @return $this updated grant
     */
    public function setWorkerSid(string $workerSid): self {
        $this->workerSid = $workerSid;
        return $this;
    }

    /**
     * Returns the role
     *
     * @return string the role
     */
    public function getRole(): string {
        return $this->role;
    }

    /**
     * Set the role of this grant
     *
     * @param string $role role of the grant
     *
     * @return $this updated grant
     */
    public function setRole(string $role): self {
        $this->role = $role;
        return $this;
    }

    /**
     * Returns the grant type
     *
     * @return string type of the grant
     */
    public function getGrantKey(): string {
        return 'task_router';
    }

    /**
     * Returns the grant data
     *
     * @return array data of the grant
     */
    public function getPayload(): array {
        $payload = [];
        if ($this->workspaceSid) {
            $payload['workspace_sid'] = $this->workspaceSid;
        }
        if ($this->workerSid) {
            $payload['worker_sid'] = $this->workerSid;
        }
        if ($this->role) {
            $payload['role'] = $this->role;
        }

        return $payload;
    }
}
