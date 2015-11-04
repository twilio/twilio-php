<?php

class Services_Twilio_Auth_IpMessagingGrant implements Services_Twilio_Auth_Grant
{
    private $serviceSid;
    private $endpointId;
    private $roleSid;
    private $credentialSid;

    /**
     * Returns the service sid
     *
     * @return string the service sid
     */
    public function getServiceSid()
    {
        return $this->serviceSid;
    }

    /**
     * Set the service sid of this grant
     *
     * @param string $serviceSid service sid of the grant
     *
     * @return Services_Twilio_Auth_IpMessagingGrant updated grant
     */
    public function setServiceSid($serviceSid)
    {
        $this->serviceSid = $serviceSid;
        return $this;
    }

    /**
     * Returns the endpoint id of the grant
     *
     * @return string the endpoint id
     */
    public function getEndpointId()
    {
        return $this->endpointId;
    }

    /**
     * Set the endpoint id of the grant
     *
     * @param string $endpointId endpoint id of the grant
     *
     * @return Services_Twilio_Auth_IpMessagingGrant updated grant
     */
    public function setEndpointId($endpointId)
    {
        $this->endpointId = $endpointId;
        return $this;
    }

    /**
     * Returns the role sid of the grant
     *
     * @return string the role sid
     */
    public function getRoleSid()
    {
        return $this->roleSid;
    }

    /**
     * Set the role sid of the grant
     *
     * @param string $roleSid role sid of the grant
     *
     * @return Services_Twilio_Auth_IpMessagingGrant updated grant
     */
    public function setRoleSid($roleSid)
    {
        $this->roleSid = $roleSid;
        return $this;
    }

    /**
     * Returns the credential sid of the grant
     *
     * @return string the credential sid
     */
    public function getCredentialSid()
    {
        return $this->credentialSid;
    }

    /**
     * Set the credential sid of the grant
     *
     * @param string $credentialSid credential sid of the grant
     *
     * @return Services_Twilio_Auth_IpMessagingGrant updated grant
     */
    public function setCredentialSid($credentialSid)
    {
        $this->credentialSid = $credentialSid;
        return $this;
    }

    /**
     * Returns the grant type
     *
     * @return string type of the grant
     */
    public function getGrantKey()
    {
        return "ip_messaging";
    }

    /**
     * Returns the grant data
     *
     * @return array data of the grant
     */
    public function getPayload()
    {
        $payload = array();
        if ($this->serviceSid) {
            $payload['service_sid'] = $this->serviceSid;
        }
        if ($this->endpointId) {
            $payload['endpoint_id'] = $this->endpointId;
        }
        if ($this->roleSid) {
            $payload['deployment_role_sid'] = $this->roleSid;
        }
        if ($this->credentialSid) {
            $payload['push_credential_sid'] = $this->credentialSid;
        }

        return $payload;
    }

}