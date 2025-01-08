<?php
namespace Twilio\Base;

use Twilio\Exceptions\ConfigurationException;
use Twilio\Exceptions\TwilioException;
use Twilio\Http\Client as HttpClient;
use Twilio\Http\CurlClient;
use Twilio\Rest\Api;
use Twilio\Security\RequestValidator;
use Twilio\VersionInfo;

/**
 * @property \Twilio\Rest\Api\V2010\AccountInstance $account
 * @property Api $api
 */
class BaseClient
{
    const ENV_ACCOUNT_SID = 'TWILIO_ACCOUNT_SID';
    const ENV_AUTH_TOKEN = 'TWILIO_AUTH_TOKEN';
    const ENV_REGION = 'TWILIO_REGION';
    const ENV_EDGE = 'TWILIO_EDGE';
    const DEFAULT_REGION = 'us1';
    const ENV_LOG = 'TWILIO_LOG_LEVEL';

    protected $username;
    protected $password;
    protected $accountSid;
    protected $region;
    protected $edge;
    protected $httpClient;
    protected $environment;
    protected $userAgentExtensions;
    protected $logLevel;
    protected $_account;

    /**
     * Initializes the Twilio Client
     *
     * @param string $username Username to authenticate with
     * @param string $password Password to authenticate with
     * @param string $accountSid Account SID to authenticate with, defaults to
     *                           $username
     * @param string $region Region to send requests to, defaults to 'us1' if Edge
     *                       provided
     * @param HttpClient $httpClient HttpClient, defaults to CurlClient
     * @param mixed[] $environment Environment to look for auth details, defaults
     *                             to $_ENV
     * @param string[] $userAgentExtensions Additions to the user agent string
     * @throws ConfigurationException If valid authentication is not present
     */
    public function __construct(
        string $username = null,
        string $password = null,
        string $accountSid = null,
        string $region = null,
        HttpClient $httpClient = null,
        array $environment = null,
        array $userAgentExtensions = null
    ) {
        $this->environment = $environment ?: \getenv();

        $this->username = $this->getArg($username, self::ENV_ACCOUNT_SID);
        $this->password = $this->getArg($password, self::ENV_AUTH_TOKEN);
        $this->region = $this->getArg($region, self::ENV_REGION);
        $this->edge = $this->getArg(null, self::ENV_EDGE);
        $this->logLevel = $this->getArg(null, self::ENV_LOG);
        $this->userAgentExtensions = $userAgentExtensions ?: [];

        if (!$this->username || !$this->password) {
            throw new ConfigurationException('Credentials are required to create a Client');
        }

        $this->accountSid = $accountSid ?: $this->username;

        if ($httpClient) {
            $this->httpClient = $httpClient;
        } else {
            $this->httpClient = new CurlClient();
        }
    }

    /**
     * Determines argument value accounting for environment variables.
     *
     * @param string $arg The constructor argument
     * @param string $envVar The environment variable name
     * @return ?string Argument value
     */
    public function getArg(?string $arg, string $envVar): ?string
    {
        if ($arg) {
            return $arg;
        }

        if (\array_key_exists($envVar, $this->environment)) {
            return $this->environment[$envVar];
        }

        return null;
    }

    /**
     * Makes a request to the Twilio API using the configured http client
     * Authentication information is automatically added if none is provided
     *
     * @param string $method HTTP Method
     * @param string $uri Fully qualified url
     * @param string[] $params Query string parameters
     * @param string[] $data POST body data
     * @param string[] $headers HTTP Headers
     * @param string $username User for Authentication
     * @param string $password Password for Authentication
     * @param int $timeout Timeout in seconds
     * @return \Twilio\Http\Response Response from the Twilio API
     */
    public function request(
        string $method,
        string $uri,
        array $params = [],
        array $data = [],
        array $headers = [],
        string $username = null,
        string $password = null,
        int $timeout = null
    ): \Twilio\Http\Response{
        $username = $username ?: $this->username;
        $password = $password ?: $this->password;
        $logLevel = (getenv('DEBUG_HTTP_TRAFFIC') === 'true' ? 'debug' : $this->getLogLevel());

        $headers['User-Agent'] = 'twilio-php/' . VersionInfo::string() .
            ' (' . php_uname("s") . ' ' . php_uname("m") . ')' .
            ' PHP/' . PHP_VERSION;
        $headers['Accept-Charset'] = 'utf-8';

        if ($this->userAgentExtensions) {
            $headers['User-Agent'] .= ' ' . implode(' ', $this->userAgentExtensions);
        }

        if (!\array_key_exists('Accept', $headers)) {
            $headers['Accept'] = 'application/json';
        }

        $uri = $this->buildUri($uri);

        if ($logLevel === 'debug') {
            error_log('-- BEGIN Twilio API Request --');
            error_log('Request Method: ' . $method);
            $u = parse_url($uri);
            if (isset($u['path'])) {
                error_log('Request URL: ' . $u['path']);
            }
            if (isset($u['query']) && strlen($u['query']) > 0) {
                error_log('Query Params: ' . $u['query']);
            }
            error_log('Request Headers: ');
            foreach ($headers as $key => $value) {
                if (strpos(strtolower($key), 'authorization') === false) {
                    error_log("$key: $value");
                }
            }
            error_log('-- END Twilio API Request --');
        }

        $response = $this->getHttpClient()->request(
            $method,
            $uri,
            $params,
            $data,
            $headers,
            $username,
            $password,
            $timeout
        );

        if ($logLevel === 'debug') {
            error_log('Status Code: ' . $response->getStatusCode());
            error_log('Response Headers:');
            $responseHeaders = $response->getHeaders();
            foreach ($responseHeaders as $key => $value) {
                error_log("$key: $value");
            }
        }

        return $response;
    }

