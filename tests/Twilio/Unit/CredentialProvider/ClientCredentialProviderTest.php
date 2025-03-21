<?php


namespace CredentialProvider;

use Twilio\AuthStrategy\TokenAuthStrategy;
use Twilio\CredentialProvider\ClientCredentialProviderBuilder;
use Twilio\Tests\Unit\UnitTest;

class ClientCredentialProviderTest extends UnitTest {
    /*
     * @var ClientCredentialProvider
     */
    private $clientCredentialProvider;

    public function setUp(): void {
        parent::setUp();
        $this->clientCredentialProvider = (new ClientCredentialProviderBuilder())->setClientId("clientId")->setClientSecret("clientSecret")->build();
    }

    public function testAuthTypeIsClientCredentials(): void {
        $this->assertEquals('client-credentials', $this->clientCredentialProvider->getAuthType());
    }

    public function testAuthStrategyIsTokenAuthStrategy(): void {
        $this->assertInstanceOf(TokenAuthStrategy::class, $this->clientCredentialProvider->toAuthStrategy());
    }
}
