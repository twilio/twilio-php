<?php

namespace Twilio\Jwt\Grants;

class SyncGrant implements Grant {
    private $serviceSid;
    private $endpointId;
    private $deploymentRoleSid;
    private $pushCredentialSid;

    /**
     * Returns the service sid
     *
     * @return string the service sid
     */
    public function getServiceSid(): string {
        return $this->serviceSid;
    }

    /**
     * Set the service sid of this grant
     *
     * @param string $serviceSid service sid of the grant
     *
     * @return $this updated grant
     */
    public function setServiceSid(string $serviceSid): self {
        $this->serviceSid = $serviceSid;
        return $this;
    }

    /**
     * Returns the endpoint id of the grant
     *
     * @return string the endpoint id
     */
    public function getEndpointId(): string {
        return $this->endpointId;
    }

    /**
     * Set the endpoint id of the grant
     *
     * @param string $endpointId endpoint id of the grant
     *
     * @return $this updated grant
     */
    public function setEndpointId(string $endpointId): self {
        $this->endpointId = $endpointId;
        return $this;
    }

    /**
     * Returns the deployment role sid of the grant
     *
     * @return string the deployment role sid
     */
    public function getDeploymentRoleSid(): string {
        return $this->deploymentRoleSid;
    }

    /**
     * Set the role sid of the grant
     *
     * @param string $deploymentRoleSid role sid of the grant
     *
     * @return $this updated grant
     */
    public function setDeploymentRoleSid(string $deploymentRoleSid): self {
        $this->deploymentRoleSid = $deploymentRoleSid;
        return $this;
    }

    /**
     * Returns the push credential sid of the grant
     *
     * @return string the push credential sid
     */
    public function getPushCredentialSid(): string {
        return $this->pushCredentialSid;
    }

    /**
     * Set the credential sid of the grant
     *
     * @param string $pushCredentialSid push credential sid of the grant
     *
     * @return $this updated grant
     */
    public function setPushCredentialSid(string $pushCredentialSid): self {
        $this->pushCredentialSid = $pushCredentialSid;
        return $this;
    }

    /**
     * Returns the grant type
     *
     * @return string type of the grant
     */
    public function getGrantKey(): string {
        return 'data_sync';
    }

    /**
     * Returns the grant data
     *
     * @return array data of the grant
     */
    public function getPayload(): array {
        $payload = [];
        if ($this->serviceSid) {
            $payload['service_sid'] = $this->serviceSid;
        }
        if ($this->endpointId) {
            $payload['endpoint_id'] = $this->endpointId;
        }
        if ($this->deploymentRoleSid) {
            $payload['deployment_role_sid'] = $this->deploymentRoleSid;
        }
        if ($this->pushCredentialSid) {
            $payload['push_credential_sid'] = $this->pushCredentialSid;
        }

        return $payload;
    }
}
