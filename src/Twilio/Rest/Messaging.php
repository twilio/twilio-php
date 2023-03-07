<?php

namespace Twilio\Rest;

use Twilio\Rest\Messaging\V1;

class Messaging extends MessagingBase {
    /**
     * @deprecated
     */
    protected function getBrandRegistrations(): \Twilio\Rest\Messaging\V1\BrandRegistrationList {
        echo "brandRegistrations is deprecated. Use v1->brandRegistrations instead.";
        return $this->v1->brandRegistrations;
    }

    /**
     * @deprecated
     * @param string $sid The SID that identifies the resource to fetch
     */
    protected function contextBrandRegistrations(string $sid): \Twilio\Rest\Messaging\V1\BrandRegistrationContext {
        echo "brandRegistrations(\$sid) is deprecated. Use v1->brandRegistrations(\$sid) instead.";
        return $this->v1->brandRegistrations($sid);
    }

    /**
     * @deprecated
     */
    protected function getDeactivations(): \Twilio\Rest\Messaging\V1\DeactivationsList {
        echo "deactivations is deprecated. Use v1->deactivations instead.";
        return $this->v1->deactivations;
    }

    /**
     * @deprecated Use v1->deactivations() instead.
     */
    protected function contextDeactivations(): \Twilio\Rest\Messaging\V1\DeactivationsContext {
        echo "deactivations() is deprecated. Use v1->deactivations() instead.";
        return $this->v1->deactivations();
    }

    /**
     * @deprecated Use v1->domainCerts instead.
     */
    protected function getDomainCerts(): \Twilio\Rest\Messaging\V1\DomainCertsList {
        echo "domainCerts is deprecated. Use v1->domainCerts instead.";
        return $this->v1->domainCerts;
    }

    /**
     * @deprecated Use v1->domainCerts(\$domainSid) instead.
     * @param string $domainSid Unique string used to identify the domain that this
     *                          certificate should be associated with.
     */
    protected function contextDomainCerts(string $domainSid): \Twilio\Rest\Messaging\V1\DomainCertsContext {
        echo "domainCerts(\$domainSid) is deprecated. Use v1->domainCerts(\$domainSid) instead.";
        return $this->v1->domainCerts($domainSid);
    }

    /**
     * @deprecated  Use v1->domainConfig instead.
     */
    protected function getDomainConfig(): \Twilio\Rest\Messaging\V1\DomainConfigList {
        echo "domainConfig is deprecated. Use v1->domainConfig instead.";
        return $this->v1->domainConfig;
    }

    /**
     * @deprecated Use v1->domainConfig(\$domainSid) instead.
     * @param string $domainSid Unique string used to identify the domain that this
     *                          config should be associated with.
     */
    protected function contextDomainConfig(string $domainSid): \Twilio\Rest\Messaging\V1\DomainConfigContext {
        echo "domainConfig(\$domainSid) is deprecated. Use v1->domainConfig(\$domainSid) instead.";
        return $this->v1->domainConfig($domainSid);
    }

    /**
     * @deprecated Use v1->externalCampaign instead.
     */
    protected function getExternalCampaign(): \Twilio\Rest\Messaging\V1\ExternalCampaignList {
        echo "externalCampaign is deprecated. Use v1->externalCampaign instead.";
        return $this->v1->externalCampaign;
    }

    /**
     * @deprecated Use v1->services instead.
     */
    protected function getServices(): \Twilio\Rest\Messaging\V1\ServiceList {
        echo "services is deprecated. Use v1->services instead.";
        return $this->v1->services;
    }

    /**
     * @deprecated Use v1->services(\$sid) instead.
     * @param string $sid The SID that identifies the resource to fetch
     */
    protected function contextServices(string $sid): \Twilio\Rest\Messaging\V1\ServiceContext {
        echo "services(\$sid) is deprecated. Use v1->services(\$sid) instead.";
        return $this->v1->services($sid);
    }

    /**
     * @deprecated Use v1->tollfreeVerifications instead.
     */
    protected function getTollfreeVerifications(): \Twilio\Rest\Messaging\V1\TollfreeVerificationList {
        echo "tollfreeVerifications is deprecated. Use v1->tollfreeVerifications instead.";
        return $this->v1->tollfreeVerifications;
    }

    /**
     * @deprecated Use v1->tollfreeVerifications(\$sid) instead.
     * @param string $sid Tollfree Verification Sid
     */
    protected function contextTollfreeVerifications(string $sid): \Twilio\Rest\Messaging\V1\TollfreeVerificationContext {
        echo "tollfreeVerifications(\$sid) is deprecated. Use v1->tollfreeVerifications(\$sid) instead.";
        return $this->v1->tollfreeVerifications($sid);
    }

    /**
     * @deprecated Use v1->usecases instead.
     */
    protected function getUsecases(): \Twilio\Rest\Messaging\V1\UsecaseList {
        echo "usecases is deprecated. Use v1->usecases instead.";
        return $this->v1->usecases;
    }
}