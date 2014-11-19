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
        return $this->hash_equals(
            $this->computeSignature($url, $data),
            $expectedSignature
        );
    }
    
    public function hash_equals($a, $b)
    {
        if (\function_exists('hash_equals')) {
            return \hash_equals($a, $b);
        }
        if (\strlen($a) !== \strlen($b)) {
            return false;
        }
        $res = 0;
        $len = \strlen($a);
        for ($i = 0; $i < $len; ++$i) {
            $res |= \ord($a[$i]) ^ \ord($b[$i]);
        }
        return $res === 0;
    }

}
