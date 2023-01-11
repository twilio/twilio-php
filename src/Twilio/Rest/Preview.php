<?php

namespace Twilio\Rest;


class Preview extends PreviewBase {

    /**
     * @deprecated Use deployedDevices->fleets instead.
     */
    protected function getFleets(): \Twilio\Rest\Preview\DeployedDevices\FleetList {
        echo "fleets is deprecated. Use deployedDevices->fleets instead.";
        return $this->deployedDevices->fleets;
    }

    /**
     * @deprecated Use deployedDevices->fleets(\$sid) instead.
     * @param string $sid A string that uniquely identifies the Fleet.
     */
    protected function contextFleets(string $sid): \Twilio\Rest\Preview\DeployedDevices\FleetContext {
        echo "fleets(\$sid) is deprecated. Use deployedDevices->fleets(\$sid) instead.";
        return $this->deployedDevices->fleets($sid);
    }

    /**
     * @deprecated Use hostedNumbers->authorizationDocuments instead.
     */
    protected function getAuthorizationDocuments(): \Twilio\Rest\Preview\HostedNumbers\AuthorizationDocumentList {
        echo "authorizationDocuments is deprecated. Use hostedNumbers->authorizationDocuments instead.";
        return $this->hostedNumbers->authorizationDocuments;
    }

    /**
     * @deprecated  Use hostedNumbers->authorizationDocuments(\$sid) instead.
     * @param string $sid AuthorizationDocument sid.
     */
    protected function contextAuthorizationDocuments(string $sid): \Twilio\Rest\Preview\HostedNumbers\AuthorizationDocumentContext {
        echo "authorizationDocuments(\$sid) is deprecated. Use hostedNumbers->authorizationDocuments(\$sid) instead.";
        return $this->hostedNumbers->authorizationDocuments($sid);
    }

    /**
     * @deprecated Use hostedNumbers->hostedNumberOrders instead.
     */
    protected function getHostedNumberOrders(): \Twilio\Rest\Preview\HostedNumbers\HostedNumberOrderList {
        echo "hostedNumberOrders is deprecated. Use hostedNumbers->hostedNumberOrders instead.";
        return $this->hostedNumbers->hostedNumberOrders;
    }

    /**
     * @deprecated  Use hostedNumbers->hostedNumberOrders(\$sid) instead
     * @param string $sid HostedNumberOrder sid.
     */
    protected function contextHostedNumberOrders(string $sid): \Twilio\Rest\Preview\HostedNumbers\HostedNumberOrderContext {
        echo "hostedNumberOrders(\$sid) is deprecated. Use hostedNumbers->hostedNumberOrders(\$sid) instead.";
        return $this->hostedNumbers->hostedNumberOrders($sid);
    }

    /**
     * @deprecated Use marketplace->availableAddOns instead.
     */
    protected function getAvailableAddOns(): \Twilio\Rest\Preview\Marketplace\AvailableAddOnList {
        echo "availableAddOns is deprecated. Use marketplace->availableAddOns instead.";
        return $this->marketplace->availableAddOns;
    }

    /**
     * @deprecated Use marketplace->availableAddOns(\$sid) instead.
     * @param string $sid The SID of the AvailableAddOn resource to fetch
     */
    protected function contextAvailableAddOns(string $sid): \Twilio\Rest\Preview\Marketplace\AvailableAddOnContext {
        echo "availableAddOns(\$sid) is deprecated. Use marketplace->availableAddOns(\$sid) instead.";
        return $this->marketplace->availableAddOns($sid);
    }

    /**
     * @deprecated Use marketplace->installedAddOns instead.
     */
    protected function getInstalledAddOns(): \Twilio\Rest\Preview\Marketplace\InstalledAddOnList {
        echo "installedAddOns is deprecated. Use marketplace->installedAddOns instead.";
        return $this->marketplace->installedAddOns;
    }

    /**
     * @deprecated Use marketplace->installedAddOns(\$sid) instead.
     * @param string $sid The SID of the InstalledAddOn resource to fetch
     */
    protected function contextInstalledAddOns(string $sid): \Twilio\Rest\Preview\Marketplace\InstalledAddOnContext {
        echo "installedAddOns(\$sid) is deprecated. Use marketplace->installedAddOns(\$sid) instead.";
        return $this->marketplace->installedAddOns($sid);
    }

    /**
     * @deprecated Use sync->services instead.
     */
    protected function getServices(): \Twilio\Rest\Preview\Sync\ServiceList {
        echo "services is deprecated. Use sync->services instead.";
        return $this->sync->services;
    }

    /**
     * @deprecated Use sync->services(\$sid) instead.
     * @param string $sid The sid
     */
    protected function contextServices(string $sid): \Twilio\Rest\Preview\Sync\ServiceContext {
        echo "services(\$sid) is deprecated. Use sync->services(\$sid) instead.";
        return $this->sync->services($sid);
    }

    /**
     * @deprecated Use understand->assistants instead.
     */
    protected function getAssistants(): \Twilio\Rest\Preview\Understand\AssistantList {
        echo "assistants is deprecated. Use understand->assistants instead.";
        return $this->understand->assistants;
    }

    /**
     * @deprecated Use understand->assistants(\$sid) instead.
     * @param string $sid A 34 character string that uniquely identifies this
     *                    resource.
     */
    protected function contextAssistants(string $sid): \Twilio\Rest\Preview\Understand\AssistantContext {
        echo "assistants(\$sid) is deprecated. Use understand->assistants(\$sid) instead.";
        return $this->understand->assistants($sid);
    }

    /**
     * @deprecated Use wireless->commands instead.
     */
    protected function getCommands(): \Twilio\Rest\Preview\Wireless\CommandList {
        echo "commands is deprecated. Use wireless->commands instead.";
        return $this->wireless->commands;
    }

    /**
     * @deprecated Use wireless->commands(\$sid) instead.
     * @param string $sid The sid
     */
    protected function contextCommands(string $sid): \Twilio\Rest\Preview\Wireless\CommandContext {
        echo "commands(\$sid) is deprecated. Use wireless->commands(\$sid) instead.";
        return $this->wireless->commands($sid);
    }

    /**
     * @deprecated Use wireless->ratePlans instead.
     */
    protected function getRatePlans(): \Twilio\Rest\Preview\Wireless\RatePlanList {
        echo "ratePlans is deprecated. Use wireless->ratePlans instead.";
        return $this->wireless->ratePlans;
    }

    /**
     * @deprecated Use wireless->ratePlans(\$sid) instead.
     * @param string $sid The sid
     */
    protected function contextRatePlans(string $sid): \Twilio\Rest\Preview\Wireless\RatePlanContext {
        echo "ratePlans(\$sid) is deprecated. Use wireless->ratePlans(\$sid) instead.";
        return $this->wireless->ratePlans($sid);
    }

    /**
     * @deprecated Use wireless->sims instead.
     */
    protected function getSims(): \Twilio\Rest\Preview\Wireless\SimList {
        echo "sims is deprecated. Use wireless->sims instead.";
        return $this->wireless->sims;
    }

    /**
     * @deprecated Use wireless->sims(\$sid) instead.
     * @param string $sid The sid
     */
    protected function contextSims(string $sid): \Twilio\Rest\Preview\Wireless\SimContext {
        echo "sims(\$sid) is deprecated. Use wireless->sims(\$sid) instead.";
        return $this->wireless->sims($sid);
    }
}