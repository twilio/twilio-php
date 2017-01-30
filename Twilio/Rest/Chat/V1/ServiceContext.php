<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Chat\V1;

use Twilio\Exceptions\TwilioException;
use Twilio\InstanceContext;
use Twilio\Options;
use Twilio\Rest\Chat\V1\Service\ChannelList;
use Twilio\Rest\Chat\V1\Service\RoleList;
use Twilio\Rest\Chat\V1\Service\UserList;
use Twilio\Values;
use Twilio\Version;

/**
 * @property \Twilio\Rest\Chat\V1\Service\ChannelList channels
 * @property \Twilio\Rest\Chat\V1\Service\RoleList roles
 * @property \Twilio\Rest\Chat\V1\Service\UserList users
 * @method \Twilio\Rest\Chat\V1\Service\ChannelContext channels(string $sid)
 * @method \Twilio\Rest\Chat\V1\Service\RoleContext roles(string $sid)
 * @method \Twilio\Rest\Chat\V1\Service\UserContext users(string $sid)
 */
class ServiceContext extends InstanceContext {
    protected $_channels = null;
    protected $_roles = null;
    protected $_users = null;

    /**
     * Initialize the ServiceContext
     * 
     * @param \Twilio\Version $version Version that contains the resource
     * @param string $sid The sid
     * @return \Twilio\Rest\Chat\V1\ServiceContext 
     */
    public function __construct(Version $version, $sid) {
        parent::__construct($version);
        
        // Path Solution
        $this->solution = array(
            'sid' => $sid,
        );
        
        $this->uri = '/Services/' . rawurlencode($sid) . '';
    }

    /**
     * Fetch a ServiceInstance
     * 
     * @return ServiceInstance Fetched ServiceInstance
     */
    public function fetch() {
        $params = Values::of(array());
        
        $payload = $this->version->fetch(
            'GET',
            $this->uri,
            $params
        );
        
        return new ServiceInstance(
            $this->version,
            $payload,
            $this->solution['sid']
        );
    }

    /**
     * Deletes the ServiceInstance
     * 
     * @return boolean True if delete succeeds, false otherwise
     */
    public function delete() {
        return $this->version->delete('delete', $this->uri);
    }

