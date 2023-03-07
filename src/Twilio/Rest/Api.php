<?php
namespace Twilio\Rest;

use Twilio\Rest\Api\V2010;

class Api extends ApiBase {
    /**
     * @return \Twilio\Rest\Api\V2010\AccountContext Account provided as the
     *                                               authenticating account
     */
    protected function getAccount(): \Twilio\Rest\Api\V2010\AccountContext {
        return $this->v2010->account;
    }

    protected function getAccounts(): \Twilio\Rest\Api\V2010\AccountList {
        return $this->v2010->accounts;
    }

    /**
     * @param string $sid Fetch by unique Account Sid
     */
    protected function contextAccounts(string $sid): \Twilio\Rest\Api\V2010\AccountContext {
        return $this->v2010->accounts($sid);
    }

    /**
     * @deprecated Use account->addresses instead.
     */
    protected function getAddresses(): \Twilio\Rest\Api\V2010\Account\AddressList {
        echo "addresses is deprecated. Use account->addresses instead.";
        return $this->v2010->account->addresses;
    }

    /**
     * @deprecated Use account->addresses(\$sid) instead.
     * @param string $sid The unique string that identifies the resource
     */
    protected function contextAddresses(string $sid): \Twilio\Rest\Api\V2010\Account\AddressContext {
        echo "addresses(\$sid) is deprecated. Use account->addresses(\$sid) instead.";
        return $this->v2010->account->addresses($sid);
    }

    /**
     * @deprecated Use account->applications instead.
     */
    protected function getApplications(): \Twilio\Rest\Api\V2010\Account\ApplicationList {
        echo "applications is deprecated. Use account->applications instead.";
        return $this->v2010->account->applications;
    }

    /**
     * @deprecated Use account->applications(\$sid) instead.
     * @param string $sid The unique string that identifies the resource
     */
    protected function contextApplications(string $sid): \Twilio\Rest\Api\V2010\Account\ApplicationContext {
        echo "applications(\$sid) is deprecated. Use account->applications(\$sid) instead.";
        return $this->v2010->account->applications($sid);
    }

    /**
     * @deprecated Use account->authorizedConnectApps instead.
     */
    protected function getAuthorizedConnectApps(): \Twilio\Rest\Api\V2010\Account\AuthorizedConnectAppList {
        echo "authorizedConnectApps is deprecated. Use account->authorizedConnectApps instead.";
        return $this->v2010->account->authorizedConnectApps;
    }

    /**
     * @deprecated Use account->authorizedConnectApps(\$connectAppSid) instead.
     * @param string $connectAppSid The SID of the Connect App to fetch
     */
    protected function contextAuthorizedConnectApps(string $connectAppSid): \Twilio\Rest\Api\V2010\Account\AuthorizedConnectAppContext {
        echo "authorizedConnectApps(\$connectAppSid) is deprecated. Use account->authorizedConnectApps(\$connectAppSid) instead.";
        return $this->v2010->account->authorizedConnectApps($connectAppSid);
    }

    /**
     * @deprecated Use account->availablePhoneNumbers instead.
     */
    protected function getAvailablePhoneNumbers(): \Twilio\Rest\Api\V2010\Account\AvailablePhoneNumberCountryList {
        echo "availablePhoneNumbers is deprecated. Use account->availablePhoneNumbers instead.";
        return $this->v2010->account->availablePhoneNumbers;
    }

    /**
     * @deprecated Use account->availablePhoneNumbers(\$countryCode) instead.
     * @param string $countryCode The ISO country code of the country to fetch
     *                            available phone number information about
     */
    protected function contextAvailablePhoneNumbers(string $countryCode): \Twilio\Rest\Api\V2010\Account\AvailablePhoneNumberCountryContext {
        echo "availablePhoneNumbers(\$countryCode) is deprecated. Use account->availablePhoneNumbers(\$countryCode) instead.";
        return $this->v2010->account->availablePhoneNumbers($countryCode);
    }

    /**
     * @deprecated Use account->balance instead.
     */
    protected function getBalance(): \Twilio\Rest\Api\V2010\Account\BalanceList {
        echo "balance is deprecated. Use account->balance instead.";
        return $this->v2010->account->balance;
    }

    /**
     * @deprecated Use account->calls instead
     */
    protected function getCalls(): \Twilio\Rest\Api\V2010\Account\CallList {
        echo "calls is deprecated. Use account->calls instead.";
        return $this->v2010->account->calls;
    }

    /**
     * @deprecated Use account->calls(\$sid) instead.
     * @param string $sid The SID of the Call resource to fetch
     */
    protected function contextCalls(string $sid): \Twilio\Rest\Api\V2010\Account\CallContext {
        echo "calls(\$sid) is deprecated. Use account->calls(\$sid) instead.";
        return $this->v2010->account->calls($sid);
    }

    /**
     * @deprecated Use account->conferences instead.
     */
    protected function getConferences(): \Twilio\Rest\Api\V2010\Account\ConferenceList {
        echo "conferences is deprecated. Use account->conferences instead.";
        return $this->v2010->account->conferences;
    }

