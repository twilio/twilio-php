<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Api;

use Twilio\Domain;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Api\V2010\AccountContext;
use Twilio\Rest\Api\V2010\AccountInstance;
use Twilio\Rest\Api\V2010\AccountList;
use Twilio\Version;

/**
 * @property \Twilio\Rest\Api\V2010\AccountList $accounts
 * @method \Twilio\Rest\Api\V2010\AccountContext accounts(string $sid)
 * @property \Twilio\Rest\Api\V2010\AccountContext $account
 * @property \Twilio\Rest\Api\V2010\Account\AddressList $addresses
 * @property \Twilio\Rest\Api\V2010\Account\ApplicationList $applications
 * @property \Twilio\Rest\Api\V2010\Account\AuthorizedConnectAppList $authorizedConnectApps
 * @property \Twilio\Rest\Api\V2010\Account\AvailablePhoneNumberCountryList $availablePhoneNumbers
 * @property \Twilio\Rest\Api\V2010\Account\BalanceList $balance
 * @property \Twilio\Rest\Api\V2010\Account\CallList $calls
 * @property \Twilio\Rest\Api\V2010\Account\ConferenceList $conferences
 * @property \Twilio\Rest\Api\V2010\Account\ConnectAppList $connectApps
 * @property \Twilio\Rest\Api\V2010\Account\IncomingPhoneNumberList $incomingPhoneNumbers
 * @property \Twilio\Rest\Api\V2010\Account\KeyList $keys
 * @property \Twilio\Rest\Api\V2010\Account\MessageList $messages
 * @property \Twilio\Rest\Api\V2010\Account\NewKeyList $newKeys
 * @property \Twilio\Rest\Api\V2010\Account\NewSigningKeyList $newSigningKeys
 * @property \Twilio\Rest\Api\V2010\Account\NotificationList $notifications
 * @property \Twilio\Rest\Api\V2010\Account\OutgoingCallerIdList $outgoingCallerIds
 * @property \Twilio\Rest\Api\V2010\Account\QueueList $queues
 * @property \Twilio\Rest\Api\V2010\Account\RecordingList $recordings
 * @property \Twilio\Rest\Api\V2010\Account\SigningKeyList $signingKeys
 * @property \Twilio\Rest\Api\V2010\Account\SipList $sip
 * @property \Twilio\Rest\Api\V2010\Account\ShortCodeList $shortCodes
 * @property \Twilio\Rest\Api\V2010\Account\TokenList $tokens
 * @property \Twilio\Rest\Api\V2010\Account\TranscriptionList $transcriptions
 * @property \Twilio\Rest\Api\V2010\Account\UsageList $usage
 * @property \Twilio\Rest\Api\V2010\Account\ValidationRequestList $validationRequests
 * @method \Twilio\Rest\Api\V2010\Account\AddressContext addresses(string $sid)
 * @method \Twilio\Rest\Api\V2010\Account\ApplicationContext applications(string $sid)
 * @method \Twilio\Rest\Api\V2010\Account\AuthorizedConnectAppContext authorizedConnectApps(string $connectAppSid)
 * @method \Twilio\Rest\Api\V2010\Account\AvailablePhoneNumberCountryContext availablePhoneNumbers(string $countryCode)
 * @method \Twilio\Rest\Api\V2010\Account\CallContext calls(string $sid)
 * @method \Twilio\Rest\Api\V2010\Account\ConferenceContext conferences(string $sid)
 * @method \Twilio\Rest\Api\V2010\Account\ConnectAppContext connectApps(string $sid)
 * @method \Twilio\Rest\Api\V2010\Account\IncomingPhoneNumberContext incomingPhoneNumbers(string $sid)
 * @method \Twilio\Rest\Api\V2010\Account\KeyContext keys(string $sid)
 * @method \Twilio\Rest\Api\V2010\Account\MessageContext messages(string $sid)
 * @method \Twilio\Rest\Api\V2010\Account\NotificationContext notifications(string $sid)
 * @method \Twilio\Rest\Api\V2010\Account\OutgoingCallerIdContext outgoingCallerIds(string $sid)
 * @method \Twilio\Rest\Api\V2010\Account\QueueContext queues(string $sid)
 * @method \Twilio\Rest\Api\V2010\Account\RecordingContext recordings(string $sid)
 * @method \Twilio\Rest\Api\V2010\Account\SigningKeyContext signingKeys(string $sid)
 * @method \Twilio\Rest\Api\V2010\Account\ShortCodeContext shortCodes(string $sid)
 * @method \Twilio\Rest\Api\V2010\Account\TranscriptionContext transcriptions(string $sid)
 */
