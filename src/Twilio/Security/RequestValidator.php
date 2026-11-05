<?php

namespace Twilio\Security;

use Twilio\Values;

/**
 * RequestValidator is a helper to validate that a request to a web server was actually made from Twilio
 * EXAMPLE USAGE:
 * $validator = new RequestValidator('your auth token here');
 * $isFromTwilio = $validator->validate($_SERVER['HTTP_X_TWILIO_SIGNATURE'], 'https://your-example-url.com/api/route/', $_REQUEST);
 * $isFromTwilio // <- if this is true, the request did come from Twilio, if not, it didn't
 */
class RequestValidator {

    /** Header that carries the webhook signature. */
    public const SIGNATURE_HEADER = 'X-Twilio-Signature';
    /** Header Twilio adds to webhooks signed with a SharedKey: key=<sharedKeyId>,algorithm=<algorithm> */
    public const SIGNATURE_SETTINGS_HEADER = 'X-Twilio-Webhooks-Signature-Settings';
    public const HMAC_SHA1 = 'HMAC_SHA1';
    public const HMAC_SHA256 = 'HMAC_SHA256';

    private const HASH_ALGORITHMS = [
        self::HMAC_SHA1 => 'sha1',
        self::HMAC_SHA256 => 'sha256',
    ];

    /**
     * @access private
     * @var string The auth token to the Twilio Account
     */
    private $authToken;

    /**
     * constructor
     * @access public
     * @param string $authToken the secret the webhook was signed with: the auth token of the Twilio user's account,
     * or the SharedKey secret when the request carries the X-Twilio-Webhooks-Signature-Settings header
     * Sets the secret to be used by the rest of the class
     */
    public function __construct(string $authToken) {
        $this->authToken = $authToken;
    }

    /**
     * Returns the signing algorithm named in the X-Twilio-Webhooks-Signature-Settings header. A missing or empty
     * header (or one without "algorithm=") means the legacy Auth Token signature, HMAC_SHA1.
     *
     * @param string|null $signatureSettingsHeader e.g. "key=webhooks_sharedkey_...,algorithm=HMAC_SHA256"
     * @return string the algorithm name
     */
    public static function getSignatureAlgorithm(?string $signatureSettingsHeader): string {
        foreach (\explode(',', (string)$signatureSettingsHeader) as $part) {
            $keyValue = \explode('=', $part, 2);
            if (\count($keyValue) === 2 && \trim($keyValue[0]) === 'algorithm' && \trim($keyValue[1]) !== '') {
                return \trim($keyValue[1]);
            }
        }
        return self::HMAC_SHA1;
    }

    /**
     * Maps an algorithm name to a PHP hash name, or null when unsupported. Null or empty means HMAC_SHA1.
     */
    private static function hashName(?string $algorithm): ?string {
        if ($algorithm === null || $algorithm === '') {
            return self::HASH_ALGORITHMS[self::HMAC_SHA1];
        }
        return self::HASH_ALGORITHMS[\strtoupper($algorithm)] ?? null;
    }

    /**
     * Creates the actual base64 encoded signature of the HMAC hash of the concatenated URL and your secret
     *
     * @param string $url the full URL of the request URL you specify for your phone number or app, from the protocol (https...) through the end of the query string (everything after the ?)
     * @param array $data the Twilio parameters the request was made with
     * @param string|null $algorithm HMAC_SHA1 (default) or HMAC_SHA256
     * @return string
     * @throws \InvalidArgumentException if the algorithm is not supported
     */
    public function computeSignature(string $url, array $data = [], ?string $algorithm = null): string {
        $hashName = self::hashName($algorithm);
        if ($hashName === null) {
            throw new \InvalidArgumentException('Unsupported webhook signature algorithm: ' . $algorithm);
        }

        // sort the array by keys
        \ksort($data);

        foreach ($data as $key => $value) {
            // convert a single value to an array or remove any duplicates
            $valueArray = \is_array($value) ? \array_unique($value) : array($value);
            // also sort all the values
            \sort($valueArray);

            // append them to the data string with no delimiters
            foreach ($valueArray as $item) {
                $url .= $key . $item;
            }
        }

        // hmac the url with the secret and return the base64-ed string
        return \base64_encode(\hash_hmac($hashName, $url, $this->authToken, true));
    }

