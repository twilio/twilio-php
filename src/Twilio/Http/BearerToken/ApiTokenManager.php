<?php
namespace Twilio\Http\BearerToken;
use Twilio\CredentialProvider\NoAuthCredentialProvider;
use Twilio\Exceptions\TwilioException;
use Twilio\Rest\Client;
use Twilio\Rest\PreviewIam\V1;
use Twilio\Rest\PreviewIam\V1\TokenList;
use Twilio\Rest\PreviewIamBase;


/**
 * Class ApiTokenManager
 * Token manager class for public OAuth
 * @property string $token The bearer token
 * @property string $tokenManager The manager for the bearer token
 */

class ApiTokenManager extends TokenManager {
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
    public function fetchToken(): string {
        $noAuthCredentialProvider = new NoAuthCredentialProvider();
        $client = new Client();
        $client->setCredentialProvider($noAuthCredentialProvider);
        $previewIamBase = new PreviewIamBase($client);
        $v1 = new V1($previewIamBase);
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
