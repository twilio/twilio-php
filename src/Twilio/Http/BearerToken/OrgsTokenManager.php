<?php
namespace Twilio\Http\BearerToken;
use Twilio\CredentialProvider\NoAuthCredentialProvider;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;
use Twilio\Rest\Iam\V1;
use Twilio\Rest\Iam\V1\TokenList;
use Twilio\Rest\IamBase;


/**
 * Class OrgsTokenManager
 * Token manager class for public OAuth
 * @property string $token The bearer token
 * @property string $tokenManager The manager for the bearer token
 */

class OrgsTokenManager extends TokenManager {
    private $options;

    public function __construct(array $options = []) {
        $this->options = $options;
    }

    public function getOptions(): array {
        return $this->options;
    }

    /**
     * Fetches the bearer token
     * @throws TwilioException
     */
    public function fetchToken(?Client $client = null): string {
        if ($client === null) {
            $client = new Client();
        }
        $noAuthCredentialProvider = new NoAuthCredentialProvider();
        $client->setCredentialProvider($noAuthCredentialProvider);
        $base = new IamBase($client);
        $v1 = new V1($base);
        $tokenList = new TokenList($v1);

        try {
            return $tokenList->create(
                $this->options['grantType'],
                $this->options['clientId'],
                $this->options
            )->accessToken;
        }

        catch (TwilioException $e) {
            throw new TwilioException($e->getMessage());
        }
    }
}