    /**
     * Build the final request uri
     *
     * @param string $uri The original request uri
     * @return string Request uri
     */
    public function buildUri(string $uri): string
    {
        if ($this->region == null && $this->edge == null) {
            return $uri;
        }

        $parsedUrl = \parse_url($uri);
        $pieces = \explode('.', $parsedUrl['host']);
        $product = $pieces[0];
        $domain = \implode('.', \array_slice($pieces, -2));
        $newEdge = $this->edge;
        $newRegion = $this->region;
        if (count($pieces) == 4) { // product.region.twilio.com
            $newRegion = $newRegion ?: $pieces[1];
        } elseif (count($pieces) == 5) { // product.edge.region.twilio.com
            $newEdge = $newEdge ?: $pieces[1];
            $newRegion = $newRegion ?: $pieces[2];
        }

        if ($newEdge != null && $newRegion == null) {
            $newRegion = self::DEFAULT_REGION;
        }

        $parsedUrl['host'] = \implode('.', \array_filter([$product, $newEdge, $newRegion, $domain]));
        return RequestValidator::unparse_url($parsedUrl);
    }

    /**
     * Magic getter to lazy load domains
     *
     * @param string $name Domain to return
     * @return \Twilio\Domain The requested domain
     * @throws TwilioException For unknown domains
     */
    public function __get(string $name)
    {
        $method = 'get' . \ucfirst($name);
        if (\method_exists($this, $method)) {
            return $this->$method();
        }

        throw new TwilioException('Unknown domain ' . $name);
    }

    /**
     * Magic call to lazy load contexts
     *
     * @param string $name Context to return
     * @param mixed[] $arguments Context to return
     * @return \Twilio\InstanceContext The requested context
     * @throws TwilioException For unknown contexts
     */
    public function __call(string $name, array $arguments)
    {
        $method = 'context' . \ucfirst($name);
        if (\method_exists($this, $method)) {
            return \call_user_func_array([$this, $method], $arguments);
        }

        throw new TwilioException('Unknown context ' . $name);
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string
    {
        return '[Client ' . $this->getAccountSid() . ']';
    }

    /**
     * Validates connection to new SSL certificate endpoint
     *
     * @param CurlClient $client
     * @throws TwilioException if request fails
     */
    public function validateSslCertificate(CurlClient $client): void
    {
        $response = $client->request('GET', 'https://tls-test.twilio.com:443');

        if ($response->getStatusCode() < 200 || $response->getStatusCode() > 300) {
            throw new TwilioException('Failed to validate SSL certificate');
        }
    }

    /**
     * @return \Twilio\Rest\Api\V2010\AccountContext Account provided as the
     *                                               authenticating account
     */
    public function getAccount(): \Twilio\Rest\Api\V2010\AccountContext
    {
        return $this->api->v2010->account;
    }

    /**
     * Retrieve the Username
     *
     * @return string Current Username
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * Retrieve the Password
     *
     * @return string Current Password
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Retrieve the AccountSid
     *
     * @return string Current AccountSid
     */
    public function getAccountSid(): string
    {
        return $this->accountSid;
    }

    /**
     * Retrieve the Region
     *
     * @return string Current Region
     */
    public function getRegion(): string
    {
        return $this->region;
    }

    /**
     * Retrieve the Edge
     *
     * @return string Current Edge
     */
    public function getEdge(): string
    {
        return $this->edge;
    }

    /**
     * Set Edge
     *
     * @param string $uri Edge to use, unsets the Edge when called with no arguments
     */
    public function setEdge(string $edge = null): void
    {
        $this->edge = $this->getArg($edge, self::ENV_EDGE);
    }

    /**
     * Retrieve the HttpClient
     *
     * @return HttpClient Current HttpClient
     */
    public function getHttpClient(): HttpClient
    {
        return $this->httpClient;
    }

    /**
     * Set the HttpClient
     *
     * @param HttpClient $httpClient HttpClient to use
     */
    public function setHttpClient(HttpClient $httpClient): void
    {
        $this->httpClient = $httpClient;
    }

    /**
     * Retrieve the log level
     *
     * @return ?string Current log level
     */
    public function getLogLevel(): ?string
    {
        return $this->logLevel;
    }

    /**
     * Set log level to debug
     *
     * @param string $logLevel log level to use
     */
    public function setLogLevel(string $logLevel = null): void
    {
        $this->logLevel = $this->getArg($logLevel, self::ENV_LOG);
    }
}
