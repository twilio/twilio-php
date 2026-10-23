<?php


namespace Twilio\Http;


final class RequestHeaders {
    private function __construct() {}

    public static function validate(array $headers): array {
        foreach ($headers as $name => $value) {
            if (!\is_string($name) || $name === '') {
                throw new \InvalidArgumentException('Header names must be non-empty strings.');
            }

            if (!\is_string($value)) {
                throw new \InvalidArgumentException('Header values must be strings.');
            }
        }

        return $headers;
    }

    public static function toCurlHeaders(array $headers): array {
        $result = [];

        foreach (self::validate($headers) as $name => $value) {
            $result[] = $name . ': ' . $value;
        }

        return $result;
    }
}
