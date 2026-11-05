<?php


namespace Twilio\Tests\Unit\Http;


use Twilio\Exceptions\EnvironmentException;
use Twilio\Http\CurlClient;
use Twilio\Http\DistrustedIntermediates;
use Twilio\Tests\Unit\UnitTest;

class DistrustedIntermediatesTest extends UnitTest {
    private $dir;
    private $server;
    private $port;
    private $rootPem;
    private $intermediateDer;

    protected function setUp(): void {
        parent::setUp();
        $this->dir = \sys_get_temp_dir() . '/twilio-distrust-' . \bin2hex(\random_bytes(6));
        \mkdir($this->dir);
    }

    protected function tearDown(): void {
        if (\is_resource($this->server)) {
            \proc_terminate($this->server);
            \proc_close($this->server);
        }
        foreach (\glob($this->dir . '/*') ?: [] as $file) {
            \unlink($file);
        }
        @\rmdir($this->dir);
        parent::tearDown();
    }

    public function testDistrustedListHasEightSha256Hashes(): void {
        $this->assertCount(8, DistrustedIntermediates::DISTRUSTED_SPKI_SHA256);
        foreach (DistrustedIntermediates::DISTRUSTED_SPKI_SHA256 as $hash) {
            $this->assertMatchesRegularExpression('/\A[0-9a-f]{64}\z/', $hash);
        }
    }

    public function testSpkiHashMatchesTheEncodedPublicKey(): void {
        $this->createChain();
        $pem = \openssl_pkey_get_details(\openssl_pkey_get_public(\file_get_contents($this->dir . '/intermediate.pem')))['key'];

        $this->assertSame(
            \hash('sha256', DistrustedIntermediates::pemToDer($pem)),
            DistrustedIntermediates::spkiSha256Hex($this->intermediateDer)
        );
    }

    public function testContainsDistrusted(): void {
        $this->createChain();
        $hash = DistrustedIntermediates::spkiSha256Hex($this->intermediateDer);

        $this->assertFalse(DistrustedIntermediates::containsDistrusted([$this->intermediateDer]));
        $this->assertTrue(DistrustedIntermediates::containsDistrusted([$this->intermediateDer], [$hash]));
    }

    public function testCheckChainThrowsForDistrustedCertificate(): void {
        $this->createChain();
        $hash = DistrustedIntermediates::spkiSha256Hex($this->intermediateDer);

        $this->expectException(EnvironmentException::class);
        DistrustedIntermediates::checkChain([$this->intermediateDer], [$hash]);
    }

    public function testCleanChainIsAllowed(): void {
        $this->startServer();
        $client = new CurlClient([CURLOPT_CAINFO => $this->rootPem]);

        foreach (['localhost', '127.0.0.1'] as $host) {
            $response = $client->request('GET', "https://$host:{$this->port}/");
            $this->assertSame(200, $response->getStatusCode());
        }
    }

    public function testDistrustedIntermediateIsRefusedBeforeAnyRequestIsSent(): void {
        $this->startServer();
        $hash = DistrustedIntermediates::spkiSha256Hex($this->intermediateDer);
        $client = new CurlClient([CURLOPT_CAINFO => $this->rootPem], [$hash]);

        for ($i = 0; $i < 3; $i++) {
            try {
                $client->request('POST', "https://localhost:{$this->port}/", [], ['Body' => 'secret'], [], 'user', 'password');
                $this->fail('Expected the distrusted chain to be refused');
            } catch (EnvironmentException $e) {
                $this->assertStringContainsString('distrusted intermediate', $e->getMessage());
            }
        }

        $this->assertFileDoesNotExist($this->dir . '/requests.log');
    }

    public function testChainThatIsValidForTheHostIsStillRefusedWhenDistrusted(): void {
        $this->startServer();
        $hash = DistrustedIntermediates::spkiSha256Hex($this->intermediateDer);

        $allowed = new CurlClient([CURLOPT_CAINFO => $this->rootPem]);
        $this->assertSame(200, $allowed->request('GET', "https://127.0.0.1:{$this->port}/")->getStatusCode());

        $refused = new CurlClient([CURLOPT_CAINFO => $this->rootPem], [$hash]);
        $this->expectException(EnvironmentException::class);
        $refused->request('GET', "https://127.0.0.1:{$this->port}/");
    }

