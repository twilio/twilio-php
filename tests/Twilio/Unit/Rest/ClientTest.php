<?php


namespace Twilio\Tests\Unit\Rest;

use Twilio\Exceptions\ConfigurationException;
use Twilio\Exceptions\TwilioException;
use Twilio\Http\CurlClient;
use Twilio\Http\Response;
use Twilio\Rest\Client;
use Twilio\Tests\Holodeck;
use Twilio\Tests\Request;
use Twilio\Tests\Unit\UnitTest;

class ClientTest extends UnitTest {

    public function testThrowsWhenUsernameAndPasswordMissing(): void {
        $this->expectException(ConfigurationException::class);
        new Client(null, null, null, null, null, []);
    }

    public function testThrowsWhenUsernameMissing(): void {
        $this->expectException(ConfigurationException::class);
        new Client(null, 'password', null, null, null, []);
    }

    public function testThrowsWhenPasswordMissing(): void {
        $this->expectException(ConfigurationException::class);
        new Client('username', null, null, null, null, []);
    }

    public function testUsernamePulledFromEnvironment(): void {
        $client = new Client(null, 'password', null, null, null, [
            Client::ENV_ACCOUNT_SID => 'username',
        ]);

        $this->assertEquals('username', $client->getUsername());
    }

    public function testPasswordPulledFromEnvironment(): void {
        $client = new Client('username', null, null, null, null, [
            Client::ENV_AUTH_TOKEN => 'password',
        ]);

        $this->assertEquals('password', $client->getPassword());
    }

    public function testUsernameAndPasswordPulledFromEnvironment(): void {
        $client = new Client(null, null, null, null, null, [
            Client::ENV_ACCOUNT_SID => 'username',
            Client::ENV_AUTH_TOKEN => 'password',
        ]);

        $this->assertEquals('username', $client->getUsername());
        $this->assertEquals('password', $client->getPassword());
    }

    public function testUsernameParameterPreferredOverEnvironment(): void {
        $client = new Client('username', 'password', null, null, null, [
            Client::ENV_ACCOUNT_SID => 'environmentUsername',
        ]);

        $this->assertEquals('username', $client->getUsername());
    }

    public function testPasswordParameterPreferredOverEnvironment(): void {
        $client = new Client('username', 'password', null, null, null, [
            Client::ENV_AUTH_TOKEN => 'environmentPassword',
        ]);

        $this->assertEquals('password', $client->getPassword());
    }

    public function testUsernameAndPasswordParametersPreferredOverEnvironment(): void {
        $client = new Client('username', 'password', null, null, null, [
            Client::ENV_ACCOUNT_SID => 'environmentUsername',
            Client::ENV_AUTH_TOKEN => 'environmentPassword',
        ]);

        $this->assertEquals('username', $client->getUsername());
        $this->assertEquals('password', $client->getPassword());
    }

    public function testAccountSidDefaultsToUsername(): void {
        $client = new Client('username', 'password');
        $this->assertEquals('username', $client->getAccountSid());
    }

    public function testAccountSidPreferredOverUsername(): void {
        $client = new Client('username', 'password', 'accountSid');
        $this->assertEquals('accountSid', $client->getAccountSid());
    }

    public function testRegionDefaultsToEmpty(): void {
        $network = new Holodeck();
        $client = new Client('username', 'password', null, null, $network);
        $client->request('POST', 'https://test.twilio.com/v1/Resources');
        $expected = new Request('POST', 'https://test.twilio.com/v1/Resources');
        $this->assertTrue($network->hasRequest($expected));
    }

    public function testRegionInjectedWhenSet(): void {
        $network = new Holodeck();
        $client = new Client('username', 'password', null, 'ie1', $network);
        $client->request('POST', 'https://test.twilio.com/v1/Resources');
        $expected = new Request('POST', 'https://test.ie1.twilio.com/v1/Resources');
        $this->assertTrue($network->hasRequest($expected));
    }

    public function testValidationSslCertificateSuccess(): void {
        $client = new Client('username', 'password');
        $curlClient = $this->createMock(CurlClient::class);
        $curlClient
            ->expects($this->once())
            ->method('request')
            ->willReturn(new Response(200, ''));

        $client->validateSslCertificate($curlClient);
    }

    public function testValidationSslCertificateError(): void {
        $this->expectException(TwilioException::class);
        $client = new Client('username', 'password');
        $curlClient = $this->createMock(CurlClient::class);
        $curlClient
            ->expects($this->once())
            ->method('request')
            ->willReturn(new Response(504, ''));

        $client->validateSslCertificate($curlClient);
    }

    protected static function callProtectedMethod(Client $obj, string $name, string $uri) {
        $class = new \ReflectionClass($obj);
        $method = $class->getMethod($name);
        $method->setAccessible(true);
        return $method->invokeArgs($obj, [$uri]);
    }

    public function testNoRegionOrEdgeInUrl(): void {
        $client = new Client('username', 'password');

        $this->assertEquals('https://api.twilio.com',
            self::callProtectedMethod($client, 'buildUri', 'https://api.twilio.com'));

        $client->setEdge('edge');
        $this->assertEquals('https://api.edge.us1.twilio.com',
            self::callProtectedMethod($client, 'buildUri', 'https://api.twilio.com'));

        $client = new Client('username', 'password', null, 'region');
        $client->setEdge('edge');
        $this->assertEquals('https://api.edge.region.twilio.com',
            self::callProtectedMethod($client, 'buildUri', 'https://api.twilio.com'));

        $client->setEdge();
        $this->assertEquals('https://api.region.twilio.com',
            self::callProtectedMethod($client, 'buildUri', 'https://api.twilio.com'));
    }

