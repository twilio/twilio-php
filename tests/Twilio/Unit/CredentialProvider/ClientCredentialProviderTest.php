<?php


namespace CredentialProvider;

use Twilio\AuthStrategy\TokenAuthStrategy;
use Twilio\CredentialProvider\ClientCredentialProviderBuilder;
use Twilio\Http\BearerToken\ApiTokenManager;
use Twilio\Tests\Unit\UnitTest;

class ClientCredentialProviderTest extends UnitTest {
    /*
     * @var ClientCredentialProvider
     */
    private $clientCredentialProviderBuilder;
    private $clientCredentialProvider;

    public function setUp(): void {
        parent::setUp();
        $this->clientCredentialProviderBuilder = (new ClientCredentialProviderBuilder())->setClientId("clientId")->setClientSecret("clientSecret");
    }

    public function testAuthTypeIsClientCredentials(): void {
        $this->clientCredentialProvider = $this->clientCredentialProviderBuilder->setGrantType("client-credentials")->build();
        $this->assertEquals('client-credentials', $this->clientCredentialProvider->getAuthType());
    }

    public function testAuthStrategyIsTokenAuthStrategy(): void {
        $this->clientCredentialProvider = $this->clientCredentialProviderBuilder->setTokenManager(new ApiTokenManager())->build();
        $this->assertInstanceOf(TokenAuthStrategy::class, $this->clientCredentialProvider->toAuthStrategy());
    }
}