    /**
     * @deprecated Use account->conferences(\$sid) instead.
     * @param string $sid The unique string that identifies this resource
     */
    protected function contextConferences(string $sid): \Twilio\Rest\Api\V2010\Account\ConferenceContext {
        echo "conferences(\$sid) is deprecated. Use account->conferences(\$sid) instead.";
        return $this->v2010->account->conferences($sid);
    }

    /**
     * @deprecated Use account->connectApps instead.
     */
    protected function getConnectApps(): \Twilio\Rest\Api\V2010\Account\ConnectAppList {
        echo "connectApps is deprecated. Use account->connectApps instead.";
        return $this->v2010->account->connectApps;
    }

    /**
     * @deprecated account->connectApps(\$sid)
     * @param string $sid The unique string that identifies the resource
     */
    protected function contextConnectApps(string $sid): \Twilio\Rest\Api\V2010\Account\ConnectAppContext {
        echo "connectApps(\$sid) is deprecated. Use account->connectApps(\$sid) instead.";
        return $this->v2010->account->connectApps($sid);
    }

    /**
     * @deprecated Use account->incomingPhoneNumbers instead
     */
    protected function getIncomingPhoneNumbers(): \Twilio\Rest\Api\V2010\Account\IncomingPhoneNumberList {
        echo "incomingPhoneNumbers is deprecated. Use account->incomingPhoneNumbers instead.";
        return $this->v2010->account->incomingPhoneNumbers;
    }

    /**
     * @deprecated Use account->incomingPhoneNumbers(\$sid) instead.
     * @param string $sid The unique string that identifies the resource
     */
    protected function contextIncomingPhoneNumbers(string $sid): \Twilio\Rest\Api\V2010\Account\IncomingPhoneNumberContext {
        echo "incomingPhoneNumbers(\$sid) is deprecated. Use account->incomingPhoneNumbers(\$sid) instead.";
        return $this->v2010->account->incomingPhoneNumbers($sid);
    }

    /**
     * @deprecated Use account->keys instead.
     */
    protected function getKeys(): \Twilio\Rest\Api\V2010\Account\KeyList {
        echo "keys is deprecated. Use account->keys instead.";
        return $this->v2010->account->keys;
    }

    /**
     * @deprecated Use account->keys(\$sid) instead
     * @param string $sid The unique string that identifies the resource
     */
    protected function contextKeys(string $sid): \Twilio\Rest\Api\V2010\Account\KeyContext {
        echo "keys(\$sid) is deprecated. Use account->keys(\$sid) instead.";
        return $this->v2010->account->keys($sid);
    }

    /**
     * @deprecated Use account->messages instead.
     */
    protected function getMessages(): \Twilio\Rest\Api\V2010\Account\MessageList {
        echo "messages is deprecated. Use account->messages instead.";
        return $this->v2010->account->messages;
    }

    /**
     * @deprecated Use account->messages(\$sid) instead.
     * @param string $sid The unique string that identifies the resource
     */
    protected function contextMessages(string $sid): \Twilio\Rest\Api\V2010\Account\MessageContext {
        echo "amessages(\$sid) is deprecated. Use account->messages(\$sid) instead.";
        return $this->v2010->account->messages($sid);
    }

    /**
     * @deprecated Use account->newKeys instead.
     */
    protected function getNewKeys(): \Twilio\Rest\Api\V2010\Account\NewKeyList {
        echo "newKeys is deprecated. Use account->newKeys instead.";
        return $this->v2010->account->newKeys;
    }

    /**
     * @deprecated Use account->newSigningKeys instead.
     */
    protected function getNewSigningKeys(): \Twilio\Rest\Api\V2010\Account\NewSigningKeyList {
        echo "newSigningKeys is deprecated. Use account->newSigningKeys instead.";
        return $this->v2010->account->newSigningKeys;
    }

    /**
     * @deprecated Use account->notifications instead.
     */
    protected function getNotifications(): \Twilio\Rest\Api\V2010\Account\NotificationList {
        echo "notifications is deprecated. Use account->notifications instead.";
        return $this->v2010->account->notifications;
    }

    /**
     * @deprecated Use account->notifications(\$sid) instead.
     * @param string $sid The unique string that identifies the resource
     */
    protected function contextNotifications(string $sid): \Twilio\Rest\Api\V2010\Account\NotificationContext {
        echo "notifications(\$sid) is deprecated. Use account->notifications(\$sid) instead.";
        return $this->v2010->account->notifications($sid);
    }

    /**
     * @deprecated Use account->outgoingCallerIds instead.
     */
    protected function getOutgoingCallerIds(): \Twilio\Rest\Api\V2010\Account\OutgoingCallerIdList {
        echo "outgoingCallerIds is deprecated. Use account->outgoingCallerIds instead.";
        return $this->v2010->account->outgoingCallerIds;
    }

