<?php

/**
 * This code was generated by
 * \ / _    _  _|   _  _
 * | (_)\/(_)(_|\/| |(/_  v1.0.0
 * /       /
 */

namespace Twilio\Rest\Chat\V2;

use Twilio\Options;
use Twilio\Values;

abstract class CredentialOptions {
    /**
     * @param string $friendlyName A string to describe the resource
     * @param string $certificate [APN only] The URL encoded representation of the
     *                            certificate
     * @param string $privateKey [APN only] The URL encoded representation of the
     *                           private key
     * @param bool $sandbox [APN only] Whether to send the credential to sandbox
     *                      APNs
     * @param string $apiKey [GCM only] The API key for the project that was
     *                       obtained from the Google Developer console for your
     *                       GCM Service application credential
     * @param string $secret [FCM only] The Server key of your project from
     *                       Firebase console
     * @return CreateCredentialOptions Options builder
     */
    public static function create(string $friendlyName = Values::NONE, string $certificate = Values::NONE, string $privateKey = Values::NONE, bool $sandbox = Values::NONE, string $apiKey = Values::NONE, string $secret = Values::NONE): CreateCredentialOptions {
        return new CreateCredentialOptions($friendlyName, $certificate, $privateKey, $sandbox, $apiKey, $secret);
    }

    /**
     * @param string $friendlyName A string to describe the resource
     * @param string $certificate [APN only] The URL encoded representation of the
     *                            certificate
     * @param string $privateKey [APN only] The URL encoded representation of the
     *                           private key
     * @param bool $sandbox [APN only] Whether to send the credential to sandbox
     *                      APNs
     * @param string $apiKey [GCM only] The API key for the project that was
     *                       obtained from the Google Developer console for your
     *                       GCM Service application credential
     * @param string $secret [FCM only] The Server key of your project from
     *                       Firebase console
     * @return UpdateCredentialOptions Options builder
     */
    public static function update(string $friendlyName = Values::NONE, string $certificate = Values::NONE, string $privateKey = Values::NONE, bool $sandbox = Values::NONE, string $apiKey = Values::NONE, string $secret = Values::NONE): UpdateCredentialOptions {
        return new UpdateCredentialOptions($friendlyName, $certificate, $privateKey, $sandbox, $apiKey, $secret);
    }
}

class CreateCredentialOptions extends Options {
    /**
     * @param string $friendlyName A string to describe the resource
     * @param string $certificate [APN only] The URL encoded representation of the
     *                            certificate
     * @param string $privateKey [APN only] The URL encoded representation of the
     *                           private key
     * @param bool $sandbox [APN only] Whether to send the credential to sandbox
     *                      APNs
     * @param string $apiKey [GCM only] The API key for the project that was
     *                       obtained from the Google Developer console for your
     *                       GCM Service application credential
     * @param string $secret [FCM only] The Server key of your project from
     *                       Firebase console
     */
    public function __construct(string $friendlyName = Values::NONE, string $certificate = Values::NONE, string $privateKey = Values::NONE, bool $sandbox = Values::NONE, string $apiKey = Values::NONE, string $secret = Values::NONE) {
        $this->options['friendlyName'] = $friendlyName;
        $this->options['certificate'] = $certificate;
        $this->options['privateKey'] = $privateKey;
        $this->options['sandbox'] = $sandbox;
        $this->options['apiKey'] = $apiKey;
        $this->options['secret'] = $secret;
    }

    /**
     * A descriptive string that you create to describe the new resource. It can be up to 64 characters long.
     *
     * @param string $friendlyName A string to describe the resource
     * @return $this Fluent Builder
     */
    public function setFriendlyName(string $friendlyName): self {
        $this->options['friendlyName'] = $friendlyName;
        return $this;
    }

    /**
     * [APN only] The URL encoded representation of the certificate. For example,
    `-----BEGIN CERTIFICATE-----
    MIIFnTCCBIWgAwIBAgIIAjy9H849+E8wDQYJKoZIhvcNAQEF.....A==
    -----END CERTIFICATE-----`
     *
     * @param string $certificate [APN only] The URL encoded representation of the
     *                            certificate
     * @return $this Fluent Builder
     */
    public function setCertificate(string $certificate): self {
        $this->options['certificate'] = $certificate;
        return $this;
    }

    /**
     * [APN only] The URL encoded representation of the private key. For example,
    `-----BEGIN RSA PRIVATE KEY-----
    MIIEpQIBAAKCAQEAuyf/lNrH9ck8DmNyo3fG...
    -----END RSA PRIVATE KEY-----`
     *
     * @param string $privateKey [APN only] The URL encoded representation of the
     *                           private key
     * @return $this Fluent Builder
     */
    public function setPrivateKey(string $privateKey): self {
        $this->options['privateKey'] = $privateKey;
        return $this;
    }

    /**
     * [APN only] Whether to send the credential to sandbox APNs. Can be `true` to send to sandbox APNs or `false` to send to production.
     *
     * @param bool $sandbox [APN only] Whether to send the credential to sandbox
     *                      APNs
     * @return $this Fluent Builder
     */
    public function setSandbox(bool $sandbox): self {
        $this->options['sandbox'] = $sandbox;
        return $this;
    }

