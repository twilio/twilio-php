<?php

class Services_Twilio_RequestValidator
{

    protected $AuthToken;

    function __construct($token)
    {
        $this->AuthToken = $token;
    }

    public function computeSignature($url, $data = array())
    {
        // sort the array by keys
        ksort($data);

        // append them to the data string in order
        // with no delimiters
        foreach($data as $key => $value)
            $url .= "$key$value";

        // This function calculates the HMAC hash of the data with the key
        // passed in
        // Note: hash_hmac requires PHP 5 >= 5.1.2 or PECL hash:1.1-1.5
        // Or http://pear.php.net/package/Crypt_HMAC/
        return base64_encode(hash_hmac("sha1", $url, $this->AuthToken, true));
    }

    public function validate($expectedSignature, $url, $data = array())
    {
        $signature = $this->computeSignature($url, $data);
        return $this->secureStringCompare($expectedSignature, $signature);
    }

    // Constant time string comparison to avoid timing attacks. Function
    // borrowed from ZendFramework.
    // https://github.com/zendframework/zf2/blob/master/library/Zend/Crypt/Utils.php
    private function secureStringCompare($expected, $actual)
    {
        $expected = (string) $expected;
        $actual = (string) $actual;
        $lenExpected = strlen($expected);
        $lenActual = strlen($actual);
        $len = min($lenExpected, $lenActual);
        $result = 0;
        for ($i = 0; $i < $len; $i++) {
            $result |= ord($expected[$i]) ^ ord($actual[$i]);
        }
        $result |= $lenExpected ^ $lenActual;
        return ($result === 0);
    }

}
