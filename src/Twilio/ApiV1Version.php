<?php

namespace Twilio;

use Twilio\Exceptions\RestException;
use Twilio\Exceptions\RestExceptionV1;
use Twilio\Exceptions\TwilioException;
use Twilio\Http\Response;

class ApiV1Version extends Version {

    protected $apiVersion;

    /**
     * @param Domain $domain
     * @param ?string $version
     */
    public function __construct(Domain $domain, ?string $version) {
        parent::__construct($domain);
        $this->version = $version;
        $this->apiVersion = "V1";
    }

    /**
     * Create the best possible exception for the response as per Twilio API Standard V1.
     *
     * Attempts to parse the response for Twilio Standard error as defined in Twilio API Standards V1
     * and use those to populate the exception, falls back to generic error message and
     * HTTP status code.
     *
     * @param Response $response Error response
     * @param string $header Header for exception message
     * @return TwilioException
     */
    protected function exception(Response $response, string $header): TwilioException {
        $message = '[HTTP ' . $response->getStatusCode() . '] ' . $header;

        $content = $response->getContent();
        if (\is_array($content)) {
            $message .= isset($content['message']) ? ': ' . $content['message'] : '';
            $code = $content['code'] ?? $response->getStatusCode();
            $httpStatusCode = $content['httpStatusCode'] ?? $response->getStatusCode();
            $params = $content['params'] ?? [];
            $userError = $content['userError'] ?? false;
            return new RestExceptionV1($code, $message, $httpStatusCode, $params, $userError);
        }

        return new RestExceptionV1($response->getStatusCode(), $message, $response->getStatusCode());
    }
}