    /**
     * [GCM only] The API key for the project that was obtained from the Google Developer console for your GCM Service application credential.
     *
     * @param string $apiKey [GCM only] The API key for the project that was
     *                       obtained from the Google Developer console for your
     *                       GCM Service application credential
     * @return $this Fluent Builder
     */
    public function setApiKey(string $apiKey): self {
        $this->options['apiKey'] = $apiKey;
        return $this;
    }

    /**
     * [FCM only] The **Server key** of your project from the Firebase console, found under Settings / Cloud messaging.
     *
     * @param string $secret [FCM only] The Server key of your project from
     *                       Firebase console
     * @return $this Fluent Builder
     */
    public function setSecret(string $secret): self {
        $this->options['secret'] = $secret;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        $options = [];
        foreach ($this->options as $key => $value) {
            if ($value !== Values::NONE || $value !== Values::ARRAY_NONE) {
                $options[] = "$key=$value";
            }
        }
        return '[Twilio.Chat.V2.CreateCredentialOptions ' . \implode(' ', $options) . ']';
    }
}

class UpdateCredentialOptions extends Options {
    /**
     * @param string $friendlyName A string to describe the resource
     * @param string $certificate [APN only] The URL encoded representation of the
     *                            certificate
     * @param string $privateKey [APN only] The URL encoded representation of the
     *                           private key
     * @param bool $sandbox [APN only] Whether to send the credential to sandbox
     *                      APNs
     * @param string $apiKey [GCM only] The API key for the project that was
     *                       obtained from the Google Developer console for your
     *                       GCM Service application credential
     * @param string $secret [FCM only] The Server key of your project from
     *                       Firebase console
     */
    public function __construct(string $friendlyName = Values::NONE, string $certificate = Values::NONE, string $privateKey = Values::NONE, bool $sandbox = Values::NONE, string $apiKey = Values::NONE, string $secret = Values::NONE) {
        $this->options['friendlyName'] = $friendlyName;
        $this->options['certificate'] = $certificate;
        $this->options['privateKey'] = $privateKey;
        $this->options['sandbox'] = $sandbox;
        $this->options['apiKey'] = $apiKey;
        $this->options['secret'] = $secret;
    }

    /**
     * A descriptive string that you create to describe the resource. It can be up to 64 characters long.
     *
     * @param string $friendlyName A string to describe the resource
     * @return $this Fluent Builder
     */
    public function setFriendlyName(string $friendlyName): self {
        $this->options['friendlyName'] = $friendlyName;
        return $this;
    }

    /**
     * [APN only] The URL encoded representation of the certificate. For example,
    `-----BEGIN CERTIFICATE-----
    MIIFnTCCBIWgAwIBAgIIAjy9H849+E8wDQYJKoZIhvcNAQEF.....A==
    -----END CERTIFICATE-----`
     *
     * @param string $certificate [APN only] The URL encoded representation of the
     *                            certificate
     * @return $this Fluent Builder
     */
    public function setCertificate(string $certificate): self {
        $this->options['certificate'] = $certificate;
        return $this;
    }

    /**
     * [APN only] The URL encoded representation of the private key. For example,
    `-----BEGIN RSA PRIVATE KEY-----
    MIIEpQIBAAKCAQEAuyf/lNrH9ck8DmNyo3fG...
    -----END RSA PRIVATE KEY-----`
     *
     * @param string $privateKey [APN only] The URL encoded representation of the
     *                           private key
     * @return $this Fluent Builder
     */
    public function setPrivateKey(string $privateKey): self {
        $this->options['privateKey'] = $privateKey;
        return $this;
    }

    /**
     * [APN only] Whether to send the credential to sandbox APNs. Can be `true` to send to sandbox APNs or `false` to send to production.
     *
     * @param bool $sandbox [APN only] Whether to send the credential to sandbox
     *                      APNs
     * @return $this Fluent Builder
     */
    public function setSandbox(bool $sandbox): self {
        $this->options['sandbox'] = $sandbox;
        return $this;
    }

    /**
     * [GCM only] The API key for the project that was obtained from the Google Developer console for your GCM Service application credential.
     *
     * @param string $apiKey [GCM only] The API key for the project that was
     *                       obtained from the Google Developer console for your
     *                       GCM Service application credential
     * @return $this Fluent Builder
     */
    public function setApiKey(string $apiKey): self {
        $this->options['apiKey'] = $apiKey;
        return $this;
    }

    /**
     * [FCM only] The **Server key** of your project from the Firebase console, found under Settings / Cloud messaging.
     *
     * @param string $secret [FCM only] The Server key of your project from
     *                       Firebase console
     * @return $this Fluent Builder
     */
    public function setSecret(string $secret): self {
        $this->options['secret'] = $secret;
        return $this;
    }

    /**
     * Provide a friendly representation
     *
     * @return string Machine friendly representation
     */
    public function __toString(): string {
        $options = [];
        foreach ($this->options as $key => $value) {
            if ($value !== Values::NONE || $value !== Values::ARRAY_NONE) {
                $options[] = "$key=$value";
            }
        }
        return '[Twilio.Chat.V2.UpdateCredentialOptions ' . \implode(' ', $options) . ']';
    }
}