    public function testProxiedRequestsAreCheckedAfterTheHandshake(): void {
        $this->startServer();
        $hash = DistrustedIntermediates::spkiSha256Hex($this->intermediateDer);
        // A proxy setting skips the pre-flight chain fetch, leaving only the check on the chain curl verified.
        $client = new CurlClient(
            [CURLOPT_CAINFO => $this->rootPem, CURLOPT_PROXY => "http://127.0.0.1:{$this->port}", CURLOPT_NOPROXY => 'localhost'],
            [$hash]
        );

        $this->expectException(EnvironmentException::class);
        $this->expectExceptionMessage('distrusted intermediate');
        $client->request('GET', "https://localhost:{$this->port}/");
    }

    private function createChain(): void {
        $config = $this->dir . '/openssl.cnf';
        \file_put_contents($config, "[req]\ndistinguished_name=dn\n[dn]\n"
            . "[v3_ca]\nbasicConstraints=critical,CA:TRUE\n"
            . "[v3_leaf]\nbasicConstraints=CA:FALSE\nsubjectAltName=DNS:localhost,IP:127.0.0.1\n");
        $keyOptions = ['private_key_bits' => 2048, 'private_key_type' => OPENSSL_KEYTYPE_RSA, 'config' => $config];

        $rootKey = \openssl_pkey_new($keyOptions);
        $root = \openssl_csr_sign(\openssl_csr_new(['commonName' => 'Test Root'], $rootKey, ['config' => $config]), null, $rootKey, 1,
            ['config' => $config, 'x509_extensions' => 'v3_ca', 'digest_alg' => 'sha256'], 1);

        $intermediateKey = \openssl_pkey_new($keyOptions);
        $intermediate = \openssl_csr_sign(\openssl_csr_new(['commonName' => 'Test Intermediate'], $intermediateKey, ['config' => $config]),
            $root, $rootKey, 1, ['config' => $config, 'x509_extensions' => 'v3_ca', 'digest_alg' => 'sha256'], 2);

        $leafKey = \openssl_pkey_new($keyOptions);
        $leaf = \openssl_csr_sign(\openssl_csr_new(['commonName' => 'localhost'], $leafKey, ['config' => $config]),
            $intermediate, $intermediateKey, 1, ['config' => $config, 'x509_extensions' => 'v3_leaf', 'digest_alg' => 'sha256'], 3);

        \openssl_x509_export($root, $rootPem);
        \openssl_x509_export($intermediate, $intermediatePem);
        \openssl_x509_export($leaf, $leafPem);
        \openssl_pkey_export($leafKey, $leafKeyPem, null, ['config' => $config]);

        $this->rootPem = $this->dir . '/root.pem';
        \file_put_contents($this->rootPem, $rootPem);
        \file_put_contents($this->dir . '/intermediate.pem', $intermediatePem);
        \file_put_contents($this->dir . '/server.pem', $leafPem . $intermediatePem . $leafKeyPem);
        $this->intermediateDer = DistrustedIntermediates::pemToDer($intermediatePem);
    }

    /**
     * Starts a TLS server in a child process that serves the generated chain and logs every request it receives.
     */
    private function startServer(): void {
        $this->createChain();
        $script = $this->dir . '/server.php';
        \file_put_contents($script, <<<'PHP'
<?php
$context = stream_context_create(['ssl' => ['local_cert' => $argv[1], 'verify_peer' => false]]);
$server = stream_socket_server('ssl://127.0.0.1:0', $errno, $errstr, STREAM_SERVER_BIND | STREAM_SERVER_LISTEN, $context);
echo explode(':', stream_socket_get_name($server, false))[1], "\n";
while (true) {
    $client = @stream_socket_accept($server, 30);
    if (!$client) {
        continue;
    }
    $request = '';
    while (strpos($request, "\r\n\r\n") === false && ($chunk = @fread($client, 8192)) !== false && $chunk !== '') {
        $request .= $chunk;
    }
    if ($request !== '') {
        file_put_contents($argv[2], $request . "\n", FILE_APPEND);
        fwrite($client, "HTTP/1.1 200 OK\r\nContent-Type: application/json\r\nContent-Length: 2\r\nConnection: close\r\n\r\n{}");
    }
    fclose($client);
}
PHP
        );

        $pipes = [];
        $this->server = \proc_open(
            [PHP_BINARY, $script, $this->dir . '/server.pem', $this->dir . '/requests.log'],
            [1 => ['pipe', 'w'], 2 => ['file', '/dev/null', 'w']],
            $pipes
        );
        $this->port = (int)\trim((string)\fgets($pipes[1]));
        $this->assertGreaterThan(0, $this->port, 'The test TLS server did not start');
    }
}
