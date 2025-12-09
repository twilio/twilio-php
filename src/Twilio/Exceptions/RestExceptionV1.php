<?php


namespace Twilio\Exceptions;


class RestExceptionV1 extends TwilioException {
    protected $code;
    protected $message;
    protected $httpStatusCode;
    protected $params;
    protected $userError;

    /**
     * Construct the exception.
     * @param int $code A unique error code.
     * @param string $message A human-readable error message.
     * @param int $httpStatusCode The HTTP status code.
     * @param array $params [optional] More information about the error.
     * @param bool $userError [optional] true if it is an error that depends on the end users actions
     */
    public function __construct(int $code, string $message, int $httpStatusCode, array $params = [], bool $userError = false) {
        $this->code = $code;
        $this->message = $message;
        $this->httpStatusCode = $httpStatusCode;
        $this->params = $params;
        $this->userError = $userError;
        parent::__construct($message, $code);
    }

    /**
     * Get the HTTP Status Code of the RestException
     * @return int HTTP Status Code
     */
    public function getHttpStatusCode(): int {
        return $this->httpStatusCode;
    }

    /**
     * Get more information to additional information about the error
     * @return array additional information about the error
     */
    public function getParams(): array {
        return $this->params;
    }

    /**
     * Get the user error flag of the RestException
     * @return bool user error flag
     */
    public function getUserError(): bool {
        return $this->userError;
    }
}
