<?php

namespace Twilio\Base;

use Twilio\Exceptions\TwilioException;
use Twilio\Values;

/**
 * @property bool $mms
 * @property bool $sms
 * @property bool $voice
 * @property bool $fax
 */
class PhoneNumberCapabilities
{
    protected $mms;
    protected $sms;
    protected $voice;
    protected $fax;

    public function __construct(array $capabilities)
    {
        $this->mms = Values::array_get($capabilities, 'mms', "false");
        $this->sms = Values::array_get($capabilities, 'sms', "false");
        $this->voice = Values::array_get($capabilities, 'voice', "false");
        $this->fax = Values::array_get($capabilities, 'fax', "false");
    }

    /**
     * Access the mms
     */
    public function getMms(): bool
    {
        return $this->mms;
    }

    /**
     * Access the sms
     */
    public function getSms(): bool
    {
        return $this->sms;
    }

    /**
     * Access the voice
     */
    public function getVoice(): bool
    {
        return $this->voice;
    }

    /**
     * Access the fax
     */
    public function getFax(): bool
    {
        return $this->fax;
    }

    public function __get(string $name)
    {
        if (\property_exists($this, $name)) {
            $method = 'get' . \ucfirst($name);
            return $this->$method();
        }
        throw new TwilioException('Unknown subresource ' . $name);
    }

    public function __toString(): string
    {
        return "[Twilio.Base.PhoneNumberCapabilities " .
            "(
            mms: " . json_encode($this->mms) . ",
            sms: " . json_encode($this->sms) . ",
            voice: " . json_encode($this->voice) . ",
            fax: " . json_encode($this->fax) . "
        )]";
    }
}
