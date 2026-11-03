<?php

namespace Twilio\Tests\Unit;

use Twilio\Security\RequestValidator;

class RequestValidatorTest extends UnitTest {
    /** @var RequestValidator */
    private $validator;
    private $params = [
        'CallSid' => 'CA1234567890ABCDE',
        'Caller' => '+14158675309',
        'Digits' => '1234',
        'From' => '+14158675309',
        'To' => '+18005551212',
    ];
    private $url = 'https://mycompany.com/myapp.php?foo=1&bar=2';
    private $signature = 'RSOYDt4T1cUTdK1PDd93/VVr8B8=';
    private $body = '{"property": "value", "boolean": true}';
    private $bodyHash = '0a1ff7634d9ab3b95db5c9a2dfe9416e41502b283a80c7cf19632632f96e6620';

    public function setUp(): void {
        $this->validator = new RequestValidator('12345');
    }

    public function testValidate(): void {
        $isValid = $this->validator->validate($this->signature, $this->url, $this->params);
        $this->assertTrue($isValid);
    }

    public function testFailsWhenIncorrect(): void {
        $isValid = $this->validator->validate('FAIL', $this->url, $this->params);
        $this->assertFalse($isValid);
    }

    public function testValidateWithArrayAndDuplicates(): void {
        $paramsWithArray = [
            'Sid' => 'CA123',
            'SidAccount' => 'AC123',
            'Digits' => ['5678', '1234', '1234'],
        ];
        $signatureWithArray = 'IK+Dwps556ElfBT0I3Rgjkr1wJU=';
        $isValid = $this->validator->validate($signatureWithArray, $this->url, $paramsWithArray);
        $this->assertTrue($isValid);
    }

    public function testValidateBody(): void {
        $hash = $this->validator->computeBodyHash($this->body);
        $this->assertEquals($this->bodyHash, $hash);
    }

    public function testValidateWithBody(): void {
        $url = $this->url . '&bodySHA256=' . $this->bodyHash;
        $signatureWithHash = 'a9nBmqA0ju/hNViExpshrM61xv4=';

        $isValid = $this->validator->validate($signatureWithHash, $url, $this->body);
        $this->assertTrue($isValid);
    }

    public function testValidateBodyWithoutSignature(): void {
        $isValid = $this->validator->validate($this->signature, $this->url, $this->body);

        $this->assertFalse($isValid);
    }

    public function testValidateRemovesPortHttps(): void {
        $url = \str_replace('.com', '.com:1234', $this->url);
        $isValid = $this->validator->validate($this->signature, $url, $this->params);
        $this->assertTrue($isValid);
    }

    public function testValidateRemovesPortHttp(): void {
        $url = \str_replace('.com', '.com:1234', $this->url);
        $url = \str_replace('https', 'http', $url);
        $signature = 'Zmvh+3yNM1Phv2jhDCwEM3q5ebU=';  // hash of http url with port 1234
        $isValid = $this->validator->validate($signature, $url, $this->params);
        $this->assertTrue($isValid);
    }

    public function testValidateAddsPortHttps(): void {
        $signature = 'kvajT1Ptam85bY51eRf/AJRuM3w=';  // hash of https url with port 443
        $isValid = $this->validator->validate($signature, $this->url, $this->params);
        $this->assertTrue($isValid);
    }

    public function testValidateAddsPortHttp(): void {
        $url = \str_replace('https', 'http', $this->url);
        $signature = '0ZXoZLH/DfblKGATFgpif+LLRf4=';  // hash of http url with port 80
        $isValid = $this->validator->validate($signature, $url, $this->params);
        $this->assertTrue($isValid);
    }

    public function testBuildUrlCreds(): void {
        $url = 'https://user:pass@mycompany.com/myapp.php?foo=1&bar=2';
        $signature = 'CukzLTc1tT5dXEDIHm/tKBanW10='; // hash of this url
        $isValid = $this->validator->validate($signature, $url, $this->params);
        $this->assertTrue($isValid);
    }

    public function testBuildUrlWithUser(): void {
        $url = 'https://user@mycompany.com/myapp.php?foo=1&bar=2';
        $signature = '2YRLlVAflCqxaNicjMpJcSTgzSs='; // hash of this url
        $isValid = $this->validator->validate($signature, $url, $this->params);
        $this->assertTrue($isValid);
    }