class V2010 extends Version {
    protected $_accounts = null;
    protected $_account = null;
    protected $_addresses = null;
    protected $_applications = null;
    protected $_authorizedConnectApps = null;
    protected $_availablePhoneNumbers = null;
    protected $_balance = null;
    protected $_calls = null;
    protected $_conferences = null;
    protected $_connectApps = null;
    protected $_incomingPhoneNumbers = null;
    protected $_keys = null;
    protected $_messages = null;
    protected $_newKeys = null;
    protected $_newSigningKeys = null;
    protected $_notifications = null;
    protected $_outgoingCallerIds = null;
    protected $_queues = null;
    protected $_recordings = null;
    protected $_signingKeys = null;
    protected $_sip = null;
    protected $_shortCodes = null;
    protected $_tokens = null;
    protected $_transcriptions = null;
    protected $_usage = null;
    protected $_validationRequests = null;

    /**
     * Construct the V2010 version of Api
     *
     * @param \Twilio\Domain $domain Domain that contains the version
     * @return \Twilio\Rest\Api\V2010 V2010 version of Api
     */
    public function __construct(Domain $domain) {
        parent::__construct($domain);
        $this->version = '2010-04-01';
    }

    /**
     * @return \Twilio\Rest\Api\V2010\AccountList
     */
    protected function getAccounts() {
        if (!$this->_accounts) {
            $this->_accounts = new AccountList($this);
        }
        return $this->_accounts;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\AccountContext Account provided as the
     *                                               authenticating account
     */
    protected function getAccount() {
        if (!$this->_account) {
            $this->_account = new AccountContext(
                $this,
                $this->domain->getClient()->getAccountSid()
            );
        }
        return $this->_account;
    }

    /**
     * Setter to override the primary account
     *
     * @param AccountContext|AccountInstance $account account to use as the primary
     *                                                account
     */
    public function setAccount($account) {
        $this->_account = $account;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\AddressList
     */
    protected function getAddresses() {
        return $this->account->addresses;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\ApplicationList
     */
    protected function getApplications() {
        return $this->account->applications;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\AuthorizedConnectAppList
     */
    protected function getAuthorizedConnectApps() {
        return $this->account->authorizedConnectApps;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\AvailablePhoneNumberCountryList
     */
    protected function getAvailablePhoneNumbers() {
        return $this->account->availablePhoneNumbers;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\BalanceList
     */
    protected function getBalance() {
        return $this->account->balance;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\CallList
     */
    protected function getCalls() {
        return $this->account->calls;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\ConferenceList
     */
    protected function getConferences() {
        return $this->account->conferences;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\ConnectAppList
     */
    protected function getConnectApps() {
        return $this->account->connectApps;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\IncomingPhoneNumberList
     */
    protected function getIncomingPhoneNumbers() {
        return $this->account->incomingPhoneNumbers;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\KeyList
     */
    protected function getKeys() {
        return $this->account->keys;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\MessageList
     */
    protected function getMessages() {
        return $this->account->messages;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\NewKeyList
     */
    protected function getNewKeys() {
        return $this->account->newKeys;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\NewSigningKeyList
     */
    protected function getNewSigningKeys() {
        return $this->account->newSigningKeys;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\NotificationList
     */
    protected function getNotifications() {
        return $this->account->notifications;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\OutgoingCallerIdList
     */
    protected function getOutgoingCallerIds() {
        return $this->account->outgoingCallerIds;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\QueueList
     */
    protected function getQueues() {
        return $this->account->queues;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\RecordingList
     */
    protected function getRecordings() {
        return $this->account->recordings;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\SigningKeyList
     */
    protected function getSigningKeys() {
        return $this->account->signingKeys;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\SipList
     */
    protected function getSip() {
        return $this->account->sip;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\ShortCodeList
     */
    protected function getShortCodes() {
        return $this->account->shortCodes;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\TokenList
     */
    protected function getTokens() {
        return $this->account->tokens;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\TranscriptionList
     */
    protected function getTranscriptions() {
        return $this->account->transcriptions;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\UsageList
     */
    protected function getUsage() {
        return $this->account->usage;
    }

    /**
     * @return \Twilio\Rest\Api\V2010\Account\ValidationRequestList
     */
    protected function getValidationRequests() {
        return $this->account->validationRequests;
    }

    /**
     * Magic getter to lazy load root resources
     *
     * @param string $name Resource to return
     * @return \Twilio\ListResource The requested resource
     * @throws \Twilio\Exceptions\TwilioException For unknown resource
     */
    public function __get($name) {
        $method = 'get' . ucfirst($name);
        if (method_exists($this, $method)) {
            return $this->$method();
        }

        throw new TwilioException('Unknown resource ' . $name);
    }

    /**
     * Magic caller to get resource contexts
     *
     * @param string $name Resource to return
     * @param array $arguments Context parameters
     * @return \Twilio\InstanceContext The requested resource context
     * @throws \Twilio\Exceptions\TwilioException For unknown resource
     */
    public function __call($name, $arguments) {
        $property = $this->$name;
        if (method_exists($property, 'getContext')) {
            return call_user_func_array(array($property, 'getContext'), $arguments);
        }

        throw new TwilioException('Resource does not have a context');
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString() {
        return '[Twilio.Api.V2010]';
    }
}