    public function testRegionInUrl(): void {
        $client = new Client('username', 'password');

        $this->assertEquals('https://api.urlRegion.twilio.com',
            self::callProtectedMethod($client, 'buildUri', 'https://api.urlRegion.twilio.com'));

        $client->setEdge('edge');
        $this->assertEquals('https://api.edge.urlRegion.twilio.com',
            self::callProtectedMethod($client, 'buildUri', 'https://api.urlRegion.twilio.com'));

        $client = new Client('username', 'password', null, 'region');
        $client->setEdge('edge');
        $this->assertEquals('https://api.edge.region.twilio.com',
            self::callProtectedMethod($client, 'buildUri', 'https://api.urlRegion.twilio.com'));

        $client->setEdge();
        $this->assertEquals('https://api.region.twilio.com',
            self::callProtectedMethod($client, 'buildUri', 'https://api.urlRegion.twilio.com'));
    }

    public function testRegionAndEdgeInUrl(): void {
        $client = new Client('username', 'password');

        $this->assertEquals('https://api.urlEdge.urlRegion.twilio.com',
            self::callProtectedMethod($client, 'buildUri', 'https://api.urlEdge.urlRegion.twilio.com'));

        $client->setEdge('edge');
        $this->assertEquals('https://api.edge.urlRegion.twilio.com',
            self::callProtectedMethod($client, 'buildUri', 'https://api.urlEdge.urlRegion.twilio.com'));

        $client = new Client('username', 'password', null, 'region');
        $client->setEdge('edge');
        $this->assertEquals('https://api.edge.region.twilio.com',
            self::callProtectedMethod($client, 'buildUri', 'https://api.urlEdge.urlRegion.twilio.com'));

        $client->setEdge();
        $this->assertEquals('https://api.urlEdge.region.twilio.com',
            self::callProtectedMethod($client, 'buildUri', 'https://api.urlEdge.urlRegion.twilio.com'));
    }

    public function testRegionAndEdgeEnvVars(): void {
        $client = new Client('username', 'password', null, null, null, [
            Client::ENV_REGION => 'region',
            Client::ENV_EDGE => 'edge'
        ]);
        $this->assertEquals('https://api.edge.region.twilio.com/path/to/something.json?foo=12.34',
            self::callProtectedMethod($client, 'buildUri', 'https://api.urlEdge.urlRegion.twilio.com/path/to/something.json?foo=12.34'));
    }

    public function testActivatingLoggingPulledFromEnvironment(): void {
        $client = new Client('username', 'password', null, null, null, [
            Client::ENV_LOG => 'debug'
        ]);
        $this->assertEquals('debug', $client->getLogLevel());
    }

    public function testActivatingLoggingThroughSetterOverEnvironment(): void {
        $client = new Client('username', 'password', null, null, null, [
            Client::ENV_LOG => 'info'
        ]);
        $client->setLogLevel('debug');
        $this->assertEquals('debug', $client->getLogLevel());
    }

    public function testDebugLogging(): void {
        $capturedLogging = tmpfile();
        ini_set('error_log', stream_get_meta_data($capturedLogging)['uri']);
        $client = new Client('username', 'password', null, null, null, [
            Client::ENV_LOG => 'debug'
        ]);
        $client->request('GET', 'http://api.twilio.com', [], [], ['test-header' => 'test header value'], 'test-user', 'test-password');
        $this->assertStringContainsString('test header value', stream_get_contents($capturedLogging));
    }

    public function testAuthorizationHeaderRemoval(): void {
        $capturedLogging = tmpfile();
        ini_set('error_log', stream_get_meta_data($capturedLogging)['uri']);
        $client = new Client('username', 'password', null, null, null, [
            Client::ENV_LOG => 'debug'
        ]);
        $client->request('GET', 'http://api.twilio.com', [], [], ['Authorization-header' => 'auth header value','test-header' => 'test header value'], 'test-user', 'test-password');
        $this->assertStringNotContainsString('Authorization-header', stream_get_contents($capturedLogging));
    }

    public function testDefaultUserAgent(): void {
        $client = new Client('username', 'password');
        $client->request('GET', 'https://api.twilio.com');
        $userAgent = $client->getHttpClient()->{'lastRequest'}[CURLOPT_HTTPHEADER][0];
        $this->assertRegExp('/^User-Agent: twilio-php\/[0-9.]+(-rc\.[0-9]+)?\s\(\w+\s\w+\)\sPHP\/[^\s]+$/',$userAgent);
    }

    public function testUserAgentExtensionsWhenSet(): void {
        $expectedExtensions = ['twilio-run/2.0.0-test', 'flex-plugin/3.4.0'];
        $client = new Client('username', 'password', null,null,null,null,$expectedExtensions);
        $client->request('GET', 'https://api.twilio.com');
        $userAgent = $client->getHttpClient()->{'lastRequest'}[CURLOPT_HTTPHEADER][0];
        $userAgentExtensions = array_slice(explode(" ",$userAgent),-count($expectedExtensions));
        $this->assertEquals($userAgentExtensions,$expectedExtensions);
    }

}