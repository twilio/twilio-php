<?php

namespace Twilio\Rest;

use Twilio\Rest\PreviewIam\V1\AuthorizeList;
use \Twilio\Rest\PreviewIam\V1\TokenList;
use Twilio\Rest\PreviewIam\Versionless\OrganizationList;
use Twilio\Rest\PreviewIam\Versionless;

class PreviewIam extends PreviewIamBase {
    public $_organization;

    /**
     * @deprecated Use v1->token instead.
     */
    protected function getToken(): TokenList {
        return $this->v1->token;
    }

    /**
     * @deprecated Use v1->authorize instead.
     */
    protected function getAuthorize(): AuthorizeList {
        return $this->v1->authorize;
    }

    /* getter for organization resource */
    protected function getOrganization(): OrganizationList {
        if ($this->_organization !== null) {
            $versionless = new Versionless($this);
            $this->_organization = $versionless->organization;
        }
        return $this->_organization;
    }

}
