<?php


namespace Twilio\Jwt\Grants;


class ChatGrant implements Grant {
    private $serviceSid;
    private $endpointId;
    private $deploymentRoleSid;
    private $pushCredentialSid;

    /**
     * Returns the service sid
     *
     * @return string the service sid
     */
    public function getServiceSid() {
        return $this->serviceSid;
    }

    /**
     * Set the service sid of this grant
     *
     * @param string $serviceSid service sid of the grant
     *
     * @return $this updated grant
     */
    public function setServiceSid($serviceSid) {
        $this->serviceSid = $serviceSid;
        return $this;
    }

    /**
     * Returns the endpoint id of the grant
     *
     * @return string the endpoint id
     */
    public function getEndpointId() {
        return $this->endpointId;
    }

    /**
     * Set the endpoint id of the grant
     *
     * @param string $endpointId endpoint id of the grant
     *
     * @return $this updated grant
     */
    public function setEndpointId($endpointId) {
        $this->endpointId = $endpointId;
        return $this;
    }

    /**
     * Returns the deployment role sid of the grant
     *
     * @return string the deployment role sid
     */
    public function getDeploymentRoleSid() {
        return $this->deploymentRoleSid;
    }

    /**
     * Set the role sid of the grant
     *
     * @param string $deploymentRoleSid role sid of the grant
     *
     * @return $this updated grant
     */
    public function setDeploymentRoleSid($deploymentRoleSid) {
        $this->deploymentRoleSid = $deploymentRoleSid;
        return $this;
    }

    /**
     * Returns the push credential sid of the grant
     *
     * @return string the push credential sid
     */
    public function getPushCredentialSid() {
        return $this->pushCredentialSid;
    }

    /**
     * Set the credential sid of the grant
     *
     * @param string $pushCredentialSid push credential sid of the grant
     *
     * @return $this updated grant
     */
    public function setPushCredentialSid($pushCredentialSid) {
        $this->pushCredentialSid = $pushCredentialSid;
        return $this;
    }

    /**
     * Returns the grant type
     *
     * @return string type of the grant
     */
    public function getGrantKey() {
        return "chat";
    }

    /**
     * Returns the grant data
     *
     * @return array data of the grant
     */
    public function getPayload() {
        $payload = array();
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