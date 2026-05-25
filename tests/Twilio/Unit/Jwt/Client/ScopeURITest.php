<?php

namespace Twilio\Tests\Unit\Jwt\Client;

use Twilio\Jwt\Client\ScopeURI;
use Twilio\Tests\Unit\UnitTest;

class ScopeURITest extends UnitTest {
    public function testParseWithParams(): void {
        $scope = ScopeURI::parse('scope:client:incoming?clientName=andy');

        $this->assertSame('client', $scope->service);
        $this->assertSame('incoming', $scope->privilege);
        $this->assertSame(['clientName' => 'andy'], $scope->params);
        $this->assertSame('scope:client:incoming?clientName=andy', $scope->toString());
    }

    public function testParseWithoutParams(): void {
        $scope = ScopeURI::parse('scope:client:incoming');

        $this->assertSame('client', $scope->service);
        $this->assertSame('incoming', $scope->privilege);
        $this->assertSame([], $scope->params);
        $this->assertSame('scope:client:incoming', $scope->toString());
    }

    public function testParseEncodedParams(): void {
        $scope = ScopeURI::parse('scope:client:outgoing?appSid=AP123&appParams=foobar%3D3');

        $this->assertSame('client', $scope->service);
        $this->assertSame('outgoing', $scope->privilege);
        $this->assertSame(['appSid' => 'AP123', 'appParams' => 'foobar=3'], $scope->params);
        $this->assertSame('scope:client:outgoing?appSid=AP123&appParams=foobar%3D3', $scope->toString());
    }

    public function testParseRejectsNonScopeUri(): void {
        $this->expectException(\UnexpectedValueException::class);

        ScopeURI::parse('client:incoming?clientName=andy');
    }

    public function testParseRejectsIncompleteScopeUri(): void {
        $this->expectException(\UnexpectedValueException::class);

        ScopeURI::parse('scope:client');
    }

    public function testParseRejectsTooManyScopeParts(): void {
        $this->expectException(\UnexpectedValueException::class);

        ScopeURI::parse('scope:client:incoming:extra');
    }
}
