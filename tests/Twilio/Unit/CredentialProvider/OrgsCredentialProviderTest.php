<?php


namespace CredentialProvider;

use Twilio\AuthStrategy\TokenAuthStrategy;
use Twilio\CredentialProvider\OrgsCredentialProviderBuilder;
use Twilio\Http\BearerToken\OrgsTokenManager;
use Twilio\Tests\Unit\UnitTest;

class OrgsCredentialProviderTest extends UnitTest {
    /*
     * @var orgsCredentialProvider
     */
    private $orgsCredentialProviderBuilder;
    private $orgsCredentialProvider;

    public function setUp(): void {
        parent::setUp();
        $this->orgsCredentialProviderBuilder = (new OrgsCredentialProviderBuilder())->setClientId("clientId")->setClientSecret("clientSecret");
    }

    public function testAuthTypeIsClientCredentials(): void {
        $this->orgsCredentialProvider = $this->orgsCredentialProviderBuilder->setGrantType("client-credentials")->build();
        $this->assertEquals('client-credentials', $this->orgsCredentialProvider->getAuthType());
        $this->assertEquals('client-credentials', $this->orgsCredentialProvider->grantType);
    }

    public function testSetTokenManager(): void {
        $tokenManager = new OrgsTokenManager();
        $this->orgsCredentialProvider = $this->orgsCredentialProviderBuilder->setTokenManager($tokenManager)->build();
        $this->assertEquals($tokenManager, $this->orgsCredentialProvider->getTokenManager());
    }

    public function testInvalidGetter(): void {
        $this->orgsCredentialProvider = $this->orgsCredentialProviderBuilder->build();
        $this->expectExceptionMessage('Unknown property invalid');
        $this->orgsCredentialProvider->invalid;
    }

    public function testInvalidSetter(): void {
        $this->orgsCredentialProvider = $this->orgsCredentialProviderBuilder->build();
        $this->expectExceptionMessage('Unknown property invalid');
        $this->orgsCredentialProvider->invalid = 'invalid';
    }

    public function testAuthStrategyIsTokenAuthStrategy(): void {
        $this->orgsCredentialProvider = $this->orgsCredentialProviderBuilder->build();
        $this->assertInstanceOf(TokenAuthStrategy::class, $this->orgsCredentialProvider->toAuthStrategy());
    }
}
