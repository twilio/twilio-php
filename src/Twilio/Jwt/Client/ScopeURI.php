<?php


namespace Twilio\Jwt\Client;


/**
 * Scope URI implementation
 *
 * Simple way to represent configurable privileges in an OAuth
 * friendly way. For our case, they look like this:
 *
 * scope:<service>:<privilege>?<params>
 *
 * For example:
 * scope:client:incoming?name=jonas
 */
class ScopeURI {
    public $service;
    public $privilege;
    public $params;

    public function __construct($service, $privilege, $params = array()) {
        $this->service = $service;
        $this->privilege = $privilege;
        $this->params = $params;
    }

    public function toString() {
        $uri = "scope:{$this->service}:{$this->privilege}";
        if (\count($this->params)) {
            $uri .= "?" . \http_build_query($this->params, '', '&');
        }
        return $uri;
    }

    /**
     * Parse a scope URI into a ScopeURI object
     *
     * @param string $uri The scope URI
     * @return ScopeURI The parsed scope uri
     * @throws \UnexpectedValueException
     */
    public static function parse($uri) {
        if (\strpos($uri, 'scope:') !== 0) {
            throw new \UnexpectedValueException(
                'Not a scope URI according to scheme');
        }

        $parts = \explode('?', $uri, 1);
        $params = null;

        if (\count($parts) > 1) {
            \parse_str($parts[1], $params);
        }

        $parts = \explode(':', $parts[0], 2);

        if (\count($parts) != 3) {
            throw new \UnexpectedValueException(
                'Not enough parts for scope URI');
        }

        list($scheme, $service, $privilege) = $parts;
        return new ScopeURI($service, $privilege, $params);
    }
}