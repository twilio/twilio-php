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
    protected $_mms;
    protected $_sms;
    protected $_voice;
    protected $_fax;

    public function __construct(array $capabilities)
    {
        $this->_mms = Values::array_get($capabilities, 'mms', "false");
        $this->_sms = Values::array_get($capabilities, 'sms', "false");
        $this->_voice = Values::array_get($capabilities, 'voice', "false");
        $this->_fax = Values::array_get($capabilities,'fax', "false");
    }

    /**
     * Access the mms
     */
    public function getMms(): bool
    {
        return $this->_mms;
    }

    /**
     * Access the sms
     */
    public function getSms(): bool
    {
        return $this->_sms;
    }

    /**
     * Access the voice
     */
    public function getVoice(): bool
    {
        return $this->_voice;
    }

    /**
     * Access the fax
     */
    public function getFax(): bool
    {
        return $this->_fax;
    }

    public function __get(string $name)
    {
        if (\property_exists($this, "_" . $name)) {
            $method = 'get' . \ucfirst($name);
            return $this->$method();
        }
        throw new TwilioException('Unknown subresource ' . $name);
    }

    public function __toString(): string
    {
        return "[Twilio.Base.PhoneNumberCapabilities " .
            "( 
            mms: " . json_encode($this->_mms) . ",
            sms: " . json_encode($this->_sms) . ",
            voice: " . json_encode($this->_voice) . ",
            fax: " . json_encode($this->_fax) . "
        )]";
    }
}