    /**
     * @deprecated Use account->outgoingCallerIds(\$sid) instead.
     * @param string $sid The unique string that identifies the resource
     */
    protected function contextOutgoingCallerIds(string $sid): \Twilio\Rest\Api\V2010\Account\OutgoingCallerIdContext {
        echo "outgoingCallerIds(\$sid) is deprecated. Use account->outgoingCallerIds(\$sid) instead.";
        return $this->v2010->account->outgoingCallerIds($sid);
    }

    /**
     * @deprecated Use account->queues instead.
     */
    protected function getQueues(): \Twilio\Rest\Api\V2010\Account\QueueList {
        echo "queues is deprecated. Use account->queues instead.";
        return $this->v2010->account->queues;
    }

    /**
     * @deprecated Use account->queues(\$sid) instead.
     * @param string $sid The unique string that identifies this resource
     */
    protected function contextQueues(string $sid): \Twilio\Rest\Api\V2010\Account\QueueContext {
        echo "queues(\$sid) is deprecated. Use account->queues(\$sid) instead.";
        return $this->v2010->account->queues($sid);
    }

    /**
     * @deprecated Use account->recordings instead.
     */
    protected function getRecordings(): \Twilio\Rest\Api\V2010\Account\RecordingList {
        echo "recordings is deprecated. Use account->recordings instead.";
        return $this->v2010->account->recordings;
    }

    /**
     * @deprecated Use account->recordings(\$sid) instead.
     * @param string $sid The unique string that identifies the resource
     */
    protected function contextRecordings(string $sid): \Twilio\Rest\Api\V2010\Account\RecordingContext {
        echo "recordings(\$sid) is deprecated. Use account->recordings(\$sid) instead.";
        return $this->v2010->account->recordings($sid);
    }

    /**
     * @deprecated  Use account->signingKeys instead.
     */
    protected function getSigningKeys(): \Twilio\Rest\Api\V2010\Account\SigningKeyList {
        echo "signingKeys is deprecated. Use account->signingKeys instead.";
        return $this->v2010->account->signingKeys;
    }

    /**
     * @deprecated Use account->signingKeys(\$sid) instead.
     * @param string $sid The sid
     */
    protected function contextSigningKeys(string $sid): \Twilio\Rest\Api\V2010\Account\SigningKeyContext {
        echo "signingKeys(\$sid) is deprecated. Use account->signingKeys(\$sid) instead.";
        return $this->v2010->account->signingKeys($sid);
    }

    /**
     * @deprecated Use account->sip instead.
     */
    protected function getSip(): \Twilio\Rest\Api\V2010\Account\SipList {
        echo "sip is deprecated. Use account->sip instead.";
        return $this->v2010->account->sip;
    }

    /**
     * @deprecated Use account->shortCodes instead.
     */
    protected function getShortCodes(): \Twilio\Rest\Api\V2010\Account\ShortCodeList {
        echo "shortCodes is deprecated. Use account->shortCodes instead.";
        return $this->v2010->account->shortCodes;
    }

    /**
     * @deprecated Use account->shortCodes(\$sid) instead.
     * @param string $sid The unique string that identifies this resource
     */
    protected function contextShortCodes(string $sid): \Twilio\Rest\Api\V2010\Account\ShortCodeContext {
        echo "shortCodes(\$sid) is deprecated. Use account->shortCodes(\$sid) instead.";
        return $this->v2010->account->shortCodes($sid);
    }

    /**
     * @deprecated Use account->token instead.
     */
    protected function getTokens(): \Twilio\Rest\Api\V2010\Account\TokenList {
        echo "tokens is deprecated. Use account->token instead.";
        return $this->v2010->account->tokens;
    }

    /**
     * @deprecated Use account->transcriptions instead.
     */
    protected function getTranscriptions(): \Twilio\Rest\Api\V2010\Account\TranscriptionList {
        echo "transcriptions is deprecated. Use account->transcriptions instead.";
        return $this->v2010->account->transcriptions;
    }

    /**
     * @deprecated Use account->transcriptions(\$sid) instead
     * @param string $sid The unique string that identifies the resource
     */
    protected function contextTranscriptions(string $sid): \Twilio\Rest\Api\V2010\Account\TranscriptionContext {
        echo "transcriptions(\$sid) is deprecated. Use account->transcriptions(\$sid) instead.";
        return $this->v2010->account->transcriptions($sid);
    }

    /**
     * @deprecated Use account->usage instead.
     */
    protected function getUsage(): \Twilio\Rest\Api\V2010\Account\UsageList {
        echo "usage is deprecated. Use account->usage instead.";
        return $this->v2010->account->usage;
    }

    /**
     * @deprecated Use account->validationRequests instead.
     */
    protected function getValidationRequests(): \Twilio\Rest\Api\V2010\Account\ValidationRequestList {
        echo "validationRequests is deprecated. Use account->validationRequests instead.";
        return $this->v2010->account->validationRequests;
    }
}