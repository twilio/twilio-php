<?php

namespace Twilio\Rest;

use Twilio\Rest\Trusthub\V1;

class Trusthub extends TrusthubBase {
    /**
     * @deprecated Use v1->customerProfiles instead.
     */
    protected function getCustomerProfiles(): \Twilio\Rest\Trusthub\V1\CustomerProfilesList {
        echo "customerProfiles is deprecated. Use v1->customerProfiles instead.";
        return $this->v1->customerProfiles;
    }

    /**
     * @deprecated Use v1->customerProfiles(\$sid) instead.
     * @param string $sid The unique string that identifies the resource.
     */
    protected function contextCustomerProfiles(string $sid): \Twilio\Rest\Trusthub\V1\CustomerProfilesContext {
        echo "customerProfiles(\$sid) is deprecated. Use v1->customerProfiles(\$sid) instead.";
        return $this->v1->customerProfiles($sid);
    }

    /**
     * @deprecated Use v1->endUsers instead.
     */
    protected function getEndUsers(): \Twilio\Rest\Trusthub\V1\EndUserList {
        echo "endUsers is deprecated. Use v1->endUsers instead.";
        return $this->v1->endUsers;
    }

    /**
     * @deprecated Use v1->endUsers(\$sid) instead.
     * @param string $sid The unique string that identifies the resource
     */
    protected function contextEndUsers(string $sid): \Twilio\Rest\Trusthub\V1\EndUserContext {
        echo "endUsers(\$sid) is deprecated. Use v1->endUsers(\$sid) instead.";
        return $this->v1->endUsers($sid);
    }

    /**
     * @deprecated Use v1->endUserTypes instead.
     */
    protected function getEndUserTypes(): \Twilio\Rest\Trusthub\V1\EndUserTypeList {
        echo "endUserTypes is deprecated. Use v1->endUserTypes instead.";
        return $this->v1->endUserTypes;
    }

    /**
     * @deprecated Use v1->endUserTypes(\$sid) instead.
     * @param string $sid The unique string that identifies the End-User Type
     *                    resource
     */
    protected function contextEndUserTypes(string $sid): \Twilio\Rest\Trusthub\V1\EndUserTypeContext {
        echo "endUserTypes(\$sid) is deprecated. Use v1->endUserTypes(\$sid) instead.";
        return $this->v1->endUserTypes($sid);
    }

    /**
     * @deprecated Use v1->policies instead.
     */
    protected function getPolicies(): \Twilio\Rest\Trusthub\V1\PoliciesList {
        echo "policies is deprecated. Use v1->policies instead.";
        return $this->v1->policies;
    }

    /**
     * @deprecated Use v1->policies(\$sid) instead.
     * @param string $sid The unique string that identifies the Policy resource
     */
    protected function contextPolicies(string $sid): \Twilio\Rest\Trusthub\V1\PoliciesContext {
        echo "policies(\$sid) is deprecated. Use v1->policies(\$sid) instead.";
        return $this->v1->policies($sid);
    }

    /**
     * @deprecated Use v1->supportingDocuments instead.
     */
    protected function getSupportingDocuments(): \Twilio\Rest\Trusthub\V1\SupportingDocumentList {
        echo "supportingDocuments is deprecated. Use v1->supportingDocuments instead.";
        return $this->v1->supportingDocuments;
    }

    /**
     * @deprecated Use v1->supportingDocuments(\$sid) instead.
     * @param string $sid The unique string that identifies the resource
     */
    protected function contextSupportingDocuments(string $sid): \Twilio\Rest\Trusthub\V1\SupportingDocumentContext {
        echo "supportingDocuments(\$sid) is deprecated. Use v1->supportingDocuments(\$sid) instead.";
        return $this->v1->supportingDocuments($sid);
    }

    /**
     * @deprecated Use v1->supportingDocumentTypes instead.
     */
    protected function getSupportingDocumentTypes(): \Twilio\Rest\Trusthub\V1\SupportingDocumentTypeList {
        echo "supportingDocumentTypes is deprecated. Use v1->supportingDocumentTypes instead.";
        return $this->v1->supportingDocumentTypes;
    }

    /**
     * @deprecated Use v1->supportingDocumentTypes(\$sid) instead.
     * @param string $sid The unique string that identifies the Supporting Document
     *                    Type resource
     */
    protected function contextSupportingDocumentTypes(string $sid): \Twilio\Rest\Trusthub\V1\SupportingDocumentTypeContext {
        echo "supportingDocumentTypes(\$sid) is deprecated. Use v1->supportingDocumentTypes(\$sid) instead.";
        return $this->v1->supportingDocumentTypes($sid);
    }

    /**
     * @deprecated Use v1->trustProducts instead.
     */
    protected function getTrustProducts(): \Twilio\Rest\Trusthub\V1\TrustProductsList {
        echo "trustProducts is deprecated. Use v1->trustProducts instead.";
        return $this->v1->trustProducts;
    }

    /**
     * @deprecated Use v1->trustProducts(\$sid) instead.
     * @param string $sid The unique string that identifies the resource.
     */
    protected function contextTrustProducts(string $sid): \Twilio\Rest\Trusthub\V1\TrustProductsContext {
        echo "trustProducts(\$sid) is deprecated. Use v1->trustProducts(\$sid) instead.";
        return $this->v1->trustProducts($sid);
    }
}