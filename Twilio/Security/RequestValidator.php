<?php


namespace Twilio\Security;


class RequestValidator {

    protected $authToken;

    function __construct($authToken) {
        $this->authToken = $authToken;
    }

    public function computeSignature($url, $data = array()) {
        // username and password from HTTP URLs and username, password and 
        // port from HTTPS URLs must be dropped before the calculation,
        // see https://www.twilio.com/docs/api/security#notes
        $parsed_url = parse_url($url);
        unset($parsed_url['user'], $parsed_url['pass']);

        if(isset($_SERVER['HTTPS'])) {
            if ($_SERVER['HTTPS'] != "") {
                unset($parsed_url['port']);
            }
        }

        // unparse URL for people without http_build_url()
        // see http://php.net/manual/en/function.parse-url.php#106731
        $scheme   = isset($parsed_url['scheme']) ? $parsed_url['scheme'] . '://' : ''; 
        $host     = isset($parsed_url['host']) ? $parsed_url['host'] : ''; 
        $port     = isset($parsed_url['port']) ? ':' . $parsed_url['port'] : ''; 
        $user     = isset($parsed_url['user']) ? $parsed_url['user'] : ''; 
        $pass     = isset($parsed_url['pass']) ? ':' . $parsed_url['pass']  : ''; 
        $pass     = ($user || $pass) ? "$pass@" : ''; 
        $path     = isset($parsed_url['path']) ? $parsed_url['path'] : ''; 
        $query    = isset($parsed_url['query']) ? '?' . $parsed_url['query'] : ''; 
        $fragment = isset($parsed_url['fragment']) ? '#' . $parsed_url['fragment'] : ''; 
        $url = "$scheme$user$pass$host$port$path$query$fragment"; 

        // sort the array by keys
        ksort($data);

        // append them to the data string in order
        // with no delimiters
        foreach ($data as $key => $value)
            $url .= "$key$value";

        // This function calculates the HMAC hash of the data with the key
        // passed in
        // Note: hash_hmac requires PHP 5 >= 5.1.2 or PECL hash:1.1-1.5
        // Or http://pear.php.net/package/Crypt_HMAC/
        return base64_encode(hash_hmac("sha1", $url, $this->authToken, true));
    }

    public function validate($expectedSignature, $url, $data = array()) {
        return self::compare(
            $this->computeSignature($url, $data),
            $expectedSignature
        );
    }

    /**
     * Time insensitive compare, function's runtime is governed by the length
     * of the first argument, not the difference between the arguments.
     * @param $a string First part of the comparison pair
     * @param $b string Second part of the comparison pair
     * @return bool True if $a == $b, false otherwise.
     */
    public
    static function compare($a, $b) {
        $result = true;

        if (strlen($a) != strlen($b)) {
            return false;
        }

        if (!$a && !$b) {
            return true;
        }

        $limit = strlen($a);

        for ($i = 0; $i < $limit; ++$i) {
            if ($a[$i] != $b[$i]) {
                $result = false;
            }
        }

        return $result;
    }

}
