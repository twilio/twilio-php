<?php


namespace Twilio\Exceptions;


class RestException extends TwilioException {
    protected $statusCode;

    /**
     * Construct the exception. Note: The message is NOT binary safe.
     * @link http://php.net/manual/en/exception.construct.php
     * @param string $message [optional] The Exception message to throw.
     * @param int $code [optional] The Exception code.
     * @param int $statusCode [optional] The HTTP Status code.
     * @since 5.1.0
     */
    public function __construct(string $message, int $code, int $statusCode) {
        $this->statusCode = $statusCode;
        parent::__construct($message, $code);
    }

    /**
     * Get the HTTP Status Code of the RestException
     * @return int HTTP Status Code
     */
    public function getStatusCode(): int {
        return $this->statusCode;
    }


}
