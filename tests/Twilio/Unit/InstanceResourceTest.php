<?php

namespace Twilio\Tests\Unit;

use Twilio\Http\CurlClient;
use Twilio\InstanceResource;
use Twilio\Rest\Client;
use Twilio\Version;

class TestInstance extends InstanceResource {
    public function __construct(Version $version) {
        parent::__construct($version);

        $this->properties = [
            'someKey' => 'someValue'
        ];
    }
}

class InstanceResourceTest extends UnitTest {
    protected $curlClient;
    /** @var Client $client */
    protected $client;
    /** @var TestDomain $domain */
    protected $domain;
    /** @var TestVersion $version */
    protected $version;

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp(): void {
        $this->curlClient = $this->createMock(CurlClient::class);
        $this->client = new Client('username', 'password', null, null, $this->curlClient, null);
        $this->domain = new TestDomain($this->client);
        $this->version = new TestVersion($this->domain);
    }

    public function testIsset(): void {
        $resource = new TestInstance($this->version);
        $this->assertTrue(isset($resource->someKey));
        $this->assertFalse(isset($resource->someOtherKey));
    }
}
