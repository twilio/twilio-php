<?php


namespace Twilio\Exceptions;


/**
 * Exception thrown when a required key is missing from a response or metadata.
 *
 * This exception is typically thrown when the expected 'key' field is not present
 * in the response data or metadata, which may indicate a malformed or incomplete response.
 *
 * Example scenarios:
 * - When parsing API responses and the 'key' field is missing.
 * - When validating metadata and a required key is not found.
 */
class KeyErrorException extends TwilioException {

}
