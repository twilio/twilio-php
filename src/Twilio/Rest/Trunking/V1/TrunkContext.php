<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Trunking\V1;

use Twilio\Exceptions\TwilioException;
use Twilio\InstanceContext;
use Twilio\ListResource;
use Twilio\Options;
use Twilio\Rest\Trunking\V1\Trunk\CredentialListList;
use Twilio\Rest\Trunking\V1\Trunk\IpAccessControlListList;
use Twilio\Rest\Trunking\V1\Trunk\OriginationUrlList;
use Twilio\Rest\Trunking\V1\Trunk\PhoneNumberList;
use Twilio\Rest\Trunking\V1\Trunk\TerminatingSipDomainList;
use Twilio\Serialize;
use Twilio\Values;
use Twilio\Version;

/**
 * @property OriginationUrlList $originationUrls
 * @property CredentialListList $credentialsLists
 * @property IpAccessControlListList $ipAccessControlLists
 * @property PhoneNumberList $phoneNumbers
 * @property TerminatingSipDomainList $terminatingSipDomains
 * @method \Twilio\Rest\Trunking\V1\Trunk\OriginationUrlContext originationUrls(string $sid)
 * @method \Twilio\Rest\Trunking\V1\Trunk\CredentialListContext credentialsLists(string $sid)
 * @method \Twilio\Rest\Trunking\V1\Trunk\IpAccessControlListContext ipAccessControlLists(string $sid)
 * @method \Twilio\Rest\Trunking\V1\Trunk\PhoneNumberContext phoneNumbers(string $sid)
 * @method \Twilio\Rest\Trunking\V1\Trunk\TerminatingSipDomainContext terminatingSipDomains(string $sid)
 */
class TrunkContext extends InstanceContext {
    protected $_originationUrls;
    protected $_credentialsLists;
    protected $_ipAccessControlLists;
    protected $_phoneNumbers;
    protected $_terminatingSipDomains;

    /**
     * Initialize the TrunkContext
     *
     * @param Version $version Version that contains the resource
     * @param string $sid The unique string that identifies the resource
     */
    public function __construct(Version $version, $sid) {
        parent::__construct($version);

        // Path Solution
        $this->solution = ['sid' => $sid, ];

        $this->uri = '/Trunks/' . \rawurlencode($sid) . '';
    }

    /**
     * Fetch a TrunkInstance
     *
     * @return TrunkInstance Fetched TrunkInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function fetch(): TrunkInstance {
        $params = Values::of([]);

        $payload = $this->version->fetch(
            'GET',
            $this->uri,
            $params
        );

        return new TrunkInstance($this->version, $payload, $this->solution['sid']);
    }

    /**
     * Deletes the TrunkInstance
     *
     * @return bool True if delete succeeds, false otherwise
     * @throws TwilioException When an HTTP error occurs.
     */
    public function delete(): bool {
        return $this->version->delete('delete', $this->uri);
    }

    /**
     * Update the TrunkInstance
     *
     * @param array|Options $options Optional Arguments
     * @return TrunkInstance Updated TrunkInstance
     * @throws TwilioException When an HTTP error occurs.
     */
    public function update($options = []): TrunkInstance {
        $options = new Values($options);

        $data = Values::of([
            'FriendlyName' => $options['friendlyName'],
            'DomainName' => $options['domainName'],
            'DisasterRecoveryUrl' => $options['disasterRecoveryUrl'],
            'DisasterRecoveryMethod' => $options['disasterRecoveryMethod'],
            'Recording' => $options['recording'],
            'Secure' => Serialize::booleanToString($options['secure']),
            'CnamLookupEnabled' => Serialize::booleanToString($options['cnamLookupEnabled']),
        ]);

        $payload = $this->version->update(
            'POST',
            $this->uri,
            [],
            $data
        );

        return new TrunkInstance($this->version, $payload, $this->solution['sid']);
    }

    /**
     * Access the originationUrls
     */
    protected function getOriginationUrls(): OriginationUrlList {
        if (!$this->_originationUrls) {
            $this->_originationUrls = new OriginationUrlList($this->version, $this->solution['sid']);
        }

        return $this->_originationUrls;
    }

    /**
     * Access the credentialsLists
     */
    protected function getCredentialsLists(): CredentialListList {
        if (!$this->_credentialsLists) {
            $this->_credentialsLists = new CredentialListList($this->version, $this->solution['sid']);
        }

        return $this->_credentialsLists;
    }

    /**
     * Access the ipAccessControlLists
     */
    protected function getIpAccessControlLists(): IpAccessControlListList {
        if (!$this->_ipAccessControlLists) {
            $this->_ipAccessControlLists = new IpAccessControlListList($this->version, $this->solution['sid']);
        }

        return $this->_ipAccessControlLists;
    }

    /**
     * Access the phoneNumbers
     */
    protected function getPhoneNumbers(): PhoneNumberList {
        if (!$this->_phoneNumbers) {
            $this->_phoneNumbers = new PhoneNumberList($this->version, $this->solution['sid']);
        }

        return $this->_phoneNumbers;
    }

    /**
     * Access the terminatingSipDomains
     */
    protected function getTerminatingSipDomains(): TerminatingSipDomainList {
        if (!$this->_terminatingSipDomains) {
            $this->_terminatingSipDomains = new TerminatingSipDomainList(
                $this->version,
                $this->solution['sid']
            );
        }

        return $this->_terminatingSipDomains;
    }

    /**
     * Magic getter to lazy load subresources
     *
     * @param string $name Subresource to return
     * @return ListResource The requested subresource
     * @throws TwilioException For unknown subresources
     */
    public function __get($name): ListResource {
        if (\property_exists($this, '_' . $name)) {
            $method = 'get' . \ucfirst($name);
            return $this->$method();
        }

        throw new TwilioException('Unknown subresource ' . $name);
    }

    /**
     * Magic caller to get resource contexts
     *
     * @param string $name Resource to return
     * @param array $arguments Context parameters
     * @return InstanceContext The requested resource context
     * @throws TwilioException For unknown resource
     */
    public function __call($name, $arguments): InstanceContext {
        $property = $this->$name;
        if (\method_exists($property, 'getContext')) {
            return \call_user_func_array([$property, 'getContext'], $arguments);
        }

        throw new TwilioException('Resource does not have a context');
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        $context = [];
        foreach ($this->solution as $key => $value) {
            $context[] = "$key=$value";
        }
        return '[Twilio.Trunking.V1.TrunkContext ' . \implode(' ', $context) . ']';
    }
}