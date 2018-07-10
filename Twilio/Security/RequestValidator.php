<?php


namespace Twilio\Security;


class RequestValidator {

    protected $authToken;

    function __construct($authToken) {
        $this->authToken = $authToken;
    }

    public function computeSignature($url, $data = array()) {
        // sort the array by keys
        ksort($data);

        // append them to the data string in order
        // with no delimiters
        foreach ($data as $key => $value)
            $url .= "$key$value";

        return base64_encode(hash_hmac("sha1", $url, $this->authToken, true));
    }

    public function computeBodyHash($data = '') {
        return base64_encode(hash("sha256", $data, true));
    }

    public function validate($expectedSignature, $url, $data = array()) {
        if (is_array($data)) {
            return self::compare(
                $this->computeSignature($url, $data),
                $expectedSignature
            );
        } else {
            $queryString = explode('?', $url);
            $queryString = $queryString[1];
            parse_str($queryString, $params);

            return self::compare(
                $this->computeSignature($url),
                $expectedSignature
            ) && self::compare(
                $this->computeBodyHash($data),
                $params['bodySHA256']
            );
        }
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