    /**
     * Converts the raw binary output to a hexadecimal return
     *
     * @param string $data
     * @return string
     */
    public static function computeBodyHash(string $data = ''): string {
        return \bin2hex(\hash('sha256', $data, true));
    }

    /**
     * The only method the client should be running...takes the Twilio signature, their URL, and the Twilio params and validates the signature
     *
     * @param string $expectedSignature
     * @param string $url
     * @param array|string $data
     * @param string|null $algorithm HMAC_SHA1 (default) or HMAC_SHA256, see getSignatureAlgorithm().
     *                               An unsupported algorithm fails validation and is logged.
     * @return bool
     */
    public function validate(string $expectedSignature, string $url, $data = [], ?string $algorithm = null): bool {
        if (self::hashName($algorithm) === null) {
            \error_log(
                "[Twilio] Unsupported webhook signature algorithm '" . $algorithm . "'. Supported: "
                . self::HMAC_SHA1 . ', ' . self::HMAC_SHA256 . '. Upgrade twilio-php if Twilio added a new one.'
            );
            return false;
        }

        $parsedUrl = \parse_url($url);

        $urlWithPort = self::addPort($parsedUrl);
        $urlWithoutPort = self::removePort($parsedUrl);
        $validBodyHash = true;  // May not receive body hash, so default succeed

        if (!\is_array($data)) {
            // handling if the data was passed through as a string instead of an array of params
            $queryString = \explode('?', $url);
            $queryString = $queryString[1];
            \parse_str($queryString, $params);

            $validBodyHash = self::compare(self::computeBodyHash($data), Values::array_get($params, 'bodySHA256'));
            $data = [];
        }

        /*
         *  Check signature of the URL with and without port information
         *  since sig generation on the back end is inconsistent.
         */
        $validSignatureWithPort = self::compare(
            $expectedSignature,
            $this->computeSignature($urlWithPort, $data, $algorithm)
        );
        $validSignatureWithoutPort = self::compare(
            $expectedSignature,
            $this->computeSignature($urlWithoutPort, $data, $algorithm)
        );

        return $validBodyHash && ($validSignatureWithPort || $validSignatureWithoutPort);
    }

    /**
     * Time insensitive compare, function's runtime is governed by the length
     * of the first argument, not the difference between the arguments.
     *
     * @param ?string $a First part of the comparison pair
     * @param ?string $b Second part of the comparison pair
     * @return bool True if $a === $b, false otherwise.
     */
    public static function compare(?string $a, ?string $b): bool {
        if ($a && $b) {
            return hash_equals($a, $b);
        }

        return false;
    }

    /**
     * Removes the port from the URL
     *
     * @param array $parsedUrl
     * @return string Full URL without the port number
     */
    private static function removePort(array $parsedUrl): string {
        unset($parsedUrl['port']);
        return self::unparse_url($parsedUrl);
    }

    /**
     * Adds the port to the URL
     *
     * @param array $parsedUrl
     * @return string Full URL with the port number
     */
    private static function addPort(array $parsedUrl): string {
        if (!isset($parsedUrl['port'])) {
            $port = ($parsedUrl['scheme'] === 'https') ? 443 : 80;
            $parsedUrl['port'] = $port;
        }
        return self::unparse_url($parsedUrl);
    }

    /**
     * Builds the URL from its parsed component pieces
     *
     * @param array $parsedUrl
     * @return string Full URL
     */
    static function unparse_url(array $parsedUrl): string {
        $parts = [];

        $parts['scheme'] = isset($parsedUrl['scheme']) ? $parsedUrl['scheme'] . '://' : '';
        $parts['user'] = $parsedUrl['user'] ?? '';
        $parts['pass'] = isset($parsedUrl['pass']) ? ':' . $parsedUrl['pass'] : '';
        $parts['pass'] = ($parts['user'] || $parts['pass']) ? $parts['pass'] . '@' : '';
        $parts['host'] = $parsedUrl['host'] ?? '';
        $parts['port'] = isset($parsedUrl['port']) ? ':' . $parsedUrl['port'] : '';
        $parts['path'] = $parsedUrl['path'] ?? '';
        $parts['query'] = isset($parsedUrl['query']) ? '?' . $parsedUrl['query'] : '';
        $parts['fragment'] = isset($parsedUrl['fragment']) ? '#' . $parsedUrl['fragment'] : '';

        return \implode('', $parts);
    }
}