    public function testBuildUrlCredsAddsPort(): void {
        $url = 'https://user:pass@mycompany.com/myapp.php?foo=1&bar=2';
        $signature = 'ZQFR1PTIZXF2MXB8ZnKCvnnA+rI='; // hash of this url with port 443
        $isValid = $this->validator->validate($signature, $url, $this->params);
        $this->assertTrue($isValid);
    }

    private function sha256Signature(string $data): string {
        return \base64_encode(\hash_hmac('sha256', $data, '12345', true));
    }

    public function testComputeSignatureSha256(): void {
        $data = $this->url;
        $params = $this->params;
        \ksort($params);
        foreach ($params as $key => $value) {
            $data .= $key . $value;
        }

        $this->assertSame(
            $this->sha256Signature($data),
            $this->validator->computeSignature($this->url, $this->params, RequestValidator::HMAC_SHA256)
        );
    }

    public function testValidateSha256(): void {
        $signature = $this->validator->computeSignature($this->url, $this->params, RequestValidator::HMAC_SHA256);

        $this->assertTrue($this->validator->validate($signature, $this->url, $this->params, RequestValidator::HMAC_SHA256));
        $this->assertTrue($this->validator->validate($signature, $this->url, $this->params, 'hmac_sha256'));
    }

    public function testSha256AndSha1AreNotInterchangeable(): void {
        $sha256Signature = $this->validator->computeSignature($this->url, $this->params, RequestValidator::HMAC_SHA256);

        $this->assertFalse($this->validator->validate($sha256Signature, $this->url, $this->params));
        $this->assertFalse($this->validator->validate($this->signature, $this->url, $this->params, RequestValidator::HMAC_SHA256));
    }

    public function testValidateDefaultsToSha1(): void {
        $this->assertTrue($this->validator->validate($this->signature, $this->url, $this->params, null));
        $this->assertTrue($this->validator->validate($this->signature, $this->url, $this->params, ''));
        $this->assertTrue($this->validator->validate($this->signature, $this->url, $this->params, RequestValidator::HMAC_SHA1));
    }

    public function testValidateUnsupportedAlgorithmReturnsFalseAndLogs(): void {
        $logFile = \tempnam(\sys_get_temp_dir(), 'twilio-log');
        $previous = \ini_set('error_log', $logFile);

        try {
            $isValid = $this->validator->validate($this->signature, $this->url, $this->params, 'HMAC_SHA512');
        } finally {
            \ini_set('error_log', $previous === false ? '' : $previous);
        }

        $this->assertFalse($isValid);
        $this->assertStringContainsString('HMAC_SHA512', (string)\file_get_contents($logFile));
        \unlink($logFile);
    }

    public function testComputeSignatureUnsupportedAlgorithmThrows(): void {
        $this->expectException(\InvalidArgumentException::class);
        $this->validator->computeSignature($this->url, $this->params, 'MD5');
    }

    public function testValidateBodySha256(): void {
        $url = $this->url . '&bodySHA256=' . $this->bodyHash;
        $signature = $this->validator->computeSignature($url, [], RequestValidator::HMAC_SHA256);

        $this->assertTrue($this->validator->validate($signature, $url, $this->body, RequestValidator::HMAC_SHA256));
        $this->assertFalse($this->validator->validate($signature, $url, '{}', RequestValidator::HMAC_SHA256));
        $this->assertFalse($this->validator->validate($signature, $url, $this->body));
    }

    public function testGetSignatureAlgorithm(): void {
        $this->assertSame('HMAC_SHA256', RequestValidator::getSignatureAlgorithm('key=webhooks_sharedkey_1,algorithm=HMAC_SHA256'));
        $this->assertSame('HMAC_SHA1', RequestValidator::getSignatureAlgorithm('algorithm=HMAC_SHA1,key=k'));
        $this->assertSame('HMAC_SHA256', RequestValidator::getSignatureAlgorithm(' key=k , algorithm = HMAC_SHA256 '));
    }

    public function testGetSignatureAlgorithmDefaultsToSha1(): void {
        foreach ([null, '', 'key=k', 'key=k,algorithm='] as $header) {
            $this->assertSame('HMAC_SHA1', RequestValidator::getSignatureAlgorithm($header));
        }
    }

    public function testHeaderConstants(): void {
        $this->assertSame('X-Twilio-Signature', RequestValidator::SIGNATURE_HEADER);
        $this->assertSame('X-Twilio-Webhooks-Signature-Settings', RequestValidator::SIGNATURE_SETTINGS_HEADER);
    }
}
