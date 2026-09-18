<?php
namespace Twilio\Http\BearerToken;
use Twilio\CredentialProvider\NoAuthCredentialProvider;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;
use Twilio\Rest\Oauth\V2;
use Twilio\Rest\Oauth\V2\TokenList;
use Twilio\Rest\OauthBase;


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
        $base = new OauthBase($client);
        $v2 = new V2($base);
        $tokenList = new TokenList($v2);

        try {
            return $tokenList->create(
                $this->options
            )->accessToken;
        }

        catch (TwilioException $e) {
            throw new TwilioException($e->getMessage());
        }
    }
}
