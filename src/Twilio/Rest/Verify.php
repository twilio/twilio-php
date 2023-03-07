<?php

namespace Twilio\Rest;

use Twilio\Rest\Verify\V2;

class Verify extends VerifyBase {
    /**
     * @deprecated Use v2->forms instead.
     */
    protected function getForms(): \Twilio\Rest\Verify\V2\FormList {
        echo "forms is deprecated. Use v2->forms instead.";
        return $this->v2->forms;
    }

    /**
     * @deprecated Use v2->forms(\$formType) instead.
     * @param string $formType The Type of this Form
     */
    protected function contextForms(string $formType): \Twilio\Rest\Verify\V2\FormContext {
        echo "forms(\$formType) is deprecated. Use v2->forms(\$formType) instead.";
        return $this->v2->forms($formType);
    }

    /**
     * @deprecated Use v2->safelist instead.
     */
    protected function getSafelist(): \Twilio\Rest\Verify\V2\SafelistList {
        echo "safelist is deprecated. Use v2->safelist instead.";
        return $this->v2->safelist;
    }

    /**
     * @deprecated Use v2->safelist(\$phoneNumber) instead.
     * @param string $phoneNumber The phone number to be fetched from SafeList.
     */
    protected function contextSafelist(string $phoneNumber): \Twilio\Rest\Verify\V2\SafelistContext {
        echo "safelist(\$phoneNumber) is deprecated. Use v2->safelist(\$phoneNumber) instead.";
        return $this->v2->safelist($phoneNumber);
    }

    /**
     * @deprecated Use v2->services instead.
     */
    protected function getServices(): \Twilio\Rest\Verify\V2\ServiceList {
        echo "services is deprecated. Use v2->services instead.";
        return $this->v2->services;
    }

    /**
     * @deprecated Use v2->services(\$sid) instead.
     * @param string $sid The unique string that identifies the resource
     */
    protected function contextServices(string $sid): \Twilio\Rest\Verify\V2\ServiceContext {
        echo "services(\$sid) is deprecated. Use v2->services(\$sid) instead.";
        return $this->v2->services($sid);
    }

    /**
     * @deprecated Use v2->verificationAttempts instead.
     */
    protected function getVerificationAttempts(): \Twilio\Rest\Verify\V2\VerificationAttemptList {
        echo "verificationAttempts is deprecated. Use v2->verificationAttempts instead.";
        return $this->v2->verificationAttempts;
    }

    /**
     * @deprecated Use v2->verificationAttempts(\$sid) instead.
     * @param string $sid Verification Attempt Sid.
     */
    protected function contextVerificationAttempts(string $sid): \Twilio\Rest\Verify\V2\VerificationAttemptContext {
        echo "verificationAttempts(\$sid) is deprecated. Use v2->verificationAttempts(\$sid) instead.";
        return $this->v2->verificationAttempts($sid);
    }

    /**
     * @deprecated Use v2->verificationAttemptsSummary instead.
     */
    protected function getVerificationAttemptsSummary(): \Twilio\Rest\Verify\V2\VerificationAttemptsSummaryList {
        echo "verificationAttemptsSummary is deprecated. Use v2->verificationAttemptsSummary instead.";
        return $this->v2->verificationAttemptsSummary;
    }

    /**
     * @deprecated Use v2->verificationAttemptsSummary() instead.
     */
    protected function contextVerificationAttemptsSummary(): \Twilio\Rest\Verify\V2\VerificationAttemptsSummaryContext {
        echo "verificationAttemptsSummary() is deprecated. Use v2->verificationAttemptsSummary() instead.";
        return $this->v2->verificationAttemptsSummary();
    }

    /**
     * @deprecated Use v2->templates instead.
     */
    protected function getTemplates(): \Twilio\Rest\Verify\V2\TemplateList {
        echo "templates is deprecated. Use v2->templates instead.";
        return $this->v2->templates;
    }
}