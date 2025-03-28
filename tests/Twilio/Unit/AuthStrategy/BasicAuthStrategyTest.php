<?php


namespace Twilio\Tests\Unit\AuthStrategy;

use Twilio\Tests\Unit\UnitTest;
use Twilio\AuthStrategy\BasicAuthStrategy;

class BasicAuthStrategyTest extends UnitTest {
    /**
     * @var string
     */
    private $username;
    /**
     * @var string
     */
    private $password;
    /**
     * @var BasicAuthStrategy
     */
    private $basicAuthStrategy;

    public function setUp(): void {
        parent::setUp();
        $this->username = "username";
        $this->password = "password";
        $this->basicAuthStrategy = new BasicAuthStrategy($this->username, $this->password);
    }

    public function testAuthType(): void {
        $this->assertEquals('basic', $this->basicAuthStrategy->getAuthType());
    }

    public function testAuthString(): void {
        $auth = base64_encode($this->username . ':' . $this->password);
        $this->assertEquals($auth, $this->basicAuthStrategy->getAuthString());
    }
}
