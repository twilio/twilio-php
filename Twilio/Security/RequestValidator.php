<?php

namespace Twilio\Security;

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

    public function __construct($authToken) {
        $this->authToken = $authToken;
    }

    /**
     * Creates the actual base64 encoded signature of the sha1 hash of the concatenated URL and your auth token
     * @param string $url the full URL of the request URL you specify for your phone number or app, from the protocol (https...) through the end of the query string (everything after the ?)
     * @param array $data the Twilio parameters the request was made with
     * @return string 
     */

    public function computeSignature($url, $data = array()) {

        // sort the array by keys
        \ksort($data);

        // append them to the data string in order
        // with no delimiters
        foreach ($data as $key => $value) {
            $url .= $key.$value;
        }

        // sha1 then base64 the url to the auth token and return the base64-ed string
        return \base64_encode(\hash_hmac('sha1', $url, $this->authToken, true));

    }

    /**
     * Converts the raw binary output to a hexadecimal return
     * @param string $data
     * @return string 
     */

    public static function computeBodyHash($data = '') {
        return \bin2hex(\hash('sha256', $data, true));
    }

    /**
     * The only method the client should be running...takes the Twilio signature, their URL, and the Twilio params and validates the signature
     * @param string $expectedSignature
     * @param string $url
     * @param array $data
     * @return bool 
     */

    public function validate($expectedSignature, $url, $data = array()) {

        if (\is_array($data)) {

            return self::compare(
                $this->computeSignature($url, $data),
                $expectedSignature
            );

        } else {

            // handling if the data was passed through as a string instead of an array of params
            $queryString = \explode('?', $url);
            $queryString = $queryString[1];
            \parse_str($queryString, $params);

            return self::compare(
                $this->computeSignature($url),
                $expectedSignature
            ) && self::compare(
                self::computeBodyHash($data),
                $params['bodySHA256']
            );

        }

    }

    /**
     * Time insensitive compare, function's runtime is governed by the length
     * of the first argument, not the difference between the arguments.
     * @param $a string First part of the comparison pair
     * @param $b string Second part of the comparison pair
     * @return bool True if $a === $b, false otherwise.
     */
    public static function compare($a, $b) {

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

}
