<?php


namespace Twilio\Http;


use Twilio\Exceptions\EnvironmentException;

/**
 * Refuses TLS connections whose certificate chain contains one of eight intermediate certificates that are no
 * longer trustworthy.
 *
 * The private keys of these intermediates are weak, so anyone can use them to issue a certificate that a default
 * trust store accepts. This is the same list Go distrusts as of Go 1.27.3 and 1.26.10 (CVE-2026-111943,
 * golang/go#82345). Each certificate is identified by the SHA-256 hash of its DER-encoded SubjectPublicKeyInfo.
 *
 * CurlClient applies this check. A client you build yourself, including a GuzzleClient, doesn't; call
 * DistrustedIntermediates::checkChain() with the server's certificates to opt in.
 */
final class DistrustedIntermediates {
    // Copied from Go commit 7f86f957633ee31a1c17a1eb8452ca7a3d9bc141 (src/crypto/x509/verify.go).
    public const DISTRUSTED_SPKI_SHA256 = [
        'ebed6475c2c2d80fcb199f3fe8dd6e6b3ce60b77eb15d4e42c3dec0c6f5b5105',
        '49dd353dc2b919a3770645117d0e60c16115e7d1bc259eefe734b00ea434fe5f',
        'e0254c7fcdc265e2f0f8a428dabb75ab4ae039b4872d62f5ee57f0877d5a8a41',
        '5c0660a2b164910d8ff589c18e14552e9e0ec237dcefe2cb736d41a4811f81a0',
        '43bffa19d6ef651451f6841e019931e96f6f2eaeff28ab4b6f1ce4576de2717b',
        '63ecefee431d49523bc1136c4e72d0206a477086caf606cd5cf025686c109cf8',
        'ec4ffa1ad0ac88081314b7aaffef6a91f97cd57291bb5ba686c5415f5eb4f6b6',
        '92c063d67e8f14db71d288e11266ffdaf69cbf115f7bab14f3bc2f68d25e0e30',
    ];

    private function __construct() {
    }

    /**
     * Throw if any certificate in the chain is distrusted.
     *
     * @param string[] $derCertificates DER-encoded certificates
     * @param string[]|null $distrusted SPKI SHA-256 hashes, defaults to DISTRUSTED_SPKI_SHA256
     * @throws EnvironmentException
     */
    public static function checkChain(array $derCertificates, ?array $distrusted = null): void {
        if (self::containsDistrusted($derCertificates, $distrusted)) {
            throw new EnvironmentException('Certificate chain contains a distrusted intermediate certificate');
        }
    }

    /**
     * @param string[] $derCertificates DER-encoded certificates
     * @param string[]|null $distrusted SPKI SHA-256 hashes, defaults to DISTRUSTED_SPKI_SHA256
     */
    public static function containsDistrusted(array $derCertificates, ?array $distrusted = null): bool {
        $distrusted = $distrusted ?? self::DISTRUSTED_SPKI_SHA256;
        foreach ($derCertificates as $der) {
            if (\in_array(self::spkiSha256Hex($der), $distrusted, true)) {
                return true;
            }
        }
        return false;
    }

    public static function spkiSha256Hex(string $derCertificate): string {
        return \hash('sha256', self::subjectPublicKeyInfo($derCertificate));
    }

    public static function pemToDer(string $pem): string {
        $body = \preg_replace('/-----(BEGIN|END)[^-]*-----|\s+/', '', $pem);
        return (string)\base64_decode($body, true);
    }

    /**
     * Go hashes the SubjectPublicKeyInfo bytes exactly as they appear in the certificate, so read them from the
     * TBSCertificate instead of re-encoding the parsed key.
     *
     * TBSCertificate ::= SEQUENCE { version [0] EXPLICIT OPTIONAL, serialNumber, signature, issuer, validity,
     *                               subject, subjectPublicKeyInfo, ... }
     */
    public static function subjectPublicKeyInfo(string $derCertificate): string {
        // Certificate ::= SEQUENCE { tbsCertificate, signatureAlgorithm, signature }
        [$certOffset] = self::readHeader($derCertificate, 0, 0x30);
        [$tbsOffset] = self::readHeader($derCertificate, $certOffset, 0x30);

        $offset = $tbsOffset;
        if (isset($derCertificate[$offset]) && \ord($derCertificate[$offset]) === 0xa0) {
            $offset = self::skip($derCertificate, $offset);
        }
        for ($i = 0; $i < 5; $i++) {
            $offset = self::skip($derCertificate, $offset);
        }

        [$contentOffset, $length] = self::readHeader($derCertificate, $offset, 0x30);
        return \substr($derCertificate, $offset, $contentOffset + $length - $offset);
    }

    private static function skip(string $der, int $offset): int {
        [$contentOffset, $length] = self::readHeader($der, $offset, -1);
        return $contentOffset + $length;
    }

    /**
     * Returns [contentOffset, contentLength] for the DER element at $offset. $expectedTag is -1 to accept any tag.
     */
    private static function readHeader(string $der, int $offset, int $expectedTag): array {
        $size = \strlen($der);
        if ($offset + 2 > $size) {
            throw new EnvironmentException('Truncated DER element');
        }
        $tag = \ord($der[$offset]);
        if (($tag & 0x1f) === 0x1f || ($expectedTag !== -1 && $tag !== $expectedTag)) {
            throw new EnvironmentException('Unexpected DER tag ' . $tag);
        }
        $length = \ord($der[$offset + 1]);
        $contentOffset = $offset + 2;
        if ($length >= 0x80) {
            $lengthBytes = $length & 0x7f;
            if ($lengthBytes === 0 || $lengthBytes > 3 || $contentOffset + $lengthBytes > $size) {
                throw new EnvironmentException('Unsupported DER length');
            }
            $length = 0;
            for ($i = 0; $i < $lengthBytes; $i++) {
                $length = ($length << 8) | \ord($der[$contentOffset++]);
            }
        }
        if ($contentOffset + $length > $size) {
            throw new EnvironmentException('Truncated DER element');
        }
        return [$contentOffset, $length];
    }
}
