<?php

namespace Twilio\Jwt;

/**
 * JSON Web Token implementation
 *
 * Minimum implementation used by Realtime auth, based on this spec:
 * http://self-issued.info/docs/draft-jones-json-web-token-01.html.
 *
 * @author Neuman Vong <neuman@twilio.com>
 */
class JWT {
    /**
     * @param string $jwt The JWT
     * @param string|null $key The secret key
     * @param bool $verify Don't skip verification process
     * @return object The JWT's payload as a PHP object
     * @throws \DomainException
     * @throws \UnexpectedValueException
     */
    public static function decode(string $jwt, string $key = null, bool $verify = true) {
        $tks = \explode('.', $jwt);
        if (\count($tks) !== 3) {
            throw new \UnexpectedValueException('Wrong number of segments');
        }
        list($headb64, $payloadb64, $cryptob64) = $tks;
        if (null === ($header = self::jsonDecode(self::urlsafeB64Decode($headb64)))
        ) {
            throw new \UnexpectedValueException('Invalid segment encoding');
        }
        if (null === $payload = self::jsonDecode(self::urlsafeB64Decode($payloadb64))
        ) {
            throw new \UnexpectedValueException('Invalid segment encoding');
        }
        $sig = self::urlsafeB64Decode($cryptob64);
        if ($verify) {
            if (empty($header->alg)) {
                throw new \DomainException('Empty algorithm');
            }

            if (!hash_equals($sig, self::sign("$headb64.$payloadb64", $key, $header->alg))) {
                throw new \UnexpectedValueException('Signature verification failed');
            }
        }
        return $payload;
    }

    /**
     * @param string $jwt The JWT
     * @return object The JWT's header as a PHP object
     * @throws \UnexpectedValueException
     */
    public static function getHeader(string $jwt) {
        $tks = \explode('.', $jwt);
        if (\count($tks) !== 3) {
            throw new \UnexpectedValueException('Wrong number of segments');
        }
        list($headb64) = $tks;
        if (null === ($header = self::jsonDecode(self::urlsafeB64Decode($headb64)))
        ) {
            throw new \UnexpectedValueException('Invalid segment encoding');
        }
        return $header;
    }

    /**
     * @param object|array $payload PHP object or array
     * @param string $key The secret key
     * @param string $algo The signing algorithm
     * @param array $additionalHeaders Additional keys/values to add to the header
     *
     * @return string A JWT
     */
    public static function encode($payload, string $key, string $algo = 'HS256', array $additionalHeaders = []): string {
        $header = ['typ' => 'JWT', 'alg' => $algo];
        $header += $additionalHeaders;

        $segments = [];
        $segments[] = self::urlsafeB64Encode(self::jsonEncode($header));
        $segments[] = self::urlsafeB64Encode(self::jsonEncode($payload));
        $signing_input = \implode('.', $segments);

        $signature = self::sign($signing_input, $key, $algo);
        $segments[] = self::urlsafeB64Encode($signature);

        return \implode('.', $segments);
    }

    /**
     * @param string $msg The message to sign
     * @param string $key The secret key
     * @param string $method The signing algorithm
     * @return string An encrypted message
     * @throws \DomainException
     */
    public static function sign(string $msg, string $key, string $method = 'HS256'): string {
        $methods = [
            'HS256' => 'sha256',
            'HS384' => 'sha384',
            'HS512' => 'sha512',
        ];
        if (empty($methods[$method])) {
            throw new \DomainException('Algorithm not supported');
        }
        return \hash_hmac($methods[$method], $msg, $key, true);
    }

    /**
     * @param string $input JSON string
     * @return object Object representation of JSON string
     * @throws \DomainException
     */
    public static function jsonDecode(string $input) {
        $obj = \json_decode($input);
        if (\function_exists('json_last_error') && $errno = \json_last_error()) {
            self::handleJsonError($errno);
        } else if ($obj === null && $input !== 'null') {
            throw new \DomainException('Null result with non-null input');
        }
        return $obj;
    }

    /**
     * @param object|array $input A PHP object or array
     * @return string JSON representation of the PHP object or array
     * @throws \DomainException
     */
    public static function jsonEncode($input): string {
        $json = \json_encode($input);
        if (\function_exists('json_last_error') && $errno = \json_last_error()) {
            self::handleJsonError($errno);
        } else if ($json === 'null' && $input !== null) {
            throw new \DomainException('Null result with non-null input');
        }
        return $json;
    }

    /**
     * @param string $input A base64 encoded string
     *
     * @return string A decoded string
     */
    public static function urlsafeB64Decode(string $input): string {
        $padLen = 4 - \strlen($input) % 4;
        $input .= \str_repeat('=', $padLen);
        return \base64_decode(\strtr($input, '-_', '+/'));
    }

    /**
     * @param string $input Anything really
     *
     * @return string The base64 encode of what you passed in
     */
    public static function urlsafeB64Encode(string $input): string {
        return \str_replace('=', '', \strtr(\base64_encode($input), '+/', '-_'));
    }

    /**
     * @param int $errno An error number from json_last_error()
     *
     * @throws \DomainException
     */
    private static function handleJsonError(int $errno): void {
        $messages = [
            JSON_ERROR_DEPTH => 'Maximum stack depth exceeded',
            JSON_ERROR_CTRL_CHAR => 'Unexpected control character found',
            JSON_ERROR_SYNTAX => 'Syntax error, malformed JSON'
        ];
        throw new \DomainException($messages[$errno] ?? 'Unknown JSON error: ' . $errno);
    }
}
