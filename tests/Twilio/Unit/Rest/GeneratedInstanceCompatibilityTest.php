<?php

namespace Twilio\Tests\Unit\Rest;

use Twilio\Domain;
use Twilio\Http\CurlClient;
use Twilio\Rest\Client;
use Twilio\Rest\Numbers\V1\PortingWebhookConfigurationDeleteInstance;
use Twilio\Rest\PreviewIam\Versionless\OrganizationInstance;
use Twilio\Rest\Voice\V1\ArchivedCallContext;
use Twilio\Rest\Voice\V1\ArchivedCallInstance;
use Twilio\Tests\Unit\UnitTest;
use Twilio\Version;

class GeneratedInstanceCompatibilityTest extends UnitTest {
    private function createVersion(): Version {
        $client = new Client('username', 'password', null, null, $this->createMock(CurlClient::class), null);
        $domain = new class($client) extends Domain {
        };

        return new class($domain) extends Version {
        };
    }

    private function withoutWarnings(callable $callback) {
        \set_error_handler(function (int $severity, string $message, string $file, int $line): void {
            throw new \ErrorException($message, 0, $severity, $file, $line);
        });

        try {
            return $callback();
        } finally {
            \restore_error_handler();
        }
    }

    public function testPortingWebhookConfigurationDeleteInstanceUsesPayloadFallback(): void {
        $output = $this->withoutWarnings(function (): string {
            $instance = new PortingWebhookConfigurationDeleteInstance(
                $this->createVersion(),
                ['webhook_type' => 'PORT_IN']
            );

            return (string) $instance;
        });

        $this->assertSame('[Twilio.Numbers.V1.PortingWebhookConfigurationDeleteInstance webhookType=PORT_IN]', $output);
    }

    public function testOrganizationInstanceUsesPayloadFallback(): void {
        $output = $this->withoutWarnings(function (): string {
            $instance = new OrganizationInstance($this->createVersion(), ['id' => 'OR123']);

            return (string) $instance;
        });

        $this->assertSame('[Twilio.PreviewIam.Versionless.OrganizationInstance organizationSid=OR123]', $output);
    }

    public function testOrganizationInstancePrefersOrganizationSidPayloadFallback(): void {
        $output = $this->withoutWarnings(function (): string {
            $instance = new OrganizationInstance(
                $this->createVersion(),
                ['organization_sid' => 'OR456', 'id' => 'OR123']
            );

            return (string) $instance;
        });

        $this->assertSame('[Twilio.PreviewIam.Versionless.OrganizationInstance organizationSid=OR456]', $output);
    }

    public function testArchivedCallInstanceUsesPayloadFallback(): void {
        $output = $this->withoutWarnings(function (): string {
            $instance = new ArchivedCallInstance(
                $this->createVersion(),
                ['date' => '2024-01-02', 'sid' => 'CA123']
            );

            return (string) $instance;
        });

        $this->assertSame('[Twilio.Voice.V1.ArchivedCallInstance date=2024-01-02 sid=CA123]', $output);
    }

    public function testArchivedCallInstanceStringifiesDateTimeSolution(): void {
        $output = $this->withoutWarnings(function (): string {
            $instance = new ArchivedCallInstance(
                $this->createVersion(),
                [],
                new \DateTime('2024-01-02'),
                'CA123'
            );

            return (string) $instance;
        });

        $this->assertSame('[Twilio.Voice.V1.ArchivedCallInstance date=2024-01-02 sid=CA123]', $output);
    }

    public function testArchivedCallContextStringifiesDateTimeSolution(): void {
        $output = $this->withoutWarnings(function (): string {
            $context = new ArchivedCallContext($this->createVersion(), new \DateTime('2024-01-02'), 'CA123');

            return (string) $context;
        });

        $this->assertSame('[Twilio.Voice.V1.ArchivedCallContext date=2024-01-02 sid=CA123]', $output);
    }
}