    /**
     * Update the ServiceInstance
     * 
     * @param array|Options $options Optional Arguments
     * @return ServiceInstance Updated ServiceInstance
     */
    public function update($options = array()) {
        $options = new Values($options);
        
        $data = Values::of(array(
            'FriendlyName' => $options['friendlyName'],
            'DefaultServiceRoleSid' => $options['defaultServiceRoleSid'],
            'DefaultChannelRoleSid' => $options['defaultChannelRoleSid'],
            'DefaultChannelCreatorRoleSid' => $options['defaultChannelCreatorRoleSid'],
            'ReadStatusEnabled' => $options['readStatusEnabled'],
            'ReachabilityEnabled' => $options['reachabilityEnabled'],
            'TypingIndicatorTimeout' => $options['typingIndicatorTimeout'],
            'ConsumptionReportInterval' => $options['consumptionReportInterval'],
            'Notifications.NewMessage.Enabled' => $options['notifications.NewMessage.Enabled'],
            'Notifications.NewMessage.Template' => $options['notifications.NewMessage.Template'],
            'Notifications.AddedToChannel.Enabled' => $options['notifications.AddedToChannel.Enabled'],
            'Notifications.AddedToChannel.Template' => $options['notifications.AddedToChannel.Template'],
            'Notifications.RemovedFromChannel.Enabled' => $options['notifications.RemovedFromChannel.Enabled'],
            'Notifications.RemovedFromChannel.Template' => $options['notifications.RemovedFromChannel.Template'],
            'Notifications.InvitedToChannel.Enabled' => $options['notifications.InvitedToChannel.Enabled'],
            'Notifications.InvitedToChannel.Template' => $options['notifications.InvitedToChannel.Template'],
            'PreWebhookUrl' => $options['preWebhookUrl'],
            'PostWebhookUrl' => $options['postWebhookUrl'],
            'WebhookMethod' => $options['webhookMethod'],
            'WebhookFilters' => $options['webhookFilters'],
            'Webhooks.OnMessageSend.Url' => $options['webhooks.OnMessageSend.Url'],
            'Webhooks.OnMessageSend.Method' => $options['webhooks.OnMessageSend.Method'],
            'Webhooks.OnMessageSend.Format' => $options['webhooks.OnMessageSend.Format'],
            'Webhooks.OnMessageUpdate.Url' => $options['webhooks.OnMessageUpdate.Url'],
            'Webhooks.OnMessageUpdate.Method' => $options['webhooks.OnMessageUpdate.Method'],
            'Webhooks.OnMessageUpdate.Format' => $options['webhooks.OnMessageUpdate.Format'],
            'Webhooks.OnMessageRemove.Url' => $options['webhooks.OnMessageRemove.Url'],
            'Webhooks.OnMessageRemove.Method' => $options['webhooks.OnMessageRemove.Method'],
            'Webhooks.OnMessageRemove.Format' => $options['webhooks.OnMessageRemove.Format'],
            'Webhooks.OnChannelAdd.Url' => $options['webhooks.OnChannelAdd.Url'],
            'Webhooks.OnChannelAdd.Method' => $options['webhooks.OnChannelAdd.Method'],
            'Webhooks.OnChannelAdd.Format' => $options['webhooks.OnChannelAdd.Format'],
            'Webhooks.OnChannelDestroy.Url' => $options['webhooks.OnChannelDestroy.Url'],
            'Webhooks.OnChannelDestroy.Method' => $options['webhooks.OnChannelDestroy.Method'],
            'Webhooks.OnChannelDestroy.Format' => $options['webhooks.OnChannelDestroy.Format'],
            'Webhooks.OnChannelUpdate.Url' => $options['webhooks.OnChannelUpdate.Url'],
            'Webhooks.OnChannelUpdate.Method' => $options['webhooks.OnChannelUpdate.Method'],
            'Webhooks.OnChannelUpdate.Format' => $options['webhooks.OnChannelUpdate.Format'],
            'Webhooks.OnMemberAdd.Url' => $options['webhooks.OnMemberAdd.Url'],
            'Webhooks.OnMemberAdd.Method' => $options['webhooks.OnMemberAdd.Method'],
            'Webhooks.OnMemberAdd.Format' => $options['webhooks.OnMemberAdd.Format'],
            'Webhooks.OnMemberRemove.Url' => $options['webhooks.OnMemberRemove.Url'],
            'Webhooks.OnMemberRemove.Method' => $options['webhooks.OnMemberRemove.Method'],
            'Webhooks.OnMemberRemove.Format' => $options['webhooks.OnMemberRemove.Format'],
            'Webhooks.OnMessageSent.Url' => $options['webhooks.OnMessageSent.Url'],
            'Webhooks.OnMessageSent.Method' => $options['webhooks.OnMessageSent.Method'],
            'Webhooks.OnMessageSent.Format' => $options['webhooks.OnMessageSent.Format'],
            'Webhooks.OnMessageUpdated.Url' => $options['webhooks.OnMessageUpdated.Url'],
            'Webhooks.OnMessageUpdated.Method' => $options['webhooks.OnMessageUpdated.Method'],
            'Webhooks.OnMessageUpdated.Format' => $options['webhooks.OnMessageUpdated.Format'],
            'Webhooks.OnMessageRemoved.Url' => $options['webhooks.OnMessageRemoved.Url'],
            'Webhooks.OnMessageRemoved.Method' => $options['webhooks.OnMessageRemoved.Method'],
            'Webhooks.OnMessageRemoved.Format' => $options['webhooks.OnMessageRemoved.Format'],
            'Webhooks.OnChannelAdded.Url' => $options['webhooks.OnChannelAdded.Url'],
            'Webhooks.OnChannelAdded.Method' => $options['webhooks.OnChannelAdded.Method'],
            'Webhooks.OnChannelAdded.Format' => $options['webhooks.OnChannelAdded.Format'],
            'Webhooks.OnChannelDestroyed.Url' => $options['webhooks.OnChannelDestroyed.Url'],
            'Webhooks.OnChannelDestroyed.Method' => $options['webhooks.OnChannelDestroyed.Method'],
            'Webhooks.OnChannelDestroyed.Format' => $options['webhooks.OnChannelDestroyed.Format'],
            'Webhooks.OnChannelUpdated.Url' => $options['webhooks.OnChannelUpdated.Url'],
            'Webhooks.OnChannelUpdated.Method' => $options['webhooks.OnChannelUpdated.Method'],
            'Webhooks.OnChannelUpdated.Format' => $options['webhooks.OnChannelUpdated.Format'],
            'Webhooks.OnMemberAdded.Url' => $options['webhooks.OnMemberAdded.Url'],
            'Webhooks.OnMemberAdded.Method' => $options['webhooks.OnMemberAdded.Method'],
            'Webhooks.OnMemberAdded.Format' => $options['webhooks.OnMemberAdded.Format'],
            'Webhooks.OnMemberRemoved.Url' => $options['webhooks.OnMemberRemoved.Url'],
            'Webhooks.OnMemberRemoved.Method' => $options['webhooks.OnMemberRemoved.Method'],
            'Webhooks.OnMemberRemoved.Format' => $options['webhooks.OnMemberRemoved.Format'],
        ));
        
        $payload = $this->version->update(
            'POST',
            $this->uri,
            array(),
            $data
        );
        
        return new ServiceInstance(
            $this->version,
            $payload,
            $this->solution['sid']
        );
    }

    /**
     * Access the channels
     * 
     * @return \Twilio\Rest\Chat\V1\Service\ChannelList 
     */
    protected function getChannels() {
        if (!$this->_channels) {
            $this->_channels = new ChannelList(
                $this->version,
                $this->solution['sid']
            );
        }
        
        return $this->_channels;
    }

    /**
     * Access the roles
     * 
     * @return \Twilio\Rest\Chat\V1\Service\RoleList 
     */
    protected function getRoles() {
        if (!$this->_roles) {
            $this->_roles = new RoleList(
                $this->version,
                $this->solution['sid']
            );
        }
        
        return $this->_roles;
    }

    /**
     * Access the users
     * 
     * @return \Twilio\Rest\Chat\V1\Service\UserList 
     */
    protected function getUsers() {
        if (!$this->_users) {
            $this->_users = new UserList(
                $this->version,
                $this->solution['sid']
            );
        }
        
        return $this->_users;
    }

    /**
     * Magic getter to lazy load subresources
     * 
     * @param string $name Subresource to return
     * @return \Twilio\ListResource The requested subresource
     * @throws \Twilio\Exceptions\TwilioException For unknown subresources
     */
    public function __get($name) {
        if (property_exists($this, '_' . $name)) {
            $method = 'get' . ucfirst($name);
            return $this->$method();
        }
        
        throw new TwilioException('Unknown subresource ' . $name);
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
        $context = array();
        foreach ($this->solution as $key => $value) {
            $context[] = "$key=$value";
        }
        return '[Twilio.Chat.V1.ServiceContext ' . implode(' ', $context) . ']';
    }
}