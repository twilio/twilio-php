<?php


namespace Twilio\Exceptions;


class RestException extends TwilioException {
    protected $statusCode;
    protected $details;
    protected $moreInfo;

    /**
     * Construct the exception. Note: The message is NOT binary safe.
     * @link http://php.net/manual/en/exception.construct.php
     * @param string $message [optional] The Exception message to throw.
     * @param int $code [optional] The Exception code.
     * @param int $statusCode [optional] The HTTP Status code.
     * @param string $moreInfo [optional] More information about the error.
     * @param array $details [optional] Additional details about the error.
     * @since 5.1.0
     */
    public function __construct(string $message, int $code, int $statusCode, string $moreInfo = null, array $details = null) {
        $this->statusCode = $statusCode;
        $this->details = $details;
        $this->moreInfo = $moreInfo;
        parent::__construct($message, $code);
    }

    /**
     * Get the HTTP Status Code of the RestException
     * @return int HTTP Status Code
     */
    public function getStatusCode(): int {
        return $this->statusCode;
    }

    /**
     * Get more information of the RestException
     * @return string More error information
     */
    public function getMoreInfo(): string {
        return $this->moreInfo;
    }

    /**
     * Get the details of the RestException
     * @return exception details
     */
    public function getDetails(): array {
        return $this->details;
    }
}
