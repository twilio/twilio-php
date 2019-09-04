<?php


namespace Twilio\Jwt\Grants;


class VoiceGrant implements Grant {

    private $incomingAllow;
    private $outgoingApplicationSid;
    private $outgoingApplicationParams;
    private $pushCredentialSid;
    private $endpointId;

    /**
     * Returns whether incoming is allowed
     *
     * @return boolean whether incoming is allowed
     */
    public function getIncomingAllow()
    {
        return $this->incomingAllow;
    }

    /**
     * Set whether incoming is allowed
     *
     * @param boolean $incomingAllow whether incoming is allowed
     *
     * @return $this updated grant
     */
    public function setIncomingAllow($incomingAllow)
    {
        $this->incomingAllow = $incomingAllow;
        return $this;
    }

    /**
     * Returns the outgoing application sid
     *
     * @return string the outgoing application sid
     */
    public function getOutgoingApplicationSid()
    {
        return $this->outgoingApplicationSid;
    }

    /**
     * Set the outgoing application sid of the grant
     *
     * @param string $outgoingApplicationSid outgoing application sid of grant
     *
     * @return $this updated grant
     */
    public function setOutgoingApplicationSid($outgoingApplicationSid)
    {
        $this->outgoingApplicationSid = $outgoingApplicationSid;
        return $this;
    }

    /**
     * Returns the outgoing application params
     *
     * @return array the outgoing application params
     */
    public function getOutgoingApplicationParams()
    {
        return $this->outgoingApplicationParams;
    }

    /**
     * Set the outgoing application of the the grant
     *
     * @param string $sid outgoing application sid of the grant
     * @param string $params params to pass the the application
     *
     * @return $this updated grant
     */
    public function setOutgoingApplication($sid, $params) {
        $this->outgoingApplicationSid = $sid;
        $this->outgoingApplicationParams = $params;
        return $this;
    }

    /**
     * Returns the push credential sid
     *
     * @return string the push credential sid
     */
    public function getPushCredentialSid()
    {
        return $this->pushCredentialSid;
    }

    /**
     * Set the push credential sid
     *
     * @param string $pushCredentialSid
     *
     * @return $this updated grant
     */
    public function setPushCredentialSid($pushCredentialSid)
    {
        $this->pushCredentialSid = $pushCredentialSid;
        return $this;
    }

    /**
     * Returns the endpoint id
     *
     * @return string the endpoint id
     */
    public function getEndpointId()
    {
        return $this->endpointId;
    }

    /**
     * Set the endpoint id
     *
     * @param string $endpointId endpoint id
     *
     * @return $this updated grant
     */
    public function setEndpointId($endpointId)
    {
        $this->endpointId = $endpointId;
        return $this;
    }

    /**
     * Returns the grant type
     *
     * @return string type of the grant
     */
    public function getGrantKey()
    {
        return "voice";
    }

    /**
     * Returns the grant data
     *
     * @return array data of the grant
     */
    public function getPayload()
    {
        $payload = array();
        if ($this->incomingAllow == true) {
            $incoming = array();
            $incoming['allow'] = true;
            $payload['incoming'] = $incoming;
        }

        if ($this->outgoingApplicationSid) {
            $outgoing = array();
            $outgoing['application_sid'] = $this->outgoingApplicationSid;

            if ($this->outgoingApplicationParams) {
                $outgoing['params'] = $this->outgoingApplicationParams;
            }

            $payload['outgoing'] = $outgoing;
        }

        if ($this->pushCredentialSid) {
            $payload['push_credential_sid'] = $this->pushCredentialSid;
        }

        if ($this->endpointId) {
            $payload['endpoint_id'] = $this->endpointId;
        }

        return $payload;
    }


}
