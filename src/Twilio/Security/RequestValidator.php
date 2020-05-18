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
final class RequestValidator {

    /**
     * @access private
     * @var string The auth token to the Twilio Account
     */
    private $authToken;

    /**
     * constructor
     * @access public
     * @param string $authToken the auth token of the Twilio user's account
     * Sets the account auth token to be used by the rest of the class
     */
    public function __construct(string $authToken) {
        $this->authToken = $authToken;
    }

    /**
     * Creates the actual base64 encoded signature of the sha1 hash of the concatenated URL and your auth token
     *
     * @param string $url the full URL of the request URL you specify for your phone number or app, from the protocol (https...) through the end of the query string (everything after the ?)
     * @param array $data the Twilio parameters the request was made with
     * @return string
     */
    public function computeSignature(string $url, array $data = []): string {
        // sort the array by keys
        \ksort($data);

        // append them to the data string in order
        // with no delimiters
        foreach ($data as $key => $value) {
            $url .= $key . $value;
        }

        // sha1 then base64 the url to the auth token and return the base64-ed string
        return \base64_encode(\hash_hmac('sha1', $url, $this->authToken, true));
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
     * @return bool
     */
    public function validate(string $expectedSignature, string $url, $data = []): bool {
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
            $this->computeSignature($urlWithPort, $data),
            $expectedSignature
        );
        $validSignatureWithoutPort = self::compare(
            $this->computeSignature($urlWithoutPort, $data),
            $expectedSignature
        );

        return $validBodyHash && ($validSignatureWithPort || $validSignatureWithoutPort);
    }

    /**
     * Time insensitive compare, function's runtime is governed by the length
     * of the first argument, not the difference between the arguments.
     *
     * @param string $a First part of the comparison pair
     * @param string $b Second part of the comparison pair
     * @return bool True if $a === $b, false otherwise.
     */
    public static function compare(?string $a, ?string $b): bool {
        // if the strings are different lengths, obviously they're invalid
        if (\strlen($a) !== \strlen($b)) {
            return false;
        }

        if (!$a && !$b) {
            return true;
        }

        $limit = \strlen($a);

        // checking every character for an exact difference, if you find one, return false
        for ($i = 0; $i < $limit; ++$i) {
            if ($a[$i] !== $b[$i]) {
                return false;
            }
        }

        // there have been no differences found
        return true;
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

