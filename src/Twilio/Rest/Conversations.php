<?php

namespace Twilio\Rest;

use Twilio\Rest\Conversations\V1;

class Conversations extends ConversationsBase {

    /**
     * @deprecated Use v1->configuration instead.
     */
    protected function getConfiguration(): \Twilio\Rest\Conversations\V1\ConfigurationList {
        echo "configuration is deprecated. Use v1->configuration instead.";
        return $this->v1->configuration;
    }

    /**
     * @deprecated Use v1->configuration() instead.
     */
    protected function contextConfiguration(): \Twilio\Rest\Conversations\V1\ConfigurationContext {
        echo "configuration() is deprecated. Use v1->configuration() instead.";
        return $this->v1->configuration();
    }

    /**
     * @deprecated Use v1->addressConfigurations instead.
     */
    protected function getAddressConfigurations(): \Twilio\Rest\Conversations\V1\AddressConfigurationList {
        echo "addressConfigurations is deprecated. Use v1->addressConfigurations instead.";
        return $this->v1->addressConfigurations;
    }

    /**
     * @deprecated Use v1->addressConfigurations(\$sid) instead.
     * @param string $sid The SID or Address of the Configuration.
     */
    protected function contextAddressConfigurations(string $sid): \Twilio\Rest\Conversations\V1\AddressConfigurationContext {
        echo "addressConfigurations(\$sid) is deprecated. Use v1->addressConfigurations(\$sid) instead.";
        return $this->v1->addressConfigurations($sid);
    }

    /**
     * @deprecated Use v1->conversations instead.
     */
    protected function getConversations(): \Twilio\Rest\Conversations\V1\ConversationList {
        echo "conversations is deprecated. Use v1->conversations instead.";
        return $this->v1->conversations;
    }

    /**
     * @deprecated Use v1->conversations(\$sid) instead.
     * @param string $sid A 34 character string that uniquely identifies this
     *                    resource.
     */
    protected function contextConversations(string $sid): \Twilio\Rest\Conversations\V1\ConversationContext {
        echo "conversations(\$sid) is deprecated. Use v1->conversations(\$sid) instead.";
        return $this->v1->conversations($sid);
    }

    /**
     * @deprecated Use v1->credentials instead.
     */
    protected function getCredentials(): \Twilio\Rest\Conversations\V1\CredentialList {
        echo "credentials is deprecated. Use v1->credentials instead.";
        return $this->v1->credentials;
    }

    /**
     * @deprecated Use v1->credentials(\$sid) instead.
     * @param string $sid A 34 character string that uniquely identifies this
     *                    resource.
     */
    protected function contextCredentials(string $sid): \Twilio\Rest\Conversations\V1\CredentialContext {
        echo "credentials(\$sid) is deprecated. Use v1->credentials(\$sid) instead.";
        return $this->v1->credentials($sid);
    }

    /**
     * @deprecated Use v1->participantConversations instead.
     */
    protected function getParticipantConversations(): \Twilio\Rest\Conversations\V1\ParticipantConversationList {
        echo "participantConversations is deprecated. Use v1->participantConversations instead.";
        return $this->v1->participantConversations;
    }

    /**
     * @deprecated Use v1->roles instead.
     */
    protected function getRoles(): \Twilio\Rest\Conversations\V1\RoleList {
        echo "roles is deprecated. Use v1->roles instead.";
        return $this->v1->roles;
    }

    /**
     * @deprecated Use v1->roles(\$sid) instead.
     * @param string $sid The SID of the Role resource to fetch
     */
    protected function contextRoles(string $sid): \Twilio\Rest\Conversations\V1\RoleContext {
        echo "roles(\$sid) is deprecated. Use v1->roles(\$sid) instead.";
        return $this->v1->roles($sid);
    }

    /**
     * @deprecated Use v1->services instead.
     */
    protected function getServices(): \Twilio\Rest\Conversations\V1\ServiceList {
        echo "services is deprecated. Use v1->services instead.";
        return $this->v1->services;
    }

    /**
     * @deprecated Use v1->services(\$sid) instead.
     * @param string $sid A 34 character string that uniquely identifies this
     *                    resource.
     */
    protected function contextServices(string $sid): \Twilio\Rest\Conversations\V1\ServiceContext {
        echo "services(\$sid) is deprecated. Use v1->services(\$sid) instead.";
        return $this->v1->services($sid);
    }

    /**
     * @deprecated Use v1->users instead.
     */
    protected function getUsers(): \Twilio\Rest\Conversations\V1\UserList {
        echo "users is deprecated. Use v1->users instead.";
        return $this->v1->users;
    }

    /**
     * @deprecated Use v1->users(\$sid) instead.
     * @param string $sid The SID of the User resource to fetch
     */
    protected function contextUsers(string $sid): \Twilio\Rest\Conversations\V1\UserContext {
        echo "users(\$sid) is deprecated. Use v1->users(\$sid) instead.";
        return $this->v1->users($sid);
    }
}